@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Bonus Report</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2 class="text-center"><strong>Bonus Report</strong></h2>
                <div class="container">
                    <div class="form-container">
                        {{-- <h3>Report for Employee Database</h3> --}}
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Group</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="group">
                                        {{-- <option selected>J & Z Group</option> --}}
                                        @foreach($groups as $g)
                                            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 control-label">Report Type</label>
                                <div class="col-sm-4">
                                    @include('common.reportSelect')
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Branch</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="branch" id="branch">
                                        <option value="">Select</option>
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 control-label">Financial Year</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="financial_year">
                                        <option value="">Select</option>
                                        @for ($year = 2030; $year >= 2010; $year--)
                                            <!-- Corrected condition -->
                                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="department">
                                        <option value="">Select</option>
                                        @foreach ($departments as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 control-label">Bonus Type</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="bonus_type">
                                        <option value="">Select</option>
                                        @foreach ($bonusType as $bt)
                                            <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Section</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="section">
                                        <option value="">Select</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Designation</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="designation">
                                        <option value="">Select</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employee ID</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="employee_id" id="employee_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" id="report" class="btn btn-primary">Report</button>
                                    <button type="reset" class="btn btn-default" id="reset">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#branch').change(function() {
                var branch_id = $(this).val();
                $('#employee_id').val('').trigger('change');
                HandleBranchWiseEmployees(branch_id, '#employee_id');
            });
            $('#reset').click(function() {
                window.location.reload();
            });
            $('#report').click(function() {
                $('#report').prop('disabled', true);
                $('#reset').prop('disabled', true);
                var group = $('select[name="group"]').val();
                var reportType = $('select[name="reportType"]').val();
                var branch = $('select[name="branch"]').val();
                var gender = $('select[name="gender"]').val();
                var department = $('select[name="department"]').val();
                var section = $('select[name="section"]').val();
                var designation = $('select[name="designation"]').val();
                var employee_id = $('#employee_id').val();
                var formData = {
                    branch: branch,
                    department: department,
                    section: section,
                    designation: designation,
                    employee_id: employee_id,
                    financial_year: $('select[name="financial_year"]').val(), 
                    bonus_type: $('select[name="bonus_type"]').val(),
                };

                $.ajax({
                    type: 'post',
                    url: '/bonus-process-report',
                    data: formData,
                    success: function(response) {
                        GetReport(response)
                        $('#report').prop('disabled', false);
                        $('#reset').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                         $('#report').prop('disabled', false);
                         $('#reset').prop('disabled', false);
                    }

                });
            });
        });

        function GetReport(response){
            let Totalgross = 0;
            let TotalBonus = 0;

            response.data.forEach((item) => {
                Totalgross += parseFloat(item.gross_amount) || 0;
                TotalBonus += parseFloat(item.bonus_amount) || 0;
            })
            let tableRows = '';
            response.data.forEach((item, index) => {
                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.branch || ''}</td>
                        <td>${item.employee_code || ''}</td>
                        <td>${item.first_name || ''}</td>
                        <td>${item.department || ''}</td>
                        <td>${item.section || ''}</td>
                        <td>${item.date_of_joining || ''}</td>
                        <td>${item.gross_amount || ''}</td>
                        <td>${item.bonus_amount || ''}</td>
                        <td>${item.account_number || ''}</td>
                        <td></td>
                        <td></td>
                    </tr>
                `;
            });
            // Open a new window and inject HTML content
            const newWindow = window.open('', '_blank', 'width=1000,height=800');
            newWindow.document.open();

            // Build the report layout in the new window
            const reportHTML = `
                <html>
                <head>
                    <title>Gender Wise Report</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        .display-flex {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            border: 1px solid #ccc;
                            padding: 10px;
                            margin-bottom: 20px;
                        }
                        .center-item {
                            text-align: center;
                            margin: auto;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            border: 1px solid #ccc;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f4f4f4;
                        }
                        h3 {
                            text-align: center;
                        }
                        @media print {
                            .print_btn button{
                                display: none;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="table-container">
                        <div class="display-flex">
                            <div class="left-item">
                                <img src="{{ URL::to(config('constants.upload_path.logo').config('config.logo')) }}" width="100px" style="margin-left:20px;">
                            </div>
                            <div class="center-item">
                                <h2 style="margin:0;" >J & Z Group</h2>
                                ${response.branch? `<h5 style="margin:0;">${response.branch?.name}</h5>
                                <p style="margin:0;">Address : ${response.branch?.description} </p>` : ''}
                                <h2 style="margin:0;">${response.type?.name} Bonus Summary</h2>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Branch</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>DOJ</th>
                                    <th>Gross</th>
                                    <th>Bonus</th>
                                    <th>A/C No</th>
                                    <th>Signature</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tableRows}

                                <tr>
                                    <td colspan="7">Total</td>
                                    <td>${Totalgross}</td>
                                    <td>${TotalBonus}</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="display-flex">
                            <div class="center-item print_btn">
                                <button onclick="window.print()" class="btn btn-primary">Print</button>
                                <button id="exportExcel" class="btn btn-success">Export to Excel</button>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `;

            newWindow.document.write(reportHTML);
            newWindow.document.close();
            // Excel Export
            newWindow.document.getElementById('exportExcel').addEventListener('click', function() {
                var tableHTML = newWindow.document.querySelector('.report-table').outerHTML;
                var filename = 'Employee_Report.xls';
                var uri = 'data:application/vnd.ms-excel;base64,';
                var template = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                    xmlns:x="urn:schemas-microsoft-com:office:excel" 
                    xmlns="http://www.w3.org/TR/REC-html40">
                <head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>
                <x:Name>Salary Slab</x:Name>
                <x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>
                </x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->
                </head><body>${tableHTML}</body></html>
                `;
                var base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) };
                var link = newWindow.document.createElement('a');
                link.href = uri + base64(template);
                link.download = filename;
                link.click();
            });
        }
    </script>
@stop
