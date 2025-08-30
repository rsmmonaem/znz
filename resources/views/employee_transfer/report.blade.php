@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.leave_repot') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-section {
            margin-bottom: 20px;
        }

        .report-table th,
        .report-table td {
            text-align: center;
        }

        .col-sm-4 control-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .form-group {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2><strong>{!! trans('messages.check') !!}</strong> {!! trans('messages.employee_transfer_report') !!}
                </h2>
                {{-- Form Container --}}
                <div class="container">
                    <!-- Header Section -->
                    <div class="text-center">
                        <h3>{!! trans('messages.employee_transfer_report') !!}</h3>
                        <p><strong>Report Name:</strong> Transfer History List</p>
                    </div>

                    <!-- Filter Form Section -->
                    <div class="row">
                        <form>
                            <div class="col-md-6">
                                <div class="form-section">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="group">Group</label>
                                        <select class="form-control" name="group" id="group">
                                            <option value="">J & Z Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="branch">Branch</label>
                                        <select class="form-control" name="branch" id="branch">
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="department">Department</label>
                                        <select class="form-control" name="department" id="department">
                                            <option value="">Select Department</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="section">Section</label>
                                        <select class="form-control" name="section" id="section">
                                            <option value="">Select Section</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="designation">Designation</label>
                                        <select class="form-control" name="designation" id="designation">
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="employeeID">Employee ID</label>
                                        {{-- <input type="text" class="form-control" id="employeeID"
                                            placeholder="Employee ID"> --}}
                                        <select class="form-control" name="employeeID" id="employeeID">
                                            <option value="">Select Employee ID</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->employee_code }} -
                                                    {{ $e->first_name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="reportType">Report Type</label>
                                    {{-- <input type="text" class="form-control" id="reportType" value="Transfer History"
                                        readonly> --}}
                                   @include('common.reportSelect')
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-bottom: 20px" id="generateReport">Generate
                        Report</button>
                    </form>

                    <!-- Report Table Section -->

                </div>
            </div>
        </div>
        {{-- End Form Containner --}}
    </div>
    </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('select').select2();
        });

        $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employeeID').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employeeID');
        });
        // Generate Report
        $('#generateReport').on('click', function(e) {
            e.preventDefault();

            var branch = $('#branch').val();
            var department = $('#department').val();
            var section = $('#section').val();
            var designation = $('#designation').val();
            var employeeID = $('#employeeID').val();
            var reportType = $('#reportType').val();

            var formData = {
                branch: branch,
                department: department,
                section: section,
                designation: designation,
                employeeID: employeeID,
                reportType: reportType
            };

            $.ajax({
                url: '{{ url('reportData') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Create a new window
                    var newWindow = window.open('', '_blank', 'width=1200,height=800');

                    // Build the content for the new window
                    var content = `
                <html>
                    <head>
                        <title>Employee Transfer Report</title>
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
                            @media print {
                                @page {
                                    size: landscape;
                                }
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
                                <h3>Employee Transfer Report</h3>
                                <p>Transfer History List</p>
                            </div>
                        </div>
                        <table class="table table-bordered report-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>DOJ</th>
                                    <th>Designation</th>
                                    <th>Dept</th>
                                    <th>Section</th>
                                    <th>Joining Branch</th>
                                    <th>Transfer Branch</th>
                                    <th>Transfer Date</th>
                                </tr>
                            </thead>
                            <tbody>
            `;

                    // Append table rows dynamically from the response
                    response.forEach((record, index) => {
                        content += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${record.employee_code || 'N/A'}</td>
                        <td>${record.name || 'N/A'}</td>
                        <td>${record.date_of_joining || 'N/A'}</td>
                        <td>${record.designation || 'N/A'}</td>
                        <td>${record.department || 'N/A'}</td>
                        <td>${record.section || 'N/A'}</td>
                        <td>${record.from_branch || 'N/A'}</td>
                        <td>${record.to_branch || 'N/A'}</td>
                        <td>${record.ftransfer_date || 'N/A'}</td>
                    </tr>
                `;
                    });

                    // Close table and add print button
                    content += `
                            </tbody>
                        </table>
                        <div class="display-flex">
                            <div class="left-item"></div>
                            <div class="center-item">
                                <button onclick="window.print()" class="btn btn-primary">Print</button>
                                <button id="exportExcel" class="btn btn-success">Export to Excel</button>
                            </div>
                        </div>
                    </body>
                </html>
            `;

                    // Write the content to the new window
                    newWindow.document.write(content);
                    newWindow.document.close(); // Close the document to apply styles
                    newWindow.document.getElementById('exportExcel').addEventListener('click', function() {
            var tableHTML = newWindow.document.querySelector('.report-table').outerHTML;
            var filename = 'Employee_Report.xls';
            var uri = 'data:application/vnd.ms-excel;base64,';
            var template = `
            <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                xmlns:x="urn:schemas-microsoft-com:office:excel" 
                xmlns="http://www.w3.org/TR/REC-html40">
            <head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>
            <x:Name>Salary Slab</x:Name>
            <x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>
            </x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->
            </head><body>${tableHTML}</body></html>
            `;
            var base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) };
            var link = newWindow.document.createElement('a');
            link.href = uri + base64(template);
            link.download = filename;
            link.click();
        });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
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
