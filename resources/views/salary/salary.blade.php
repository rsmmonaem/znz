@extends('layouts.default')

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
    <li class="active">{!! trans('messages.Salary_BankPart') !!}</li>
</ul>
@stop

@section('content')
<style>
.panel-section{margin:20px 0;}
.form-group{display:flex;align-items:center;margin-bottom:10px;}
.form-group label{width:150px;margin-right:10px;}
.form-group input, .form-group select{flex:1;}
.action-buttons{text-align:center;margin-top:20px;}
.table-container{margin-top:30px;}
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Salary Bank Panel</h2>

                <!-- Entry Panel -->
                <div class="panel-section">
                    <form id="bankForm">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee ID <span class="text-danger">*</span></label>
                                    <select class="form-control" id="employeeId">
                                        <option value="">Select</option>
                                        @foreach($employee as $e)
                                            <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" id="designation" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" id="category" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Gross</label>
                                    <input type="text" id="gross" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Entry Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="entryDate" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label>Effective Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="effectiveDate">
                                </div>
                                <div class="form-group">
                                    <label>Bank Amount <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="bankAmount">
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" id="remarks">
                                </div>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-success" id="saveData">Save</button>
                            <button type="button" class="btn btn-danger">Close</button>
                        </div>
                    </form>
                </div>

                <!-- Data Table -->
                <div class="table-container">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Emp ID</th>
                                <th>Effective Date</th>
                                <th>Bank Amount</th>
                                <th>Cash Amount</th>
                                <th>Hold</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
$(document).ready(function(){

    // Load default table
    GetBankPart();

    // Employee change
    $('#employeeId').on('change', function(){
        let employeeId = $(this).val();

        // Fill employee info
        $.ajax({
            url:'/get-user-data-salary',
            type:'POST',
            data:{ employeeId: employeeId, _token:'{{ csrf_token() }}' },
            success:function(res){
                $('#name').val(res.first_name);
                $('#designation').val(res.designation);
                $('#category').val(res.category);
                $('#gross').val(res.gross);
            }
        });

        // Update table
        GetBankPart(employeeId);
    });

    function validate(msg){
        toastr.error(msg);
        $('#saveData').attr('disabled', false).text('Save');
        return false;
    }

    // Save bank part
    $('#saveData').on('click', function(){
        $(this).attr('disabled', true).text('Saving...');
        let FormData = {
            employeeId: $('#employeeId').val(),
            entryDate: $('#entryDate').val(),
            effectiveDate: $('#effectiveDate').val(),
            gross: $('#gross').val(),
            bankAmount: $('#bankAmount').val(),
            remarks: $('#remarks').val()
        };

        if(FormData.employeeId=='') return validate('Select employee');
        if(FormData.entryDate=='') return validate('Select entry date');
        if(FormData.effectiveDate=='') return validate('Select effective date');
        if(FormData.bankAmount=='') return validate('Enter bank amount');

        $.ajax({
            url:'/salary-bank-part-create',
            type:'POST',
            data:FormData,
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
            success:function(res){
                GetBankPart();
                $('#saveData').attr('disabled', false).text('Save');
                toastr.success(res.message);
            },
            error:function(){ 
                $('#saveData').attr('disabled', false).text('Save');
                toastr.error('Save failed');
            }
        });
    });
});

// Load table data
function GetBankPart(employeeId=''){
    $.ajax({
        url:'/GetBankPart',
        type:'GET',
        data:{employeeId:employeeId},
        success:function(res){
            const dt = $('#datatable');
            dt.DataTable().destroy();
            let tbody = $('#tbody');
            tbody.empty();
            if(res.length==0){
                tbody.append('<tr><td colspan="8" class="text-center">No data found</td></tr>');
            } else {
                res.forEach(function(item){
                    let row = `<tr>
                        <td><input type="checkbox"></td>
                        <td>${item.employee_code}</td>
                        <td>${item.effective_date}</td>
                        <td>${item.bank_amount}</td>
                        <td>${item.cash_amount}</td>
                        <td><input type="checkbox" data-id="${item.id}" class="status" ${item.status==1?'checked':''}></td>
                        <td>${item.status==0?'false':'true'}</td>
                        <td>
                            <a href="/edit-bank-part/${item.id}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                            <button class="btn btn-xs btn-danger delete-btn" data-id="${item.id}"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>`;
                    tbody.append(row);
                });
            }
            dt.DataTable({lengthMenu:[10,20,50,100]});
        }
    });
}

// Delete
$(document).on('click','.delete-btn',function(){
    let id=$(this).data('id');
    if(!confirm('Are you sure?')) return;
    $.get('/delete-bank-part/'+id,function(res){
        toastr.success(res.message);
        GetBankPart();
    });
});

// Status change
$(document).on('change','.status',function(){
    let id=$(this).data('id');
    let status=$(this).is(':checked')?1:0;
    $.post('/updatebank-status',{id:id,status:status,_token:'{{ csrf_token() }}'},function(res){
        toastr.success(res.message);
        GetBankPart();
    });
});
</script>
@stop
