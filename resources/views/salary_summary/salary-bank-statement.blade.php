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
    $(document).ready(function () {
        $('#branch').change(function () {
            var branchId = $(this).val();
            $('#employee').val('').trigger('change');
            HandleBranchWiseEmployees(branchId, '#employee');
        });

        $('#GetReport').click(function () {
            var newWindow = window.open('', '_blank', 'width=1200,height=800');
            if (newWindow) {
                newWindow.document.write('<html><head><title>Salary Bank Statement</title></head><body style="font-family:Arial,sans-serif;padding:30px;text-align:center;"><h2>Loading Salary Bank Statement...</h2></body></html>');
            }

            $('#GetReport').attr('disabled', 'disabled').html('Please wait...');
            const FormDataObj = {
                _token: '{{ csrf_token() }}',
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employee: $('#employee').val(),
                reportType: $('#report-select').val(),
                financialYear: $('#financialYear').val(),
                month: $('#month').val(),
                bankType: $('#bankType').val()
            };

            $.ajax({
                url: '/salary-bank-statement',
                type: 'POST',
                data: FormDataObj,
                success: function (response) {
                    $('#GetReport').removeAttr('disabled').html('Report');
                    ShowData(response, newWindow);
                }
            }).fail(function (xhr, status, error) {
                $('#GetReport').removeAttr('disabled').html('Report');
                if (newWindow) newWindow.close();
                alert('Error loading report: ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : (error || 'Failed to fetch data')));
            });
        });


        function numberToWordsTaka(amount) {
            let num = Math.round(amount);
            if (num === 0) return 'Zero';

            const words = [
                '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
                'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
            ];
            const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

            function convertTwoDigits(n) {
                if (n < 20) return words[n];
                let ten = tens[Math.floor(n / 10)];
                let unit = words[n % 10];
                return ten + (unit ? '-' + unit.toLowerCase() : '');
            }

            function convertThreeDigits(n) {
                let hundred = Math.floor(n / 100);
                let remainder = n % 100;
                let str = '';
                if (hundred > 0) {
                    str += words[hundred].toLowerCase() + ' hundred';
                }
                if (remainder > 0) {
                    if (str !== '') str += ' ';
                    str += convertTwoDigits(remainder).toLowerCase();
                }
                return str;
            }

            let crore = Math.floor(num / 10000000);
            num %= 10000000;
            let lakh = Math.floor(num / 100000);
            num %= 100000;
            let thousand = Math.floor(num / 1000);
            num %= 1000;
            let hundredAndRest = num;

            let result = '';
            if (crore > 0) {
                result += convertThreeDigits(crore) + ' crore ';
            }
            if (lakh > 0) {
                result += convertTwoDigits(lakh).toLowerCase() + ' lakh ';
            }
            if (thousand > 0) {
                result += convertTwoDigits(thousand).toLowerCase() + ' thousand ';
            }
            if (hundredAndRest > 0) {
                result += convertThreeDigits(hundredAndRest);
            }

            let finalStr = result.trim();
            return finalStr.charAt(0).toUpperCase() + finalStr.slice(1);
        }

        function ShowData(data, existingWindow) {
            const newWindow = existingWindow || window.open('', '_blank', 'width=1200,height=800');
            if (!newWindow) {
                alert('Popup window blocked by browser. Please allow popups for this site.');
                return;
            }

            const bankName = data.companyBank ? data.companyBank.bank_name : (data.bankType || 'Bank Asia Ltd.');
            const branchAddr = data.companyBank && data.companyBank.branch ? data.companyBank.branch : (data.branch ? (data.branch.name + ' Branch,Dhaka') : 'Uttara Branch,Dhaka-1230');

            // HTML structure for the statement report window
            let payslipsHtml = `
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Salary Bank Statement</title>
                        <style>
                            * {
                                box-sizing: border-box;
                            }
                            body {
                                font-family: Arial, Helvetica, sans-serif;
                                padding: 25px;
                                margin: 0;
                                color: #000;
                                background: #fff;
                                line-height: 1.5;
                                text-align: left !important;
                            }
                            .letter-header {
                                text-align: left !important;
                                margin-bottom: 20px;
                                font-size: 13px;
                            }
                            .letter-header div {
                                margin-bottom: 3px;
                                text-align: left !important;
                            }
                            .subject-line {
                                font-weight: bold;
                                margin-top: 15px;
                                margin-bottom: 15px;
                                font-size: 13px;
                                text-decoration: underline;
                                text-align: left !important;
                            }
                            table.statement-table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 15px;
                                margin-bottom: 15px;
                                font-size: 11px;
                                text-align: left !important;
                            }
                            table.statement-table th {
                                border: 1px solid #000;
                                padding: 5px 6px;
                                text-align: left !important;
                                vertical-align: middle;
                                word-break: break-word;
                                background-color: #ffffff;
                                font-weight: bold;
                            }
                            table.statement-table td {
                                border: 1px solid #000;
                                padding: 5px 6px;
                                text-align: left !important;
                                vertical-align: middle;
                                word-break: break-word;
                            }
                            .bold {
                                font-weight: bold;
                            }
                            .text-left {
                                text-align: left !important;
                            }
                            .total-words {
                                margin-top: 15px;
                                font-size: 13px;
                                font-weight: bold;
                                text-align: left !important;
                            }
                            .sign-off-section {
                                margin-top: 35px;
                                font-size: 13px;
                                line-height: 1.5;
                                text-align: left !important;
                            }
                            .sign-off-section div {
                                text-align: left !important;
                            }
                            .sign-off-section .warm-regards {
                                font-weight: bold;
                                margin-bottom: 45px;
                                text-align: left !important;
                            }
                            .sign-off-section .designation-title {
                                font-weight: bold;
                                text-align: left !important;
                            }
                            .print-container {
                                margin-top: 30px;
                                text-align: left !important;
                            }
                            .btn-print {
                                background-color: #0275d8;
                                color: #fff;
                                border: none;
                                padding: 8px 20px;
                                font-size: 14px;
                                border-radius: 4px;
                                cursor: pointer;
                            }
                            @media print {
                                body {
                                    padding: 10px;
                                }
                                .print-container {
                                    display: none;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="letter-header">
                            <div>Date: ${data.currentDate || ''}</div>
                            <div>To,</div>
                            <div>The Manager</div>
                            <div>${bankName}</div>
                            <div>${branchAddr}</div>
                            
                            <div class="subject-line">Sub: Request for Salary disbursement for the month of ${data.month} /${data.financialYear}</div>
                            
                            <div>Dear Sir,</div>
                            <div>We would like to request you for disbursement of Salary from our following account numbers of mentioned persons from fund transfer regulations.</div>
                        </div>

                        <table class="statement-table">
                            <thead>
                                <tr>
                                    <th>Effective date<br>(D/M/Y)</th>
                                    <th>Bank Name</th>
                                    <th>Credit Account</th>
                                    <th>Receiver Name</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Originating<br>Bank<br>Routing No</th>
                                    <th>Receiving<br>Bank<br>Routing No</th>
                                    <th>Originating<br>Account No</th>
                                    <th>Originator Name</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>`;

            let totalAmount = 0;
            $.each(data.data, function (index, item) {
                let amt = parseFloat(item.salary_bank_amount || 0);
                totalAmount += amt;

                payslipsHtml += `
                        <tr>
                            <td class="text-left">${item.salary_bank_effective_date || ''}</td>
                            <td class="text-left">${item.latest_bank_name || 'N/A'}</td>
                            <td class="text-left">${item.latest_bank_account_number || 'N/A'}</td>
                            <td class="text-left">${item.first_name || 'N/A'}</td>
                            <td class="text-left">BDT</td>
                            <td class="text-left">${amt.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 })}</td>
                            <td class="text-left">${item.originating_bank_routing_no || ''}</td>
                            <td class="text-left">${item.receiving_bank_routing_no || ''}</td>
                            <td class="text-left">${item.originating_account_no || ''}</td>
                            <td class="text-left">${item.originator_name || ''}</td>
                            <td class="text-left">${item.remarks || ''}</td>
                        </tr>
                    `;
            });

            let formattedTotal = totalAmount.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
            let takaInWords = numberToWordsTaka(totalAmount);

            const companyName = data.groupName || (data.branch ? data.branch.name : 'J & Z Group');

            payslipsHtml += `
                                <tr class="bold">
                                    <td colspan="5" class="text-left">Total Taka</td>
                                    <td class="text-left">${formattedTotal}</td>
                                    <td colspan="5"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="total-words">
                            Taka : ${takaInWords} Only.
                        </div>

                        <div class="sign-off-section">
                            <div class="warm-regards">With Warm Regards,</div>
                            <div class="designation-title">Managing Director</div>
                            <div>${companyName}</div>
                            <div>House-15, Road-15, Sector-04</div>
                            <div>Uttara, Dhaka-1230</div>
                        </div>

                        <div class="print-container">
                            <button onclick="window.print()" class="btn-print" id="printButton">Print Statement</button>
                        </div>
                    </body>
                </html>`;

            // Reset document buffer to clear loading text, then write content
            newWindow.document.open();
            newWindow.document.write(payslipsHtml);
            newWindow.document.close();
        }
    });
</script>
@stop