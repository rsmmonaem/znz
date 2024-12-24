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

        .dflex {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="box-info">
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
                                    {{-- <select class="form-control" id="branch">
                                            <option value="">Select Branch</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}" {{ $b->id == $data->branch_id ? 'selected' : '' }}>{{ $b->name }}</option>
                                            @endforeach
                                        </select> --}}
                                    <input type="text" id="branch" class="form-control" placeholder="Branch" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <select class="form-control select2m" id="employee_id">
                                        <option value="">Select Employee</option>
                                        <option value="{{ $employee->id }}" selected>{{ $employee->first_name }} -
                                            {{ $employee->employee_code }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" id="designation" class="form-control" placeholder="Designation"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Date of Joining</label>
                                    <input type="date" id="date_of_joining" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" id="category" class="form-control" placeholder="Category"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="number" id="salary" class="form-control" placeholder="Salary" readonly>
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Entry Date</label>
                                    <input type="date" id="entry_date" class="form-control" value="{{ $data->entry_date }}">
                                </div>
                                <div class="form-group">
                                    <label>Effective Date</label>
                                    <input type="date" id="effective_date" class="form-control" value="{{ $data->effective_date }}">
                                </div>
                                <div class="form-group">
                                    <label>Type</label><br>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="promotion" {{ $data->promotion == true ? 'checked' : '' }}> Promotion
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="increment" {{ $data->increment == true ? 'checked' : '' }}> Increment
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Emp Category</label>
                                    <select class="form-control" id="categorynew">
                                        <option value="">Select Category</option>
                                        @foreach ($catregory as $c)
                                            <option value="{{ $c->name }}" {{ $c->name == $data->category ? 'selected' : '' }}>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Grade</label>
                                    <select class="form-control" id="grade">
                                        <option value="">Select Grade</option>
                                        @foreach ($grade as $g)
                                            <option value="{{ $g->id }}" {{ $data->grade  == $g->id ? 'selected' : ''  }}>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" id="amountnew" class="form-control" placeholder="Amount" value="{{ $data->amount }}">
                                    <p id="new_salary"></p>
                                </div>
                                <div class="form-group">
                                    <label>Promoted Designation</label>
                                    <select class="form-control" id="designation">
                                        <option value="">Select Designation</option>
                                        @foreach ($designation as $d)
                                            <option value="{{ $d->id }}" {{ $d->name == $data->designation ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input type="text" id="remark" class="form-control" placeholder="Remarks" value="{{ $data->remark }}">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-md-12 text-center">
                                <button type="button" id="UpdateBTN" class="btn btn-primary btn-save-close">Save</button>
                                <button type="reset" class="btn btn-default btn-save-close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            // Get User Data Dynamically
            var employee_id = $('#employee_id').val();
            $.ajax({
                url: '/get-employee-details/' + employee_id,
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('#name').val(data.first_name);
                    // $('#employee_id').val(data.id);
                    $('#branch').val(data.branch);
                    $('#designation').val(data.designation);
                    $('#date_of_joining').val(data.date_of_joining);
                    $('#category').val(data.category);
                    $('#salary').val(Math.round(data.amount));
                },
                error: function() {
                    console.log('error');
                }
            });

        })

        $('#UpdateBTN').on('click', function() {
            $('#UpdateBTN').attr('disabled', true);
            $('#UpdateBTN').text('Please Wait...');
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
            $.ajax({
                url: '/increment-and-promotion' + '/' + {{ $data->id }},
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(data) {
                    $('#UpdateBTN').attr('disabled', false);
                    $('#UpdateBTN').text('Save');
                    toastr.success('Incriments record updated successfully.');               
                },
                error: function() {
                    console.log('error');
                    $('#UpdateBTN').attr('disabled', false);
                    $('#UpdateBTN').text('Save');
                    toastr.error('Incriments record update failed.');
                }
            });
        })
    </script>
@stop
