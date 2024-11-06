
@extends('layouts.default')

	@section('breadcrumb')
	<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li class="active">{!! trans('messages.appraisal_task_add') !!}</li>
		</ul>
	@stop
	
	@section('content')

	<div class="row">
			
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.add_new') !!}</strong> Task
					</h2>
					<!--write content start-->

					
					<div class="col-sm-12">
					<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
					<!--body form start-->

					<form class="" id="add_task_form" name="add_task_form" action="/appraisal_task_save" method="post">

					<div class="form-group">
					<label for="" class="control-label">Time Period*</label>
					<select class="form-control" title="Time Period" name="time_period" required="required">
					
					<?php
					
					for($i=2020; $i<=date('Y')+2;$i++)
					{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}

					?>
					</select> 
					</div>
					<div class="form-group">
					<label for="" class="control-label">Employee*</label>
					<select class="form-control" title="Employee" name="emp_id" required="required">
					<option value="" selected="selected">Select...</option>
					<?php
					
					for($i=0; $i<count($employee_array);$i++)
					{
						$emp_id=$employee_array[$i]['id'];
						$emp_username=$employee_array[$i]['username'];
						$emp_first_name=$employee_array[$i]['first_name'];
						$emp_last_name=$employee_array[$i]['last_name'];
						$emp_deg=$employee_array[$i]['designation'];

						echo '<option value="'.$emp_id.'">'.$emp_username.' ('.$emp_first_name.' '.$emp_last_name.' '.$emp_deg.')</option>';
					}

					?>
					</select> 
					</div>

					<div class="form-group">
					<label for="" class="control-label">Objective*</label>
					<textarea class="form-control" name="objective" rows="3" required="required"></textarea>
					</div>

					<div class="form-group">
					<label for="" class="control-label">Expected Result*</label>
					<textarea class="form-control" name="expected_result" rows="3" required="required"></textarea>
					</div>

					<div id="task_section">
					<div id="" class="form-group">
					<div class="row">
					<div class="col-md-7">
					<label for="" class="control-label">Task Title</label>
					<input type="text" class="form-control" name="task[]" value="" required="required">
					</div>
					<div class="col-md-3">
					<label for="" class="control-label">Deadline</label>
					<input type="date" class="form-control" name="date[]" required="required">
					</div>
					<div class="col-md-2">
					<label for="" class="control-label">Priority</label>
					<select class="form-control" name="priority[]" required="required">
					<?php

					for($i=0;$i<=10;$i++)
					{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					
					?>
					
					</select> 
					</div>
					</div>
					
					</div>


					


					</div>

					<div class="form-group text-right">
					<i id="" class="btn btn-success btn-xs fa fa-plus-circle" title="Add new" onclick="add_new_task_field();"> Add New</i>
					</div>
					<div class="form-group">
					<input type="hidden" name="sup_id" value="<?php echo $supervisor_array['supervisor_id'];?>">
					<input type="hidden" name="sup_user_id" value="<?php echo $supervisor_array['supervisor_user_id'];?>">
					<button type="submit" class="btn btn-success" name="button" value="save">Save</button>
					</div>

					</form>
					<!--body form end-->
					</div>
					<div class="col-md-3">
					</div>
					</div>

					</div>
					


					<!--write content end-->
				</div>
			</div>
		</div>
	
	@stop

	