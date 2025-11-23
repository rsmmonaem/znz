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
$(document).ready(function () {

    let reportWindow = null; // store popup reference

    $('#branch').on('change', function () {
        var branch_id = $(this).val();
        $('#employeeId').val('').trigger('change');
        HandleBranchWiseEmployees(branch_id, '#employeeId');
    });

    function nf(n) {
        n = parseFloat(n || 0);
        return n % 1 === 0 ? n.toString() : n.toFixed(2);
    }

    $('#submit').on('click', function (e) {
        e.preventDefault();
        $('#submit').attr("disabled", true).text('Processing...');

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
            url: '/salary-sheet-report',
            type: 'POST',
            data: formData,
            success: function (response) {
                populateSalaryTable(response);
                $('#submit').attr("disabled", false).text('Get Pay Sheet');
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
                $('#submit').attr("disabled", false).text('Get Pay Sheet');
            }
        });
    });

    function populateSalaryTable(data) {
        reportWindow = window.open('', '_blank', 'width=1200,height=800');
        if (!reportWindow) {
            alert('Popup blocked! Please allow popups for this website.');
            return;
        }

        let totalWorkedDays = 0, totalGrossSalary = 0, totalBasic = 0, totalHRA = 0,
            totalMedical = 0, totalConveyance = 0, totalOthers = 0, totalNetSalary = 0,
            totalAdvanceSalary = 0, totalHoliday = 0, totalHolidayAmount = 0,
            totalProvidentFund = 0, totalTaxAmount = 0, totalArrearAmount = 0,
            totalOT = 0, totalNetPayable = 0, totalBankAmount = 0, totalCashAmount = 0;

        let tableHTML = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Salary Sheet</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 11px; }
                th, td { border: 1px solid #ddd; padding: 4px 6px; text-align: left; }
                th { background-color: #f5f5f5; }
                .totals-row { font-weight: bold; background-color: #f5f5f5; }
                h1, h2 { text-align: center; text-transform: uppercase; }
                .footer { width: 100%; margin-top: 50px; margin-bottom: 50px; text-align: center; }
                .footer-section { display: inline-block; width: 22%; text-align: center; border: 1px solid #fff; }
                .page-break { page-break-before: always; }
                #printReportBtn { margin: 10px 0; padding: 5px 10px; }
            </style>
        </head>
        <body>
            <h1>${data.branch?.name || ''} (${data.branch?.description || ''})</h1>
            <h2>SALARY SHEET FOR THE MONTH OF ${data.month} (${data.form_date} TO ${data.to_date})</h2>

            <div style="text-align:center;">
                <button id="printReportBtn">Print Report</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>SL No</th><th>Name</th><th>Desi.</th><th>D.of Join</th>
                        <th>Em. Code</th><th>Atten.</th><th>Gross Salary</th>
                        <th>Basic (50%)</th><th>HRA (28%)</th><th>Medical (9%)</th>
                        <th>Con. (8%)</th><th>Others (5%)</th><th>Net Salary</th>
                        <th>Holiday</th><th>Holi. Amount</th><th>Prov. Fund</th>
                        <th>Adv. Salary</th><th>Tax Amount</th><th>Arrear Amount</th>
                        <th>OT Amount</th><th>Net Payable</th><th>Bank Amount</th><th>Cash Amount</th>
                        <th>Acc. Num.</th><th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
        `;

        data.employee_salary_data.forEach((item, index) => {
            let basic=0,hra=0,medical=0,conveyance=0,others=0;
            Object.values(item.salaryData||{}).forEach(salary=>{
                const head=(salary.head||'').toLowerCase();
                const amt=parseFloat(salary.amount)||0;
                if(head.includes("basic")) basic=amt;
                else if(head.includes("house rent")) hra=amt;
                else if(head.includes("medical")) medical=amt;
                else if(head.includes("conveyance")) conveyance=amt;
                else if(head.includes("other")) others=amt;
            });
            const gross=parseFloat(item.gross_salary||0);
            if(basic===0) basic=(gross*50)/100;
            if(hra===0) hra=(gross*28)/100;
            if(medical===0) medical=(gross*9)/100;
            if(conveyance===0) conveyance=(gross*8)/100;
            if(others===0) others=(gross*5)/100;

            const netSalary=parseFloat(item.net_salary||0);
            const arrearAmount=parseFloat(item.arrear_amount||0);
            const advanceSalary=parseFloat(item.advance_salary||0);
            const providentFund=parseFloat(item.provident_fund||0);
            const taxAmount=parseFloat(item.tax_amount||0);
            const otAmount=parseFloat(item.ot_amount||0);
            const bankAmount=parseFloat(item.bankamount||0);
            const cashAmount=parseFloat(item.cashamount||0);
            const holiday=parseFloat(item.holiday||0);
            const holidayAmount=parseFloat(item.holiday_amount||0);
            const workedDays=parseFloat(item.total_worked_days||0);
            const netPayable=(netSalary+arrearAmount+otAmount+holidayAmount-advanceSalary-providentFund-taxAmount).toFixed(2);

            totalWorkedDays+=workedDays; totalGrossSalary+=gross; totalBasic+=basic;
            totalHRA+=hra; totalMedical+=medical; totalConveyance+=conveyance; totalOthers+=others;
            totalNetSalary+=netSalary; totalAdvanceSalary+=advanceSalary; totalHoliday+=holiday;
            totalHolidayAmount+=holidayAmount; totalProvidentFund+=providentFund; totalTaxAmount+=taxAmount;
            totalArrearAmount+=arrearAmount; totalOT+=otAmount; totalNetPayable+=parseFloat(netPayable);
            totalBankAmount+=bankAmount; totalCashAmount+=cashAmount;

            tableHTML+=`
                <tr>
                    <td>${index+1}</td><td>${item.first_name||''}</td><td>${item.designation||''}</td>
                    <td>${item.date_of_joining||''}</td><td>${item.employee_code||''}</td><td>${workedDays}</td>
                    <td>${nf(gross)}</td><td>${nf(basic)}</td><td>${nf(hra)}</td><td>${nf(medical)}</td>
                    <td>${nf(conveyance)}</td><td>${nf(others)}</td><td>${nf(netSalary)}</td>
                    <td>${nf(holiday)}</td><td>${nf(holidayAmount)}</td><td>${nf(providentFund)}</td>
                    <td>${nf(advanceSalary)}</td><td>${nf(taxAmount)}</td><td>${nf(arrearAmount)}</td>
                    <td>${nf(otAmount)}</td><td>${nf(netPayable)}</td><td>${nf(bankAmount)}</td>
                    <td>${nf(cashAmount)}</td><td>${item.account_number||''}</td><td>${item.remarks||''}</td>
                </tr>`;
        });

        tableHTML += `
            <tr class="totals-row">
                <td colspan="6">Total</td>
                <td>${nf(totalGrossSalary)}</td><td>${nf(totalBasic)}</td><td>${nf(totalHRA)}</td>
                <td>${nf(totalMedical)}</td><td>${nf(totalConveyance)}</td><td>${nf(totalOthers)}</td>
                <td>${nf(totalNetSalary)}</td><td>${nf(totalHoliday)}</td><td>${nf(totalHolidayAmount)}</td>
                <td>${nf(totalProvidentFund)}</td><td>${nf(totalAdvanceSalary)}</td><td>${nf(totalTaxAmount)}</td>
                <td>${nf(totalArrearAmount)}</td><td>${nf(totalOT)}</td><td>${nf(totalNetPayable)}</td>
                <td>${nf(totalBankAmount)}</td><td>${nf(totalCashAmount)}</td><td colspan="2"></td>
            </tr>
        </tbody></table>
        <script>
            document.getElementById('printReportBtn').addEventListener('click', function() {
                window.print();
            });
        <\/script>
        </body></html>`;

        reportWindow.document.write(tableHTML);
        reportWindow.document.close();
    }

});
</script>



@stop
