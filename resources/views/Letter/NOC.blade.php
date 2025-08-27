@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">NOC</li>
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
         * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important;                 /* Firefox 48 – 96 */
            print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
            }
            .noc-container {
                padding: 30px;
                border-radius: 5px;
                position: relative;
                margin: 20px auto;
                width: 210mm;
                height: 297mm;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            .noc-container::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-image: url('{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}');
                    background-size: 500px 500px !important; 
                    background-size: cover;
                    background-repeat: no-repeat !important;
                    background-position: center;
                    opacity: 0.2;
                    z-index: -1; /* Ensures watermark is behind the text */
            }
            
            .noc-header {
                text-align: center;
                font-weight: bold;
                font-size: 25px;
                text-decoration: underline;
                margin-bottom: 40px;
            }

            .noc-body {
                font-size: 18px;
                line-height: 1.6;
                position: relative;
                z-index: 2;
            }

            .noc-body .highlight {
                font-weight: bold;
            }

            .noc-signature {
               margin-top: 300px;
               font-size: 18px;
            }

            .noc-note {
                font-size: 18px;
                font-style: italic;
                margin-top: 10px;
            }

            .signature-line {
                display: inline-block;
                margin-top: 30px;
                font-weight: bold;
            }

            .noc-date {
                text-align: right;
                font-size: 18px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .noc-header {
                text-align: center;
                font-weight: bold;
                font-size: 18px;
                text-decoration: underline;
                margin-bottom: 20px;
            }

            #nocContent {
                width: 100%;
                font-size: 14px;           
                line-height: 1.5;
                white-space: normal;       
                word-wrap: break-word;     
                padding: 20px;             
                background: #fff;
            }

            @media print {
                body {
                    margin: 0;
                    padding: 0;
                    width: 210mm; 
                    height: 297mm;
                }
                .noc-container {
                width: 100%;
                  padding: 20mm;
                }
            }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <h2>NOC</h2>
                {{-- Form Container --}}
                <div class="container">
                    <!-- Filter Form Section -->
                    <form>
                    <div class="row">
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
                                <label class="col-sm-4 control-label" for="effectiveDate ">Effective Date</label>
                                <input type="date" class="form-control" id="effectiveDate" name="effectiveDate">
                            </div>

                            {{-- <div class="form-group">
                                <input type="radio" id="active" name="status" value="active">
                                <label for="active">Active</label><br>
                                <input type="radio" id="inactive" name="status" value="inactive" checked>
                                <label for="inactive">Inactive</label>
                            </div> --}}
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" style="margin-bottom: 20px" id="getNOC">Generate
                        NOC</button>
                    </form>

                     <!-- Report Table Section -->
                    {{-- NOC Container --}}
                    <button class="btn btn-primary" style="display: none;" id="print" style="margin-bottom: 20px" onclick="printNOC()">Print NOC</button>
                    <button onclick="downloadWord()" class="btn btn-success">Download Word</button>
                    <button onclick="downloadPDF()" class="btn btn-danger">Download PDF</button>
                    <div class="noc-container" style="display: none;" id="nocContent">
                        <div class="noc-date" style="margin-top: 120px;">Date: {{ date('d-m-Y') }}</div>
                        <div class="noc-header">No Objection Certificate (NOC)</div>
                        <div class="noc-body">
                            <p>This is to certify that <span class="highlight" id="employeeName"></span> has been our employee
                                since
                                <span class="highlight" id="joiningDate"></span> to <span class="highlight"
                                    id="endingDate"></span></span> and
                                his/her service length is <span class="highlight" id="serviceLength"></span>. His/her present
                                designation is <span class="highlight" id="designation_name"></span>, in our company.
                            </p>

                            <p>In his/her time of staying with our company <span class="highlight empName"></span> showed full dedication to his/her work which makes him/her one of the assets of our company. And also we have no objection on his/her decision to resign his/her position.</p>

                            <p class="noc-note"><strong>Note:</strong> This certificate has been issued upon request of the
                                interested parts for reference purposes.</p>

                            <div class="noc-signature">
                                <div class="signature-line">__________________________</div>
                                <p><span class="font-weight-bold">Saida Islam Setu</span><br>Manager<br>HR & Business Development<br>J & Z Group</p>
                            </div>
                        </div>
                    </div>
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
                    designation: $('#designation').val(),
                    effectiveDate: $('#effectiveDate').val()
                }
                $.ajax({
                    url: "/letter-noc",
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
                            $('#effectiveDate').text(' ');
                            $('#active').text(' ');
                            $('#inactive').text(' ');
                            $('.empName').text(' ');
                            btnControll();
                            return;
                        } else {
                            toastr.success('Data Fetched Successfully');
                            $('#employeeName').text(data.employee_name);
                            $('#joiningDate').text(data.date_of_joining);
                            $('#endingDate').text(data.entry_date);
                            $('#serviceLength').text(data.date_diff);
                            $('#designation_name').text(data.designation_name);
                            $('.empName').text(data.employee_name);
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
                $('#nocContent').css('display', 'block');
            }
        })
    </script>

    <script>
        function printNOC() {
            var printWindow = window.open('', '', 'width=1200,height=800');

            
            printWindow.document.write('<html><head><title>Print NOC</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
            * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
            color-adjust: exact !important;                 /* Firefox 48 – 96 */
            print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
            }
            .noc-container {
                padding: 30px;
                border-radius: 5px;
                position: relative;
                width: 210mm;
                height: 297mm;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            .noc-container::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-size: 500px 500px !important; 
                    background-size: cover;
                    background-repeat: no-repeat !important;
                    background-position: center;
                    opacity: 0.2;
                    z-index: -1; /* Ensures watermark is behind the text */
            }
            
            .noc-header {
                text-align: center;
                font-weight: bold;
                font-size: 25px;
                text-decoration: underline;
                margin-bottom: 40px;
            }

            .noc-body {
                font-size: 18px;
                line-height: 1.6;
                position: relative;
                z-index: 2;
            }

            .noc-body .highlight {
                font-weight: bold;
            }

            .noc-signature {
                margin-top: 300px;
            }

            .noc-note {
                font-size: 18px;
                font-style: italic;
                margin-top: 10px;
            }

            .signature-line {
                display: inline-block;
                margin-top: 30px;
                font-weight: bold;
            }

            .noc-date {
                text-align: right;
                font-size: 18px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .noc-header {
                text-align: center;
                font-weight: bold;
                font-size: 18px;
                text-decoration: underline;
                margin-bottom: 20px;
            }

                @media print {
                    body {
                        margin: 0;
                        padding: 0;
                        width: 210mm; 
                        height: 297mm;
                    }
                    .noc-container {
                        width: 100%;
                        padding: 20mm;
                    }
                }
            `);
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');

            
            printWindow.document.write('<div class="noc-container">');
            printWindow.document.write(document.getElementById('nocContent').innerHTML);
            printWindow.document.write('</div>');
            printWindow.document.write('</body></html>');

            printWindow.document.close();

            
            printWindow.onload = function() {
                
                const img = new Image();
                img.onload = function() {
                    printWindow.print(); 
                };
                img.src =
                    'https://scontent.fdac5-2.fna.fbcdn.net/v/t39.30808-1/393121278_798706948724860_2546228729910779588_n.jpg?stp=c7.7.186.186a_dst-jpg_p200x200&_nc_cat=103&ccb=1-7&_nc_sid=f4b9fd&_nc_ohc=P_Qg84VXC5IQ7kNvgE1uXHJ&_nc_zt=24&_nc_ht=scontent.fdac5-2.fna&_nc_gid=APdhLEfV5m7g2iNTpKLaWX1&oh=00_AYAk_f9FoAQbtLvKHm28Y9ySQyO8yjNYhccDtt67wSepxQ&oe=67534096'; 
            };
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        function downloadPDF() {
            var element = document.getElementById("nocContent");

            var opt = {
                margin:       [0.5, 0.7, 0.5, 0.7], // top, left, bottom, right (inch)
                filename:     'noc_letter.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 3, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };

            html2pdf().set(opt).from(element).save();
        }
    </script>
    <script>
    function downloadWord() {
        var content = document.getElementById("nocContent").innerHTML;
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
                    "xmlns:w='urn:schemas-microsoft-com:office:word' "+
                    "xmlns='http://www.w3.org/TR/REC-html40'>"+
                    "<head><meta charset='utf-8'><title>NOC</title></head><body>";
        var footer = "</body></html>";
        var sourceHTML = header + content + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = 'noc_letter.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
    </script>
    <script>
    function downloadExcel() {
        var content = document.getElementById("nocContent").innerHTML;
        var blob = new Blob([content], { type: "application/vnd.ms-excel" });
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "noc_letter.xlsx";
        a.click();
        window.URL.revokeObjectURL(url);
    }
    </script>


@stop
