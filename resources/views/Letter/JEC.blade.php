@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">JEC</li>
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
            margin-top: 50px;
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
                <h2>JEC</h2>
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
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="effectiveDate">Effective Date</label>
                                    <input type="date" class="form-control" id="effectiveDate" name="effectiveDate">
                                </div>
                            </div>
                            
                    </div>
                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px" id="getNOC">Generate
                        JEC</button>
                    </form>

                     <!-- Report Table Section -->
                    {{-- NOC Container --}}
                    <button class="btn btn-primary" id="print" style="margin-bottom: 20px; display: none;" onclick="printNOC()">Print JEC</button>
                    <button onclick="downloadWord()" class="btn btn-success">Download Word</button>
                    <button onclick="downloadPDF()" class="btn btn-danger">Download PDF</button>

    {{-- Start JEC Certificate --}}
    <div class="certificate-container" id="certificateContent" style="display: none;">
        <!-- Header Section -->
        <div class="header" style="display: flex; justify-content: space-between; margin-bottom: 120px;">
            <img src="{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}" alt="J & Z Group Logo" style="display: none;">
            <div class="company-info" style="display: none;">
                <h3>J & Z GROUP</h3>
                House # 15, Road # 15, Sector # 04, Uttara,<br>
                Dhaka, Bangladesh-1230
            </div>
        </div>

        <!-- Ref and Date -->
        <div class="ref-date">
            <div>Ref: J&Z/HR/S-2014/5</div>
            <div>Date: {{ date('d-m-Y') }}</div>
        </div>

        <!-- Title -->
        <div class="title">Job Experience Certificate</div>

        <!-- Body Text -->
        <div class="body-text">
            It is to certify that <span class="highlight">‘<span id="empName"></span>’; ‘ID - <span id="empID"></span>’</span> has been working with our company
            for the period from <span class="highlight" id="joiningDate"></span> to <span class="highlight" id="endingDate"></span>.
            And his current designation is <span class="highlight">‘<span id="designation_name"></span>’ – <span id="department_name"></span></span>.
        </div>

        <div class="body-text">
            During the job we found him very hardworking, honest, punctual, reliable, and his job as well as up to our expectation.
            We are sure about his capability that he would fully be able to do justice to his profession with the blessings of Almighty Allah. 
            We certify that there is no liability during the job on him.
        </div>

        <div class="body-text">
            Wish him best of luck for betterment of his/her future and success in his coming life endeavors.
        </div>

        <!-- Note -->
        <div class="note">
            <strong>Note:</strong> This certificate has been issued upon request of the interested parties for reference purposes.
        </div>

        <!-- Signature -->
        <div class="signature" style="margin-top:250px">
            <div class="line">__________________________</div>
            <p>
                Saida Islam Setu<br>
                Manager<br>
                HR & Business Development<br>
                J & Z Group
            </p>
        </div>

    </div>
    {{-- End JEC Certificate --}}
                </div>
            </div>
        </div>
        {{-- End Form Containner --}}
    </div>


    <script>
function downloadWord() {
    var content = document.getElementById("certificateContent").outerHTML;

    var css = `
        <style>
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
            font-size: 25px;
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
            margin-top: 50px;
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
    `;

    var sourceHTML = `
    <html xmlns:o='urn:schemas-microsoft-com:office:office' 
          xmlns:w='urn:schemas-microsoft-com:office:word' 
          xmlns='http://www.w3.org/TR/REC-html40'>
    <head><meta charset='utf-8'><title>Job Experience Certificate</title>${css}</head>
    <body>${content}</body></html>`;

    var blob = new Blob(['\ufeff', sourceHTML], { type: 'application/msword' });
    var url = URL.createObjectURL(blob);

    var link = document.createElement("a");
    link.href = url;
    link.download = "job_experience_certificate.doc";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    URL.revokeObjectURL(url);
}
</script>


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
                    designation: $('#designation').val(),
                    effectiveDate: $('#effectiveDate').val()
                }
                $.ajax({
                    url: "/letter-jec",
                    method: 'POST',
                    data: FormData,
                    success: function(data) {
                        if (data.message) {
                            toastr.error(data.message);
                            $('#employeeName').text(' ');
                            $('#joiningDate').text(' ');
                            $('#endingDate').text(' ');
                            $('#serviceLength').text(' ');
                            $('#designation_name').text(' ');
                            $('.empName').text(' ');
                            $('.effectiveDate').text(' ');
                            btnControll();
                            return;
                        } else {
                            toastr.success('Data Fetched Successfully');
                            $('#empName').text(data.employee_name);
                            $('#joiningDate').text(data.date_of_joining);
                            $('#endingDate').text(data.entry_date);
                            $('#empID').text(data.employee_code);
                            $('#designation_name').text(data.designation_name);
                            $('#department_name').text(data.department_name);
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
                $('#getNOC').text('Generate NOC');
                $('#print').css('display', 'block');
                $('#certificateContent').css('display', 'block');
            }
        })
    </script>

    <script>
        function printNOC() {
            var printWindow = window.open('', '', 'width=1200,height=800');

            // Write the HTML structure with the background image applied via style
            printWindow.document.write('<html><head><title>Print NOC</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
            * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important;                 /* Firefox 48 – 96 */
            print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
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
            font-size: 25px;
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
            margin-top: 50px;
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
                img.src =
                    'https://scontent.fdac5-2.fna.fbcdn.net/v/t39.30808-1/393121278_798706948724860_2546228729910779588_n.jpg?stp=c7.7.186.186a_dst-jpg_p200x200&_nc_cat=103&ccb=1-7&_nc_sid=f4b9fd&_nc_ohc=P_Qg84VXC5IQ7kNvgE1uXHJ&_nc_zt=24&_nc_ht=scontent.fdac5-2.fna&_nc_gid=APdhLEfV5m7g2iNTpKLaWX1&oh=00_AYAk_f9FoAQbtLvKHm28Y9ySQyO8yjNYhccDtt67wSepxQ&oe=67534096'; // Ensure this matches the URL used in the style
            };
        }
    </script>

<!-- PDF Download -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    var element = document.getElementById("certificateContent");

    var opt = {
        margin:       10,
        filename:     'job_experience_certificate.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true, logging: false },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak:    { mode: ['css','legacy'] }
    };

    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
        const totalPages = pdf.internal.getNumberOfPages();
        if (totalPages > 1) {
            pdf.deletePage(totalPages);
        }
    }).save();
}
</script>

@stop
