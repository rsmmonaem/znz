@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Slip</li>
    </ul>
@stop

@section('content')
    <style>
        .wrapper {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .payslip {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 4px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            max-width: 80px;
        }

        .company-details h3,
        .company-details p {
            margin: 0;
            text-align: right;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            text-decoration: underline;
            font-size: 1.5rem;
        }

        .employee-info table,
        .earnings table,
        .deductions table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .employee-info td,
        .earnings td,
        .earnings th,
        .deductions td,
        .deductions th {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .earnings th,
        .deductions th {
            background-color: #f2f2f2;
        }

        .net-payable {
            margin-top: 20px;
        }

        .net-payable p {
            font-weight: bold;
            margin: 5px 0;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .employee-info td,
        .earnings td,
        .earnings th,
        .deductions td,
        .deductions th {
            border: 1px solid #000;
            padding: 1px !important;
            text-align: center;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Slip Panel</h2>
                    <!-- Entry Panel -->
                    <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="report-type">Report Type</label>
                                        {{-- <select class="form-control" id="report-type">
                                            <option value="salary-slab">Salary Slab</option>
                                        </select> --}}
                                       @include('common.reportSelect')
                                    </div>
                                    <div class="form-group">
                                        <label for="entryDate">Form Date</label>
                                        <input type="date" class="form-control" id="formDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="effectiveDate">To Date</label>
                                        <input type="date" class="form-control" id="toDate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-center" id="submit">Get Pay
                                            Slip</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Slip Panel --}}
                    <div id="payslip-container"></div>
                    {{-- Slip Part --}}
                    {{-- <div class="col-md-12">
                        <div class="wrapper">
                            <div class="payslip">
                                <!-- Header -->
                                <div class="header">
                                    <div class="logo">
                                        <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}"
                                            alt="Logo">
                                    </div>
                                    <div class="company-details">
                                        <h3>Kasundi Restora Ltd.</h3>
                                        <p>Uttara Dhaka</p>
                                    </div>
                                </div>

                                <!-- Title -->
                                <h2 class="title">Salary Pay Slip</h2>

                                <!-- Employee Info -->
                                <div class="employee-info">
                                    <table>
                                        <tr>
                                            <td>Month:</td>
                                            <td>JULY 2024</td>
                                            <td>Employee ID:</td>
                                            <td>5555</td>
                                        </tr>
                                        <tr>
                                            <td>Designation:</td>
                                            <td>SERVICE</td>
                                            <td>Employee Name:</td>
                                            <td>MD. RAHUL ISLAM RAHAT</td>
                                        </tr>
                                        <tr>
                                            <td>Gross:</td>
                                            <td>15,000</td>
                                            <td>Days Of Month:</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Attendance:</td>
                                            <td>30</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Earnings -->
                                <div class="earnings">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Earnings</th>
                                                <th>Amount</th>
                                                <th>Details</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Basic (50%)</td>
                                                <td>7,500</td>
                                                <td>OT Amount</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>House Rent (28%)</td>
                                                <td>4,200</td>
                                                <td>Arrear</td>
                                                <td>5,000</td>
                                            </tr>
                                            <tr>
                                                <td>Conveyance (9%)</td>
                                                <td>1,350</td>
                                                <td>Others</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Medical (8%)</td>
                                                <td>1,200</td>
                                                <td>Other Payment</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Others (5%)</td>
                                                <td>750</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Salary</td>
                                                <td>15,000</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Total Payable</strong></td>
                                                <td colspan="2"><strong>20,000</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Deductions -->
                                <div class="deductions">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Deductions</th>
                                                <th>Amount</th>
                                                <th>Details</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Late</td>
                                                <td>500</td>
                                                <td>Advance</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td>Provident Fund</td>
                                                <td>-</td>
                                                <td>Tax</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Others</td>
                                                <td>-</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Total Deduction</strong></td>
                                                <td colspan="2"><strong>1,500</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Net Payable -->
                                <div class="net-payable">
                                    <p><strong>Net Payable:</strong> 18,500</p>
                                    <p><strong>Salary in Words:</strong> Eighteen Thousand Five Hundred Only</p>
                                </div>

                                <!-- Signatures -->
                                <div class="signatures">
                                    <p>Employee Signature: __________</p>
                                    <p>Authorized Signature: _________</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
            $('#submit').click(function(e) {
                e.preventDefault();
                var formData = {
                    group: $('#group').val(),
                    branch: $('#branch').val(),
                    department: $('#department').val(),
                    section: $('#section').val(),
                    employeeId: $('#employeeId').val(),
                    formDate: $('#formDate').val(),
                    toDate: $('#toDate').val()
                };
                $.ajax({
                    url: '/salary-slip-post',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        generatePayslips(response);
                    }
                });
            })

            function generatePayslips(data) {
                // Create a new window
                const newWindow = window.open('', '_blank', 'width=800,height=600');

                // HTML structure for the new window
                let payslipsHtml = `
                    <html>
                        <head>
                            <title>Payslips</title>
                            <style>
                                .wrapper {
                                    font-family: Arial, sans-serif;
                                    padding: 20px;
                                    background-color: #f9f9f9;
                                }

                                .payslip {
                                    max-width: 900px;
                                    margin: auto;
                                    background: #fff;
                                    padding: 0px 20px;
                                    border: 1px solid #000;
                                    border-radius: 4px;
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

                                .employee-info table,
                                .earnings table,
                                .deductions table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin-bottom: 20px;
                                }

                                .employee-info td,
                                .earnings td,
                                .earnings th,
                                .deductions td,
                                .deductions th {
                                    border: 1px solid #000;
                                    padding: 8px;
                                    font-weight: bold;
                                    font-style: italic;
                                }

                                .earnings th,
                                .deductions th {
                                    background-color: #f2f2f2;
                                }

                                .net-payable {
                                    margin-top: 20px;
                                }

                                .net-payable p {
                                    font-weight: bold;
                                    margin: 5px 0;
                                }

                                .signatures {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-top: 0px;
                                }

                                .employee-info td,
                                .earnings td,
                                .earnings th,
                                .deductions td,
                                .deductions th {
                                    border: 1px solid #000;
                                    padding: 1px !important;
                                    // text-align: center;
                                }
                                .bold {
                                    font-weight: bold;
                                }
                                .text-right {
                                    text-align: right;
                                }
                                .text-center {
                                    text-align: center;
                                }
                            </style>
                        </head>
                        <body>
                `;
            
                // Loop through employee salary data to generate payslips content
                data.employee_salary_data.forEach(employee => {
                    const netPayable = 
                        parseFloat(employee.net_salary || 0) +
                        parseFloat(employee.arrear_amount || 0) +
                        parseFloat(employee.holiday_amount || 0) +
                        parseFloat(employee.ot_amount || 0) -
                        parseFloat(employee.tax_amount || 0) -
                        parseFloat(employee.provident_fund || 0) -
                        parseFloat(employee.advance_salary || 0);

                    const netPayableAfeterTax =
                        parseFloat(employee.net_salary || 0) +
                        parseFloat(employee.arrear_amount || 0) +
                        parseFloat(employee.holiday_amount || 0) +
                        parseFloat(employee.ot_amount || 0) -
                        parseFloat(employee.tax_amount || 0) -
                        parseFloat(employee.provident_fund || 0) -
                        parseFloat(employee.advance_salary || 0);
                    const grossSalary = parseFloat(employee.gross_salary || 0);
                    // HTML structure for a single payslip
                    const payslip = `
                        <div class="wrapper">
                            <div class="payslip">
                                <!-- Header -->
                                <div class="header">
                                    <div class="logo">
                                        ${data.branch.id == 7 ? 'Mohakhali Branch' : `<img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" alt="Logo">`}
                                    </div>
                                    <div class="company-details">
                                        <h3 class="bold">${data.branch.name ?? ''}</h3>
                                        <p class="bold">${data.branch.description ?? ''}</p>
                                    </div>
                                </div>
                                <!-- Title -->
                                <h2 class="title">Salary Pay Slip</h2>
                                <!-- Employee Info -->
                                <div class="employee-info">
                                    <table>
                                        <tr class="bold">
                                            <td class="text-left">Month:</td>
                                            <td colspan="3" class="text-right">${formatDate(employee.created_at)}</td>                               
                                        </tr>
                                        <tr>
                                            <td>Employee ID:</td>
                                            <td class="text-right">${employee.employee_code}</td>
                                            <td class="text-center">Employee Name:</td>
                                            <td class="text-right">${employee.first_name}</td>
                                        </tr>
                                        <tr>
                                            <td>Designation:</td>
                                            <td class="text-right">${employee.designation}</td>
                                            <td class="text-center">Gross:</td>
                                            <td class="text-right">${formatCurrency(employee.gross_salary)}</td>
                                        </tr>
                                        <tr>
                                            <td>Days Of Month:</td>
                                            <td class="text-right">${employee.date_difference}</td>
                                            <td class="text-center">Attendance:</td>
                                            <td class="text-right">${Number(employee.total_worked_days)}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Earnings -->
                                <div class="earnings">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="4">Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">Basic (50% of Gross)</td>
                                                <td class="text-right">${formatCurrency((parseFloat(employee.gross_salary || 0) * 50) / 100)}</td>
                                                <td class="text-center">OT Amount</td>
                                                <td class="text-right">${formatCurrency(parseFloat(employee.ot_amount || 0))}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">House Rent(28% of Gross)</td>
                                                <td class="text-right">${formatCurrency((parseFloat(employee.gross_salary || 0) * 28) / 100)}</td>
                                                <td class="text-center">Arrear Amount</td>
                                                <td class="text-right">${formatCurrency(parseFloat(employee.arrear_amount || 0))}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Medical (9% of Gross)</td>
                                                <td class="text-right">${formatCurrency((parseFloat(employee.gross_salary || 0) * 9) / 100)}</td>
                                                <td class="text-center">Holiday</td>
                                                <td class="text-right">${formatCurrency(parseFloat(employee.holiday_amount || 0))}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Conveyance (8% of Gross)</td>
                                                <td class="text-right">${formatCurrency((parseFloat(employee.gross_salary || 0) * 8) / 100)}</td>
                                                <td class="text-center">Other Payments</td>
                                                <td class="text-right">${formatCurrency(employee.other_payments || 0)}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Others (5% of Gross)</td>
                                                <td class="text-right">${formatCurrency((parseFloat(employee.gross_salary || 0) * 5) / 100)}</td>
                                                <td class="text-center">Other Payments</td>
                                                <td class="text-right">${formatCurrency(employee.other_payments || 0)}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Salary</td>
                                                <td class="text-right">${formatCurrency(employee.gross_salary)}</td>
                                                <td class="text-center">Other Payments</td>
                                                <td class="text-right">${formatCurrency(employee.other_payments || 0)}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"><strong>Total Payable</strong></td>
                                                <td colspan="3" style="text-align: right; margin-right: 20px"><strong>${formatCurrency(
                                                    (parseFloat(employee.gross_salary || 0) +
                                                    parseFloat(employee.ot_amount || 0) +
                                                    parseFloat(employee.arrear_amount || 0) +
                                                    parseFloat(employee.holiday_amount || 0))
                                                )}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Deductions -->
                                <div class="deductions">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="4">Deductions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Late</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-center">Advance</td>
                                                <td class="text-right">${formatCurrency(employee.advance_salary)}</td>
                                            </tr>
                                            <tr>
                                                <td>Provident Fund</td>
                                                <td class="text-right">${formatCurrency(employee.provident_fund)}</td>
                                                <td class="text-center">Tax</td>
                                                <td class="text-right">${employee.tax_amount ? formatCurrency(employee.tax_amount) : '-'}</td>
                                            </tr>
                                            <tr>
                                                <td>Absent</td>
                                                <td class="text-right">${employee.total_absents_fee}</td>
                                                <td class="text-center">Others</td>
                                                <td class="text-right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"><strong>Total Deduction</strong></td>
                                                <td colspan="3" style="text-align: right;">
                                                    <strong>${formatCurrency(
                                                        (parseFloat(employee.advance_salary || 0) +
                                                        parseFloat(employee.provident_fund || 0) +
                                                        parseFloat(employee.total_absents_fee || 0) +
                                                        parseFloat(employee.tax_amount || 0))
                                                    )}</strong>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td colspan="1"><strong>Net Payable:</strong></td>
                                                <td colspan="3" style="text-align: right;">
                                                    <strong>${formatCurrency(Math.round(netPayableAfeterTax || 0))}</strong>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td rowspan="2"><strong>Mode of Payment:</strong></td>
                                            
                                                <td class="text-right" colspan="2"><strong>Bank Amount:</strong></td>
                                                <td class="text-right" > ${formatCurrency(Math.round(employee.bankamount || 0))}</td>
                                            </tr>
                                        
                                            <tr>    
                                                <td colspan="2" class="text-right"><strong>Cash Amount:</strong></td>
                                                <td  class="text-right"> ${formatCurrency(Math.round(employee.cashamount || 0))}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"><strong>Salary in Words:</strong></td>
                                                <td colspan="3" class="text-center"><strong>${numberToWords(Math.round(netPayableAfeterTax || 0))} Only</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    
                                <!-- Signatures -->
                                <div class="signatures">
                                    <p>Employee Signature: __________</p>
                                    <p>Authorized Signature: _________</p>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    payslipsHtml += payslip;
                });

                // Close the HTML tags
                payslipsHtml += '</body></html>';

                // Write the payslips content to the new window
                newWindow.document.write(payslipsHtml);

                // Optionally, you can print the payslip in the new window after loading
                // newWindow.document.close();
                // newWindow.print();
            }

            // Helper function to generate earnings
            function generateEarnings(salaryData) {
                return Object.values(salaryData).map(salary => `
                    <tr>
                        <td>${salary.head}</td>
                        <td>${formatCurrency(salary.amount)}</td>
                        <td></td>
                        <td></td>
                    </tr>
                `).join('');
            }

            // Helper function to format currency
            function formatCurrency(amount) {
                return parseFloat(amount).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).replace('$', ''); // Remove dollar sign if not needed
            }

            // Helper function to format date
            function formatDate(date) {
                const options = { year: 'numeric', month: 'long' };
                return new Date(date).toLocaleDateString('en-US', options);
            }

            // Convert number to words
            function numberToWords(amount) {
                if (amount === 0) return "Zero";

                const ones = [
                    "", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
                    "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen",
                    "Seventeen", "Eighteen", "Nineteen"
                ];

                const tens = [
                    "", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"
                ];

                const scales = ["", "Thousand", "Million", "Billion"];

                function convertToWords(num) {
                    if (num === 0) return "";

                    if (num < 20) {
                        return ones[num];
                    } else if (num < 100) {
                        return tens[Math.floor(num / 10)] + (num % 10 > 0 ? " " + ones[num % 10] : "");
                    } else if (num < 1000) {
                        return ones[Math.floor(num / 100)] + " Hundred" + (num % 100 > 0 ? " and " + convertToWords(num % 100) : "");
                    }

                    for (let i = 0; i < scales.length; i++) {
                        const unit = 1000 ** (i + 1);
                        if (num < unit) {
                            return convertToWords(Math.floor(num / (unit / 1000))) + " " + scales[i] + (num % (unit / 1000) > 0 ? " " + convertToWords(num % (unit / 1000)) : "");
                        }
                    }
                }

                const words = convertToWords(amount);
                return words;
            }

        });
    </script>
@stop
