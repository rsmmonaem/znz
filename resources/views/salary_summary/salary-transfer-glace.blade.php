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
        $('#GetReport').attr('disabled', 'disabled').html('Please wait...');

        var FormDataObj = {
            branch: $('#branch').val(),
            department: $('#department').val(),
            section: $('#section').val(),
            designation: $('#designation').val(),
            employee: $('#employee').val(),
            reportType: $('#reportType').val(),
            financialYear: $('#financialYear').val(),
            month: $('#month').val(),
            category: $('#category').val(),
            _token: $('input[name=_token]').val()
        };

        $.ajax({
            url: '/salary-transfer-glance',
            type: 'POST',
            data: FormDataObj,
            success: function(response) {
                $('#GetReport').removeAttr('disabled').html('Report');
                ShowData(response);
            }
        }).fail(function() {
            $('#GetReport').removeAttr('disabled').html('Report');
        });
    });

    function safeNumber(v) {
        return (v === null || v === undefined || v === "" || isNaN(v)) ? 0 : parseFloat(v);
    }

    function ShowData(data) {
        var newWindow = window.open('', '_blank', 'width=900,height=600');

        var totalBank = 0;
        var totalCash = 0;
        var totalNet = 0;
        var totalDeductionAll = 0;
        var totalNetPayable = 0;

        var html = '';
        html += '<html><head><title>Salary Transfer</title>';
        html += '<style>';
        html += 'body{font-family:Arial;padding:20px;}';
        html += 'table{width:100%;border-collapse:collapse;}';
        html += 'th,td{border:1px solid #000;padding:5px;text-align:center;}';
        html += 'th{background:#f2f2f2;}';
        html += '</style>';
        html += '<style>@media print{@page {size: landscape;}#printButton,#excelButton{display:none;}table,th,td{font-size:10px;padding:3px;}}</style>';
        html += '</head><body>';

        html += '<div id="controls">';
        html += '<button onclick="window.print()" id="printButton" style="padding:6px 12px;background:#3498db;color:#fff;border:none;border-radius:4px;cursor:pointer;">Print</button> ';
        html += '<button onclick="downloadExcel()" id="excelButton" style="padding:6px 12px;background:#27ae60;color:#fff;border:none;border-radius:4px;cursor:pointer;">Excel Download</button>';
        html += '</div>';

        html += '<h2 style="text-align:center;margin-top:-10px;">Employee Salary Transfer at a Glance</h2>';
        html += '<h4 style="text-align:center;">For the Month of ' + data.month + ' ' + data.financialYear + '</h4>';

        html += '<table id="salaryTable">';
        html += '<thead><tr>';
        html += '<th>SL</th><th>Branch</th><th>ID</th><th>Name</th><th>Desig</th><th>Dept</th><th>Section</th>';
        html += '<th>Gross</th><th>Total Payable</th><th>Total Deduction</th><th>Net Payable</th><th>Bank Transfer</th><th>Cash Payment</th>';
        html += '</tr></thead><tbody>';

        $.each(data.data, function(i, item) {
            var adv  = safeNumber(item.advance_salary);
            var pf   = safeNumber(item.provident_fund);
            var tax  = safeNumber(item.tax_amount);
            var net  = safeNumber(item.net_salary);
            var arr  = safeNumber(item.arrear_amount);

            var totalDeduction = adv + pf + tax;
            var netPayable = net + arr - totalDeduction;

            var bank = safeNumber(item.bankamount);
            var cash = safeNumber(item.cashamount);

            totalBank += bank;
            totalCash += cash;
            totalNet += net;
            totalDeductionAll += totalDeduction;
            totalNetPayable += netPayable;

            html += '<tr>';
            html += '<td>' + (i + 1) + '</td>';
            html += '<td>' + item.branch_name + '</td>';
            html += '<td>' + item.employee_code + '</td>';
            html += '<td>' + item.first_name + '</td>';
            html += '<td>' + item.designation_name + '</td>';
            html += '<td>' + item.department_name + '</td>';
            html += '<td>' + item.section_name + '</td>';
            html += '<td>' + safeNumber(item.gross_salary).toFixed(2) + '</td>';
            html += '<td>' + net.toFixed(2) + '</td>';
            html += '<td>' + totalDeduction.toFixed(2) + '</td>';
            html += '<td>' + netPayable.toFixed(2) + '</td>';
            html += '<td>' + bank.toFixed(2) + '</td>';
            html += '<td>' + cash.toFixed(2) + '</td>';
            html += '</tr>';
        });

        html += '</tbody><tfoot>';
        html += '<tr><th colspan="8" style="text-align:right">Totals:</th>';
        html += '<th>' + totalNet.toFixed(2) + '</th>';
        html += '<th>' + totalDeductionAll.toFixed(2) + '</th>';
        html += '<th>' + totalNetPayable.toFixed(2) + '</th>';
        html += '<th>' + totalBank.toFixed(2) + '</th>';
        html += '<th>' + totalCash.toFixed(2) + '</th></tr>';
        html += '</tfoot></table>';

        html += '<script>';
        html += 'function downloadExcel(){';
        html += 'var table=document.getElementById("salaryTable").outerHTML;';
        html += 'var a=document.createElement("a");';
        html += 'a.href="data:application/vnd.ms-excel,"+encodeURIComponent(table);';
        html += 'a.download="salary_transfer.xls";';
        html += 'a.click();';
        html += '}';
        html += '<\/script>';

        html += '<style>@media print{#printButton,#excelButton{display:none;}}</style>';
        html += '</body></html>';

        newWindow.document.write(html);
        newWindow.document.close();
    }

});
</script>


@stop
