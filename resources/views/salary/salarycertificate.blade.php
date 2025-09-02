@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Salary Certificate</li>
    </ul>
@stop

@section('content')
    <style>
        .form-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .form-section .form-group {
            width: 48%;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select,
        .form-group input {
            width: 100%;
        }

        .form-section-right {
            display: flex;
            flex-direction: column;
        }

        .form-section-right .form-group {
            margin-bottom: 15px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .report-header h3 {
            text-align: center;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container" style="margin-bottom: 30px">
                    <!-- Report Header -->
                    <div class="report-header">
                        <h3>Salary Certificate</h3>
                    </div>

                    <!-- Form Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select class="form-control" id="group">
                                    <option value="">Select Group</option>
                                    @foreach ($group as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select class="form-control" id="branch">
                                    <option value="">Select Branch</option>
                                    @foreach ($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department">
                                    <option value="">Select Department</option>
                                    @foreach ($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select class="form-control" id="section">
                                    <option value="">Select Section</option>
                                    @foreach ($section as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select class="form-control" id="designation">
                                    <option value="">Select Designation</option>
                                    @foreach ($designation as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employee-id">Employee ID</label>
                                <select class="form-control" id="employee_id">
                                    <option value="">Select Employee ID</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="report-type">Report Type</label>
                                @include('common.reportSelect')
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                @include('common.category')
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type">
                                    <option value="management">Management</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons Section -->
                    <div class="buttons">
                        <button class="btn btn-primary" id="report">Report</button>
                        <button class="btn btn-danger">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('#employee_id').select2();

        $('#branch').on('change', function() {
            var branch_id = $(this).val();
            $('#employee_id').val('').trigger('change');
            HandleBranchWiseEmployees(branch_id, '#employee_id');
        });

        $('#report').on('click', function() {
            var formData = {
                group: $('#group').val(),
                branch: $('#branch').val(),
                department: $('#department').val(),
                section: $('#section').val(),
                designation: $('#designation').val(),
                employeeId: $('#employee_id').val(),
                reportType: $('#report-type').val(),
                category: $('#category').val(),
                type: $('#type').val()
            };

            $.ajax({
                url: "{{ url('SalaryCertificateReportPOST') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.error){
                        toastr.error(response.error);
                    } else {
                        getCertificate(response);
                        toastr.success("Salary certificate generated!");
                    }
                },
                error: function() {
                    toastr.error("Something went wrong while generating certificate!");
                }
            })
        })
    })

    function getCertificate(data) {
        var today = new Date().toLocaleDateString('en-GB'); 
        var newWindow = window.open('', '_blank', 'width=900,height=800');

        var taxRow = '';
        if (data.tax && data.tax > 0) {
            taxRow = `<tr><th>Tax</th><td>- ${data.tax}</td></tr>`;
        }

        var content = `
        <html>
        <head>
            <title>Salary Certificate</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body { font-family: Arial, sans-serif; margin: 40px; }
                .certificate { border: 2px solid #000; padding: 30px; }
                .header { text-align: center; margin-bottom: 30px; }
                .salary-table { width:100%; border-collapse:collapse; margin-top:20px; }
                .salary-table th, .salary-table td { border:1px solid #000; padding:8px; text-align:center; }
                .signature { margin-top:50px; text-align:right; }
                @media print {
                    .btn-print { display:none; }
                }
            </style>
        </head>
        <body>
            <div class="certificate">
                <div class="header">
                    <h3>Salary Certificate</h3>
                    <p>Date: ${today}</p>
                </div>
                <p>
                    This is to certify that <b>${data.employee.first_name}</b> 
                    (Employee ID: ${data.employee.employee_code}), 
                    working as <b>${data.employee.designation}</b> in the 
                    <b>${data.employee.department}</b> department, 
                    has been employed with us since ${data.employee.date_of_joining}.
                </p>

                <table class="salary-table">
                    <tr><th>Basic Salary</th><td>${data.basic}</td></tr>
                    <tr><th>House Rent</th><td>${data.house}</td></tr>
                    <tr><th>Medical</th><td>${data.medical}</td></tr>
                    <tr><th>Conveyance</th><td>${data.conveyance}</td></tr>
                    <tr><th>Others</th><td>${data.others}</td></tr>
                    <tr><th><b>Gross Salary</b></th><td><b>${data.gross}</b></td></tr>
                    ${taxRow}
                    <tr><th><b>Net Payable</b></th><td><b>${data.net}</b></td></tr>
                </table>

                <p style="margin-top:20px;">This certificate has been issued upon his request without any liability on the company.</p>

                <div class="signature">
                    <p>______________________</p>
                    <p>Authorized Signature</p>
                </div>

                <div class="btn-print">
                    <button onclick="window.print()" class="btn btn-primary">Print</button>
                </div>
            </div>
        </body>
        </html>
        `;

        newWindow.document.write(content);
        newWindow.document.close();
    }
</script>
@stop
