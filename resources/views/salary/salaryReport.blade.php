@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Slab Report</li>
    </ul>
@stop

@section('content')
    <style>
        .form-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-section .form-group {
            width: 48%;
            /* Adjust width to make space for both sides */
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select,
        .form-group input {
            width: 100%;
        }

        .form-section-right {
            display: flex;
            flex-direction: column;
        }

        .form-section-right .form-group {
            margin-bottom: 15px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .report-header h3 {
            text-align: center;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container" style="margin-bottom: 30px">
                    <!-- Report Header -->
                    <div class="report-header">
                        <h3>Salary Slab Report</h3>
                    </div>

                    <!-- Form Section -->
                    <div class="row">
                        <!-- Left Section: Filters -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option value="">Select Group</option>
                                    @foreach ($group as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select class="form-control" id="branch">
                                    <option value="">Select Branch</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department">
                                    <option value="">Select Department</option>
                                    @foreach ($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select class="form-control" id="section">
                                    <option value="">Select Section</option>
                                    @foreach ($section as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select class="form-control" id="designation">
                                    <option value="">Select Designation</option>
                                    @foreach ($designation as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employee-id">Employee ID</label>
                                <select class="form-control" id="employee_id">
                                    <option value="">Select Employee ID</option>
                                    {{-- @foreach ($employee as $e)
                                        <option value="{{ $e->id }}">{{ $e->first_name }} -
                                            {{ $e->employee_code }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <!-- Right Section: Report Type and Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="report-type">Report Type</label>
                                {{-- <select class="form-control" id="report-type">
                                    <option value="salary-slab">Salary Slab</option>
                                </select> --}}
                               @include('common.reportSelect')
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                {{-- <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                    <otion value="owner">Owner</option>
                                    <option value="staff">Staff</option>
                                </select> --}}
                                 @include('common.category')
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type">
                                    <option value="management">Management</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="buttons">
                        <button class="btn btn-primary" id="report">Report</button>
                        <button class="btn btn-danger">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        $('#employee_id').select2();

        $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employee_id').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employee_id');
        });

        $('#report').on('click', function() {
            var formData = {
                group: $('#group').val(),
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employeeId: $('#employee_id').val(),
                reportType: $('#report-type').val(),
                category: $('#category').val(),
                type: $('#type').val()
            };

            $.ajax({
                url: "{{ url('SalaryReportPOST') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    getReport(response);
                },
                error: function() {
                    console.log('error');
                }
            })
        })
    })

    
    function getReport(response) {
        
        var newWindow = window.open('', '_blank', 'width=1200,height=800');

        
        var content = `
        <html>
            <head>
                <title>Salary Slab Report</title>
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
                    .btn {
                        display: block;
                        margin: 20px auto;
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
                        <h3>Salary Slab Report</h3>
                        <p>Branch: {{ Auth::user()->profile->branch->name }}</p>
                        <p>Date: <strong id="date"></strong></p>
                    </div>
                </div>
                <table class="table table-bordered report-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Section</th>
                            <th>DOJ</th>
                            <th>Grade</th>
                            <th>Account Number</th>
                            <th>Bank Amount</th>
                            <th>Cash Amount</th>
                            <th>Gross</th>
                            <th>Basic</th>
                            <th>House Rent</th>
                            <th>Medical</th>
                            <th>Conveyance</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        
        response.forEach((employee, index) => {
            let gross = parseFloat(employee.user_info.gross) || 0;

            
            let basic = Math.round(gross * 0.50);
            let house = Math.round(gross * 0.28);
            let medical = Math.round(gross * 0.09);
            let conveyance = Math.round(gross * 0.08);
            let others = Math.round(gross * 0.05);

            content += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${employee.user_info.first_name || ' '}</td>
                    <td>${employee.user_info.designation || ' '}</td>
                    <td>${employee.user_info.departments || ' '}</td>
                    <td>${employee.user_info.section || ' '}</td>
                    <td>${employee.user_info.date_of_joining || ' '}</td>
                    <td>${employee.user_info.grades || ' '}</td>
                    <td>${employee.user_info.account_number || ' '}</td>
                    <td>${employee.user_info.bank_amount || 0}</td>
                    <td>${employee.user_info.cash_amount || 0}</td>
                    <td>${gross}</td>
                    <td>${basic}</td>
                    <td>${house}</td>
                    <td>${medical}</td>
                    <td>${conveyance}</td>
                    <td>${others}</td>
                </tr>`;
        });

        
        content += `
                    </tbody>
                </table>
                <div class="display-flex">
                    <div class="center-item">
                        <button onclick="window.print()" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </body>
        </html>
        `;

        
        newWindow.document.write(content);
        newWindow.document.close(); 
    }


</script>
@stop
