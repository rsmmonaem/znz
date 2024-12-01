@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Process</li>
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
                    <h2 class="text-center">Salary Sheet</h2>
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
                                            @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach
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
                                        <button type="button" class="btn btn-primary pull-center" id="submit">Get Pay
                                            Sheet</button>
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
                                    <th rowspan="2">SL<br />No</th>
                                    <th rowspan="2">Name Of Employee</th>
                                    <th rowspan="2">Designation</th>
                                    <th rowspan="2">Date of Joining</th>
                                    <th rowspan="2">ID No</th>
                                    <th rowspan="2">Attendance</th>
                                    <th rowspan="2">Gross Salary</th>
                                    <th colspan="5">Basic Breakdown</th>
                                    <th rowspan="2">Net Salary</th>
                                    <th rowspan="2">Advance</th>
                                    <th rowspan="2">Provident Fund</th>
                                    <th rowspan="2">TAX</th>                                    <th rowspan="2">Arrear Amount</th>
                                    <th rowspan="2">Net Payable</th>
                                    <th rowspan="2">Bank Asia A/C No.</th>
                                    <th rowspan="2">Remarks</th>
                                </tr>
                                <tr>
                                    <th>Basic<br />(50% of Gross)</th>
                                    <th>HRA<br />(28% of Gross)</th>
                                    <th>MA<br />(9% of Gross)</th>
                                    <th>CA<br />(8% of Gross)</th>
                                    <th>Other's<br />(5% of Gross)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic data should populate here -->
                            </tbody>
                             <tfoot>
                                <tr>
                                    <td colspan="6">Total</td>
                                    {{-- <td id="total-attendance"></td> --}}
                                    <td id="total-gross-salary"></td>
                                    <td id="total-basic"></td>
                                    <td id="total-hra"></td>
                                    <td id="total-ma"></td>
                                    <td id="total-ca"></td>
                                    <td id="total-others"></td>
                                    <td id="total-net-salary"></td>
                                    <td id="total-advance"></td>
                                    <td id="total-provident-fund"></td>
                                    <td id="total-tax"></td>
                                    <td id="total-arrear"></td>
                                    <td id="total-net-payable"></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
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
                    url: '/slary-shit-post', // Replace with your API URL
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        table_container.removeAttr("style")
                        // Parse response and populate the table
                        populateSalaryTable(response.employee_salary_data);
                        $('#submit').attr("disabled", false);
                        $('#submit').text('Get Pay Sheet');
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
                        let salaryData = item.salaryData || {};

                        // Breakdown amounts
                        let basic = salaryData[0]?.amount || '0.00';
                        let hra = salaryData[2]?.amount || '0.00';
                        let medical = salaryData[6]?.amount || '0.00';
                        let conveyance = salaryData[4]?.amount || '0.00';
                        let others = salaryData[8]?.amount || '0.00';

                        // Append row to the table
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.first_name}</td>
                                <td>${item.designation}</td>
                                <td>${item.date_of_joining}</td>
                                <td>${item.employee_code}</td>
                                <td>${item.total_worked_days}</td>
                                <td>${item.gross_salary}</td>
                                <td>${Math.floor(parseFloat(basic)).toFixed(2)}</td>
                                <td>${Math.floor(parseFloat(hra)).toFixed(2)}</td>
                                <td>${Math.floor(parseFloat(medical)).toFixed(2)}</td>
                                <td>${Math.floor(parseFloat(conveyance)).toFixed(2)}</td>
                                <td>${Math.floor(parseFloat(others)).toFixed(2)}</td>
                                <td>${item.net_salary}</td>
                                <td>${item.advance_salary}</td>
                                <td>${item.provident_fund}</td>
                                <td>${item.tax_amount || '0.00'}</td>
                                <td class="arrear-amount" data-name="${item.first_name}" data-arrear-amount="${item.arrear_amount}" data-id="${item.id}" >${item.arrear_amount}</td>
                                <td class="net-payable" data-id="${item.id}" data-netpayable="${item.net_salary}">${parseFloat(item.net_salary) + parseFloat(item.arrear_amount)}</td>
                                <td>${item.account_number || ' '}</td>
                                <td>${item.remarks || ' '}</td>
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

                        "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();

                            // Sum for various columns without currency formatting
                            // var totalAttendance = api.column(5).data().reduce(function(a, b) {
                            //     return parseFloat(a) + parseFloat(b);
                            // }, 0);

                            var totalGrossSalary = api.column(6).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalBasic = api.column(7).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalHRA = api.column(8).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalMA = api.column(9).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalCA = api.column(10).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalOthers = api.column(11).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalNetSalary = api.column(12).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalAdvance = api.column(13).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalProvidentFund = api.column(14).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalTax = api.column(15).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalArrear = api.column(16).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            var totalNetPayable = api.column(17).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                            // Update the footer with the calculated sums
                            // $('#total-attendance').html(totalAttendance);
                            $('#total-gross-salary').html(totalGrossSalary);
                            $('#total-basic').html(totalBasic);
                            $('#total-hra').html(totalHRA);
                            $('#total-ma').html(totalMA);
                            $('#total-ca').html(totalCA);
                            $('#total-others').html(totalOthers);
                            $('#total-net-salary').html(totalNetSalary);
                            $('#total-advance').html(totalAdvance);
                            $('#total-provident-fund').html(totalProvidentFund);
                            $('#total-tax').html(totalTax);
                            $('#total-arrear').html(totalArrear);
                            $('#total-net-payable').html(totalNetPayable);
                        }
                        
                    });
                    

                    $('#salaryTable_filter input').attr('placeholder', 'Search by Employee ID');
                    // Override default search behavior
                    $('#salaryTable_filter input').on('keyup', function () {
                        table.column(4).search(this.value).draw(); 
                    });
                }

                $(document).on('click', '.arrear-amount', function() {
                    const arrearAmount = parseFloat($(this).data('arrear-amount'));  // Get the current arrear amount
                    const id = $(this).data('id');  // Get the ID of the clicked element
                    const name = $(this).data('name');  // Get the name of the clicked employee
                    // Create the modal
                    console.log(id);

                    const modal = $('<div class="modal fade" id="arrearModal" tabindex="-1" role="dialog" aria-labelledby="arrearModalLabel" aria-hidden="true">');
                    modal.html(`
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="arrearModalLabel">Edit Arrear Amount</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to edit the arrear amount for <strong>${name}</strong>?</p>
                                    <label for="arrearAmountInput">Arrear Amount</label>
                                    <input type="number" id="arrearAmountInput" class="form-control" value="${arrearAmount}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="saveArrearAmount" data-id="${id}" data-arrear-amount="${arrearAmount}">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    `);

                    // Append the modal to the body
                    $('body').append(modal);

                    // Show the modal
                    $('#arrearModal').modal('show');

                    // Handle save button click
                    $('#saveArrearAmount').on('click', function() {
                        const arrearAmountInput = $('#arrearAmountInput').val();  // Get the new arrear amount from the input field
                        const id = $(this).data('id');  // Get the ID
                        const arrearAmount = $(this).data('arrear-amount');  // Get the old arrear amount
                        
                        // Make the AJAX request to update the arrear amount
                        $.ajax({
                            url: '/update-arrear-amount',  // Your endpoint for updating the arrear amount
                            method: 'POST',
                            data: {
                                id: id,
                                arrear_amount: arrearAmountInput
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Update the arrear amount in the table without reloading
                                    $('.arrear-amount[data-id="' + id + '"]').text(arrearAmountInput);  // Update the displayed arrear amount
                                    $('.arrear-amount[data-id="' + id + '"]').data('arrear-amount', arrearAmountInput);  // Update the data attribute for the arrear amount
                        
                                    const netPayable = parseFloat($('.net-payable[data-id="' + id + '"]').data('netpayable'));
                                    const newNetPayable = isNaN(netPayable) ? parseFloat(arrearAmountInput) : (netPayable + parseFloat(arrearAmountInput));

                                    $('.net-payable[data-id="' + id + '"]').text(newNetPayable);
                                    $('.net-payable[data-id="' + id + '"]').data('netpayable', newNetPayable);

                                    // Hide the modal
                                    $('#arrearModal').modal('hide');  // Close the modal
                                    toastr.success('Arrear amount updated successfully.');
                                } else {
                                    toastr.error('Failed to update arrear amount.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);  // Log any errors
                                toastr.error('An error occurred while updating the arrear amount.');
                            }
                        });
                    });

                    // Close modal on clicking outside or pressing the escape key
                    $('#arrearModal').on('hidden.bs.modal', function() {
                        $(this).remove();  // Remove modal from the DOM after it is closed
                    });
                });

            });
    </script>
@stop
