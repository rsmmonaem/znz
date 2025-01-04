@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.promotion_increment') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .form-group label {
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
        }
        .dflex{
            display: flex;
            justify-content: space-between;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
                <div class="container">
                    <h3 class="text-center">Promotion & Increment (Entry Panel)</h3>
                    <div class="container">
                        <h2 class="text-center">Promotion & Increment</h2>
                        <form>
                            <div class="row form-section">
                                <!-- Left Side -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Group</label>
                                        <select class="form-control">
                                            <option value="">Select Group</option>
                                            <option value="J & Z Group" selected>J & Z Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" id="branch" class="form-control" placeholder="Branch" readonly> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Employee ID <span class="text-danger">*</span></label>
                                        <select class="form-control select2m" id="employee_id">
                                            <option value="">Select Employee</option>
                                            @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" class="form-control" placeholder="Name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" id="designations" class="form-control" placeholder="Designation" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Joining</label>
                                        <input type="date" id="date_of_joining" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" id="category"  class="form-control" placeholder="Category" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input type="number" id="salary" class="form-control" placeholder="Salary"  readonly>
                                    </div>
                                </div>

                                <!-- Right Side -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Entry Date <span class="text-danger">*</span></label>
                                        <input type="date" id="entry_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Effective Date <span class="text-danger">*</span></label>
                                        <input type="date" id="effective_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="promotion"> Promotion
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="increment"> Increment
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Emp Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="categorynew">
                                            <option value="">Select Category</option>
                                            @foreach ($catregory as $c)
                                                <option value="{{ $c->name }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- @include('common.category') --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Grade <span class="text-danger">*</span></label>
                                        <select class="form-control" id="grade">
                                            <option value="">Select Grade</option>
                                            @foreach ($grade as $g)
                                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" id="amountnew" class="form-control" placeholder="Amount">
                                         <p id="new_salary"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Promoted Designation <span class="text-danger">*</span></label>
                                        <select class="form-control" id="designation">
                                            <option value="">Select Designation</option>
                                            @foreach ($designation as $d)
                                                <option value="{{ $d->name }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" id="remark" class="form-control" placeholder="Remarks">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="savedata" class="btn btn-primary btn-save-close">Save</button>
                                    <button type="reset" class="btn btn-default btn-save-close">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-container">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>X</th>
                                    <th>Emp ID</th>
                                    <th>Designation</th>
                                    <th>Promoted Designation</th>
                                    <th>Grade</th>
                                    <th>Category</th>
                                    <th>Entry Date</th>
                                    <th>Effective Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script>
    // Intisalize Select2
    $(document).ready(function() {
        getData();
    });
    const amount = $('#amountnew').on('input', function() {
        const oldamount = $('#salary').val();
        const amount = $(this).val();
        const final = parseInt(oldamount) + parseInt(amount);
        $('#new_salary').html(`<strong class="text-danger">New Salary Amount: </strong><span>${final}</span>`);
    });

    function validate(data) {
        $('#savedata').attr('disabled', false);
        $('#savedata').text('Save');
        toastr.error(data);
        return false;
    }
    // SaveDate Increment And Promotion
    $('#savedata').on('click', function() {
        $('#savedata').attr('disabled', true);
        $('#savedata').text('Please Wait...');
        const employee_id = $('#employee_id').val();
        const entry_date = $('#entry_date').val();
        const effective_date = $('#effective_date').val();
        const promotion = $('#promotion').is(':checked') ? 1 : 0;
        const increment = $('#increment').is(':checked') ? 1 : 0;    
        const category = $('#categorynew').val();
        const grade = $('#grade').val();
        const amount = $('#amountnew').val();
        const designation = $('#designation').val();
        const remark = $('#remark').val();
        const oldamount = $('#salary').val();
        const formData = {
            employee_id: employee_id,
            entry_date: entry_date,
            effective_date: effective_date,
            promotion: promotion,
            increment: increment,
            category: category,
            grade: grade,
            amount: amount,
            designation: designation,
            remark: remark,
            old_amount: oldamount
        }

        if(formData.employee_id === ''){
            validate('Please select employee');
            return false;
        }
        if(formData.entry_date === ''){
            validate('Please select entry date');
            return false;
        }
        if(formData.effective_date === ''){
            validate('Please select effective date');
            return false;
        }
        if(formData.category === ''){
            validate('Please select category');
            return false;
        }
        if(formData.grade === ''){
            validate('Please select grade');
            return false;
        }
        if(formData.designation === ''){
            validate('Please select designation');
            return false;
        }
        $.ajax({
            url: '/increment-and-promotion',
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(data) {
                $('#savedata').attr('disabled', false);
                $('#savedata').text('Save');
                toastr.success('Incriments record saved successfully.');
                getData();
            },
            error: function() {
                console.log('error');
                $('#savedata').attr('disabled', false);
                $('#savedata').text('Save');
            }
        });
    })
     
    function getData() {
         $.ajax({
                url: '/increment-and-promotion-data',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    const datatable = $('#datatable');
                    datatable.DataTable().destroy();
                    var tableBody = $('#tableData');
                    tableBody.empty(); // Clear any existing rows
                    // Loop through each separation record and append a row
                    response.forEach(function(inandpro) {
                        var row = `<tr>
                            <td>
                                <div class="btn-group btn-group-xs dflex">
                                    <a href="/increment-and-promotion/${inandpro.id}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="${inandpro.id}" class="btn btn-danger btn-xs" id="deleteIncriments"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            <td>${inandpro.employee_code}</td>
                            <td>${inandpro.predesignation}</td>
                            <td>${inandpro.designation}</td>
                            <td>${inandpro.grade_name}</td>
                            <td>${inandpro.category}</td>
                            <td>${inandpro.entry_date}</td>
                            <td>${inandpro.effective_date}</td>
                            <td>${inandpro.status}</td>
                            <td>${inandpro.amount}</td>
                            <td>${inandpro.remark}</td>
                        </tr>`;
                        tableBody.append(row);
                    });
                    datatable.DataTable({
                        // order: [
                        //     [1, 'desc']
                        // ],
                        lengthMenu: [10, 20, 50, 100],
                    })
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
    }
    // Delete Increments And Promotions
    $(document).on('click','#deleteIncriments', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this Incriments record?')) {
            $.ajax({
                url: `/increment-and-promotion/${id}`,
                type: 'DELETE',
                success: function(response) {
                    getData();
                    toastr.success('Incriments record deleted successfully.');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }
    });
    // Get User Data Dynamically
    $('#employee_id').on('change', function() {
        var employee_id = $(this).val();
        if (employee_id) {
            $.ajax({
                url: '/get-employee-details/' + employee_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.first_name);
                    // $('#employee_id').val(data.id);
                    $('#branch').val(data.branch);
                    $('#designations').val(data.designation);
                    $('#date_of_joining').val(data.date_of_joining);
                    $('#category').val(data.category);
                    $('#salary').val(Math.round(data.amount));
                },
                error: function() {
                    console.log('error');
                }
            });
        } else {
            $('#designations').val('');
            $('#date_of_joining').val('');
            $('#category').val('');
            $('#salary').val('');
        }
    }); 
</script>
@stop