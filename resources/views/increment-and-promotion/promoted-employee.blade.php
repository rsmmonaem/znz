@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Promoted Employee List</li>
    </ul>
@stop

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Promoted Employee List</h2>
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="entryDate">Form Date</label>
                                        <input type="date" class="form-control" id="formDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="effectiveDate">To Date</label>
                                        <input type="date" class="form-control" id="toDate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary pull-center" id="submit">Get Promoted Employee</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Add a scrollable container for the table -->
                    <div class="table-responsive" id="table-container" style="display: none">
                        <table id="salaryTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>ID No</th>
                                    <th>Name Of Employee</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Date of Joining</th>
                                    <th>Gross Salary</th>
                                    <th>Promoted Designation</th>
                                    <th>Increment Amount</th>
                                    <th>Old Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic data should populate here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- End of scrollable container -->
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
            $(document).ready(function() {
                $('#branch').on('change', function() {
                    var branch_id = $(this).val();
                    $('#employeeId').val('').trigger('change');
                    HandleBranchWiseEmployees(branch_id, '#employeeId');
                });

                const table_container = $('#table-container');
                // Fetch data via AJAX
                $('#submit').on('click', function(e) {
                    e.preventDefault();
                    $('#submit').attr("disabled", true);
                    $('#submit').text('Processing...');
                    let formData = {
                        group: $('#group').val(),
                        branch: $('#branch').val(),
                        department: $('#department').val(),
                        section: $('#section').val(),
                        employeeId: $('#employeeId').val(),
                        formDate: $('#formDate').val(),
                        toDate: $('#toDate').val()
                    };
                    $.ajax({
                    url: '/promoted-employee', // Replace with your API URL
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        table_container.removeAttr("style")
                        // Parse response and populate the table
                        $('#submit').attr("disabled", false);
                        $('#submit').text('Get Pay Sheet');
                        populateSalaryTable(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        $('#submit').attr("disabled", false);
                        $('#submit').text('Get Pay Sheet');
                    }
                   });
                })
                // Function to populate the table
                function populateSalaryTable(data) {
                    const datatable = $('#salaryTable');
                    datatable.DataTable().destroy();
                    let tableBody = $('#salaryTable tbody');
                    tableBody.empty(); // Clear existing rows

                    // Loop through the data and append rows
                    data.forEach((item, index) => {
                        // Append row to the table body
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.employee_code || 'N/A'}</td>
                                <td>${item.first_name}</td>
                                <td>${item.designation}</td>
                                <td>${item.department}</td>
                                <td>${item.section}</td>
                                <td>${item.date_of_joining}</td>
                                <td>${parseFloat(item.promotedAmount) + parseFloat(item.old_amount) || 'N/A'}</td>
                                <td>${item.promotedDesignation || 'N/A'}</td>
                                <td>${item.promotedAmount || 'N/A'}</td>
                                <td>${item.old_amount || 'N/A'}</td>
                            </tr>
                        `);
                    });

 
                    const table = datatable.DataTable({
                        lengthMenu: [10, 20, 50, 100],
                        paging: true,
                        // searching: true,
                        autoWidth: true,
                        orderable: false,
                        dom: 'Bfrtip', // Specify placement of buttons (B: Buttons, f: Filter, r: Processing, t: Table)
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                text: 'Export to Excel',
                                title: 'Salary Report', // The title of the exported Excel file
                            },
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'Salary Report', // The title of the printed document
                                customize: function (win) {
                                    $(win.document.body)
                                        .css('font-size', '8pt')
                                        .find('table')
                                        .css('font-size', 'inherit');
                                },
                            }
                        ],
                        // responsive: true,
                        columnDefs: [
                            { targets: [0], orderable: true }, // Make SL No sortable
                            { targets: [2], orderable: true }, // Make Designation sortable
                        ],
                    });
                    

                    $('#salaryTable_filter input').attr('placeholder', 'Search by Employee ID');
                    // Override default search behavior
                    $('#salaryTable_filter input').on('keyup', function () {
                        table.column(1).search(this.value).draw(); 
                    });
                }

            });
    </script>
@stop
