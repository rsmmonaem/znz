@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_separetion_report') !!}</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container" style="margin-bottom: 20px ">
                    <h2 class="text-center">Separated ID Report</h2>
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
                                    <select class="form-control" name="employeeId" id="employeeId">
                                        <option value="">Select Employee ID</option>
                                        {{-- @foreach ($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                {{ $e->employee_code }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reportType">Report Type</label>
                                    {{-- <select class="form-control" id="reportType">
                                        <option>Employee List</option>
                                        <!-- Add more options as necessary -->
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
                                    <label for="fromDate">From Date</label>
                                    <input type="date" class="form-control" id="fromDate">
                                </div>
                                <div class="form-group">
                                    <label for="toDate">To Date</label>
                                    <input type="date" class="form-control" id="toDate">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="GetReport">Report</button>
                            <button type="button" class="btn btn-danger">Close</button>
                        </div>
                    </form>

                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>DOJ</th>
                                <th>DOB</th>
                                <th>Blood</th>
                                <th>Job Nature</th>
                                <th>Category</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will go here -->
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Manager</td>
                                <td>HR</td>
                                <td>Admin</td>
                                <td>2020-01-15</td>
                                <td>1990-05-10</td>
                                <td>O+</td>
                                <td>Full-Time</td>
                                <td>Permanent</td>
                                <td>1234567890</td>
                                <td>Male</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
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
            HandleBranchWiseEmployees(branch_id, '#employeeId');
        });
        // Get Report
        $(document).on('click', '#GetReport', function(e) {
            e.preventDefault();
            var formData = {
                group: $('#group').val(),
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employeeId: $('#employeeId').val(),
                reportType: $('#reportType').val(),
                category: $('#category').val(),
                fromDate: $('#fromDate').val(),
                toDate: $('#toDate').val()
            };

            $.ajax({
                url: '/employee-separation-report',
                type: 'POST',
                data: formData, 
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    getReport(response)
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
        function getReport(response) {
            var newWindow = window.open('', '_blank', 'width=1200,height=800');

            // Build the content for the new window
            var content = `
            <html>
                <head>
                    <title>Employee Separation Report</title>
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
                        @media print {
                            .btn-print-excel button {
                                display: none !important;
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
                            <h3>Employee Separation Report</h3>
                            <p>Branch: ${response.branch_name || "All Branch"}</p>
                            <p>Date: <strong id="date">${response.date}</strong></p>
                        </div>
                    </div>
                    <table class="table table-bordered report-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Emp. Code</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>D.Of Join</th>
                                <th>DOB</th>
                                <th>BG</th>
                                <th>Job Nature</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Entry Date</th>
                                <th>Last Working Day</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            // Append rows dynamically from the response data
            response.data.forEach((employee, index) => {
                content += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${employee.employee_code || ' '}</td>
                        <td>${employee.first_name || ' '}</td>
                        <td>${employee.designation || ' '}</td>
                        <td>${employee.department || ' '}</td>
                        <td>${employee.section || ' '}</td>
                        <td>${employee.date_of_joining || ' '}</td>
                        <td>${employee.date_of_birth || ' '}</td>
                        <td>${employee.blood_group || ' '}</td>
                        <td>${employee.job_nature || ' '}</td>
                        <td>${employee.category || ' '}</td>
                        <td>${employee.contact_number || ' '}</td>
                        <td>${employee.gender || ' '}</td>
                        <td>${employee.date || ' '}</td>
                        <td>${employee.last_working_day || ' '}</td>
                    </tr>
                `;
            });

            // Close the table and add the print button
            content += `
                        </tbody>
                    </table>
                    <div class="display-flex">
                        <div class="left-item"></div>
                        <div class="center-item btn-print-excel">
                            <button onclick="window.print()" class="btn btn-primary">Print</button>
                            <button id="exportExcel" class="btn btn-success">Export to Excel</button>
                        </div>
                    </div>
                </body>
            </html>
            `;

            // Write the content to the new window
            newWindow.document.write(content);
            newWindow.document.close();  // Close the document to apply the styles  
            // Excel Export
            newWindow.document.getElementById('exportExcel').addEventListener('click', function() {
                var tableHTML = newWindow.document.querySelector('.report-table').outerHTML;
                var filename = 'Employee_separation_report.xls';
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
        }
    });
  </script>
@stop