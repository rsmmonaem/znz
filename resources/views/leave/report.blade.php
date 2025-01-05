@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.leave_repot') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2><strong>{!! trans('messages.check') !!}</strong> {!! trans('messages.leave_repot') !!}
                    {{-- <div class="additional-btn">
                            <a href="/leave"><button class="btn btn-sm btn-primary"><i class="fa fa-bars icon"></i> {!! trans('messages.list_all') !!}</button></a>
                        </div> --}}
                </h2>

                <div class="container">
                    <form>
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Group</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="group">
                                            <option>J &amp; Z Group</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Branch</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="branch" id="branch">
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Department</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="department" id="department">
                                            <option value="">Select Department</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Section</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="section" id="section">
                                            <option value="">Select Section</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Designation</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="designation" id="designation">
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Employee ID</label>
                                    <div class="col-sm-8">
                                        {{-- <input type="text" id="employeeID" class="form-control"
                                            placeholder="Employee ID"> --}}
                                        <select class="form-control" name="employeeID" id="employeeID">
                                            <option value="">Select Employee ID</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->employee_code }}">{{ $e->employee_code }} - {{ $e->first_name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Report Type</label>
                                    <div class="col-sm-8">
                                        {{-- <select class="form-control" id="reportType">
                                            <option>Leave Details (By staff)</option>
                                        </select> --}}
                                        @include('common.reportSelect')
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Category</label>
                                    <div class="col-sm-8">
                                        {{-- <select class="form-control" name="category" id="category">
                                            <option value="staff">staff</option>
                                            <option value="owner">owner</option>
                                        </select> --}}
                                         @include('common.category')
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="status" id="status">
                                            <option value="">All</option>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="lwp">LWP</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">From Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="fromDate">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">To Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="toDate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons at the Bottom, Centered -->
                        <div class="form-group row text-center">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" id="getData">Report</button>
                                <button type="reset" class="btn btn-default" >Close</button>
                            </div>
                        </div>
                    </form>

                    <hr>
                <div class="table-container" style="display: none">
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
                            <p>Leave Details by Status</p>
                            <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                            <p>Date: <strong id="date"></strong></p>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Leave</th>
                                <th>Approve Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
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
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('select').select2();
            
              $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employeeID').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employeeID', true);
        });
            // get form data
$('#getData').on('click', function(e) {
    e.preventDefault();

    // Gather form data
    var branch = $('#branch').val();
    var department = $('#department').val();
    var section = $('#section').val();
    var designation = $('#designation').val();
    var employeeID = $('#employeeID').val();
    var reportType = $('#reportType').val();
    var category = $('#category').val();
    var status = $('#status').val();
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();

    var formData = {
        branch: branch,
        department: department,
        section: section,
        designation: designation,
        employeeID: employeeID,
        reportType: reportType,
        category: category,
        status: status,
        fromDate: fromDate,
        toDate: toDate
    };

    // Make the AJAX request
    $.ajax({
        url: '{{ url('leave-report') }}',  // URL to get the leave report data
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Open a new window
            var newWindow = window.open('', '_blank', 'width=1200,height=800');

            // Build the content for the new window
            var content = `
            <html>
                <head>
                    <title>Leave Report</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        .center-item {
                            margin-left: auto;
                            margin-right: auto;
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
                    </style>
                </head>
                <body>
                    <div class="display-flex">
                        <div class="left-item">
                            <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" width="150px" style="margin-left:20px;">
                        </div>
                        <div class="center-item">
                            <h4>{{ config('config.company_name') }}</h4>
                            <h3>Leave Report</h3>
                            <p>Leave Details by Status</p>
                            <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                            <p>Date: <strong id="date">${response.fromDate} to ${response.toDate}</strong></p>
                        </div>
                    </div>
                    <table class="table table-bordered report-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Leave Type</th>
                                <th>Approve Date</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            // Append rows dynamically from the response
            response.data.forEach((leave, index) => {
                content += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${leave.employee_id || 'N/A'}</td>
                    <td>${leave.first_name || 'N/A'}</td>
                    <td>${leave.designation_name || 'N/A'}</td>
                    <td>${leave.department_name || 'N/A'}</td>
                    <td>${leave.section_name || 'N/A'}</td>
                    <td>${leave.leave_type_name || 'N/A'}</td>
                    <td>${leave.approved_date || 'N/A'}</td>
                    <td>${leave.from_date || 'N/A'}</td>
                    <td>${leave.to_date || 'N/A'}</td>
                    <td>${leave.remarks || 'N/A'}</td>
                </tr>
                `;
            });

            // Close the table and add the print button
            content += `
                        </tbody>
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
        },
        error: function(xhr, status, error) {
            console.error("Error occurred: " + error);
        }
    });
});


            // display data
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
