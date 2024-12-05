@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Process</li>
    </ul>
@stop

@section('content')
    <style>
        .panel-section {
            margin: 20px 0;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .form-group label {
            width: 150px;
            margin-right: 10px;
        }

        .form-group input,
        .form-group select {
            flex: 1;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            margin-top: 30px;
        }

        .iconrotate {
            font-size: 50px;
            display: block;
            margin: 10px auto;
        }

        .iconrotate.rotate {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(-360deg);
            }
        }

        button#rotateButton {
            padding: 10px 20px;
            font-size: 16px;
            background-color: transparent;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Process Panel</h2>
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
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        <input type="text" class="form-control" id="remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" id="rotateButton">
                                    <span><img class="iconrotate" id="rotateIcon" src="https://www.emoji.family/api/emojis/1f504/openmoji/svg" alt="" style="width: 1.5em; height: 1.5em;" /></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            const $icon = $('#rotateIcon');
            $('#rotateButton').click(function() {
                // Start rotation
                $icon.addClass('rotate');
                // Simulate AJAX request
                const FormData = {
                    employeeId: $('#employeeId').val(),
                    formDate: $('#formDate').val(),
                    toDate: $('#toDate').val(),
                    section: $('#section').val(),
                    department: $('#department').val(),
                    branch: $('#branch').val(),
                    remarks: $('#remarks').val(),
                }
               // Check if any required field is empty
                if (FormData.employeeId === '' && FormData.formDate === '' && FormData.toDate === '' && FormData.section === '' && FormData.department === '' && FormData.branch === '') {
                    toastr.error('Please select fields');
                    $icon.removeClass('rotate');
                } else {
                    // If all required fields are filled, proceed with the AJAX request
                    $.ajax({
                        url: '/salary-process-post',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for security
                        },
                        data: FormData, // Send the data
                        success: function(response) {
                            // Handle success
                            $icon.removeClass('rotate');
                            console.log(response);
                            if (response.processed_employee_ids.length > 0) {
                                for (let i = 0; i < response.processed_employee_ids.length; i++) {
                                    const id = response.processed_employee_ids[i]; 
                                    const message = `The salary for ID No: ${id} has been successfully processed.`;
                                    toastr.success(message);
                                }
                            }else{
                                toastr.warning("No employees were processed");
                            }
                            // toastr.success(response.message + response.processed_employee_ids);
                        },
                        error: function() {
                            // Handle error
                            $icon.removeClass('rotate');
                            console.log('error');
                            toastr.error('Something went wrong');
                        },
                    });
                }
            });
        })
    </script>
@stop
