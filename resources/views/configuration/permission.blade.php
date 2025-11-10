@extends('layouts.default')

	@section('breadcrumb')
		<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li class="active">{!! trans('messages.permission') !!}</li>
		</ul>
	@stop
	
	@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="box-info">
					<div class="container">
						<h2 class="text-center">Employee Permission Settings</h2>
					</div>
					<div class="clear"></div>
					<div class="form">

						{{-- Employee Select --}}
						<div class="form-group">
							<select name="employee_id" id="employee_id" class="form-control">
								<option value="">Select Employee</option>
								@foreach($employees as $employee)
									<option value="{{ $employee->id }}">{{ $employee->name.'-'.$employee->employee_id }}</option>
								@endforeach
							</select>
						</div>

						{{-- Username Input --}}
						<div class="form-group">
							<input class="form-control" name="username" id="username" placeholder="Enter Username" value="">
						</div>

						{{-- Role --}}
						<div class="form-group">
							<select name="role_id" id="role_id" class="form-control">
								<option value="">Select Role</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>

						{{-- Password --}}
						<div class="form-group">
							<input class="form-control" name="password" id="password" placeholder="Enter Password" value="">
						</div>

						{{-- Button --}}
						<div class="form-group">
							<button class="btn btn-primary" id="save_permission">Save Permission</button>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong>{!! trans('messages.manage'). '</strong> '.trans('messages.permission') !!}</h2>
					{!! Form::open(['route' => 'configuration.save-permission','role' => 'form', 'class'=>'permission-form','id' => 'permission-form','data-no-form-clear' => 1]) !!}
					  <p class="alert alert-info"><strong>{!! trans('messages.subordinate_definition') !!}</strong></p>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right','style' => 'margin:10px;']) !!}
					  	<br /><br />
					  <table class="table table-hover table-striped">
					  	<thead>
					  		<tr>
					  			<th>{!! trans('messages.permission') !!}</th>
					  			@foreach(\App\Role::all() as $role)
					  			<th>{!! \App\Classes\Helper::toWord($role->name) !!}</th>
					  			@endforeach
					  		</tr>
					  		</tr>
					  	</thead>
					  	<tbody>
					  		@foreach($permissions as $permission)
					  			@if($permission->category != $category)
					  			<tr style="background-color:#3498DB;color:#ffffff;"><td colspan="{!! count(\App\Role::all())+1 !!} "><strong>{!! \App\Classes\Helper::toWord($permission->category).' '.trans('messages.module') !!}</strong></td></tr>
					  			<?php $category = $permission->category; ?>
					  			@endif
					  			<tr>
					  				<td>{!! \App\Classes\Helper::toWord($permission->name) !!}</td>
						  			@foreach(\App\Role::all() as $role)
						  			<th><input type="checkbox" name="permission[{!!$role->id!!}][{!!$permission->id!!}]" value = '1' {!! (in_array($role->id.'-'.$permission->id,$permission_role)) ? 'checked' : '' !!} @if($role->is_hidden) disabled @endif></th>
						  			@endforeach
					  			</tr>
					  		@endforeach
					  	</tbody>
					  </table>
					  <br /><br />
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right','style' => 'margin:10px;']) !!}
					{!! Form::close() !!}
					<div class="clear"></div>
				</div>
			</div>
		</div>
	@stop
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){

    // When Employee selected → Fetch username via AJAX
    $('#employee_id').on('change', function(){
        const emp_id = $(this).val();
        $('#username').val(''); // reset first

        if(emp_id !== ''){
            $.ajax({
                url: '/get-employee-username/' + emp_id,
                type: 'GET',
                success: function(data){
                    if(data.status === 'success'){
                        $('#username').val(data.username ?? '');
                    } else {
                        $('#username').val('');
                    }
                }
            });
        }
    });

    // Save button click
    $('#save_permission').on('click', function(e){
        e.preventDefault();

        const FormData = {
            employee_id: $('#employee_id').val(),
            username: $('#username').val(),
            role_id: $('#role_id').val(),
            password: $('#password').val(),
        };

        $.ajax({
            url: '/save-user-role',
            type: 'POST',
            data: FormData,
            success: function(data){
                if(data.status === 'success'){
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function(){
                toastr.error('Something went wrong!');
            }
        });
    });

});
</script>
@stop