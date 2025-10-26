@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.Salary_BankPart') !!}</li>
    </ul>
@stop

@section('content')
<style>
    .panel-section { margin: 20px 0; }
    .form-group { display: flex; align-items: center; margin-bottom:10px; }
    .form-group label { width: 150px; margin-right: 10px; }
    .form-group input, .form-group select { flex: 1; }
    .action-buttons { text-align: center; margin-top: 20px; }
    .table-container { margin-top: 30px; }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box-info">
            <div class="container">
                <h2 class="text-center">Salary Bank Panel</h2>

                <!-- Entry Panel -->
                <div class="panel-section">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Group</label>
                                    <select class="form-control" id="group">
                                        <option value="">Select</option>
                                        @foreach ($group as $g)
                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" id="branch">
                                        <option value="">Select</option>
                                        @foreach ($branch as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" id="department">
                                        <option value="">Select</option>
                                        @foreach ($department as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Section</label>
                                    <select class="form-control" id="section">
                                        <option value="">Select</option>
                                        @foreach ($section as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Employee ID <span class="text-danger">*</span></label>
                                    <select class="form-control" id="employeeId">
                                        <option value="">Select</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control" id="designation" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control" id="category" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Gross</label>
                                    <input type="text" class="form-control" id="gross" disabled>
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
    // Load employees on branch change
    $('#branch').on('change', function(){
        var branch_id = $(this).val();
        $('#employeeId').val('');
        HandleBranchWiseEmployees(branch_id, '#employeeId');
        ClearFormAndTable();
    });

    // Employee select
    $('#employeeId').on('change', function(){
        var employeeId = $(this).val();
        if(employeeId==''){
            ClearFormAndTable();
            return;
        }

        $.ajax({
            url:'/get-user-data-salary',
            type:'POST',
            data:{ employeeId: employeeId, _token:'{{ csrf_token() }}' },
            success:function(res){
                $('#name').val(res.first_name);
                $('#designation').val(res.designation);
                $('#category').val(res.category);
                $('#gross').val(res.gross);
                GetBankPart(employeeId);
            },
            error:function(){
                ClearFormAndTable();
            }
        });
    });

    function validate(msg){
        toastr.error(msg);
        $('#saveData').attr('disabled', false).text('Save');
        return false;
    }

    $('#saveData').on('click', function(){
        $(this).attr('disabled', true).text('Saving...');
        const FormData = {
            employeeId: $('#employeeId').val(),
            entryDate: $('#entryDate').val(),
            effectiveDate: $('#effectiveDate').val(),
            gross: $('#gross').val(),
            bankAmount: $('#bankAmount').val(),
            remarks: $('#remarks').val(),
        };

        if(FormData.employeeId=='') return validate('Please select employee');
        if(FormData.entryDate=='') return validate('Please select entry date');
        if(FormData.effectiveDate=='') return validate('Please select effective date');
        if(FormData.bankAmount=='') return validate('Please enter bank amount');

        $.ajax({
            url:'/salary-bank-part-create',
            type:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
            data:FormData,
            success:function(res){
                GetBankPart(FormData.employeeId);
                $('#saveData').attr('disabled', false).text('Save');
                toastr.success(res.message || 'Data saved successfully.');
            },
            error:function(){
                $('#saveData').attr('disabled', false).text('Save');
                toastr.error('Data save failed.');
            }
        });
    });
});

function ClearFormAndTable(){
    $('#name,#designation,#category,#gross').val('');
    const dt = $('#datatable');
    dt.DataTable().destroy();
    $('#tbody').html('<tr><td colspan="8" class="text-center">No data found</td></tr>');
    dt.DataTable({lengthMenu:[10,20,50,100]});
}

function GetBankPart(employeeId=''){
    $.ajax({
        url:'/GetBankPart',
        type:'GET',
        data:{employeeId:employeeId},
        success:function(res){
            const dt = $('#datatable');
            dt.DataTable().destroy();
            var tbody = $('#tbody');
            tbody.empty();

            if(res.length==0){
                tbody.append('<tr><td colspan="8" class="text-center">No data found</td></tr>');
            } else {
                res.forEach(function(item){
                    let row = `<tr>
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
        },
        error:function(){ console.log('error'); }
    });
}

$(document).on('click','.delete-btn', function(){
    var id = $(this).data('id');
    if(!confirm('Are you sure to delete this record?')) return;
    $.ajax({
        url:'/delete-bank-part/'+id,
        type:'GET',
        success:function(res){
            toastr.success(res.message);
            var employeeId = $('#employeeId').val();
            GetBankPart(employeeId);
        },
        error:function(){ toastr.error('Delete failed'); }
    });
});

$(document).on('change','.status', function(){
    var id = $(this).data('id');
    var status = $(this).is(':checked')?1:0;
    $.ajax({
        url:'/updatebank-status',
        type:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
        data:{id:id,status:status},
        success:function(res){
            var employeeId = $('#employeeId').val();
            GetBankPart(employeeId);
            toastr.success(res.message || 'Status updated successfully.');
        },
        error:function(){ toastr.error('Failed to update status.'); }
    });
});
</script>
@stop
