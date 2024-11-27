@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Advance Entry</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container" style="margin-bottom: 20px">
                    <h2 class="text-center">Advance Entry Panel</h2>
                    <div class="row">
                        <!-- Left Side -->
                        <div class="col-md-6">
                            <div class="entry-panel">
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select class="form-control" id="group">
                                        <option value="">Select Group</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" class="form-control" id="branch" value="" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control" id="department" value="" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" id="section" value="" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" value="" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="employeeId">Employee ID</label>
                                    <select class="form-control select2me" id="employeeId">
                                        <option value="">Select Employee ID</option>
                                        @foreach ($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                {{ $e->employee_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" value="" disabled/>
                              </div>

                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select class="form-control select2me" id="month" multiple>
                                        <option value="">Select</option>
                                        <!-- Add month options dynamically -->
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-md-6">
                            <div class="entry-panel">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" value="{{ date('Y-m-d') }}" />
                                </div>
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input type="date" class="form-control" id="effectiveDate" />
                                </div>
                                <div class="form-group radio-group">
                                    <label>Gross</label>
                                    <div>
                                        <label><input type="radio" name="grossOption" value="fixed" />
                                            Fixed</label>
                                        <label><input type="radio" name="grossOption" value="percentage" />
                                            Percentage</label>
                                        <input type="text" class="form-control" name="grossValue"
                                            style="display: inline-block; width: auto; margin-left: 10px" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="action-buttons" style="margin-bottom: 20px">
                        <button type="button" class="btn btn-success" id="saveData">Save</button>
                        <button type="button" class="btn btn-danger">Close</button>
                    </div>

                    <!-- Data Table -->
                    <div class="table-container">
                        <table class="table table-bordered table-striped" id="data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" /></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Advance Due</th>
                                    <th>Effective Date</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            GetData();
            $('#saveData').click(function() {
                $('#saveData').attr('disabled', true).text('Saving...');
                var formData = {
                    'employeeId': $('#employeeId').val(),
                    'date': $('#date').val(),
                    'effectiveDate': $('#effectiveDate').val(),
                    'month': $('#month').val(),
                    'grossOption': $('input[name="grossOption"]:checked').val(),
                    'grossValue': $('input[name="grossValue"]').val(),
                    'remarks': $('#remarks').val(),
                };
                $.ajax({
                    url: '/salary-advance-create',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        GetData();
                        $('#saveData').attr('disabled', false).text('Save');
                        console.log(response);
                        toastr.success(response.message || 'Data saved successfully.');
                    },
                    error: function(xhr) {
                        $('#saveData').attr('disabled', false).text('Save');
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            })

            function GetData() {
                $.ajax({
                    url: '/salary-advance-list',
                    type: 'POST',
                    success: function(response) {
                        const datatable = $('#data-table');
                        datatable.DataTable().destroy();
                        // Clear the existing table body and rows
                        var tableBody = $('#table-tbody');
                        tableBody.empty();

                        // Loop through each item in the response
                        response.forEach(function(item) {
                            // Ensure item.month is an array before passing it to getMonthNames
                            var row = `
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td>${item.employee_code}</td>
                                <td>${item.first_name}</td>
                                <td>${item.department}</td>
                                <td>${item.section}</td>
                                <td>${item.grossValue}</td>
                                <td>${item.effectiveDate}</td>
                                <td>${item.months}</td> 
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="/salary-advance-edit/${item.id}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="${item.id}" class="delete-btn btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        `;
                            tableBody.append(row); // Append each row to the table body
                        });
                        // Reinitialize the DataTable after adding new rows
                        datatable.DataTable({
                            lengthMenu: [10, 20, 50, 100],
                        });
                        bindDeleteBtns();
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                    }
                });
            }

            // Function to bind delete button event
            function bindDeleteBtns() {
                // Delegate the click event using jQuery for dynamically added elements
                $('.delete-btn').click(function() {
                    var id = $(this).data('id');
                    if (confirm('Are you sure you want to delete this record?')) {
                        $.ajax({
                            url: '/salary-advance-delete',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                console.log(response);
                                toastr.success(response.message ||
                                'Data deleted successfully.');
                                GetData(); // Refresh the data after successful deletion
                            },
                            error: function(xhr) {
                                console.error('Error:', xhr.responseText);
                                toastr.error('Something went wrong. Please try again.');
                            }
                        });
                    }
                });
            }
            // User Data
            $('#employeeId').on('change', function(){
                userData();
            });
            function userData(){
                var UserID = document.getElementById('employeeId').value;
                $.ajax({
                    url: '/UserData',
                    type: 'POST',
                    data: {employeeId: UserID},
                    success: function(data){
                        $('#branch').val(data.branch);
                        $('#department').val(data.department);
                        $('#section').val(data.section);
                        $('#designation').val(data.designation);
                        $('#category').val(data.category);
                    }
                });
            }

        })
    </script>
@stop
