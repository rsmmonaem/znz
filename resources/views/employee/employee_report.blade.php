@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.employee_list') !!}</li>
    </ul>
@stop

@section('content')
    <div class="row">
        @if (Entrust::can('create_employee'))
            <div class="col-sm-12">
                <div class="box-info full">
                    <h2><strong>Report for Employee Database</strong>
                        <div class="additional-btn">
                            {{-- @if (Entrust::can('create_employee'))
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add_new') !!}</button></a>
							@endif --}}
                        </div>
                    </h2>

                    <div class="container">
                        <div class="form-container">
                            {{-- <h3>Report for Employee Database</h3> --}}
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Group</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="group">
                                            <option>J & Z Group</option>
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
                                        <select class="form-control" name="branch">
                                            <option value="">Select</option>
                                            @foreach ($brach as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-4">
                                        {{-- <select class="form-control" name="category">
                                            <option value="">Select</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Staff">Staff</option>
                                        </select> --}}
                                         @include('common.category')
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

                                    <label class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="gender">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="transgender">Transgender</option>
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

                                    <label class="col-sm-2 control-label">Grade</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="grade">
                                            <option value="">Select</option>
                                            @foreach ($grade as $g)
                                                <option value="{{ $g->id }}">{{ $g->name }}</option>
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

                                    <label class="col-sm-2 control-label">Employee ID</label>
                                    <div class="col-sm-4">
                                        {{-- <input type="text" name="employee_id" class="form-control"> --}}
                                        <select class="form-control" name="employee_id" id="employee_id">
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->employee_code }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Multiple ID</label>
                                    <div class="col-sm-4">
                                        {{-- <input type="text" name="multiple_id" class="form-control"
                                            placeholder="ID1, ID2, ID3"> --}}

                                        <select class="form-control" name="multiple_id" id="multiple_id" multiple>
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->employee_code }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                            @endforeach --}}
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
        @endif
    </div>
@stop

@section('javascript')
    <script>
        $('select[name="branch"]').on('change', function() {
            var branch_id = $(this).val();
            $('#employee_id').val('').trigger('change');
            $('#multiple_id').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employee_id', true);
            HandleBranchWiseEmployees(branch_id, '#multiple_id', true);
            $('#multiple_id').val('').trigger('change');
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Print Section
            document.getElementById('print').addEventListener('click', function() {
                const printFrame = document.createElement('iframe');
                printFrame.style.position = 'absolute';
                printFrame.style.width = '0';
                printFrame.style.height = '0';
                printFrame.style.padding = '20px';
                printFrame.style.border = 'none';
                document.getElementById('print').style.display = 'none';
                document.body.appendChild(printFrame);
                const printContents = document.querySelector('.table-container').innerHTML;
                printFrame.contentDocument.write(`
                    <html>
                    <head>
                        <title>Print Table</title>
                        <style>
                            /* Optional: Include styles for the printed content */
                            body { font-family: Arial, sans-serif; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        </style>
                    </head>
                    <body>${printContents}</body>
                    </html>
                `);
                document.getElementById('print').style.display = 'block';
                printFrame.contentDocument.close();
                printFrame.contentWindow.focus();
                printFrame.contentWindow.print();
                printFrame.onafterprint = () => document.body.removeChild(printFrame);
            })
            // Rset Section
            document.getElementById('reset').addEventListener('click', function() {
                const tbody = document.getElementById('report-tbody');
                tbody.innerHTML = '';
                document.querySelector('.table-container').style.display = 'none';
            })
            // Generate Report
        });
        document.getElementById('report').addEventListener('click', function () {
    const btn = document.getElementById('report');
    btn.disabled = true;

    // Collect form values
    const group = document.querySelector('select[name="group"]').value;
    //const report_type = document.querySelector('select[name="report_type"]').value;
    const branch = document.querySelector('select[name="branch"]').value;
    const category = document.querySelector('select[name="category"]').value;
    const department = document.querySelector('select[name="department"]').value;
    const gender = document.querySelector('select[name="gender"]').value;
    const section = document.querySelector('select[name="section"]').value;
    const grade = document.querySelector('select[name="grade"]').value;
    const designation = document.querySelector('select[name="designation"]').value;
    const employee_id = document.querySelector('#employee_id').value;
    const multiple_id = $('#multiple_id').val();
    // const multiple_id_array = multiple_id.split(',').map(id => id.trim()).filter(id => id !== "");

    const formData = {
        group: group,
        //report_type: report_type,
        branch: branch,
        category: category,
        department: department,
        gender: gender,
        section: section,
        grade: grade,
        designation: designation,
        employee_id: employee_id,
        multiple_id: multiple_id
    };

    console.log(formData);

    $.ajax({
        url: "{{ url('employee/report') }}",
        method: 'POST',
        data: formData,
        success: function (response) {
            btn.disabled = false;

            // Generate report table rows dynamically
            let tableRows = '';
            response.sort((a, b) => a.employee_code.localeCompare(b.employee_code, undefined, { numeric: true }));

            response.forEach((item, index) => {
                tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.employee_code}</td>
                        <td>${item.first_name || ''}</td>
                        <td>${item.designation_name || ''}</td>
                        <td>${item.department_name || ''}</td>
                        <td>${item.section_name || ''}</td>
                        <td>${item.date_of_joining || ''}</td>
                        <td>${item.date_of_birth || ''}</td>
                        <td>${item.blood_group || ''}</td>
                        <td>${item.category || ''}</td>
                        <td>${item.contact_number || ''}</td>
                        <td>${item.gender || ''}</td>
                        <td>${item.grade_name || ''}</td>
                        <td>${item.job_nature || ''}</td>
                        <td>${item.nid || ''}</td>
                        <td>${item.birth || ''}</td>
                        <td>${item.pres_house || ''}</td>
                        <td>${item.pres_district || ''}</td>
                        <td>${item.pres_post || ''}</td>
                        <td>${item.pres_thana || ''}</td>
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
                    <title>Employee Report</title>
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
                            text-transform: none; /* No automatic capitalization */
                        }
                    
                        th {
                            background-color: #f4f4f4;
                        }
                    
                        h3 {
                            text-align: center;
                        }
                    
                        @media print {
                            @page {
                                size: landscape;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="table-container">
                        <div class="display-flex">
                            <div class="left-item">
                                <img src="{{ URL::to(config('constants.upload_path.logo').config('config.logo')) }}" width="150px" style="margin-left:20px;">
                            </div>
                            <div class="center-item">
                                <h3>{{ config('config.company_name') }}</h3>
                                <p>Address : {{ config('config.address_1') }}</p>
                                <p>Empoyee Report</p>
                                <p>Branch : ${branch ? $('select[name="branch"] option:selected').text() : 'All Branches'}</p>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped report-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Section</th>
                                    <th>DOJ</th>
                                    <th>DOB</th>
                                    <th>Blood</th>
                                    <th>Category</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Grade</th>
                                    <th>Job Nature</th>
                                    <th>NID</th>
                                    <th>Birth Certificate</th>
                                    <th>House</th>
                                    <th>District</th>
                                    <th>Post</th>
                                    <th>Thana</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${tableRows}
                            </tbody>
                        </table>
                        <div class="display-flex">
                            <div class="center-item">
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
            
            function capitalizeFirstLetter(str) {
                return str.replace(/\\b\\w/g, function(char) { return char.toUpperCase(); });
            }

            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                    cell.textContent = capitalizeFirstLetter(cell.textContent.trim());
                });
            });

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

        },
        error: function (xhr, status, error) {
            console.error(error);
            btn.disabled = false;
        }
    });
});
    </script>
@stop
