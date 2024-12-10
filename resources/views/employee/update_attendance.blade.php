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
                {{-- <div class="form-group">
					    {!! Form::label('user_id',trans('messages.employee'),['class' => 'control-label'])!!}
					    {!! Form::select('user_id', [null => trans('messages.select_one')] + $users, $user->id,['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('date',trans('messages.date'),[])!!}
						{!! Form::input('text','date',$date,['class'=>'form-control datepicker','placeholder'=>trans('messages.date'),'readonly' => 'true'])!!}
					  </div> --}}
                <div class="form-group">
                    {!! Form::label('date', trans('Branch'), []) !!}
                    <select class="form-control" name="branch" id="branch">
                        <option value="">Select Branch</option>
                        @php
                            $branch = \App\Branch::all();
                            $department = \App\Department::all();
                            $section = \App\Section::all();
                            $designation = \App\Designation::all();
                            $employee = \App\User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
                                ->select('users.first_name', 'users.id', 'profile.employee_code')
                                ->get();
                        @endphp
                        @foreach ($branch as $b)
                            <option value="{{ $b->id }}"
                                {{ isset($holiday->branch) && $holiday->branch == $b->id ? 'selected' : '' }}>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <select class="form-control" name="department">
                        <option value="">Select Department</option>
                        @foreach ($department as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <select class="form-control" name="section">
                        <option value="">Select Section</option>
                        @foreach ($section as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <select class="form-control" name="designation">
                        <option value="">Select Designation</option>
                        @foreach ($designation as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Employee IDs</label>
                    <input type="text" name="multiple_id" class="form-control" placeholder="ID1, ID2, ID3">
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
                <h2><strong>{!! trans('messages.update_attendance') !!}</strong></h2>
              {{--   <h4>{!! $user->full_name_with_designation !!}</h4>
                <p><strong>{!! showDate($date) . ' ' . $label !!}</strong></p>
                <p><strong>Office Shift: {!! showDateTime($my_shift->in_time) !!} to {!! showDateTime($my_shift->out_time) !!}</strong></p> --}}

                {{-- <div class="row">
                    {!! Form::model($user, [
                        'method' => 'POST',
                        'route' => ['clock.clock-update', $user->id, $date],
                        'class' => 'clock-form',
                        'id' => 'clock-form',
                        'data-table-alter' => 'clock-list-table',
                        'data-submit' => 'noAjax',
                    ]) !!}
                    <div class="col-md-4">{!! Form::input('text', 'clock_in', '', [
                        'class' => 'form-control datetimepicker',
                        'placeholder' => trans('messages.clock_in'),
                        'readonly' => true,
                    ]) !!}</div>
                    <div class="col-md-4">{!! Form::input('text', 'clock_out', '', [
                        'class' => 'form-control datetimepicker',
                        'placeholder' => trans('messages.clock_out'),
                        'readonly' => true,
                    ]) !!}</div>
                    <div class="col-md-4"><button type="submit" class="btn btn-success">{!! trans('messages.add_new') !!}</button>
                    </div>
                    {!! Form::close() !!}
                </div> --}}

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
                            @foreach ($clocks as $clock)
                                <tr>
                                    <td>{{ $clock->first_name }}</td>
                                    <td>{!! showDateTime($clock->clock_in) !!}</td>
                                    <td>{!! showDateTime($clock->clock_out) !!}</td>
                                    <td>{{ $clock->date }}</td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <a href="#" data-href="/clock/{{ $clock->id }}/edit"
                                                class='btn btn-xs btn-default' data-toggle="modal" data-target="#myModal">
                                                <i class='fa fa-edit' data-toggle="tooltip"
                                                    title="{!! trans('messages.edit') !!}"></i> </a>
                                            {!! delete_form(['clock.destroy', $clock->id]) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
			displaydata();
			// save-attendance
			$('#save-attendance').click(function() {
				$('#save-attendance').attr('disabled', true);
				$('#save-attendance').text('Processing...');
			    const multiple_id = $('input[name="multiple_id"]').val();
                const multiple_id_array = multiple_id.split(',').map(id => id.trim()).filter(id => id !== "");
				const FormDate = {
					employee_id: multiple_id_array,
					branch: $('[name="branch"]').val(),
					description: $('#description').val(),
					designation: $('[name="designation"]').val(),
					department: $('[name="department"]').val(),
					section: $('[name="section"]').val(),
					date: $('#date').val(),
					clock_in: $('#clock_in').val(),
					clock_out: $('#clock_out').val(),
				};
				$.ajax({
					url: "/post-update-attendance",
					type: 'POST',
					data: FormDate,
					success: function(data) {
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

			function displaydata() {
				$.ajax({
					url: "/post-update-attendance-list",
					type: 'POST',
					success: function(data) {
						const datatable = $('#clock-list-table');
						datatable.DataTable().destroy();
						var tableBody = $('#clock-list-table-body');
						tableBody.empty(); // Clear any existing rows
						// Loop through each separation record and append a row
						data.forEach(function(separation) {
							var row = `<tr>
								<td>${separation.first_name}</td>
								<td>${separation.clock_in || ' '}</td>
								<td>${separation.clock_out}</td> 
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
						datatable.DataTable({
							lengthMenu: [10, 20, 50, 100],
						})
					},
					error(xhr) {
						console.error('Error:', xhr.responseText);
					}
				})
			}
		});
	</script>
@stop