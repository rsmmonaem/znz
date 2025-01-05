@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.attendance') !!}</li>
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
                <h4 class="text-center">Monthly Attendance Report</h4>
                <form>
                    <div class="row">
                        <div class="col-md-6 form-section">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option>J & Z Group</option>
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
                                <label for="employeeId">Employee ID(Single & Multiple)</label>
                                {{-- <input type="text" class="form-control" name="employeeId" id="employeeId" placeholder="ID1,ID2,ID3"> --}}
                                <select class="form-control" name="employeeId" id="employeeId" multiple>
                                    <option value="">Select Employee</option>
                                    @foreach ($employee as $e)
                                        <option value="{{ $e->employee_code }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-section">
                            <div class="form-group">
                                <label for="reportType">Report Type</label>
                                {{-- <select class="form-control" id="reportType">
                                    <option value="Daily Attendance">Monthly Attendance</option>
                                </select> --}}
                                  @include('common.reportSelect')
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                {{-- <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Staff">Staff</option>
                                </select> --}}
                                 @include('common.category')
                            </div>
                            <div class="form-group">
                                <label for="category">Shift</label>
                                <select class="form-control" id="shift_id" name="shift_id">
                                    <option value="">Select shift</option>
                                    @foreach ($shift as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">StartDate</label>
                                <input type="date" name="date" class="form-control" id="startDate" format>
                            </div>
                            <div class="form-group">
                                <label for="date">End Date</label>
                                <input type="date" name="date" class="form-control" id="endDate">
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
                                        WHD</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="5">
                                        LWP</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="6">
                                        Leave</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="7">
                                        Holiday</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="8">
                                        SPHD</label>
                                   {{-- <label class="radio-inline"><input type="radio" name="status" value="8">
                                        Overtime</label> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center form-section">
                            <button type="button" class="btn btn-primary" id="getData">Report</button>
                            <button type="button" class="btn btn-default">Close</button>
                        </div>
                    </div>
                </form>
              
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#getData').on('click', function() {
                $('#getData').prop('disabled', true);
                $('#getData').text('Please Wait...');
                const date = $('#date').val();
                const status = $('input[name="status"]:checked').val();
                const branch_id = $('#branch').val();
                const department_id = $('#department').val();
                const section_id = $('#section').val();
                const category_id = $('#category').val();
                const designation_id = $('#designation').val();
                const employee_id = $('select[name="employeeId"]').val();
                const startDate = $('#startDate').val();
                const $endDate = $('#endDate').val();
                const shift_id = $('#shift_id').val();
                // console.log(shift_id);

                const formData = {
                    date: date,
                    status: status,
                    branch_id: branch_id,
                    department_id: department_id,
                    section_id: section_id,
                    category_id: category_id,
                    designation_id: designation_id,
                    employee_id: employee_id,
                    startDate: startDate,
                    endDate: $endDate,
                    shift_id: shift_id
                }
                $.ajax({
                    url: "{{ url('attendance-report') }}",
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                         $('#getData').prop('disabled', false);
                         $('#getData').text('Report');
                         toastr.success('Report Generated Successfully');
                         var newWindow = window.open('', '_blank', 'width=1200,height=800');

                        // Build the content for the new window
                        var content = `
                        <html>
                            <head>
                                <title>Monthly Attendance Report</title>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
                                <style>
                                    .center-item {
                                        margin-left: auto;
                                        margin-right: auto;
                                        text-align: center;
                                    }
                                    .display-flex {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                        border: 1px solid #ccc;
                                        padding: 10px;
                                        margin: 0 0 20px 0;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                    }
                                    th, td {
                                        border: 1px solid #ccc;
                                        padding: 8px;
                                        text-align: left;
                                    }
                                    .totals-row td {
                                        font-weight: bold;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="display-flex" id="header-for">
                                    <div class="left-item">
                                        <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" width="150px" style="margin-left:20px;">
                                    </div>
                                    <div class="center-item">
                                        <h4>{{ config('config.company_name') }}</h4>
                                        <p>Monthly Attendance Report (Date)</p>
                                        <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                                        <p>Date: <strong id="date">${response.startDate} to ${response.toDate}</strong></p>
                                    </div>
                                </div>
                                <table class="table table-bordered report-table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
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
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;
                        response.filtered_data.forEach((attendance, index) => {
                            content += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${attendance.date || 'N/A'}</td>
                                <td>${attendance.employee_code || 'N/A'}</td>
                                <td>${attendance.name || 'N/A'}</td>
                                <td>${attendance.department || 'N/A'}</td>
                                <td>${attendance.section || 'N/A'}</td>
                                <td>${attendance.category || 'N/A'}</td>
                                <td>${attendance.designation || 'N/A'}</td>
                                <td>${attendance.shift_in || 'N/A'}</td>
                                <td>${attendance.shift_out || 'N/A'}</td>
                                <td>${attendance.shift_name || 'N/A'}</td>
                                <td>${attendance.in_time || 'N/A'}</td>
                                <td>${attendance.out_time || 'N/A'}</td>
                                <td>${attendance.status || 'N/A'} </td>
                                <td>${attendance.overTime || ''}</br> ${attendance.lateTime || ''}</td>
                            </tr>
                            `;
                        });

                        // Close the table and add the print button
                        content += `
                                    </tbody>
                                    <tfoot>`;
                                        content += `
                                        
                                       <tr class="totals-row">
    <td colspan="2" style="text-align:center;">
        Total Present = ${response.filtered_totals.find(status => status.status === "P")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total Absent = ${response.filtered_totals.find(status => status.status === "Absent")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total SPHD = ${response.filtered_totals.find(status => status.status === "SPHD")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total WHD = ${response.filtered_totals.find(status => status.status === "WHD")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total Late = ${response.filtered_totals.find(status => status.status === "L")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total LWP = ${response.filtered_totals.find(status => status.status === "LWP")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total HLD = ${response.filtered_totals.find(status => status.status === "HLD")?.count || 0}
    </td>
    <td colspan="2" style="text-align:center;">
        Total Leave = ${response.filtered_totals.find(status => status.status === "Leave")?.count || 0}
    </td>
</tr>
                                    </tfoot>
                                </table>
                                <div class="display-flex">
                                    <div class="left-item"></div>
                                    <div class="center-item">
                                        <button onclick="window.print()" class="btn btn-primary">Print</button>
                                    </div>
                                </div>
                            </body>
                        </html>
                        `;

                        // Write the content to the new window
                        newWindow.document.write(content);
                        newWindow.document.close();  // Close the document to apply the styles


                    }, error: function(xhr, status, error) {
                         $('#getData').prop('disabled', false);
                         $('#getData').text('Report');
                         toastr.error('Something went wrong. Please try again.');
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
