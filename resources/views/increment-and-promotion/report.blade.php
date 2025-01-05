@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.promotion_increment') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            width: 150px;
            /* Adjust the width of labels */
            margin-right: 15px;
            text-align: right;
            /* Align labels to the right */
        }

        .form-group .form-control {
            flex: 1;
            /* Input field takes the remaining space */
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .table-container {
            margin-top: 20px;
        }

        .btn-section {
            margin-top: 20px;
            text-align: center;
        }

        .header h2,
        .header h4 {
            margin: 7px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container report-container" style="margin-bottom: 20px">
                    <!-- Header Section -->
                    <div class="header">
                        <h2>Promotion & Increment Report</h2>
                        <h4>Employee Promotion & Increment History</h4>
                        {{-- <p>Head Office | Address</p> --}}
                    </div>

                    <!-- Form Section -->
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group">Group</label>
                                    <select id="group" class="form-control">
                                        <option value="">Select Group</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select id="branch" class="form-control">
                                        <option value="">Select Branch</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <select id="section" class="form-control">
                                        <option value="">Select Section</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <select id="designation" class="form-control">
                                        <option value="">Select Designation</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="empId">Emp ID</label>
                                    <select id="empId" class="form-control">
                                        <option value="">Select Emp ID</option>
                                        {{-- @foreach ($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                {{ $e->employee_code }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reportType">Report Type</label>
                                    {{-- <select id="reportType" class="form-control">
                                        <option value="history">Emp Promotion & Increment History</option>
                                    </select> --}}
                                    @include('common.reportSelect')
                                </div>
                                <div class="form-group">
                                    <label for="financialYear">Financial Year</label>
                                    <select id="financialYear" class="form-control">
                                        <option value="">Select Financial Year</option>
                                        @for ($i = 2030; $i >= date('Y') - 10; $i--)
                                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                        {{-- @foreach ($year as $y)
                                        <option value="{{ $y->id }}">{{ $y->name }}</option>
                                    @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Before/After/All</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="dateFilter" value="before"> Before
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="dateFilter" value="after"> After
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="dateFilter" value="all" checked> All
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-section">
                            <button type="submit" class="btn btn-primary" id ="generateReport">Generate Report</button>
                            <button type="button" class="btn btn-default">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#empId').select2();
        });

          $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#empId').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#empId');
        });

        $(document).on('click', '#generateReport', function(e) {
            e.preventDefault();
            var formData = {
                group: $('#group').val(),
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employeeId: $('#empId').val(),
                reportType: $('#reportType').val(),
                financialYear : $('#financialYear').val(),
                month : $('#month').val(),
                dateFilter : $('input[name="dateFilter"]:checked').val()
            };

            $.ajax({
                url: '/increment-and-promotion-report',
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
                    </style>
                </head>
                <body>
                    <div class="display-flex">
                        <div class="left-item">
                            <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" width="150px" style="margin-left:20px;">
                        </div>
                        <div class="center-item">
                            <h4>{{ config('config.company_name') }}</h4>
                            <h3>Promotion & Increment Report</h3>
                            <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                            <p>Date: <strong id="date">${response.date}</strong></p>
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
                                <th>DOJ</th>
                                <th>Gross</th>
                                <th>Increment</th>
                                <th>Promotion</th>
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
                        <td>${(parseFloat(employee.old_amount) || 0) + (parseFloat(employee.promotedAmount) || 0)}</td>
                        <td>${employee.increment || ' '}</td>
                        <td>${employee.promotion || ' '}</td>
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
        }
    </script>
@stop
