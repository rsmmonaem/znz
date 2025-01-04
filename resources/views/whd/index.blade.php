@extends('layouts.default')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">WHD</li>
    </ul>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box-info">
                    <div class="box-info-header" >
                        <h2><strong>WHD</strong> List
                            <div class="additional-btn">
                                <a href="/whd-create"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add') !!}</button></a>
                            </div>
                        </h2> 
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Group</label>
                            <select class="form-control" name="group_id" id="group_id">
                                <option value="">Select Group</option>
                                @foreach ($group as $g)
                                    <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Brach</label>
                            <select class="form-control" name="branch_id" id="branch_id_view">
                                <option value="">Select Branch</option>
                                @foreach ($branch as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Employee ID</label>
                            <select class="form-control" name="get_empl_id" id="get_empl_id">
                                <option value="">Select Employee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Form Date</label>
                            <input type="date" name="form_date_get" id="form_date_get" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" name="department_id" id="department_id_view">
                                <option value="">Select Department</option>
                                @foreach ($department as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Designation</label>
                            <select class="form-control" name="designation_id" id="designation_id_view">
                                <option value="">Select Designation</option>
                                @foreach ($designation as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Section</label>
                            <select class="form-control" name="section_id" id="section_id_view">
                                <option value="">Select Section</option>
                                @foreach ($section as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" name="to_date_get" id="to_date_get" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" id="get-attendance">Get WHD List</button>
                    </div>
                </div>
                
                <div class="box-info">
                    <div class="table-responsive">
                    <table class="table table-hover table-striped" id="clock-list-table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>{!! trans('messages.option') !!}</th>
                            </tr>
                        </thead>
                        <tbody id="clock-list-table-body">
    
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">{!! trans('messages.delete') !!}</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">{!! trans('messages.delete_message') !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('messages.close') !!}</button>
                    <button type="button" class="btn btn-danger" id="delete">{!! trans('messages.delete') !!}</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#branch_id_view').on('change', function() {
                HandleBranchWiseEmployees($(this).val(), '#get_empl_id');
                $('#get_empl_id').val('').trigger('change');
            });

            $('#get-attendance').on('click', function() {
                $('#get-attendance').attr('disabled', true);
                $('#get-attendance').text('Processing...');
                const FormData = {
                    branch_id: $('#branch_id_view').val(),
                    employee_id: $('#get_empl_id').val(),
                    department_id: $('#department_id_view').val(),
                    designation_id: $('#designation_id_view').val(),
                    section_id: $('#section_id_view').val(),
                    form_date: $('#form_date_get').val(),
                    to_date: $('#to_date_get').val()
                }
                displaydata(FormData);
            })

            function displaydata(FormData) {
                $.ajax({
                    url: "whd_lists",
                    type: 'POST',
                    data: FormData,
                    success: function(data) {
                        $('#get-attendance').attr('disabled', false);
                        $('#get-attendance').text('Get WHD List');
                        const datatable = $('#clock-list-table');
                        datatable.DataTable().destroy();
                        var tableBody = $('#clock-list-table-body');
                        tableBody.empty(); // Clear any existing rows
                        // Loop through each separation record and append a row
                        var i = 1;
                        data.forEach(function(separation) {
                            var row = `<tr>
                                <td>${i++}</td>
                                <td>${separation.employee_code}</td>
								<td>${separation.user_name}</td>
								<td>${separation.date || ' '}</td> 
								<td>
									<div class="btn-group btn-group-xs">
                                        
										<form method="POST" action="/whd/${separation.id}" accept-charset="UTF-8" class="form-inline" id="_${separation.id}"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value=""><button data-toggle="tooltip" title="" class="btn btn-danger btn-xs" data-submit-confirm-text="Yes" type="submit" data-original-title="Delete"><i class="fa fa-trash-o"></i> </button></form>
                                    </div>
								</td>
							</tr>`;
                            tableBody.append(row);
                        });
                    },
                    error(xhr) {
                        $('#get-attendance').attr('disabled', false);
                        $('#get-attendance').text('Get Attendance');
                        console.error('Error:', xhr.responseText);
                    }
                })
            }
        });
    </script>
@stop
