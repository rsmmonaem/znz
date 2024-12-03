@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">Incriment and Promotion Letter </li>
    </ul>
@stop

@section('content')
    <style>
        .form-section {
            margin-bottom: 20px;
        }

        .report-table th,
        .report-table td {
            text-align: center;
        }

        .col-sm-4 control-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .form-group {
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between !important;
        }
        /* NOC Design */
        .confidential-box {
            border: 1px solid red;
            padding: 5px 10px;
            font-weight: bold;
            color: red;
        }
        .certificate-container {
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            text-align: center;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .header .company-info {
            font-size: 14px;
            line-height: 1.4;
            color: #333;
            text-align: right;
        }

        .ref-date {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            font-size: 14px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        .body-text {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .body-text .highlight {
            font-weight: bold;
        }

        .note {
            font-size: 13px;
            font-style: italic;
            margin-top: 30px;
        }

        .signature {
            margin-top: 40px;
        }

        .signature .line {
            margin-bottom: 5px;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 30px;
            right: 30px;
            font-size: 12px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .footer .jec-info {
            bottom: 20px;
            left: 30px;
            right: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer img {
            display: block;
            margin: 0 auto;
            max-height: 30px;
        }

        .footer .contact {
            text-align: right;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2>Incriment and Promotion Letter</h2>
                {{-- Form Container --}}
                <div class="container">
                    <!-- Filter Form Section -->
                    <div class="row">
                        <form>
                            <div class="col-md-6">
                                <div class="form-section">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="group">Group</label>
                                        <select class="form-control" name="group" id="group">
                                            <option value="">J & Z Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="branch">Branch</label>
                                        <input type="text" class="form-control" id="branch_form" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="department">Department</label>
                                        <input type="text" class="form-control" id="department_form" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="section">Section</label>
                                       <input type="text" class="form-control" id="section_form" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="designation">Designation</label>
                                       <input type="text" class="form-control" id="designation_form" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="employeeID">Employee ID</label>
                                        <select class="form-control" name="employeeID" id="employeeID">
                                            <option value="">Select Employee ID</option>
                                            @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->employee_code }} -
                                                    {{ $e->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="reportType">Report Type</label>
                                    {{-- <input type="text" class="form-control" id="reportType" value="Transfer History"
                                        readonly> --}}
                                    @include('common.reportSelect')
                                </div>
                            </div>
                    </div>
                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px" id="getNOC">Generate
                        Incriment and Promotion Letter</button>
                    </form>

                     <!-- Report Table Section -->
                    {{-- NOC Container --}}
                    <button class="btn btn-primary" id="print" style="margin-bottom: 20px; display: none;" onclick="printNOC()">Print Incriment Letter</button>

    {{-- Start JEC Certificate --}}
    <div class="certificate-container" id="certificateContent" style="display: none;">
        <!-- Header Section -->
        <div class="header" style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc">
            <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" alt="J & Z Group Logo">
            <div class="company-info">
                <h3>J & Z GROUP</h3>
                House # 15, Road # 15, Sector # 04, Uttara,<br>
                Dhaka, Bangladesh-1230
            </div>
        </div>
       
         <!-- Main Content -->
        <div class="content">
            <div style="display: flex; justify-content: space-between">
                <p class="date" style="margin-top: 10px">{{ date('d-m-Y') }}</p>
                <p style="border: 1px solid #db0a0a !important; padding:7px; font-weight: bold; color: #db0a0a; width: 30%; margin-top: 10px">Private & Confidential</p>
            </div>
            <p><span class="empName"></span></p>
            <p>ID: <span class="empID"></span></p>
            <p>Department: <span class="department"></span></p>
            <p>Section: <span class="Section_Name"></span></p>
            <p>Designation: <span class="designation"></span></p>

            <p><strong>Subject: About Increment & Promotion Letter.</strong></p>
            <p>Dear,</p>
            <p>
                It is with great pleasure that we inform you of the management's decision regarding your annual increment for the year <span class="year"></span>. We acknowledge and commend your outstanding dedication and performance at <strong><span class="branch"></span>"</strong> in your respective position.
            </p>
            <p>
                After careful consideration, the management is pleased to approve a revised monthly gross salary of Taka <span class="gross_salary"></span> for you and a promotion to the rank of <strong>'<span class="promotion_designation"></span>'</strong> with an increment amount of Taka <span class="incrementAmount"></span>. This increment will be effective from <strong>'<span class="effectiveDate"></span>'</strong>.
            </p>
            <p>
                We wish to extend our heartfelt congratulations on your splendid performance in the past year.
            </p>
            <p>
                We anticipate your continued dedication and efforts towards the prosperity of <strong><span class="branch"></span>"</strong>.</strong>
            </p>
            <p>Best wishes from J & Z Group.</p>
            <p>Sincerely,</p>
            <p class="signature" style="margin-top: 100px">
                 ____________________________<br>
                <strong>Executive Director.</strong><br><span class="branch"></span><br>J & Z Group
            </p>
            <p>Copy: 1. Personal copy.<br>2. Office copy.</p>
        </div>


        <!-- Footer -->
        <div class="footer">
            <img src="{{ URL::to(config('constants.upload_path.logo') . 'JEC_footer.jpg') }}" alt="J & Z Group Logo">
            <div class="jec-info" style="background: #0091b6; color: #fff">
                <p>📞 8951022, 58951987, 58957642</p>
                <p>🌐 www.jandzgroup.com</p>
                <p>📧 info@jandzgroup.com</p>
            </div>
        </div>
    </div>
    {{-- End JEC Certificate --}}
                </div>
            </div>
        </div>
        {{-- End Form Containner --}}
    </div>
@stop

@section('javascript')

    <script>
        $(document).ready(function() {
            $('#employeeID').on('change', function() {
                var employeeId = $(this).val();
                $.ajax({
                    url: "/get-letter-user",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        employeeId: employeeId
                    },
                    success: function(data) {
                        $('#department_form').val(data.department_name);
                        $('#section_form').val(data.section_name);
                        $('#designation_form').val(data.designation_name);
                        $('#branch_form').val(data.branch_name);
                    }
                });
            });
            //Get NOC
            $('#getNOC').on('click', function(e) {
                e.preventDefault();
                $('#getNOC').prop('disabled', true);
                $('#getNOC').text('Processing...');
                const FormData = {
                    _token: "{{ csrf_token() }}",
                    employeeId: $('#employeeID').val(),
                    branch: $('#branch').val(),
                    department: $('#department').val(),
                    section: $('#section').val(),
                    designation: $('#designation').val()
                }
                $.ajax({
                    url: "/letter-increment-promotion",
                    method: 'POST',
                    data: FormData,
                    success: function(data) {
                        if (data.message) {
                            toastr.error(data.message);
                            btnControll();
                            return;
                        } else {
                                toastr.success('Data Fetched Successfully');
                                $('.empName').text(data.employee_name);
                                $('.empID').text(data.employee_code || 'N/A'); 
                                $('.department').text(data.department_name);
                                $('#Section_Name').text(data.section_name);
                                $('.designation').text(data.designation_name);
                                $('.branch').text(data.branch_name);
                                $('.effectiveDate').text(data.effective_date);
                                $('.gross_salary').text(data.slary_slab_gross);
                                $('.promotion_designation').text(data.new_designation);
                                $('.incrementAmount').text(data.increment_amount);
                                const year = new Date(data.effective_date).getFullYear();
                                $('.year').text(year);
                                btnControll();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        btnControll();
                    }
                });
            });

            function btnControll() {
                $('#getNOC').prop('disabled', false);
                $('#getNOC').text('Generate Increment & Promotion Letter');
                $('#print').css('display', 'block');
                $('#certificateContent').css('display', 'block');
            }
        })
    </script>

    <script>
        function printNOC() {
            var printWindow = window.open('', '', 'width=1200,height=800');

            // Write the HTML structure with the background image applied via style
            printWindow.document.write('<html><head><title>Print Increment & Promotion Letter</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
            * {
            -webkit-print-color-adjust: exact !important;   
            color-adjust: exact !important;                
            print-color-adjust: exact !important;     
            }
            /* NOC Design */
        .certificate-container {
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            text-align: center;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .header .company-info {
            font-size: 18px;
            line-height: 1.4;
            color: #333;
            text-align: right;
        }

        .ref-date {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            font-size: 18px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        .body-text {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .body-text .highlight {
            font-weight: bold;
        }

        .note {
            font-size: 18px;
            font-style: italic;
            margin-top: 30px;
        }

        .signature {
            margin-top: 40px;
        }

        .signature .line {
            margin-bottom: 5px;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 30px;
            right: 30px;
            font-size: 12px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .footer .jec-info {
            bottom: 20px;
            left: 30px;
            right: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer img {
            display: block;
            margin: 0 auto;
            max-height: 30px;
        }

        .footer .contact {
            text-align: right;
        }

                @media print {
                    body {
                        margin: 0;
                        padding: 0;
                        width: 210mm; 
                        height: 297mm;
                    }
                    .certificate-container {
                        width: 100%;
                        padding: 20mm;
                    }
                }
            `);
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');

            // Add the nocContent wrapped in a container
            printWindow.document.write('<div class="certificate-container">');
            printWindow.document.write(document.getElementById('certificateContent').innerHTML);
            printWindow.document.write('</div>');
            printWindow.document.write('</body></html>');

            printWindow.document.close();

            // Wait for the content to load and then trigger print
            printWindow.onload = function() {
                // Ensure the background image is fully loaded
                const img = new Image();
                img.onload = function() {
                    printWindow.print(); // Print after the image is loaded
                };
                img.src = '{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}'; // Ensure this matches the URL used in the style
            };
        }
    </script>

@stop
