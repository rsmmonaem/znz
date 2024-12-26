@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Sheet Rport</li>
    </ul>
@stop

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h2 class="text-center">Salary Sheet Rport</h2>
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
                                            @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach
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
                                        <button type="button" class="btn btn-primary pull-center" id="submit">Get Pay
                                            Sheet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Add a scrollable container for the table -->
                    <div class="table-responsive" id="table-container" style="display: none">
                        <table id="salaryTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">SL<br />No</th>
                                    <th rowspan="2">Name Of Employee</th>
                                    <th rowspan="2">Designation</th>
                                    <th rowspan="2">Date of Joining</th>
                                    <th rowspan="2">ID No</th>
                                    <th rowspan="2">Attendance</th>
                                    <th rowspan="2">Gross Salary</th>
                                    <th colspan="5">Basic Breakdown</th>
                                    <th rowspan="2">Net Salary</th>
                                    <th rowspan="2">Advance</th>
                                    <th rowspan="2">Provident Fund</th>
                                    <th rowspan="2">TAX</th>                                    <th rowspan="2">Arrear Amount</th>
                                    <th rowspan="2">Net Payable</th>
                                    <th rowspan="2">Bank Asia A/C No.</th>
                                    <th rowspan="2">Remarks</th>
                                </tr>
                                <tr>
                                    <th>Basic<br />(50% of Gross)</th>
                                    <th>HRA<br />(28% of Gross)</th>
                                    <th>MA<br />(9% of Gross)</th>
                                    <th>CA<br />(8% of Gross)</th>
                                    <th>Other's<br />(5% of Gross)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic data should populate here -->
                            </tbody>
                             <tfoot>
                                <tr>
                                    <td colspan="6">Total</td>
                                    {{-- <td id="total-attendance"></td> --}}
                                    <td id="total-gross-salary"></td>
                                    <td id="total-basic"></td>
                                    <td id="total-hra"></td>
                                    <td id="total-ma"></td>
                                    <td id="total-ca"></td>
                                    <td id="total-others"></td>
                                    <td id="total-net-salary"></td>
                                    <td id="total-advance"></td>
                                    <td id="total-provident-fund"></td>
                                    <td id="total-tax"></td>
                                    <td id="total-arrear"></td>
                                    <td id="total-net-payable"></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End of scrollable container -->
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
            $(document).ready(function() {
                const table_container = $('#table-container');
                // Fetch data via AJAX
                $('#submit').on('click', function(e) {
                    e.preventDefault();
                    $('#submit').attr("disabled", true);
                    $('#submit').text('Processing...');
                    let formData = {
                        group: $('#group').val(),
                        branch: $('#branch').val(),
                        department: $('#department').val(),
                        section: $('#section').val(),
                        employeeId: $('#employeeId').val(),
                        formDate: $('#formDate').val(),
                        toDate: $('#toDate').val()
                    };
                    $.ajax({
                    url: '/salary-sheet-report', // Replace with your API URL
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // table_container.removeAttr("style")
                        // Parse response and populate the table
                        populateSalaryTable(response);
                        $('#submit').attr("disabled", false);
                        $('#submit').text('Get Pay Sheet');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        $('#submit').attr("disabled", false);
                        $('#submit').text('Get Pay Sheet');
                    }
                   });
                })


function populateSalaryTable(data) {
    // Create a new window for the salary table
    const newWindow = window.open('', '_blank', 'width=1200,height=800');
    if (!newWindow) {
        alert('Popup blocked! Please allow popups for this website.');
        return;
    }

    // Initialize totals for each column
    let totalWorkedDays = 0,
        totalGrossSalary = 0,
        totalBasic = 0,
        totalHRA = 0,
        totalMedical = 0,
        totalConveyance = 0,
        totalOthers = 0,
        totalNetSalary = 0,
        totalAdvanceSalary = 0,
        totalProvidentFund = 0,
        totalTaxAmount = 0,
        totalArrearAmount = 0,
        totalNetPayable = 0;
        totalOT = 0;

    // Build the main table HTML
    let tableHTML = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Salary Table</title>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #fff;
                }
                tr:nth-child(even) {
                    background-color: #fff;
                }
                tr:hover {
                    background-color: #fff;
                }
                .totals-row {
                    font-weight: bold;
                    background-color: #fff;
                }
                .page-break {
                  page-break-before: always;
                }
            </style>
        </head>
        <body>
             <div class="company-details">
                <h1 style="text-align: center; font-size: 26px; font-weight: bold; text-transform: uppercase;">${data.branch.name ?? ' '} .
                 (${data.branch.description ?? ' '})</h1>
            </div>
             <h2 style="text-align: center; font-size: 24px; font-weight: bold; text-transform: uppercase;">SALARY SHEET FOR THE MONTH OF ${data.month} (${data.form_date} to ${data.to_date})</h2>
            <table>
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Date of Joining</th>
                        <th>Employee Code</th>
                        <th>Total Worked Days</th>
                        <th>Gross Salary</th>
                        <th>Basic</th>
                        <th>Home Rent</th>
                        <th>Medical</th>
                        <th>Conveyance</th>
                        <th>Others</th>
                        <th>Net Salary</th>
                        <th>Advance Salary</th>
                        <th>Provident Fund</th>
                        <th>Tax Amount</th>
                        <th>Arrear Amount</th>
                        <th>OT Amount</th>
                        <th>Net Payable</th>
                        <th>Account Number</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
    `;

    // Loop through the data and add rows
    data.employee_salary_data.forEach((item, index) => {
        let salaryData = item.salaryData || {};
        let basic = parseFloat(salaryData[0]?.amount || 0);
        let hra = parseFloat(salaryData[2]?.amount || 0);
        let medical = parseFloat(salaryData[6]?.amount || 0);
        let conveyance = parseFloat(salaryData[4]?.amount || 0);
        let others = parseFloat(salaryData[8]?.amount || 0);
        // let netPayable = parseFloat(item.net_salary || 0) + parseFloat(item.arrear_amount || 0);

         const netPayable = 
            parseFloat(item.net_salary || 0) +
            parseFloat(item.arrear_amount || 0) +
            parseFloat(item.ot_amount || 0) -
            parseFloat(item.tax_amount || 0) -
            parseFloat(item.provident_fund || 0) -
            parseFloat(item.advance_salary || 0);
        // Update totals
        totalWorkedDays += parseFloat(item.total_worked_days || 0);
        totalGrossSalary += parseFloat(item.gross_salary || 0);
        totalBasic += basic;
        totalHRA += hra;
        totalMedical += medical;
        totalConveyance += conveyance;
        totalOthers += others;
        totalNetSalary += parseFloat(item.net_salary || 0);
        totalAdvanceSalary += parseFloat(item.advance_salary || 0);
        totalProvidentFund += parseFloat(item.provident_fund || 0);
        totalTaxAmount += parseFloat(item.tax_amount || 0);
        totalArrearAmount += parseFloat(item.arrear_amount || 0);
        totalOT += parseFloat(item.ot_amount || 0);
        totalNetPayable += netPayable;

        tableHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.first_name || ''}</td>
                <td>${item.designation || ''}</td>
                <td>${item.date_of_joining || ''}</td>
                <td>${item.employee_code || ''}</td>
                <td>${item.total_worked_days || '0'}</td>
                <td>${item.gross_salary || '0.00'}</td>
                <td>${basic.toFixed(2)}</td>
                <td>${hra.toFixed(2)}</td>
                <td>${medical.toFixed(2)}</td>
                <td>${conveyance.toFixed(2)}</td>
                <td>${others.toFixed(2)}</td>
                <td>${item.net_salary || '0.00'}</td>
                <td>${item.advance_salary || '0.00'}</td>
                <td>${item.provident_fund || '0.00'}</td>
                <td>${item.tax_amount || '0.00'}</td>
                <td>${item.arrear_amount || '0.00'}</td>
                <td>${item.ot_amount || '0.00'}</td>
                <td>${netPayable}</td>
                <td>${item.account_number || ''}</td>
                <td>${item.remarks || ''}</td>
            </tr>
        `;
    });

    tableHTML += `
                    <tr>
                        <td colspan="6">Total</td>
                        <td>${totalGrossSalary.toFixed(2)}</td>
                        <td>${totalBasic.toFixed(2)}</td>
                        <td>${totalHRA.toFixed(2)}</td>
                        <td>${totalMedical.toFixed(2)}</td>
                        <td>${totalConveyance.toFixed(2)}</td>
                        <td>${totalOthers.toFixed(2)}</td>
                        <td>${totalNetSalary.toFixed(2)}</td>
                        <td>${totalAdvanceSalary.toFixed(2)}</td>
                        <td>${totalProvidentFund.toFixed(2)}</td>
                        <td>${totalTaxAmount.toFixed(2)}</td>
                        <td>${totalArrearAmount.toFixed(2)}</td>
                        <td>${totalOT.toFixed(2)}</td>
                        <td>${totalNetPayable.toFixed(2)}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
            <style> 
                 .footer {
                 text-align: center;
                 padding: 10px;
                 margin-top: 20px;
                 background: #f0f0f0;
             }

             .footer-section {
                 display: inline-block;
                 width: 22%;
                 text-align: center;
             }
             </style>
             <!-- Footer with approval sections -->
             <table class="footer" style="width: 100%; background-color: #fff; margin-top: 50px; margin-bottom: 50px;">
                 <tr>
                     <td class="footer-section" style="border: 1px solid #ffffff;">PREPARED & CHECKED BY HR</td>
                     <td class="footer-section" style="border: 1px solid #ffffff;">VERIFIED BY FINANCE/ACCOUNTS</td>
                     <td class="footer-section" style="border: 1px solid #ffffff;">RECOMMENDED BY ADMIN BD</td>
                     <td class="footer-section" style="border: 1px solid #ffffff;">APPROVED BY EDM/MD/CHAIRMAN</td>
                 </tr>
             </table>

            <div class="page-break"></div>
            <h2>SUMMARY</h2>
            <table>
                <thead>
                    <tr>
                        <th>Total Worked Days</th>
                        <th>Total Gross Salary</th>
                        <th>Total Basic</th>
                        <th>Total Home Rent</th>
                        <th>Total Medical</th>
                        <th>Total Conveyance</th>
                        <th>Total Others</th>
                        <th>Total Net Salary</th>
                        <th>Total Advance</th>
                        <th>Total Provident Fund</th>
                        <th>Total Tax Amount</th>
                        <th>Total Arrear</th>
                        <th>Total OT</th>
                        <th>Total Net Payable</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="totals-row">
                        <td>${totalWorkedDays}</td>
                        <td>${totalGrossSalary.toFixed(2)}</td>
                        <td>${totalBasic.toFixed(2)}</td>
                        <td>${totalHRA.toFixed(2)}</td>
                        <td>${totalMedical.toFixed(2)}</td>
                        <td>${totalConveyance.toFixed(2)}</td>
                        <td>${totalOthers.toFixed(2)}</td>
                        <td>${totalNetSalary.toFixed(2)}</td>
                        <td>${totalAdvanceSalary.toFixed(2)}</td>
                        <td>${totalProvidentFund.toFixed(2)}</td>
                        <td>${totalTaxAmount.toFixed(2)}</td>
                        <td>${totalArrearAmount.toFixed(2)}</td>
                        <td>${totalOT.toFixed(2)}</td>
                        <td>${totalNetPayable.toFixed(2)}</td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>
    `;

    // Write the table to the new window and close the document
    newWindow.document.write(tableHTML);
    newWindow.document.close();
}


                // Function to populate the table
                // function populateSalaryTable(data) {
                //     const datatable = $('#salaryTable');
                //     datatable.DataTable().destroy();
                //     let tableBody = $('#salaryTable tbody');
                //     tableBody.empty(); // Clear existing rows

                //     // Loop through the data and append rows
                //     data.forEach((item, index) => {
                //         let salaryData = item.salaryData || {};

                //         // Breakdown amounts
                //         let basic = salaryData[0]?.amount || '0.00';
                //         let hra = salaryData[2]?.amount || '0.00';
                //         let medical = salaryData[6]?.amount || '0.00';
                //         let conveyance = salaryData[4]?.amount || '0.00';
                //         let others = salaryData[8]?.amount || '0.00';

                //         // Append row to the table
                //         tableBody.append(`
                //             <tr>
                //                 <td>${index + 1}</td>
                //                 <td>${item.first_name}</td>
                //                 <td>${item.designation}</td>
                //                 <td>${item.date_of_joining}</td>
                //                 <td>${item.employee_code}</td>
                //                 <td>${item.total_worked_days}</td>
                //                 <td>${item.gross_salary}</td>
                //                 <td>${Math.floor(parseFloat(basic)).toFixed(2)}</td>
                //                 <td>${Math.floor(parseFloat(hra)).toFixed(2)}</td>
                //                 <td>${Math.floor(parseFloat(medical)).toFixed(2)}</td>
                //                 <td>${Math.floor(parseFloat(conveyance)).toFixed(2)}</td>
                //                 <td>${Math.floor(parseFloat(others)).toFixed(2)}</td>
                //                 <td>${item.net_salary}</td>
                //                 <td>${item.advance_salary}</td>
                //                 <td>${item.provident_fund}</td>
                //                 <td>${item.tax_amount || '0.00'}</td>
                //                 <td class="arrear-amount" data-name="${item.first_name}" data-arrear-amount="${item.arrear_amount}" data-id="${item.id}" >${item.arrear_amount}</td>
                //                 <td class="net-payable" data-id="${item.id}" data-netpayable="${item.net_salary}">${parseFloat(item.net_salary) + parseFloat(item.arrear_amount)}</td>
                //                 <td>${item.account_number || ' '}</td>
                //                 <td>${item.remarks || ' '}</td>
                //             </tr>
                //         `);
                //     });

                //     const table = datatable.DataTable({
                //         lengthMenu: [10, 20, 50, 100],
                //         paging: true,
                //         // searching: true,
                //         autoWidth: true,
                //         orderable: false,
                //         dom: 'Bfrtip', // Specify placement of buttons (B: Buttons, f: Filter, r: Processing, t: Table)
                //         buttons: [
                //             {
                //                 extend: 'excelHtml5',
                //                 text: 'Export to Excel',
                //                 title: 'Salary Report', // The title of the exported Excel file
                //             },
                //             {
                //                 extend: 'print',
                //                 text: 'Print',
                //                 title: 'Salary Report', // The title of the printed document
                //                 customize: function (win) {
                //                     $(win.document.body)
                //                         .css('font-size', '8pt')
                //                         .find('table')
                //                         .css('font-size', 'inherit');
                //                 },
                //             }
                //         ],
                //         // responsive: true,
                //         columnDefs: [
                //             { targets: [0], orderable: true }, // Make SL No sortable
                //             { targets: [2], orderable: true }, // Make Designation sortable
                //         ],

                //         "footerCallback": function(row, data, start, end, display) {
                //             var api = this.api();

                //             // Sum for various columns without currency formatting
                //             // var totalAttendance = api.column(5).data().reduce(function(a, b) {
                //             //     return parseFloat(a) + parseFloat(b);
                //             // }, 0);

                //             var totalGrossSalary = api.column(6).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalBasic = api.column(7).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalHRA = api.column(8).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalMA = api.column(9).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalCA = api.column(10).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalOthers = api.column(11).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalNetSalary = api.column(12).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalAdvance = api.column(13).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalProvidentFund = api.column(14).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalTax = api.column(15).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalArrear = api.column(16).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             var totalNetPayable = api.column(17).data().reduce(function(a, b) {
                //                 return parseFloat(a) + parseFloat(b);
                //             }, 0);

                //             // Update the footer with the calculated sums
                //             // $('#total-attendance').html(totalAttendance);
                //             $('#total-gross-salary').html(totalGrossSalary);
                //             $('#total-basic').html(totalBasic);
                //             $('#total-hra').html(totalHRA);
                //             $('#total-ma').html(totalMA);
                //             $('#total-ca').html(totalCA);
                //             $('#total-others').html(totalOthers);
                //             $('#total-net-salary').html(totalNetSalary);
                //             $('#total-advance').html(totalAdvance);
                //             $('#total-provident-fund').html(totalProvidentFund);
                //             $('#total-tax').html(totalTax);
                //             $('#total-arrear').html(totalArrear);
                //             $('#total-net-payable').html(totalNetPayable);
                //         }
                        
                //     });
                
                // }
            });
    </script>
@stop
