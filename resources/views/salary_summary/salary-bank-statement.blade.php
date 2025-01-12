@extends('layouts.default')

@section('breadcrumb')
    <a href="/">Home</a>
    <i class="fa fa-angle-right"></i>
    <a class="current text-primary" href="/salary-bank-statement">Salary Bank Statement</a>
@stop

@section('content')
    <style>
        .report-buttons {
            margin-top: 20px;
        }

        .mb-40 {
            margin-bottom: 40px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="box-info">
                <h2><strong>Salary Bank Statement</strong></h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-40">
                            <label for="group" class="control-label col-md-3">Group:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="group">
                                    <option value="">Select</option>
                                    @foreach ($group as $g)
                                        <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="branch" class="control-label col-md-3">Branch:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="branch">
                                    <option value="">Select</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="department" class="control-label col-md-3">Department:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="department">
                                    <option value="">Select</option>
                                    @foreach ($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="section" class="control-label col-md-3">Section:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="section">
                                    <option value="">Select</option>
                                    @foreach ($section as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="designation" class="control-label col-md-3">Designation:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="designation">
                                    <option value="">Select</option>
                                    @foreach ($designation as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="employee" class="control-label col-md-3">Employee ID:</label>
                            <div class="col-md-9">
                                <select class="form-control" id="employee">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-40">
                            <label for="reportType" class="control-label col-md-4">Report Type:</label>
                            <div class="col-md-8">
                                @include('common.reportSelect')
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="financialYear" class="control-label col-md-4">Financial Year:</label>
                            <div class="col-md-8">
                                <select class="form-control" id="financialYear">
                                    <option value="">Select</option>
                                    @for ($year = 2030; $year >= 2010; $year--)
                                        <!-- Corrected condition -->
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="month" class="control-label col-md-4">Month:</label>
                            <div class="col-md-8">
                                <select class="form-control" id="month">
                                    <option value="">Select</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-40">
                            <label for="bankType" class="control-label col-md-4">Bank Type</label>
                            <div class="col-md-8">
                                <select class="form-control" id="bankType">
                                    <option value="">Select Bank Type</option>
                                    @foreach ($bankType as $b)
                                        <option value="{{ $b->bank_name }}">{{ $b->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center report-buttons">
                    <button type="button" class="btn btn-primary" id="GetReport">Report</button>
                    <button type="button" class="btn btn-danger">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#branch').change(function() {
                var branchId = $(this).val();
                $('#employee').val('').trigger('change');
                HandleBranchWiseEmployees(branchId, '#employee');
            });

            $('#GetReport').click(function() {
                $('#GetReport').attr('disabled', 'disabled');
                $('#GetReport').html('Please wait...');
                const FormData = {
                    branch: $('#branch').val(),
                    department: $('#department').val(),
                    section: $('#section').val(),
                    designation: $('#designation').val(),
                    employee: $('#employee').val(),
                    reportType: $('#reportType').val(),
                    financialYear: $('#financialYear').val(),
                    month: $('#month').val(),
                    bankType: $('#bankType').val()
                };

                $.ajax({
                    url: '/salary-bank-statement',
                    type: 'POST',
                    data: FormData,
                    success: function(response) {
                        $('#GetReport').removeAttr('disabled');
                        $('#GetReport').html('Report');
                        ShowData(response);
                    }
                }).fail(function() {
                    $('#GetReport').removeAttr('disabled');
                    $('#GetReport').html('Report');
                });
            })


            function ShowData(data) {
                // Create a new window
                const newWindow = window.open('', '_blank', 'width=900,height=600');
                // HTML structure for the new window
                let payslipsHtml = `
                <html>
                    <head>
                        <title>Salary Bank Statement</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                padding: 20px;
                            }
                            .header {
                                display: flex;
                                align-items: center; 
                                justify-content: space-between; 
                                border-bottom: 1px solid #333;
                                height: 90px;
                                margin-bottom: 20px;
                            }

                            .logo {
                                flex-shrink: 0; 
                            }

                            .logo img {
                                max-width: auto;
                                height: 100%;
                            }
                            .company-details {
                                flex-grow: 1; 
                                text-align: center; 
                            }

                            .title {
                                text-align: center;
                                margin: 0px 0;
                                font-size: 1.2rem;
                            }
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-bottom: 20px;
                            }
                            th, td {
                                border: 1px solid #000;
                                padding: 8px;
                                text-align: center;
                            }
                            th {
                                background-color: #f2f2f2;
                                font-weight: bold;
                            }
                            .bold {
                                font-weight: bold;
                            }
                            .text-right {
                                text-align: right;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                                    <div class="logo">
                                        <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" alt="Logo">
                                    </div>
                                    <div class="company-details">
                                    <h1 class="title">${data.branch.name}</h1>
                                    <h2 class="title">${data.branch.description}</h2>
                                    <h3 class="title">Salary Bank Transfer Statement for the month of ${data.month} ${data.financialYear}</h3>
                                    </div>
                                </div>       
                        <table>
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Bank Account Number</th>
                                    <th>Bank Account Name</th>
                                    <th>Deposit Amount</th>
                                </tr>
                            </thead>
                            <tbody>`;
                  let totalAmount = 0;
                   // Loop through the payslips data and add rows             
                  $.each(data.data, function(index, item) {
                    var row = '<tr>';
                    row += '<td>' + (index + 1) + '</td>'; // Adding index to display SL No
                    row += '<td>' + item.employee_code + '</td>';
                    row += '<td>' + item.first_name + '</td>';
                    // row += '<td>' + (item.latest_bank_name || 'N/A') + '</td>';
                    row += '<td>' + (item.latest_bank_account_number || 'N/A') + '</td>';
                    row += '<td>' + (item.latest_bank_account_name || 'N/A') + '</td>';
                    // row += '<td>' + (item.salary_bank_effective_date ? item.salary_bank_effective_date : 'N/A') + '</td>';
                    row += '<td>' + (item.salary_bank_amount || 'N/A') + '</td>';
                    row += '</tr>';
                    payslipsHtml += row; // Append row to the HTML string
                    if (item.salary_bank_amount) {
                        totalAmount += parseFloat(item.salary_bank_amount);
                    }
                });
                 payslipsHtml += `
                        <tr class="bold">
                            <td colspan="5" class="text-right">Total</td>
                            <td>${totalAmount.toFixed(2)}</td>
                        </tr>
                    `;
                 // Close the table and HTML tags
                payslipsHtml += `
                            </tbody>
                        </table>
                        <div class="display-flex">
                            <div class="center-item">
                                <button onclick="window.print()" class="btn btn-primary" id="printButton">Print</button>
                            </div>
                        </div>
                        <style>
                            @media print {
                                #printButton {
                                    display: none;
                                }
                            }
                        </style>
                    </body>
                </html>`;

                // Write the payslips content to the new window
                newWindow.document.write(payslipsHtml);
                newWindow.document.close();
            }
        });
    </script>
@stop
