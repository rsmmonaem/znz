@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee') !!}</li>
    </ul>
@stop

@section('content')
    {{-- @if (Entrust::can('create_employee'))
            <div class="col-sm-12 collapse" id="box-detail">
                <div class="box-info">
                    <h2>
                        <strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.employee') !!}
                        <div class="additional-btn">
                            <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i
                                    class="fa fa-minus icon"></i> {!! trans('messages.hide') !!}</button>
                        </div>
                    </h2>
                </div>
        @endif --}}
    <style>
        .attendance-report {
            margin: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .report-table th,
        .report-table td {
            text-align: center;
            vertical-align: middle;
        }

        .totals-row {
            font-weight: bold;
        }
    </style>
    <div class="box-info full">
        <div class="row">
            <div class="container attendance-report">
                <h2 class="text-center">Attendance Report</h2>
                <h4 class="text-center">Daily Attendance Report</h4>
                <form>
                    <div class="row">
                        <div class="col-md-6 form-section">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option>J & J Group</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select class="form-control" name="branch" id="branch">
                                    <option value="">Select Branch</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" name="department" id="department">
                                    <option value="">Select Department</option>
                                    @foreach ($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select class="form-control" name="section" id="section">
                                    <option value="">Select Section</option>
                                    @foreach ($section as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select class="form-control" name="designation" id="designation">
                                    <option value="">Select Designation</option>
                                    @foreach ($designation as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employeeId">Employee ID</label>
                                <input type="text" class="form-control" name="employeeId" id="employeeId">
                            </div>
                        </div>
                        <div class="col-md-6 form-section">
                            <div class="form-group">
                                <label for="reportType">Report Type</label>
                                <select class="form-control" id="reportType">
                                    <option value="Daily Attendance">Daily Attendance</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" id="date">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div>
                                    <label class="radio-inline"><input type="radio" name="status" value="all" checked> All</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="1">
                                        Present</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="2">
                                        Late</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="3">
                                        Absent</label>
                                    </br>
                                    <label class="radio-inline"><input type="radio" name="status" value="4">
                                        HL</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="5">
                                        LWP</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="6">
                                        Leave</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center form-section">
                            <button type="button" class="btn btn-primary" id="getData">Report</button>
                            <button type="button" class="btn btn-default">Close</button>
                        </div>
                    </div>
                </form>
                <div class="table-container">
                    <style>
                        .center-item {
                            margin-left: auto;
                            margin-right: auto;
                            /* Centers the second item */
                        }

                        .display-flex {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            border: 1px solid #ccc;
                            padding: 10px;
                            margin: 0 0 20px 0;
                        }
                    </style>
                    <div class="display-flex" id="header-for">
                        <div class="left-item">
                            <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}"
                                width="150px" style="margin-left:20px;">
                        </div>
                        <div class="center-item">
                            <h4>{{ config('config.company_name') }}</h4>
                            <p>Daily Attendance Report (Date)</p>
                            <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                            <p>Date: <strong id="date"></strong></p>
                        </div>
                    </div>
                    <table class="table table-bordered report-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Category</th>
                                <th>Designation</th>
                                <th>Shift In</th>
                                <th>Shift Out</th>
                                <th>Shift Name</th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Status</th>
                                <th>OT</th>
                                <th>Extra Time</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Row -->
                            <tr>
                                <td>1</td>
                                <td>101</td>
                                <td>John Doe</td>
                                <td>HR</td>
                                <td>Section A</td>
                                <td>Staff</td>
                                <td>Manager</td>
                                <td>09:00 AM</td>
                                <td>05:00 PM</td>
                                <td>Morning</td>
                                <td>09:01 AM</td>
                                <td>05:10 PM</td>
                                <td>Present</td>
                                <td>1</td>
                                <td>10 mins</td>
                                <td>-</td>
                            </tr>
                            <!-- More rows can be added as needed -->
                        </tbody>
                        <tfoot>
                            <tr class="totals-row">
                                <td colspan="2">Total Present</td>
                                <td colspan="2">Total Absent</td>
                                <td colspan="2">Total OL</td>
                                <td colspan="2">Total ML</td>
                                <td colspan="2">Total LWP</td>
                                <td colspan="2">Total SL</td>
                                <td colspan="2">Total OT</td>
                                <td colspan="2">Total WHD</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="display-flex">
                        <div class="left-item"></div>
                        <div class="center-item">
                            <button class="btn btn-primary" id="print">Print</button>
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
            $('#getData').on('click', function() {
                const date = $('#date').val();
                const status = $('input[name="status"]:checked').val();
                const branch_id = $('#branch').val();
                const department_id = $('#department').val();
                const section_id = $('#section').val();
                const category_id = $('#category').val();
                const designation_id = $('#designation').val();
                const employee_id = $('input[name="employeeId"]').val();
                const formData = {
                    date: date,
                    status: status,
                    branch_id: branch_id,
                    department_id: department_id,
                    section_id: section_id,
                    category_id: category_id,
                    designation_id: designation_id,
                    employee_id: employee_id,
                }
                $.ajax({
                    url: "{{ url('attendance-report') }}",
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                    }
                })
            });
        });

        // Print Section
        document.getElementById('print').addEventListener('click', function() {
            const printFrame = document.createElement('iframe');
            printFrame.style.position = 'absolute';
            printFrame.style.width = '0';
            printFrame.style.height = '0';
            printFrame.style.padding = '20px';
            printFrame.style.border = 'none';
            document.getElementById('print').style.display = 'none';
            document.body.appendChild(printFrame);
            const printContents = document.querySelector('.table-container').innerHTML;
            printFrame.contentDocument.write(`
                    <html>
                    <head>
                        <title>Print Table</title>
                        <style>
                            /* Optional: Include styles for the printed content */
                            body { font-family: Arial, sans-serif; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        </style>
                    </head>
                    <body>${printContents}</body>
                    </html>
                `);
            document.getElementById('print').style.display = 'block';
            printFrame.contentDocument.close();
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
            printFrame.onafterprint = () => document.body.removeChild(printFrame);
        })
    </script>
@stop
