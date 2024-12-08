@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_separetion') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-group label {
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
        }
        .dflex{
            display: flex;
            justify-content: space-between;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Employee Separation (Entry Panel)</h2>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select class="form-control" id="group">
                                        <option value="">J & Z Group</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" class="form-control" id="branch" placeholder="Enter Branch"
                                        readonly>
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
                                    <label for="employeeName">Employee Name</label>
                                    <input type="text" class="form-control" id="employeeName"
                                        placeholder="Enter Employee Name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation"
                                        placeholder="Enter Designation" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" id="section" placeholder="Enter Section"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="doj">Date of Joining (DOJ)</label>
                                    <input type="date" class="form-control" id="doj" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="separationType">Separation Type</label>
                                    <select class="form-control select2me" id="separationType">
                                        <option value="">Select Separation Type</option>
                                        @foreach ($separetionType as $septype)
                                            <option value="{{ $septype }}">{{ $septype }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <textarea class="form-control" id="reason" rows="3" placeholder="Enter Reason"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="entryDate">Entry Date</label>
                                    <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="separationAriseDate">Separation Arise Date</label>
                                    <input type="date" class="form-control" id="separationAriseDate">
                                </div>
                                <div class="form-group">
                                    <label for="lastWorkingDay">Last Working Day</label>
                                    <input type="date" class="form-control" id="lastWorkingDay">
                                </div>
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input type="date" class="form-control" id="effectiveDate">
                                </div>
                                <div class="form-group">
                                    <label for="noticePeriod">Notice Period</label>
                                    <input type="text" class="form-control" id="noticePeriod"
                                        placeholder="Enter Notice Period">
                                </div>
                                <div class="form-group">
                                    <label for="mandatoryNotice">Mandatory Notice</label>
                                    <input type="text" class="form-control" id="mandatoryNotice"
                                        placeholder="Enter Mandatory Notice">
                                </div>
                                <div class="form-group">
                                    <label for="shortDay">Short Day</label>
                                    <input type="text" class="form-control" id="shortDay"
                                        placeholder="Enter Short Day">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="saveData">Save</button>
                            <button type="button" class="btn btn-danger">Close</button>
                        </div>
                    </form>

                    <table class="table table-bordered" style="margin-top: 20px" id="datatable">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Emp ID</th>
                                <th>Employee Name</th>
                                <th>Entry Date</th>
                                <th>Separation Arise Date</th>
                                <th>Last Working Day</th>
                                <th>Effective Date</th>
                                <th>Notice Period</th>
                                <th>Mandatory Notice</th>
                                <th>Short Day</th>
                            </tr>
                        </thead>
                        <tbody id="separationTableBody">
                            <!-- Rows will go here -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $('#employeeId').on('change', function() {
            const employeeId = $(this).val();
            if (employeeId) {
                $.ajax({
                    url: `/get-employee-details/${employeeId}`,
                    type: 'POST',
                    success: function(data) {
                        $('#employeeName').val(data.first_name || '');
                        $('#section').val(data.section || '');
                        $('#designation').val(data.designation || '');
                        $('#doj').val(data.date_of_joining || '');
                        $('#branch').val(data.branch || '');
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            } else {
                $('#employeeName').val('');
                $('#section').val('');
                $('#designation').val('');
                $('#doj').val('');
                $('#branch').val('');
            }
        });
        // Save form data
        $('#saveData').on('click', function(e) {
            e.preventDefault();

            // Disable button and show loading text
            const $btn = $(this);
            $btn.attr('disabled', true).text('Please Wait...');

            // Gather form data
            const formData = {
                employeeId: $('#employeeId').val(),
                employeeName: $('#employeeName').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                doj: $('#doj').val(),
                branch: $('#branch').val(),
                separationType: $('#separationType').val(),
                reason: $('#reason').val(),
                entryDate: $('#entryDate').val(),
                separationAriseDate: $('#separationAriseDate').val(),
                lastWorkingDay: $('#lastWorkingDay').val(),
                effectiveDate: $('#effectiveDate').val(),
                noticePeriod: $('#noticePeriod').val(),
                mandatoryNotice: $('#mandatoryNotice').val(),
                shortDay: $('#shortDay').val()
            };

            // Make AJAX POST request
            $.ajax({
                url: '/employee-separation', // Endpoint to handle the request
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Enable button and reset text
                    $btn.attr('disabled', false).text('Save');
                    // Handle success response
                    if (response.status === 'success') {
                        toastr.success(response.message || 'Data saved successfully.');
                        employeeId.value = '';
                        employeeName.value = '';
                        section.value = '';
                        designation.value = '';
                        doj.value = '';
                        branch.value = '';
                        separationType.value = '';
                        reason.value = '';
                        entryDate.value = '';
                        separationAriseDate.value = '';
                        lastWorkingDay.value = '';
                        effectiveDate.value = '';
                        noticePeriod.value = '';
                        mandatoryNotice.value = '';
                        shortDay.value = '';
                    } else {
                        toastr.error(response.message || 'Failed to save data.');
                    }
                    getSeparationData();
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    // Enable button and reset text
                    $btn.attr('disabled', false).text('Save');

                    // Handle error response
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            toastr.error(errors[key][0]); // Show validation errors
                        });
                    } else {
                        toastr.error('Something went wrong. Please try again.');
                    }
                }
            });
        });

        $(document).ready(function() {
            getSeparationData();
        })

        function getSeparationData() {
            $.ajax({
                url: '/employee-separation-data',
                type: 'GET',
                success: function(response) {
                    const datatable = $('#datatable');
                    datatable.DataTable().destroy();
                    var tableBody = $('#separationTableBody');
                    tableBody.empty(); // Clear any existing rows
                    // Loop through each separation record and append a row
                    response.forEach(function(separation) {
                        var row = `<tr>
                            <td>
                                <div class="btn-group btn-group-xs dflex">
                                    <a href="/employee-separation/${separation.id}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="${separation.id}" class="btn btn-danger btn-xs" id="deleteSeparation"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            <td>${separation.employee_id}</td>
                            <td>${separation.employee_name}</td>
                            <td>${separation.entry_date}</td>
                            <td>${separation.separation_arise_date}</td>
                            <td>${separation.last_working_day}</td>
                            <td>${separation.effective_date}</td>
                            <td>${separation.notice_period}</td>
                            <td>${separation.mandatory_notice}</td>
                            <td>${separation.short_day}</td>
                        </tr>`;
                        tableBody.append(row);
                    });
                    datatable.DataTable({
                        // order: [
                        //     [1, 'desc']
                        // ],
                        lengthMenu: [10, 20, 50, 100],
                    })
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }
        // Delete separation record
        $(document).on('click', '#deleteSeparation', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this separation record?')) {
                $.ajax({
                    url: `/employee-separation/${id}`,
                    type: 'DELETE',
                    success: function(response) {
                        getSeparationData();
                        toastr.success('Separation record deleted successfully.');
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            }
        });
    </script>
@stop
