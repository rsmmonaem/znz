@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li class="active">{!! trans('messages.attendance') !!}</li>
</ul>
@stop

@section('content')

<style>
    .attendance-report { margin: 20px; }
    .form-group label { font-weight: bold; }
    .form-section { margin-bottom: 20px; }
    @media print { .no-print { display: none; } }
</style>

<div class="box-info full">
    <div class="row">
        <div class="container attendance-report">
            <h2 class="text-center">Attendance Report</h2>
            <h4 class="text-center">Monthly Attendance</h4>

            <form>
                {!! csrf_field() !!}
                <div class="row">

                    <!-- Left Side -->
                    <div class="col-md-6 form-section">
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select class="form-control" id="group">
                                <option>J & Z Group</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <select class="form-control" name="branch" id="branch">
                                <option value="">Select Branch</option>
                                @foreach ($branch as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" name="department" id="department">
                                <option value="">Select Department</option>
                                @foreach ($department as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="section">Section</label>
                            <select class="form-control" name="section" id="section">
                                <option value="">Select Section</option>
                                @foreach ($section as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select class="form-control" name="designation" id="designation">
                                <option value="">Select Designation</option>
                                @foreach ($designation as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="employeeId">Employee ID(Single & Multiple)</label>
                            <select class="form-control" name="employeeId" id="employeeId" multiple>
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-6 form-section">
                        <div class="form-group">
                            <label for="reportType">Report Type</label>
                            @include('common.reportSelect')
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            @include('common.category')
                        </div>

                        <div class="form-group">
                            <label for="shift_id">Shift</label>
                            <select class="form-control" id="shift_id" name="shift_id">
                                <option value="">Select shift</option>
                                @foreach ($shift as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>

                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <div>
                                <label><input type="radio" name="status" value="all" checked> All</label>
                                <label><input type="radio" name="status" value="1"> Present</label>
                                <label><input type="radio" name="status" value="2"> Late</label>
                                <label><input type="radio" name="status" value="3"> Absent</label>
                                <label><input type="radio" name="status" value="4"> WHD</label>
                                <label><input type="radio" name="status" value="5"> LWP</label>
                                <label><input type="radio" name="status" value="6"> Leave</label>
                                <label><input type="radio" name="status" value="7"> Holiday</label>
                                <label><input type="radio" name="status" value="8"> SPHD</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center form-section">
                        <button type="button" class="btn btn-primary" id="getData">Report</button>
                        <button type="button" class="btn btn-default" onclick="window.close();">Close</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('javascript')
<script>
$(document).ready(function() {

    var logoUrl = "{{ URL::to(config('constants.upload_path.logo') . config('config.logo')) }}";

    $('#branch').on('change', function() {
        HandleBranchWiseEmployees($(this).val(), '#employeeId', true);
    });

    function convertMinutes(min) {
        let h = Math.floor(min / 60);
        let m = min % 60;
        return `${h}:${("0"+m).slice(-2)}`;
    }

    // Summary calculation with Absent default
    function calcSummary(data, startDate, endDate){
        let start = new Date(startDate);
        let end = new Date(endDate);
        let allDates = [];
        for(let d=start; d<=end; d.setDate(d.getDate()+1)){
            allDates.push(d.toISOString().slice(0,10));
        }

        let s = { present:0, absent:0, late:0, lwp:0, leave:0, holiday:0, ot_minutes:0 };

        allDates.forEach(date => {
            let r = data.find(x=>x.date===date);

            if(!r){
                // no record → Absent
                s.absent++;
                return;
            }

            switch(r.status){
                case "P": s.present++; break;
                case "Present": s.present++; break;    // added mapping
                case "A": 
                case "Absent": s.absent++; break;       // added mapping
                case "L": 
                case "Late": s.late++; break;
                case "LWP": s.lwp++; break;
                case "Leave":
                case "CL":
                case "EL":
                case "ML":
                case "SL": s.leave++; break;
                case "H":
                case "Holiday": s.holiday++; break;
                default: if(!r.status) s.absent++;
            }

            if(r.overTime && r.overTime!=="00:00"){
                let parts = r.overTime.split(":");
                s.ot_minutes += (parseInt(parts[0])||0)*60 + (parseInt(parts[1])||0);
            }
        });

        let h = Math.floor(s.ot_minutes / 60);
        let m = s.ot_minutes % 60;
        s.ot = `${h}:${("0"+m).slice(-2)}`;
        return s;
    }


    function buildEmployeeHTML(empData, branch_name, startDate, toDate){
        let emp = empData[0];
        let rows = "";
        empData.forEach((att,i)=>{
            rows += `
            <tr>
                <td>${i+1}</td>
                <td>${att.date}</td>
                <td>${att.shift_in}</td>
                <td>${att.shift_out}</td>
                <td>${att.shift_name}</td>
                <td>${att.in_time ?? "N/A"}</td>
                <td>${att.out_time ?? "N/A"}</td>
                <td>${att.status}</td>
                <td>${att.lateTime ?? ""}</td>
                <td>${att.overTime ?? ""}</td>
                <td>${att.extra ?? ""}</td>
                <td>${att.remarks ?? ""}</td>
            </tr>`;
        });

        let S = calcSummary(empData, startDate, toDate);

        let summaryHTML = `
        <table border="1" style="width:100%; border-collapse:collapse; text-align:center; margin-top:15px;">
            <tr>
                <td><b>Total Present</b></td><td>${S.present}</td>
                <td><b>Total Absent</b></td><td>${S.absent}</td>
                <td><b>Total Late</b></td><td>${S.late}</td>
                <td><b>Total LWP</b></td><td>${S.lwp}</td>
                <td><b>Total Leave</b></td><td>${S.leave}</td>
                <td><b>Total Holiday</b></td><td>${S.holiday}</td>
                <td><b>Total OT</b></td><td>${S.ot}</td>
            </tr>
        </table>`;

        return `
        <div style="page-break-after:always; padding:10px; border:1px solid #000;">
            <div style="text-align:center; margin-bottom:10px;">
                <img src="${logoUrl}" style="width:150px; display:block; margin:0 auto;">
                <h3 style="margin:5px 0;">Attendance Report</h3>
                <p><b>Branch:</b> ${branch_name}</p>
                <p><b>Date:</b> ${startDate} to ${toDate}</p>
            </div>

            <div style="display:flex; justify-content:space-between; margin-top:10px;">
                <div>
                    <p><b>Emp ID:</b> ${emp.employee_code}</p>
                    <p><b>Department:</b> ${emp.department ?? ''}</p>
                    <p><b>Category:</b> ${emp.category ?? ''}</p>
                </div>
                <div style="text-align:right;">
                    <p><b>Name:</b> ${emp.name}</p>
                    <p><b>Section:</b> ${emp.section ?? ''}</p>
                    <p><b>Designation:</b> ${emp.designation ?? ''}</p>
                </div>
            </div>

            <table border="1" style="width:100%; border-collapse:collapse; text-align:center; margin-top:10px;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Shift In</th>
                        <th>Shift Out</th>
                        <th>Shift Name</th>
                        <th>Punch In</th>
                        <th>Punch Out</th>
                        <th>Status</th>
                        <th>Late</th>
                        <th>OT</th>
                        <th>Extra</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>${rows}</tbody>
            </table>

            ${summaryHTML}
        </div>`;
    }

    function openReportWindow(finalHTML){
        var newWindow = window.open('', '_blank');
        newWindow.document.write(`
            <div class="no-print" style="margin-bottom:15px;">
                <button onclick="window.print()" style="margin-right:10px;">Print / PDF</button>
                <button onclick="exportExcel()" style="margin-right:10px;">Excel</button>
            </div>
        `);
        newWindow.document.write(`
            <script>
                function exportExcel(){
                    var tableHTML='';
                    var tables=document.querySelectorAll('table');
                    for(var i=0;i<tables.length;i++){ tableHTML+=tables[i].outerHTML; }
                    var a=document.createElement('a');
                    a.href='data:application/vnd.ms-excel,'+encodeURIComponent(tableHTML);
                    a.download='attendance_report.xls';
                    a.click();
                }
            <\/script>
        `);
        newWindow.document.write(finalHTML);
        newWindow.document.close();
    }

    $('#getData').click(function(){
        $(this).prop('disabled',true).text('Please Wait...');

        var formData = {
            status:$('input[name="status"]:checked').val(),
            branch_id:$('#branch').val(),
            department_id:$('#department').val(),
            section_id:$('#section').val(),
            category_id:$('#category').val(),
            designation_id:$('#designation').val(),
            employee_id:$('#employeeId').val(),
            startDate:$('#startDate').val(),
            endDate:$('#endDate').val(),
            shift_id:$('#shift_id').val()
        };

        $.post("{{ url('attendance-report') }}", formData, function(response){
            $('#getData').prop('disabled',false).text('Report');

            var grouped = {};
            $.each(response.filtered_data, function(i,row){
                if(!grouped[row.employee_code]) grouped[row.employee_code]=[];
                grouped[row.employee_code].push(row);
            });
            
            // Sort each employee block by date
            Object.keys(grouped).forEach(function(key){
                grouped[key].sort(function(a,b){
                    return new Date(a.date) - new Date(b.date);
                });
            });

            var finalHTML='';
            for(var emp in grouped){
                finalHTML+=buildEmployeeHTML(grouped[emp], response.branch_name, response.startDate, response.toDate);
            }

            openReportWindow(finalHTML);
        });
    });

});
</script>
@stop
