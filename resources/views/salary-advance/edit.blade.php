@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Sakary Advance</li>
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
                <div class="container" style="margin-bottom: 20px">
                    <h2 class="text-center">Edit Advance Entry Panel</h2>
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
                                            <option value="{{ $e->id }}"
                                                {{ $entry->employeeId == $e->id ? 'selected' : '' }}>{{ $e->first_name }} -
                                                {{ $e->employee_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" value="" disabled />
                                </div>

                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select class="form-control select2me" id="month" multiple>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}"
                                                {{ in_array($month, explode(',', $entry->months)) ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="month">Month <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <label for="months">Select Months and Amounts:</label>
                                        <div class="row">
                                        @php
                                            $selectedMonths = explode(',', $entry->months);
                                            
                                            print_r($salary_advance_data);
                                        @endphp
                                        
                                        @for ($month = 1; $month <= 12; $month++)
                                            @if(in_array($month, $selectedMonths))
                                            
                                                <div class="col-md-4">
                                                    <label>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</label>
                                                    <input type="number" name="months[{{ $month }}]" class="form-control" placeholder="Enter amount" min="0">
                                                </div>
                                            @endif
                                        @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-md-6">
                            <div class="entry-panel">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" value="{{ $entry->date }}" />
                                </div>
                                <div class="form-group">
                                    <label for="effectiveDate">Effective Date</label>
                                    <input type="date" class="form-control" id="effectiveDate"
                                        value="{{ $entry->effectiveDate }}" />
                                </div>
                                <div class="form-group radio-group">
                                    <label>Gross</label>
                                    <div>
                                        <label><input type="radio" name="grossOption" value="fixed"
                                                {{ $entry->grossOption == 'fixed' ? 'checked' : '' }} />
                                            Fixed</label>
                                        <label><input type="radio" name="grossOption" value="percentage"
                                                {{ $entry->grossOption == 'percentage' ? 'checked' : '' }} />
                                            Percentage</label>
                                        <input type="text" class="form-control" name="grossValue"
                                            value="{{ $entry->grossValue }}"
                                            style="display: inline-block; width: auto; margin-left: 10px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons" style="margin-bottom: 20px">
                        <button type="button" class="btn btn-success" id="updateData">Update</button>
                        <button type="button" class="btn btn-danger">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @stop
    @section('javascript')
        <script>
            $(document).ready(function() {
                userData();
                $('#employeeId').on('change', function() {
                    userData();
                });

                function userData() {
                    var UserID = document.getElementById('employeeId').value;
                    $.ajax({
                        url: '/UserData',
                        type: 'POST',
                        data: {
                            employeeId: UserID
                        },
                        success: function(data) {
                            $('#branch').val(data.branch);
                            $('#department').val(data.department);
                            $('#section').val(data.section);
                            $('#designation').val(data.designation);
                            $('#category').val(data.category);
                        }
                    });
                }


                // Update Data
                $('#updateData').click(function() {
                    $('#updateData').attr('disabled', true).text('Saving...');
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
                        url: '/salary-advance-edit/' + {{ $entry->id }},
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle success response
                            $('#updateData').attr('disabled', false).text('Save');
                            console.log(response);
                            toastr.success(response.message || 'Data updated successfully.');
                        },
                        error: function(xhr) {
                            $('#updateData').attr('disabled', false).text('Save');
                            // Handle error response
                            console.error('Error:', xhr.responseText);
                            toastr.error('Something went wrong. Please try again.');
                        }
                    });
                })
            })
        </script>
    @stop
