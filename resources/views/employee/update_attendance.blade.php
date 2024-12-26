@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('messages.update_attendance') !!}</li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="box-info">
                <h2><strong>{!! trans('messages.update_attendance') !!}</strong></h2>

                {!! Form::open([
                    'route' => 'clock.update-attendance',
                    'role' => 'form',
                    'class' => 'update-attendance-form',
                    'id' => 'update-attendance-form',
                    'data-submit' => 'noAjax',
                ]) !!}
                @php
                    $group = DB::table('com_group')->get();
                    $branch = \App\Branch::all();
                    $department = \App\Department::all();
                    $section = \App\Section::all();
                    $designation = \App\Designation::all();
                    $employee = \App\User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
                        ->select('users.first_name', 'users.id', 'profile.employee_code')
                        ->get();
                @endphp
                <div class="form-group">
                    <label>Employee</label>
                    <select class="form-control" name="empolyee_id" id="empolyee_id">
                        <option value="">Select Employee</option>
                        @foreach ($employee as $e)
                            <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="repname" class="form-control" placeholder="Name" readonly>
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="department" id="repdepartment" class="form-control" placeholder="Department"
                        readonly>
                </div>

                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" id="repdesignation" class="form-control"
                        placeholder="Designation" readonly>
                </div>

                <div class="form-group">
                    <label>Employee IDs</label>
                    <select class="form-control" name="multiple_id" id="multiple_id" multiple>
                        <option value="">Select Employee</option>
                        @foreach ($employee as $e)
                            <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="multiple_id" class="form-control" placeholder="ID1, ID2, ID3"> --}}
                </div>
                <div class="form-group">
                    {!! Form::label('date', trans('messages.date'), []) !!}
                    {!! Form::input('text', 'date', isset($holiday->date) ? $holiday->date : '', [
                        'class' => 'form-control mdatepicker',
                        'placeholder' => trans('messages.date'),
                        'id' => 'date',
                        'readonly' => 'true',
                    ]) !!}
                </div>
                <div class="form-group">{!! Form::input('text', 'clock_in', '', [
                    'class' => 'form-control datetimepicker',
                    'id' => 'clock_in',
                    'placeholder' => trans('messages.clock_in'),
                    'readonly' => true,
                ]) !!}</div>
                <div class="form-group">{!! Form::input('text', 'clock_out', '', [
                    'class' => 'form-control datetimepicker',
                    'id' => 'clock_out',
                    'placeholder' => trans('messages.clock_out'),
                    'readonly' => true,
                ]) !!}</div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" id="save-attendance">{!! trans('messages.submit') !!}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="box-info">
                <h2><strong>Attendance View</strong></h2>
                <div class="row">
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
                                @foreach ($employee as $e)
                                    <option value="{{ $e->id }}">{{ $e->first_name }} - {{ $e->employee_code }}
                                    </option>
                                @endforeach
                            </select>
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
                    </div>
                    <div class="col-sm-12">
                      <button type="button" class="btn btn-primary" id="get-attendance">Get Attendance</button>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="clock-list-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>{!! trans('messages.in_time') !!}</th>
                                <th>{!! trans('messages.out_time') !!}</th>
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

@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#get-attendance').on('click', function() {
                $('#get-attendance').attr('disabled', true);
                $('#get-attendance').text('Processing...');
                const FormData = {
                    branch_id: $('#branch_id_view').val(),
                    employee_id: $('#get_empl_id').val(),
                    department_id: $('#department_id_view').val(),
                    designation_id: $('#designation_id_view').val(),
                    section_id: $('#section_id_view').val(),
                }
                displaydata(FormData);
            })
            // GetUser Data
            $('#empolyee_id').on('change', function() {
                $.ajax({
                    url: '/UserData',
                    type: 'POST',
                    data: {
                        employeeId: $(this).val(),
                    },
                    success: function(data) {
                        $('#repname').val(data.first_name);
                        $('#repdepartment').val(data.department);
                        $('#repdesignation').val(data.designation);
                    }
                })
            })
            // save-attendance
            $('#save-attendance').click(function() {
                if ($('#date').val() == '' || $('#clock_in').val() == '' || $('#clock_out').val() == '') {
                    toastr.error('Please fill all the fields');
                    return false;
                } else
                    $('#save-attendance').attr('disabled', true);
                $('#save-attendance').text('Processing...');
                // const multiple_id = $('input[name="multiple_id"]').val();
                // const multiple_id_array = multiple_id.split(',').map(id => id.trim()).filter(id => id !== "");
                const FormDate = {
                    employee_ids: $('#multiple_id').val(),
                    employee_id: $('#empolyee_id').val(),
                    // branch: $('[name="branch"]').val(),
                    // description: $('#description').val(),
                    // designation: $('[name="designation"]').val(),
                    // department: $('[name="department"]').val(),
                    // section: $('[name="section"]').val(),
                    date: $('#date').val(),
                    clock_in: $('#clock_in').val(),
                    clock_out: $('#clock_out').val(),
                };
                $.ajax({
                    url: "/post-update-attendance",
                    type: 'POST',
                    data: FormDate,
                    success: function(data) {
                        console.log(data);

                        displaydata();
                        toastr.success('Attendance Updated Successfully');
                        $('#save-attendance').attr('disabled', false);
                        $('#save-attendance').text('Save Attendance');
                    },
                    error(xhr) {
                        console.error('Error:', xhr.responseText);
                        $('#save-attendance').attr('disabled', false);
                        $('#save-attendance').text('Save Attendance');
                    }
                });
            });

            function displaydata(FormData) {
                $.ajax({
                    url: "/post-update-attendance-list",
                    type: 'POST',
                    data: FormData,
                    success: function(data) {
                        $('#get-attendance').attr('disabled', false);
                        $('#get-attendance').text('Get Attendance');
                        const datatable = $('#clock-list-table');
                        datatable.DataTable().destroy();
                        var tableBody = $('#clock-list-table-body');
                        tableBody.empty(); // Clear any existing rows
                        // Loop through each separation record and append a row
                        data.forEach(function(separation) {
                            var row = `<tr>
								<td>${separation.user_name}</td>
								<td>${separation.formatted_clock_in || ' '}</td>
								<td>${separation.formatted_clock_out || ' '}</td> 
								<td>${separation.date || ' '}</td> 
								<td>
									<div class="btn-group btn-group-xs">
                                            <a href="#" data-href="/clock/${separation.id}/edit"
                                                class='btn btn-xs btn-default' data-toggle="modal" data-target="#myModal">
                                            <i class='fa fa-edit' data-toggle="tooltip" title="{!! trans('messages.edit') !!}"></i> 
										</a>
										<form method="POST" action="http://znz.test/clock/${separation.id}" accept-charset="UTF-8" class="form-inline" id="_${separation.id}"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value=""><button data-toggle="tooltip" title="" class="btn btn-danger btn-xs" data-submit-confirm-text="Yes" type="submit" data-original-title="Delete"><i class="fa fa-trash-o"></i> </button></form>
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
