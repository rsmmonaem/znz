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
                    <h2><strong>Report for Employee Blood Group</strong>
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

                                    <label class="col-sm-2 control-label">Blood Group</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="blood_group">
                                            <option value="">Select</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                    </div>
                                   
                                </div>

                                <div class="form-group">
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
        $(document).ready(function() {
            // get User Id Dynamically
             $('select[name="branch"]').on('change', function() {
				var branch_id = $(this).val();
				$('#employee_id').val('').trigger('change');
				HandleBranchWiseEmployees(branch_id, '#employee_id', true);
			});
            // Print Section
            $('#print').on('click', function() {
                var printFrame = $('<iframe></iframe>');
                printFrame.css({
                    position: 'absolute',
                    width: '0',
                    height: '0',
                    padding: '20px',
                    border: 'none'
                });
                $('#print').hide();
                $('body').append(printFrame);

                var printContents = $('.table-container').html();
                printFrame[0].contentDocument.write(`
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
                $('#print').show();
                printFrame[0].contentDocument.close();
                printFrame[0].contentWindow.focus();
                printFrame[0].contentWindow.print();
                printFrame.on('afterprint', function() {
                    printFrame.remove();
                });
            });

            // Reset Section
            $('#reset').on('click', function() {
                $('#report-tbody').empty();
                $('.table-container').hide();
            });

            // Generate Report
            $('#report').on('click', function() {
                var btn = $(this);
                btn.prop('disabled', true);

                // Collect form values
                var group = $('select[name="group"]').val();
                var branch = $('select[name="branch"]').val();
                var category = $('select[name="category"]').val();
                var department = $('select[name="department"]').val();
                var gender = $('select[name="gender"]').val();
                var section = $('select[name="section"]').val();
                var grade = $('select[name="grade"]').val();
                var designation = $('select[name="designation"]').val();
                var employee_id = $('#employee_id').val();
                var blood_group = $('select[name="blood_group"]').val();

                var formData = {
                    group: group,
                    branch: branch,
                    category: category,
                    department: department,
                    gender: gender,
                    section: section,
                    grade: grade,
                    designation: designation,
                    employee_id: employee_id,
                    blood_group: blood_group
                };

                console.log(formData);

                $.ajax({
                    url: "{{ url('employee-blood-group') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        btn.prop('disabled', false);

                        // Generate report table rows dynamically
                        var tableRows = '';
                        $.each(response, function(index, item) {
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
                        </tr>
                    `;
                        });

                        // Open a new window and inject HTML content
                        var newWindow = window.open('', '_blank', 'width=1000,height=800');
                        newWindow.document.open();

                        // Build the report layout in the new window
                        var reportHTML = `
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
                            }
                            th {
                                background-color: #f4f4f4;
                            }
                            h3 {
                                text-align: center;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="table-container">
                            <div class="display-flex">
                                <div class="left-item">
                                    <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" width="150px" style="margin-left:20px;">
                                </div>
                                <div class="center-item">
                                    <h4>Head Office</h4>
                                    <p>Address : {{ config('config.address_1') }}</p>
                                    <p>Empoyee Report</p>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tableRows}
                                </tbody>
                            </table>
                            <div class="display-flex">
                                <div class="center-item">
                                    <button onclick="window.print()" class="btn btn-primary">Print</button>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>
                `;
                        newWindow.document.write(reportHTML);
                        newWindow.document.close();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        btn.prop('disabled', false);
                    }
                });
            });

        });
    </script>
@stop
