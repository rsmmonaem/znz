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
                                    <label for="employeeId">Employee ID <span class="text-danger">*</span></label>
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
                                    <label for="monthCount">Number of Months to Divide <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="months" id="monthCount" min="1" />
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-md-6">
                            <div class="entry-panel">
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="effectiveDate" />
                                </div>
                                <div class="form-group radio-group">
                                    <label>Total Advance <span class="text-danger">*</span></label>
                                    <div>
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
                        <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" id="data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" /></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>Advance Due</th>
                                    <th>January</th>
                                    <th>February</th>
                                    <th>March</th>
                                    <th>April</th>
                                    <th>May</th>
                                    <th>June</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>September</th>
                                    <th>October</th>
                                    <th>November</th>
                                    <th>December</th>
                                    <th>Effective Date</th>
                                    <th style="display: none">Month</th>
                                    <th>Year</th>
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
    </div>
@stop
@section('javascript')
<script>
    $(document).ready(function() {
        GetData();

        function Validate(data) {
            $('#saveData').attr('disabled', false).text('Save');
            return toastr.error(data);
        }

        $('#saveData').click(function() {
            $('#saveData').attr('disabled', true).text('Saving...');

            var formData = new FormData();

            formData.append('employeeId', $('#employeeId').val());
            formData.append('date', $('#date').val());
            formData.append('effectiveDate', $('#effectiveDate').val());
            formData.append('grossOption', $('input[name="grossOption"]:checked').val());
            formData.append('grossValue', $('input[name="grossValue"]').val());
            
            // Ekhane change
            $('input[name^="months"]').each(function () {
                var value = $(this).val();
                var name = $(this).attr('name'); // e.g. months[1], months[2]
                if (value) {
                    formData.append(name, value); // this is important!
                }
            });

            // Validation
            if (!formData.get('employeeId')) return Validate('Please select employee');
            if (!formData.get('date')) return Validate('Please select date');
            if (!formData.get('effectiveDate')) return Validate('Please select effective date');
            if (!formData.get('grossValue')) return Validate('Please enter gross value');

            $.ajax({
                url: '/salary-advance-create',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#saveData').attr('disabled', false).text('Save');
                    toastr.success(response.message || 'Data saved successfully.');
                    GetData();
                },
                error: function(xhr) {
                    $('#saveData').attr('disabled', false).text('Save');
                    console.error('Error:', xhr.responseText);
                    toastr.error('Something went wrong. Please try again.');
                }
            });
        });

        function GetData() {
            $.ajax({
                url: '/salary-advance-list',
                type: 'POST',
                success: function(response) {
                    const datatable = $('#data-table');
                    datatable.DataTable().destroy();

                    var tableBody = $('#table-tbody');
                    tableBody.empty();

                    response.forEach(function(item) {
                        var row = `
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td>${item.employee_code}</td>
                            <td>${item.first_name}</td>
                            <td>${item.department}</td>
                            <td>${item.section}</td>
                            <td>${item.grossValue}</td>
                            <td>${item.january_advance_amount}</td>
                            <td>${item.february_advance_amount}</td>
                            <td>${item.march_advance_amount}</td>
                            <td>${item.april_advance_amount}</td>
                            <td>${item.may_advance_amount}</td>
                            <td>${item.june_advance_amount}</td>
                            <td>${item.july_advance_amount}</td>
                            <td>${item.august_advance_amount}</td>
                            <td>${item.september_advance_amount}</td>
                            <td>${item.october_advance_amount}</td>
                            <td>${item.november_advance_amount}</td>
                            <td>${item.december_advance_amount}</td>
                            <td>${item.effectiveDate}</td>
                            <td style="display:none">${item.months}</td>
                            <td>${new Date(item.effectiveDate).getFullYear()}</td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <a href="/salary-advance-edit/${item.id}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="${item.id}" class="delete-btn btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        `;
                        tableBody.append(row);
                    });

                    datatable.DataTable({ lengthMenu: [10, 20, 50, 100] });
                    bindDeleteBtns();
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        function bindDeleteBtns() {
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this record?')) {
                    $.ajax({
                        url: '/salary-advance-delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            toastr.success(response.message || 'Data deleted successfully.');
                            GetData();
                        },
                        error: function(xhr) {
                            toastr.error('Something went wrong. Please try again.');
                        }
                    });
                }
            });
        }

        // Fetch employee data on change
        $('#employeeId').on('change', function() {
            userData();
        });

        function userData() {
            var UserID = $('#employeeId').val();
            $.ajax({
                url: '/UserData',
                type: 'POST',
                data: { employeeId: UserID },
                success: function(data) {
                    $('#branch').val(data.branch);
                    $('#department').val(data.department);
                    $('#section').val(data.section);
                    $('#designation').val(data.designation);
                    $('#category').val(data.category);
                }
            });
        }
    });
</script>
@stop

