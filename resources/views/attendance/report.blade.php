@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.attendance') !!}</li>
    </ul>
@stop

@section('content')

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
                                    {{-- @foreach ($employee as $e)
                                        <option value="{{ $e->employee_code }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                    @endforeach --}}
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

        $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employeeId').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employeeId', true);
        });

        $('#getData').on('click', function() {

            $('#getData').prop('disabled', true);
            $('#getData').text('Please Wait...');

            const formData = {
                date: $('#date').val(),
                status: $('input[name="status"]:checked').val(),
                branch_id: $('#branch').val(),
                department_id: $('#department').val(),
                section_id: $('#section').val(),
                category_id: $('#category').val(),
                designation_id: $('#designation').val(),
                employee_id: $('select[name="employeeId"]').val(),
                startDate: $('#startDate').val(),
                endDate: $('#endDate').val(),
                shift_id: $('#shift_id').val()
            };

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

                    // -----------------------------------------
                    // 🔥 Active Employee Filter (your requirement)
                    // -----------------------------------------
                    response.filtered_data = response.filtered_data.filter(
                        item => item.employee_status === "active"
                    );

                    var content = `
                    <html>
                    <head>
                        <title>Monthly Attendance Report</title>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
                        <style>
                            .center-item { text-align:center; }
                            .display-flex {
                                display:flex; justify-content:space-between;
                                border:1px solid #ccc; padding:10px; margin-bottom:20px;
                            }
                            table { width:100%; border-collapse:collapse; }
                            th, td { border:1px solid #ccc; padding:6px; text-align:center; }
                            .totals-row td { font-weight:bold; }
                            @media print { @page { size:landscape; } }
                            @media print { .btn-print-excel button { display:none; } }
                        </style>
                    </head>
                    <body>
                    `;

                    content += `
                        <div class="display-flex">
                            <div class="left-item">
                                <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}"
                                    width="150" style="margin-left:20px;">
                            </div>
                            <div class="center-item">
                                <h4>{{ config('config.company_name') }}</h4>
                                <p>Monthly Attendance Report</p>
                                <p>Branch: ${response.branch_name}</p>
                                <p>Date: <strong>${response.startDate} to ${response.toDate}</strong></p>
                            </div>
                        </div>
                    `;

                    // -----------------------------------------
                    // 🔥 Group by employee_code
                    // -----------------------------------------
                    let grouped = {};
                    response.filtered_data.forEach(att => {
                        if (!grouped[att.employee_code]) {
                            grouped[att.employee_code] = [];
                        }
                        grouped[att.employee_code].push(att);
                    });

                    // -----------------------------------------
                    // 🔥 Loop: One employee = One Page
                    // -----------------------------------------
                    for (const empCode in grouped) {

                        const empData = grouped[empCode];

                        content += `
                        <div style="page-break-after: always;">
                            <h4 style="text-align:center;">
                                ${empData[0].name} (${empCode})
                            </h4>

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
                                        <th>Late</th>
                                        <th>OT</th>
                                        <th>Extra</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        empData.forEach((att, index) => {
                            content += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${att.date || ''}</td>
                                <td>${att.employee_code || ''}</td>
                                <td>${att.name || ''}</td>
                                <td>${att.department || ''}</td>
                                <td>${att.section || ''}</td>
                                <td>${att.category || ''}</td>
                                <td>${att.designation || ''}</td>
                                <td>${att.shift_in || ''}</td>
                                <td>${att.shift_out || ''}</td>
                                <td>${att.shift_name || ''}</td>
                                <td>${att.in_time || ''}</td>
                                <td>${att.out_time || ''}</td>
                                <td>${att.status || ''}</td>
                                <td>${att.lateTime || ''}</td>
                                <td>${att.overTime || ''}</td>
                                <td>${att.overTime || ''}</td>
                                <td>${att.remarks || ''}</td>
                            </tr>
                            `;
                        });

                        content += `
                                </tbody>
                            </table>
                        </div>
                        `;
                    }

                    // -----------------------------------------
                    // PRINT + EXCEL BUTTON
                    // -----------------------------------------
                    content += `
                        <div class="center-item btn-print-excel">
                            <button onclick="window.print()" class="btn btn-primary">Print</button>
                            <button id="exportExcel" class="btn btn-success">Export to Excel</button>
                        </div>
                    </body>
                    </html>
                    `;

                    newWindow.document.write(content);
                    newWindow.document.close();

                    // Excel Export
                    newWindow.document.getElementById('exportExcel').addEventListener('click', function() {
                        var tableHTML = newWindow.document.querySelector('.report-table').outerHTML;
                        var filename = 'monthly_attendance.xls';
                        var uri = 'data:application/vnd.ms-excel;base64,';
                        var template = `
                        <html xmlns:o="urn:schemas-microsoft-com:office:office"
                            xmlns:x="urn:schemas-microsoft-com:office:excel">
                        <body>${tableHTML}</body></html>`;

                        var base64 = s => window.btoa(unescape(encodeURIComponent(s)));
                        var link = newWindow.document.createElement('a');
                        link.href = uri + base64(template);
                        link.download = filename;
                        link.click();
                    });

                },

                error: function() {
                    $('#getData').prop('disabled', false);
                    $('#getData').text('Report');
                    toastr.error('Something went wrong.');
                }

            });
        });

    });
</script>


@stop
