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
    @media print {
        .no-print { display: none; }
    }
</style>

<div class="box-info full">
    <div class="row">
        <div class="container attendance-report">
            <h2 class="text-center">Attendance Report</h2>
            <h4 class="text-center">Monthly Attendance Report</h4>

            <form>
                {!! csrf_field() !!}
                <div class="row">
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
                                <label><input type="radio" name="status" value="3"> Absent</label><br>
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

    function buildEmployeeHTML(empData, branch_name, startDate, toDate) {
        var emp = empData[0];
        var rows = '';

        $.each(empData, function(i, att){
            rows += '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+att.date+'</td>'+
                        '<td>'+att.shift_in+'</td>'+
                        '<td>'+att.shift_out+'</td>'+
                        '<td>'+att.shift_name+'</td>'+
                        '<td>'+att.in_time+'</td>'+
                        '<td>'+att.out_time+'</td>'+
                        '<td>'+att.status+'</td>'+
                        '<td>'+att.lateTime+'</td>'+
                        '<td>'+att.overTime+'</td>'+
                        '<td>'+att.overTime+'</td>'+
                        '<td>'+(att.remarks || '')+'</td>'+
                    '</tr>';
        });

        return '<div style="page-break-after:always;">'+
                    '<div style="border:1px solid #000; padding:10px;">'+
                        '<div style="display:flex; justify-content:space-between;">'+
                            '<img src="'+logoUrl+'" style="width:150px;">'+
                            '<div style="text-align:center;">'+
                                '<h3>Head Office</h3>'+
                                '<p>Monthly Attendance Report</p>'+
                                '<p><b>Branch:</b> '+branch_name+'</p>'+
                                '<p><b>Date:</b> '+startDate+' to '+toDate+'</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    // ✅ Justified employee info
                    '<table style="width:100%; margin-top:10px;">'+
                        '<tr style="display:flex; justify-content:space-between;">'+
                            '<td style="flex:1;"><b>Emp ID:</b> '+emp.employee_code+'<br><b>Department:</b> '+(emp.department||'')+'<br><b>Section:</b> '+(emp.section||'')+'</td>'+
                            '<td style="flex:1; text-align:right;"><b>Name:</b> '+emp.name+'<br><b>Category:</b> '+(emp.category||'')+'<br><b>Designation:</b> '+(emp.designation||'')+'</td>'+
                        '</tr>'+
                    '</table>'+

                    '<table border="1" style="width:100%; border-collapse:collapse; margin-top:15px;">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>SL</th>'+
                                '<th>Date</th>'+
                                '<th>Shift In</th>'+
                                '<th>Shift Out</th>'+
                                '<th>Shift Name</th>'+
                                '<th>Punch In</th>'+
                                '<th>Punch Out</th>'+
                                '<th>Status</th>'+
                                '<th>Late</th>'+
                                '<th>OT</th>'+
                                '<th>Extra</th>'+
                                '<th>Remarks</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+rows+'</tbody>'+
                    '</table>'+
               '</div>';
    }

    function openReportWindow(finalHTML) {
        var newWindow = window.open('', '_blank');

        // Buttons
        newWindow.document.write(`
            <div class="no-print" style="margin-bottom:15px;">
                <button onclick="window.print()" style="margin-right:10px;">Print / PDF</button>
                <button onclick="exportExcel()" style="margin-right:10px;">Excel</button>
            </div>
        `);

        // Excel function
        newWindow.document.write(`
            <script>
                function exportExcel() {
                    var tableHTML = '';
                    var tables = document.querySelectorAll('table');
                    for(var i=0;i<tables.length;i++){ tableHTML += tables[i].outerHTML; }
                    var a = document.createElement('a');
                    a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableHTML);
                    a.download = 'attendance_report.xls';
                    a.click();
                }
            <\/script>
        `);

        newWindow.document.write(finalHTML);
        newWindow.document.close();
    }

    $('#getData').click(function() {
        $(this).prop('disabled', true).text('Please Wait...');

        var formData = {
            status: $('input[name="status"]:checked').val(),
            branch_id: $('#branch').val(),
            department_id: $('#department').val(),
            section_id: $('#section').val(),
            category_id: $('#category').val(),
            designation_id: $('#designation').val(),
            employee_id: $('#employeeId').val(),
            startDate: $('#startDate').val(),
            endDate: $('#endDate').val(),
            shift_id: $('#shift_id').val()
        };

        $.post("{{ url('attendance-report') }}", formData, function(response) {
            $('#getData').prop('disabled', false).text('Report');

            var grouped = {};
            $.each(response.filtered_data, function(i, row){
                if (!grouped[row.employee_code]) grouped[row.employee_code] = [];
                grouped[row.employee_code].push(row);
            });

            var finalHTML = '';
            for (var code in grouped) {
                finalHTML += buildEmployeeHTML(grouped[code], response.branch_name, response.startDate, response.toDate);
            }

            openReportWindow(finalHTML);
        });
    });

    // Local Excel export for current page table
    $('#exportExcel').click(function(){
        var tableHTML = '<table border="1">'+$('.attendance-report table').html()+'</table>';
        var a = document.createElement('a');
        a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableHTML);
        a.download = 'attendance_report.xls';
        a.click();
    });

    // Local Print/PDF for current page
    $('#exportPdf').click(function(){
        window.print();
    });

});
</script>

@stop
