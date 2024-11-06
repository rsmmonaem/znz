
@extends('layouts.default')

	@section('breadcrumb')
	<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li class="active">{!! trans('messages.supervisor_add') !!}</li>
		</ul>
	@stop
	
	@section('content')
	<div class="row">
			
			<div class="col-sm-12" id="box-detail">
				<div class="box-info">
					<h2><strong>Add New</strong> Supervisor
					</h2>
					<div class="col-md-12">

						<div class="row">
						<div class="col-md-3"></div>
							<div class="col-md-6">
							<div class="form-group">
								    <label for="designation_id" class="control-label"></label>

									<select class="form-control" title="Supervisor">
									<option value="" selected="selected"></option>
									<option value="1">System Administrator (System Administration)</option>
									</select> 
								</div>
							</div>

							<div class="col-md-2">
							<div class="form-group">
									<button type="submit" class="btn btn-primary" name="button" value="add">Add</button>
								</div>
							</div>

						</div>


					</div>

					






					
				</div>
			</div>
			
		</div>
	@stop

	