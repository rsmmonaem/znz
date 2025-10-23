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

        .dflex {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Employee Separation Edit</h2>

                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select class="form-control" id="group" name="group">
                                        <option value="">J & Z Group</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" class="form-control" id="branch" name="branch"
                                        value="{{ $separation->branch }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="employeeId">Employee ID</label>
                                    <select class="form-control select2me" id="employeeId" name="employeeId" readonly>
                                        <option value="">Select Employee ID</option>
                                        @foreach ($employee as $e)
                                            <option value="{{ $e->id }}"
                                                {{ $e->id == $separation->employee_id ? 'selected' : '' }}>
                                                {{ $e->first_name }} - {{ $e->employee_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="employeeName">Employee Name</label>
                                    <input type="text" class="form-control" id="employeeName" name="employeeName"
                                        value="{{ $separation->employee_name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation"
                                        value="{{ $separation->designation }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" id="section" name="section"
                                        value="{{ $separation->section }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="doj">Date of Joining (DOJ)</label>
                                    <input type="date" class="form-control" id="doj" name="doj"
                                        value="{{ $separation->doj }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="separationType">Separation Type</label>
                                    <select class="form-control select2me" id="separationType" name="separationType">
                                        <option value="">Select Separation Type</option>
                                        @foreach ($separationType as $septype)
                                            <option value="{{ $septype }}"
                                                {{ $septype == $separation->separation_type ? 'selected' : '' }}>
                                                {{ $septype }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3">{{ $separation->reason }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="entryDate">Entry Date</label>
                                    <input type="date" class="form-control" id="entryDate" name="entryDate"
                                        value="{{ $separation->entry_date }}" >
                                </div>
                                <div class="form-group">
                                    <label for="separationAriseDate">Separation Arise Date</label>
                                    <input type="date" class="form-control" id="separationAriseDate"
                                        name="separationAriseDate" value="{{ $separation->separation_arise_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="lastWorkingDay">Last Working Day</label>
                                    <input type="date" class="form-control" id="lastWorkingDay" name="lastWorkingDay"
                                        value="{{ $separation->last_working_day }}">
                                </div>
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input type="date" class="form-control" id="effectiveDate" name="effectiveDate"
                                        value="{{ $separation->effective_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="noticePeriod">Notice Period</label>
                                    <input type="text" class="form-control" id="noticePeriod" name="noticePeriod"
                                        value="{{ $separation->notice_period }}" placeholder="Enter Notice Period">
                                </div>
                                <div class="form-group">
                                    <label for="mandatoryNotice">Mandatory Notice</label>
                                    <input type="text" class="form-control" id="mandatoryNotice"
                                        name="mandatoryNotice" value="{{ $separation->mandatory_notice }}"
                                        placeholder="Enter Mandatory Notice">
                                </div>
                                <div class="form-group">
                                    <label for="shortDay">Short Day</label>
                                    <input type="text" class="form-control" id="shortDay" name="shortDay"
                                        value="{{ $separation->short_day }}" placeholder="Enter Short Day">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="updateData">Update</button>
                            {{-- <a href="{{ url('/employee-separation') }}" class="btn btn-danger">Close</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
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
        // Update Data
        $('#updateData').on('click', function(e) {
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
                url: '/employee-separation' + '/' + {{ $separation->id }},
                type: 'PUT',
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    $btn.attr('disabled', false).text('Update');
                    toastr.success(response.message || 'Data updated successfully.');
                },
                error: function(xhr) {
                    // Handle error response
                    console.error('Error:', xhr.responseText);
                    $btn.attr('disabled', false).text('Update');
                    toastr.error('Something went wrong. Please try again.');
                }
            });
        })
    </script>
@stop