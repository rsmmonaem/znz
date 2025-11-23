@extends('layouts.default')

@section('breadcrumb')
    <a href="/">Home</a>
    <i class="fa fa-angle-right"></i>
    <a class="current text-primary" href="/salary-bank-statement">Employee Salary Transfer at a Glance</a>
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
                <h2><strong>Employee Salary Transfer at a Glance</strong></h2>
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
                            <label for="category" class="control-label col-md-4">Category</label>
                            <div class="col-md-8">
                                <select class="form-control" id="category">
                                    <option value="">Select Category</option>
                                     @foreach ($category as $c)
                                         <option value="{{ $c->name }}">{{ $c->name }}</option>
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
                    category: $('#category').val()
                };

                $.ajax({
                    url: '/salary-transfer-glance',
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
                const newWindow = window.open('', '_blank', 'width=900,height=600');

                let totalBank = 0;
                let totalCash = 0;

                let payslipsHtml = `
                <html>
                <head>
                    <title>Salary Transfer</title>
                    <style>
                        body { font-family: Arial; padding: 20px; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
                        th { background: #f2f2f2; }
                        #controls { margin-bottom: 15px; }
                    </style>
                </head>
                <body>

                    <div id="controls">
                        <button onclick="window.print()" id="printButton" 
                            style="padding:6px 12px;background:#3498db;color:#fff;border:none;border-radius:4px;cursor:pointer;">
                            Print
                        </button>

                        <button onclick="downloadExcel()" id="excelButton" 
                            style="padding:6px 12px;background:#27ae60;color:#fff;border:none;border-radius:4px;cursor:pointer;">
                            Excel Download
                        </button>
                    </div>

                    <h2 style="text-align:center;margin-top:-10px;">Employee Salary Transfer at a Glance</h2>
                    <h4 style="text-align:center;">For the Month of ${data.month} ${data.financialYear}</h4>

                    <table id="salaryTable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Branch</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Desig</th>
                                <th>Dept</th>
                                <th>Section</th>
                                <th>Gross</th>
                                <th>Total Payable</th>
                                <th>Total Deduction</th>
                                <th>Net Payable</th>
                                <th>Bank Transfer</th>
                                <th>Cash Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                $.each(data.data, function(index, item) {

                    let totalDeduction =
                        (parseFloat(item.advance_salary) || 0) +
                        (parseFloat(item.provident_fund) || 0) +
                        (parseFloat(item.tax_amount) || 0);

                    let netPayable =
                        (parseFloat(item.net_salary) || 0) +
                        (parseFloat(item.arrear_amount) || 0) -
                        (parseFloat(item.advance_salary) || 0) +
                        (parseFloat(item.provident_fund) || 0) +
                        (parseFloat(item.tax_amount) || 0);

                    // Running totals
                    totalBank += parseFloat(item.salary_bank_amount) || 0;
                    totalCash += parseFloat(item.salary_cash_amount) || 0;

                    payslipsHtml += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.branch_name}</td>
                        <td>${item.employee_code}</td>
                        <td>${item.first_name}</td>
                        <td>${item.designation_name}</td>
                        <td>${item.department_name}</td>
                        <td>${item.section_name}</td>
                        <td>${item.gross_salary}</td>
                        <td>${item.net_salary}</td>
                        <td>${totalDeduction.toFixed(2)}</td>
                        <td>${netPayable.toFixed(2)}</td>
                        <td>${item.salary_bank_amount.toFixed(2)}</td>
                        <td>${item.salary_cash_amount.toFixed(2)}</td>
                    </tr>`;
                });

                payslipsHtml += `
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="11" style="text-align:right">Totals:</th>
                                <th>${totalBank.toFixed(2)}</th>
                                <th>${totalCash.toFixed(2)}</th>
                            </tr>
                        </tfoot>
                    </table>

                    <script>
                        function downloadExcel() {
                            var table = document.getElementById("salaryTable").outerHTML;
                            var dataType = "application/vnd.ms-excel";
                            var fileName = "salary_transfer.xls";

                            var link = document.createElement("a");
                            link.href = "data:" + dataType + ", " + encodeURIComponent(table);
                            link.download = fileName;
                            link.click();
                        }
                    <\/script>

                    <style>
                        @media print {
                            #printButton, #excelButton {
                                display: none;
                            }
                        }
                    </style>
                </body>
                </html>`;

                newWindow.document.write(payslipsHtml);
                newWindow.document.close();
            }

        });
    </script>
@stop
