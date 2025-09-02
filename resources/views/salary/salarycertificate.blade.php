@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li class="active">Salary Certificate</li>
</ul>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Salary Certificate</h2>

                {{-- Filter Form --}}
                <form>
                    <div class="row">
                        {{-- LEFT SIDE --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select id="group" class="form-control">
                                    <option value="">Select Group</option>
                                    @foreach($group as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select id="branch" class="form-control">
                                    <option value="">Select Branch</option>
                                    @foreach($branch as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="department">Department</label>
                                <select id="department" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($department as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="section">Section</label>
                                <select id="section" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach($section as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select id="designation" class="form-control">
                                    <option value="">Select Designation</option>
                                    @foreach($designation as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="employee_id">Employee ID</label>
                                <select id="employee_id" class="form-control">
                                    <option value="">Select Employee</option>
                                    {{-- AJAX load employees --}}
                                </select>
                            </div>
                        </div>

                        {{-- RIGHT SIDE --}}
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
                                <select id="type" class="form-control">
                                    <option value="management">Management</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    <button type="button" class="btn btn-primary" id="report">Generate Certificate</button>
                    <button type="button" class="btn btn-danger">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@section('javascript')
<script>
$(document).ready(function(){
    $('#branch').on('change',function(){
        HandleBranchWiseEmployees($(this).val(), '#employee_id');
    });

    $('#report').on('click',function(){
        $.ajax({
            url: "{{ route('salary.certificate.generate') }}",
            type: "POST",
            data: {
                employeeId: $('#employee_id').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                if(res.error){
                    toastr.error(res.error);
                } else {
                    getCertificate(res);
                }
            }
        })
    });

    function getCertificate(data){
        var newWindow = window.open('', '_blank','width=900,height=800');
        var today = new Date().toLocaleDateString('en-GB');

        var content = `
        <html>
        <head><title>Salary Certificate</title></head>
        <body style="font-family: Arial; margin:40px;">
            <h2 style="text-align:center;">Salary Certificate</h2>
            <p>Date: ${today}</p>
            <p>This is to certify that <b>${data.employee.first_name}</b> (ID: ${data.employee.employee_code}),
            working as <b>${data.employee.designation}</b> in <b>${data.employee.department}</b> department,
            has been employed with us since ${data.employee.date_of_joining}.</p>
            <table border="1" width="100%" cellpadding="6" cellspacing="0">
                <tr><th>Basic</th><td>${data.basic}</td></tr>
                <tr><th>House Rent</th><td>${data.house}</td></tr>
                <tr><th>Medical</th><td>${data.medical}</td></tr>
                <tr><th>Conveyance</th><td>${data.conveyance}</td></tr>
                <tr><th>Others</th><td>${data.others}</td></tr>
                <tr><th>Gross Salary</th><td><b>${data.gross}</b></td></tr>
                ${data.tax ? `<tr><th>Tax</th><td>- ${data.tax}</td></tr>` : ''}
                <tr><th>Net Payable</th><td><b>${data.net}</b></td></tr>
            </table>
            <p style="margin-top:20px;">This certificate is issued upon request without liability on the company.</p>
            <div style="margin-top:50px; text-align:right;">
                <p>_______________________</p>
                <p>Authorized Signature</p>
            </div>
        </body></html>`;
        newWindow.document.write(content);
        newWindow.document.close();
    }
});
</script>
@stop
