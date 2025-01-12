@extends('layouts.default')

@section('breadcrumb')
    <a href="/">Home</a>
    <i class="fa fa-angle-right"></i>
    <a class="current text-primary" href="/salary-summary">Salary Summary</a>
@stop

@section('content')
    <style>
        /* .table th, .table td {
            text-align: center;
        }
        .container {
            margin-top: 20px;
        } */
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
                <h2><strong>Salary Summary</strong></h2>
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
                                    @for ($year = 2030; $year >= 2010; $year--) <!-- Corrected condition -->
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
                                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <br>
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
          HandleBranchWiseEmployees(branchId,'#employee');
       });

       $('#GetReport').click(function() {
          $('#GetReport').attr('disabled', 'disabled');
          $('#GetReport').html('Please wait...');
          var formData = {
                group: $('#group').val(),
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employee: $('#employee').val(),
                reportType: $('#reportType').val(),
                financialYear: $('#financialYear').val(),
                month: $('#month').val()
            };

            $.ajax({
                type: 'POST',
                url: '/salary-summary',
                data: formData,
                success: function(response) {
                    $('#GetReport').attr('disabled', false);
                    $('#GetReport').html('Report');
                    getReport(response);
                },
                error: function(response) {
                    $('#GetReport').attr('disabled', false);
                    $('#GetReport').html('Report');
                    console.log(response);
                }
            });
       });

       function getReport(data) {
    // Create a new window
    const newWindow = window.open('', '_blank', 'width=800,height=600');

    // HTML structure for the new window
    let payslipsHtml = `
    <html>
        <head>
            <title>Salary Summary</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                .header {
                    display: flex;
                    align-items: center; 
                    justify-content: space-between; 
                    border-bottom: 5px solid #333;
                    height: 90px;
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
                    font-style: italic; 
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
                             ${data.branch?.id == 7 ? 'Mohakhali Branch' : `<img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" alt="Logo">`}
                        </div>
                        <div class="company-details">
                            <h3 class="bold">${data.branch?.name ?? ''}</h3>
                            <p class="bold">${data.branch?.description ?? ''}</p>
                        </div>
                    </div>       
            <h2 class="title">Salary Summary</h2>
            <table>
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Name of Branch</th>
                        <th>Active Manpower</th>
                        <th>Separated Manpower</th>
                        <th>Net Salary</th>
                        <th>Advance Salary</th>
                        <th>Attendance Deduction</th>
                        <th>Tax Amount</th>
                        <th>Net Payable</th>
                    </tr>
                </thead>
                <tbody>
    `;

    // Initialize sums
    let totalActiveManpower = 0;
    let totalSeparatedManpower = 0;
    let totalNetSalary = 0;
    let totalAdvanceSalary = 0;
    let totalAttendanceDeduction = 0;
    let totalTaxAmount = 0;
    let totalNetPayable = 0;

    // Loop through data to populate table rows
    data.data.forEach((item, index) => {
        const rowNumber = index + 1; // SL No (1-based index)
        totalActiveManpower += parseFloat(item.active_manpower);
        totalSeparatedManpower += parseFloat(item.separated_manpower);
        totalNetSalary += parseFloat(item.net_salary);
        totalAdvanceSalary += parseFloat(item.advance_salary);
        totalAttendanceDeduction += parseFloat(item.attendance_deduction);
        totalTaxAmount += parseFloat(item.tax_amount);
        totalNetPayable += parseFloat(item.net_payable);

        payslipsHtml += `
            <tr>
                <td>${rowNumber}</td>
                <td>${item.branch_name}</td>
                <td>${item.active_manpower || 0}</td>
                <td>${item.separated_manpower || 0}</td>
                <td>${item.net_salary || 0}</td>
                <td>${item.advance_salary || 0}</td>
                <td>${item.attendance_deduction || 0}</td>
                <td>${item.tax_amount || 0}</td>
                <td>${item.net_payable || 0}</td>
            </tr>
        `;
    });

    // Add the summary row with totals
    payslipsHtml += `
        <tr class="bold">
            <td colspan="2">Total</td>
            <td>${totalActiveManpower || 0}</td>
            <td>${totalSeparatedManpower || 0}</td>
            <td>${totalNetSalary || 0}</td>
            <td>${totalAdvanceSalary || 0}</td>
            <td>${totalAttendanceDeduction || 0}</td>
            <td>${totalTaxAmount || 0}</td>
            <td>${totalNetPayable || 0}</td>
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
    </html>
    `;

    // Write the payslips content to the new window
    newWindow.document.write(payslipsHtml);
    newWindow.document.close();
}
       
    });
</script>
@stop
