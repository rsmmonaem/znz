@extends('layouts.default')

	@section('breadcrumb')
		<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li><a href="/employee">{!! trans('messages.employee') !!}</a></li>
		    <li class="active">{!! trans('messages.profile').' : '.$employee->full_name_with_designation !!}</li>
		</ul>
	@stop
	
	@section('content')
	   <style>
		.flex-form-group {
			display: flex;
			align-items: center;
		}

		.flex-form-group label {
			margin-bottom: 0;
			margin-right: 10px;
			min-width: 120px; /* Adjust width as needed */
			flex-shrink: 0;
		}

		.flex-form-group .form-control {
			flex-grow: 1;
		}
		.flex-container {
			display: flex;
			justify-content: center; 
			align-items: center;    
			margin-bottom: 20px;
		}

		.flex-end {
			margin: auto; 
		}
		</style>
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info full">
					<div class="tabs-left">	
						<ul class="nav nav-tabs col-md-2" style="padding-right:0;">
						  <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-user"></i> {!! trans('messages.basic') !!}</a></li>
						  <li><a href="#profile-picture" data-toggle="tab"><i class="fa fa-camera"></i> {!! trans('messages.profile_picture') !!}</a></li>
						  <li><a href="#contact" data-toggle="tab"><i class="fa fa-phone"></i> {!! trans('messages.contact') !!}</a></li>
						  <li><a href="#social-networking" data-toggle="tab"><i class="fa fa-users"></i> {!! trans('messages.social_networking') !!}</a></li>
						  <li><a href="#document" data-toggle="tab"><i class="fa fa-file"></i> {!! trans('messages.document') !!}</a></li>
						  <li><a href="#bank-account" data-toggle="tab"><i class="fa fa-laptop"></i> {!! trans('messages.account') !!}</a></li>
						  <li><a href="#contract" data-toggle="tab"><i class="fa fa-pencil"></i> {!! trans('messages.contract') !!}</a></li>
						  @if(count($employee->Contract))
						  <li><a href="#salary" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.salary') !!}</a></li>
						  <li><a href="#leave" data-toggle="tab"><i class="fa fa-coffee"></i> {!! trans('messages.leave') !!}</a></li>
						  @endif
						  <li><a href="#office_shift" data-toggle="tab"><i class="fa fa-clock-o"></i> {!! trans('messages.shift') !!}</a></li>
						  <li><a href="#template" data-toggle="tab"><i class="fa fa-envelope"></i> {!! trans('messages.email').' '.trans('messages.template') !!}</a></li>
						  @if(Entrust::can('reset_employee_password') && $employee->id != Auth::user()->id)
						  <li><a href="#change_password" data-toggle="tab"><i class="fa fa-key"></i> {!! trans('messages.change_password') !!}</a></li>
						  @endif
						</ul>
				        <div id="myTabContent" class="tab-content col-md-10"  style="padding:5px;">
						  <div class="tab-pane animated active fadeInRight" id="basic">
						    <div class="user-profile-content-wm">
								<h2>{!! trans('messages.basic_information') !!}</h2>
								{!! Form::model($employee,['method' => 'PATCH','route' => ['employee.update',$employee->id] ,'class' => 'employee-profile-form','id' => 'employee-profile-form','data-no-form-clear'=>1]) !!}
								<div class="row">
									{{-- Employee Code --}}
									<div class="col-sm-6">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('employee_code',trans('messages.employee_code'))!!}
											{!! Form::input('text','employee_code',isset($employee->Profile->employee_code) ? $employee->Profile->employee_code : '',['class'=>'form-control','placeholder'=>trans('messages.employee_code')])!!}
										</div>	
								  	</div>
									<div class="col-sm-6">
										<div class="form-group flex-form-group flex-end flex-container" style="margin-bottom: 30px;">
											<img src="{{ $employee->Profile->photo ? URL::to(config('constants.upload_path.profile_image').$employee->Profile->photo) : URL::to(config('constants.upload_path.profile_image').'blank_profile.webp') }}" alt="Profile Picture" class="imagePreview" style="width: 100px; height: 100px; object-fit: cover;" id="Up_preview">
											{!! Form::file('photo', ['id' => 'imageInput', 'class' => 'hidden', 'accept' => 'image/*', 'oninput' => 'Up_preview.src = window.URL.createObjectURL(this.files[0])']) !!}
											{{-- <button type="button" class="btn btn-primary" id="update_profile_picture">{!! trans('messages.update') !!}</button> --}}
										</div>
									</div>
								</div>
								<div class="row">
									{{-- First Name --}}
								  	<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('first_name',trans('messages.first_name'),['class' => 'control-label'])!!}
										{!! Form::input('text','first_name',isset($employee->first_name) ? $employee->first_name : '',['class'=>'form-control','placeholder'=>trans('messages.first_name')])!!}
									  </div>
									</div>
									{{-- Last Name --}}
								  	<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('last_name',trans('messages.banglga_name'),['class' => 'control-label'])!!}
										{!! Form::input('text','last_name',isset($employee->last_name) ? $employee->last_name : '',['class'=>'form-control','placeholder'=>trans('messages.banglga_name')])!!}
									  </div>
									</div>
									{{-- Category --}}
									<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('category',trans('messages.category'),['class' => 'control-label'])!!}
										{!! Form::select('category', [null=>trans('messages.select_one')] + $type ,($employee->Profile->category) ? $employee->Profile->category : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
									  </div>
								  	</div>

									{{-- Job Nature --}}
									<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('job_nature',trans('messages.job_nature'),['class' => 'control-label'])!!}
										{!! Form::input('text','job_nature',isset($employee->profile->job_nature ) ? $employee->profile->job_nature : '',['class'=>'form-control','placeholder'=>trans('messages.job_nature')])!!}
									  </div>
								  	</div>
									{{-- Fathers Name --}}
									<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('fathers_name',trans('messages.fathers_name'),['class' => 'control-label'])!!}
										{!! Form::input('text','fathers_name',isset($employee->profile->fathers_name) ? $employee->profile->fathers_name : '',['class'=>'form-control','placeholder'=>trans('messages.fathers_name')])!!}
									  </div>
								  	</div>
									{{-- Mother Name --}}
									<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('mothers_name',trans('messages.mothers_name'),['class' => 'control-label'])!!}
										{!! Form::input('text','mothers_name',isset($employee->profile->mothers_name) ? $employee->profile->mothers_name : '',['class'=>'form-control','placeholder'=>trans('messages.mothers_name')])!!}
									  </div>
								  	</div>
									{{--  --}}
									{{-- Email --}}
									<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('email',trans('messages.email'),['class' => 'control-label'])!!}
										{!! Form::input('text','email',isset($employee->email) ? $employee->email : '',['class'=>'form-control','placeholder'=>trans('messages.email')])!!}
									  </div>
								  	</div>
								  </div>	
								  <div class="row">
								  	@if(!$employee->Designation->is_hidden)
								  	<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('designation_id',trans('messages.designation'),['class' => 'control-label'])!!}
										{!! Form::select('designation_id', [null=>trans('messages.select_one')] + $designations,isset($employee->designation_id) ? $employee->designation_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.designation')])!!}
									  </div>
									</div>
									@endif
									@if(Entrust::can('manage_all_employee') && !$role->is_hidden)
										<div class="col-sm-6">
										  <div class="form-group flex-form-group">
										    {!! Form::label('role_id',trans('messages.role'),['class' => 'control-label'])!!}
											{!! Form::select('role_id', [null=>trans('messages.select_one')] + $roles, isset($role->id) ? $role->id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.role')])!!}
										  </div>
										</div>
									@endif
								  </div>
								  <div class="row">
									{{-- Gender --}}
								  	<div class="col-sm-6">
									  <div class="form-group flex-form-group">
									    {!! Form::label('gender',trans('messages.gender'),['class' => 'control-label'])!!}
										{!! Form::select('gender', [null=>trans('messages.select_one')] + $gender,($employee->Profile->gender) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
									  </div>
									</div>
									{{-- Marital Status --}}
									<div class="col-sm-6">	
									  <div class="form-group flex-form-group">
									    {!! Form::label('marital_status',trans('messages.marital_status'),['class' => 'control-label'])!!}
										{!! Form::select('marital_status', [null=>trans('messages.select_one')] + $marital_status,($employee->Profile->marital_status) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
									  </div>	
									</div>
								   </div>
								  <div class="row">
									{{-- Date of Joining --}}
								  	<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('date_of_joining',trans('messages.date_of_joining'))!!}
											{!! Form::input('text','date_of_joining',isset($employee->Profile->date_of_joining) ? $employee->Profile->date_of_joining : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_joining'),'readonly' => 'true'])!!}
										</div>
									</div>
									{{-- Date of Leaving --}}
								  	{{-- <div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('date_of_leaving',trans('messages.date_of_leaving'))!!}
											{!! Form::input('text','date_of_leaving',isset($employee->Profile->date_of_leaving) ? $employee->Profile->date_of_leaving : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_leaving'),'readonly' => 'true'])!!}
										</div>
									</div> --}}
									{{-- Employ Confirm Date --}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('empoloyee_confirm',trans('messages.empoloyee_confirm'))!!}
											{!! Form::input('text','empoloyee_confirm',isset($employee->Profile->confirm_date) ? $employee->Profile->confirm_date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.empoloyee_confirm'),'readonly' => 'true'])!!}
										</div>
									</div>
									{{-- Rilegion --}}
                                   <div class="col-sm-6">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('reliagion',trans('messages.reliagion'))!!}
											{!! Form::select('reliagion', [null=>trans('messages.select_one')] + $riligion,($employee->Profile->religion) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
										</div>	
								  	</div>
									
									{{-- {!! Form::select('marital_status', [null=>trans('messages.select_one')] + $marital_status,($employee->Profile->marital_status) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!} --}}

									{{-- Height --}}
									<div class="col-sm-3">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('height',trans('messages.height'))!!}
											{!! Form::input('text','height',isset($employee->Profile->height) ? $employee->Profile->height : '',['class'=>'form-control','placeholder'=>trans('messages.height')])!!}
										</div>	
								  	</div>
									{{-- Weight --}}
									<div class="col-sm-3">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('weight',trans('messages.weight'))!!}
											{!! Form::input('text','weight',isset($employee->Profile->weight) ? $employee->Profile->weight : '',['class'=>'form-control','placeholder'=>trans('messages.weight')])!!}
										</div>	
								  	</div>
									{{-- Employee Number --}}
									<div class="col-sm-6">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('contact_number',trans('messages.employee_number'))!!}
											{!! Form::input('text','contact_number',isset($employee->Profile->contact_number) ? $employee->Profile->contact_number : '',['class'=>'form-control','placeholder'=>trans('messages.employee_number')])!!}
										</div>	
								  	</div>
									{{-- Nationality --}}
									<div class="col-sm-6">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('nationality',trans('messages.nationality'))!!}
											{!! Form::input('text','nationality',isset($employee->Profile->nationality) ? $employee->Profile->nationality : '',['class'=>'form-control','placeholder'=>trans('messages.nationality')])!!}
										</div>	
								  	</div>
									
									{{-- Blood Group --}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('blood_group',trans('messages.blood_group'))!!}
											{!! Form::input('text','blood_group',isset($employee->Profile->blood_group) ? $employee->Profile->blood_group : '',['class'=>'form-control','placeholder'=>trans('messages.blood_group')])!!}
										</div>
									</div>
									{{-- Date of Birth --}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('date_of_birth',trans('messages.date_of_birth'))!!}
											{!! Form::input('text','date_of_birth',isset($employee->Profile->date_of_birth) ? $employee->Profile->date_of_birth : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_birth'),'readonly' => 'true'])!!}
										</div>
									</div>
									{{-- NID --}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('nid',trans('messages.nid'))!!}
											{!! Form::input('text','nid',isset($employee->Profile->nid) ? $employee->Profile->nid : '',['class'=>'form-control','placeholder'=>trans('messages.nid')])!!}
										</div>
									</div>
									{{-- Brith --}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('brith',trans('messages.birth'))!!}
											{!! Form::input('text','brith',isset($employee->Profile->birth) ? $employee->Profile->birth : '',['class'=>'form-control','placeholder'=>trans('messages.birth')])!!}
										</div>
									</div>
									{{--Pasport--}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('passport',trans('messages.passport'))!!}
											{!! Form::input('text','passport',isset($employee->Profile->passport) ? $employee->Profile->passport : '',['class'=>'form-control','placeholder'=>trans('messages.passport')])!!}
										</div>
									</div>
									{{--Tin--}}
									<div class="col-sm-6">
										<div class="form-group flex-form-group">
										    {!! Form::label('tin',trans('messages.tin'))!!}
											{!! Form::input('text','tin',isset($employee->Profile->tin) ? $employee->Profile->tin : '',['class'=>'form-control','placeholder'=>trans('messages.tin')])!!}
										</div>
									</div>
									{{-- Present Address --}}
									<div class="row">
										<h2>{!! trans('messages.present_address') !!}</h2>
										{{-- House --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_house',trans('messages.house'))!!}
												{!! Form::input('text','pres_house',isset($employee->Profile->pres_house) ? $employee->Profile->pres_house : '',['class'=>'form-control','placeholder'=>trans('messages.house')])!!}
											</div>
										</div>
										{{-- Road --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_road',trans('messages.road'))!!}
												{!! Form::input('text','pres_road',isset($employee->Profile->pres_road) ? $employee->Profile->pres_road : '',['class'=>'form-control','placeholder'=>trans('messages.road')])!!}
											</div>
										</div>
										{{-- Divition --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_division',trans('messages.division'))!!}
												{!! Form::input('text','pres_division',isset($employee->Profile->pres_division) ? $employee->Profile->pres_division : '',['class'=>'form-control','placeholder'=>trans('messages.division')])!!}
											</div>
										</div>
										{{-- Post --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_post',trans('messages.post'))!!}
												{!! Form::input('text','pres_post',isset($employee->Profile->pres_post) ? $employee->Profile->pres_post : '',['class'=>'form-control','placeholder'=>trans('messages.post')])!!}
											</div>
										</div>
										{{-- Distric --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_district',trans('messages.district'))!!}
												{!! Form::input('text','pres_district',isset($employee->Profile->pres_district) ? $employee->Profile->pres_district : '',['class'=>'form-control','placeholder'=>trans('messages.district')])!!}
											</div>
										</div>
										{{-- Thana --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_thana',trans('messages.thana'))!!}
												{!! Form::input('text','pres_thana',isset($employee->Profile->pres_thana) ? $employee->Profile->pres_thana : '',['class'=>'form-control','placeholder'=>trans('messages.thana')])!!}
											</div>
										</div>
									    {{-- Upazila --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_upazila',trans('messages.upazila'))!!}
												{!! Form::input('text','pres_upazila',isset($employee->Profile->pres_upazila) ? $employee->Profile->pres_upazila : '',['class'=>'form-control','placeholder'=>trans('messages.upazila')])!!}
											</div>
										</div>
										{{-- Post Code --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('pres_post_code',trans('messages.post_code'))!!}
												{!! Form::input('text','pres_post_code',isset($employee->Profile->pres_post_code) ? $employee->Profile->pres_post_code : '',['class'=>'form-control','placeholder'=>trans('messages.post_code')])!!}
											</div>
										</div>
									</div>
									{{-- Permanent Address --}}
									<div class="row">
										<h2>{!! trans('messages.permanent_address') !!}</h2>
										{{-- House --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('house',trans('messages.house'))!!}
												{!! Form::input('text','house',isset($employee->Profile->perm_house) ? $employee->Profile->perm_house : '',['class'=>'form-control','placeholder'=>trans('messages.house')])!!}
											</div>
										</div>
										{{-- Road --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('road',trans('messages.road'))!!}
												{!! Form::input('text','road',isset($employee->Profile->perm_road) ? $employee->Profile->perm_road : '',['class'=>'form-control','placeholder'=>trans('messages.road')])!!}
											</div>
										</div>
										{{-- Divition --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('division',trans('messages.division'))!!}
												{!! Form::input('text','division',isset($employee->Profile->perm_division) ? $employee->Profile->perm_division : '',['class'=>'form-control','placeholder'=>trans('messages.division')])!!}
											</div>
										</div>
										{{-- Post --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('post',trans('messages.post'))!!}
												{!! Form::input('text','post',isset($employee->Profile->perm_post) ? $employee->Profile->perm_post : '',['class'=>'form-control','placeholder'=>trans('messages.post')])!!}
											</div>
										</div>
										{{-- Distric --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('district',trans('messages.district'))!!}
												{!! Form::input('text','district',isset($employee->Profile->perm_district) ? $employee->Profile->perm_district : '',['class'=>'form-control','placeholder'=>trans('messages.district')])!!}
											</div>
										</div>
										{{-- Thana --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('thana',trans('messages.thana'))!!}
												{!! Form::input('text','thana',isset($employee->Profile->perm_thana) ? $employee->Profile->perm_thana : '',['class'=>'form-control','placeholder'=>trans('messages.thana')])!!}
											</div>
										</div>
									    {{-- Upazila --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('upazila',trans('messages.upazila'))!!}
												{!! Form::input('text','upazila',isset($employee->Profile->perm_upazila) ? $employee->Profile->perm_upazila : '',['class'=>'form-control','placeholder'=>trans('messages.upazila')])!!}
											</div>
										</div>
										{{-- Post Code --}}
										<div class="col-sm-4">
											<div class="form-group flex-form-group">
											    {!! Form::label('post_code',trans('messages.post_code'))!!}
												{!! Form::input('text','post_code',isset($employee->Profile->perm_post_code) ? $employee->Profile->perm_post_code : '',['class'=>'form-control','placeholder'=>trans('messages.post_code')])!!}
											</div>
										</div>
									</div>
									{{-- permanent_address --}}
								   </div>
			  						{{ App\Classes\Helper::getCustomFields('employee-form',$custom_field_values) }}
									{!! Form::hidden('type','basic') !!}
									{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']) !!}
								{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="contact">
						    <div class="user-profile-content-wm">
								<h2>{!! trans('messages.add_new').' '.trans('messages.contact') !!}</h2>

								{!! Form::model($employee,['method' => 'POST','route' => ['contact.store',$employee->id] ,'class' => 'employee-contact-form', 'role' => 'form','id' => 'employee-contact-form','data-table-alter' => 'employee-contact-table']) !!}
			    				  	@include('employee._contact_form')
								{!! Form::close() !!}

								<h2>{!! trans('messages.list_all').' '.trans('messages.contact') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load"  id="employee-contact-table" data-source="/contact/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.name') !!}</th>
												<th>{!! trans('messages.relation') !!}</th>
												<th>{!! trans('messages.email') !!}</th>
												<th>{!! trans('messages.mobile') !!}</th>
												<th data-sortable="false">{!! trans('messages.option') !!}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="social-networking">
						    <div class="user-profile-content-wm">
							<h2>{!! trans('messages.social_networking') !!}</h2>
								{!! Form::model($employee,['method' => 'PATCH','action' => ['EmployeeController@profileUpdate',$employee->id] ,'class' => 'employee-social-form', 'role' => 'form','id' => 'employee-social-form','data-no-form-clear' => 1]) !!}
									<div class="form-group flex-form-group">
									    {!! Form::label('facebook_link',trans('messages.facebook_profile'))!!}
										{!! Form::input('text','facebook_link',isset($employee->Profile->facebook_link) ? $employee->Profile->facebook_link : '',['class'=>'form-control','placeholder'=>trans('messages.facebook_profile')])!!}
									</div>
			    				  	<div class="form-group flex-form-group">
									    {!! Form::label('twitter_link',trans('messages.twitter_profile'))!!}
										{!! Form::input('text','twitter_link',isset($employee->Profile->twitter_link) ? $employee->Profile->twitter_link : '',['class'=>'form-control','placeholder'=>trans('messages.twitter_profile')])!!}
									</div>
			    				  	<div class="form-group flex-form-group">
									    {!! Form::label('blogger_link',trans('messages.blogger_profile'))!!}
										{!! Form::input('text','blogger_link',isset($employee->Profile->blogger_link) ? $employee->Profile->blogger_link : '',['class'=>'form-control','placeholder'=>trans('messages.blogger_profile')])!!}
									</div>
			    				  	<div class="form-group flex-form-group">
									    {!! Form::label('linkedin_link',trans('messages.linkedin_profile'))!!}
										{!! Form::input('text','linkedin_link',isset($employee->Profile->linkedin_link) ? $employee->Profile->linkedin_link : '',['class'=>'form-control','placeholder'=>trans('messages.linkedin_profile')])!!}
									</div>
			    				  	<div class="form-group flex-form-group">
									    {!! Form::label('googleplus_link',trans('messages.google_plus_profile'))!!}
										{!! Form::input('text','googleplus_link',isset($employee->Profile->googleplus_link) ? $employee->Profile->googleplus_link : '',['class'=>'form-control','placeholder'=>trans('messages.google_plus_profile')])!!}
									</div>
			  						{{ App\Classes\Helper::getCustomFields('employee-social-form',$social_custom_field_values) }}
								{!! Form::hidden('type','social_networking') !!}
								{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']) !!}
								{!! Form::close() !!}
							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="bank-account">
						    <div class="user-profile-content-wm">
							<h2>{!! trans('messages.add_new').' '.trans('messages.bank_account') !!}</h2>
					 			{!! Form::model($employee,['method' => 'POST','route' => ['bank-account.store',$employee->id] ,'class' => 'bank-account-form','id' => 'bank-account-form','data-table-alter' => 'bank-account-table']) !!}
			    				  	@include('employee._bank_account_form')
								{!! Form::close() !!}

								<div class="clear"></div>
								<h2>{!! trans('messages.list_all').' '.trans('messages.bank_account') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load" id="bank-account-table" data-source="/bank-account/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.account_name') !!}</th>
												<th>{!! trans('messages.account_number') !!}</th>
												<th>{!! trans('messages.bank_name') !!}</th>
												<th>{!! trans('messages.bank_code') !!}</th>
												<th>{!! trans('messages.branch') !!}</th>
												<th data-sortable="false" >{!! trans('messages.option') !!}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="contract">
						    <div class="user-profile-content-wm">
								<h2><strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.contract') !!}</h2>
								{!! Form::model($employee,['method' => 'POST','route' => ['contract.store',$employee->id] ,'class' => 'contract-form','id' => 'contract-form','data-table-alter' => 'contract-table']) !!}
									@include('employee._contract_form')
								{!! Form::close() !!}

								<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.contract') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load"  id="contract-table" data-source="/contract/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.duration') !!}</th>
												<th>{!! trans('messages.designation') !!}</th>
												<th>{!! trans('messages.title') !!}</th>
												<th>{!! trans('messages.contract_type') !!}</th>
												<th data-sortable="false">{!! trans('messages.option') !!}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="salary">
						    <div class="user-profile-content-wm">
						    	<h2><strong>{{ trans('messages.add_new') }} </strong>{{ trans('messages.salary') }}</h2>
					    		{!! Form::model($employee,['method' => 'POST','route' => ['salary.store',$employee->id] ,'class' => 'salary-form','id' => 'salary-form','data-table-alter' => 'salary-table']) !!}
		    				  		@include('employee._salary_form')
								{!! Form::close() !!}
								<div class="clear"></div>

								<h2><strong>{!! trans('messages.list_all') !!} </strong> {!! trans('messages.salary') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load"  id="salary-table" data-source="/salary/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{{ trans('messages.contract') }}</th>
												@foreach($earning_salary_types as $earning_salary_type)
													<th>{{ $earning_salary_type->head }}</th>
												@endforeach
												@foreach($deduction_salary_types as $deduction_salary_type)
													<th>{{ $deduction_salary_type->head }}</th>
												@endforeach
												<th>{{ trans('messages.option') }}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="leave">
						    <div class="user-profile-content-wm">
								<h2><strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.leave') !!}</h2>
								{!! Form::model($employee,['method' => 'POST','route' => ['user-leave.store',$employee->id] ,'class' => 'user-leave-form','id' => 'user-leave-form','data-table-alter' => 'user-leave-table']) !!}
									@include('employee._user_leave_form')
								{!! Form::close() !!}
								
								<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.leave') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load"  id="user-leave-table" data-source="/user-leave/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.contract') !!}</th>
												@foreach($leave_types as $leave_type)
												<th>{!! $leave_type->name !!}</th>
												@endforeach
												<th data-sortable="false">{{ trans('messages.option') }}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>					
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="office_shift">
						    <div class="user-profile-content-wm">
								<h2><strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.shift') !!}</h2>
								{!! Form::model($employee,['method' => 'POST','route' => ['user-shift.store',$employee->id] ,'class' => 'user-shift-form','id' => 'user-shift-form','data-table-alter' => 'user-shift-table']) !!}
									@include('employee._user_shift_form')
								{!! Form::close() !!}

								<br /><br />
								<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.shift') !!}</h2>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered table-ajax-load"  id="user-shift-table" data-source="/user-shift/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.date') !!}</th>
												<th>{!! trans('messages.shift') !!}</th>
												<th data-sortable="false" >{!! trans('messages.option') !!}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </div>
						  </div>
						  @if(Entrust::can('reset_employee_password') && $employee->id != Auth::user()->id)
						  <div class="tab-pane animated fadeInRight" id="change_password">
						    <div class="user-profile-content-wm">
						    <h2><strong>{!! trans('messages.employee') !!}</strong> {!! trans('messages.force').' '.trans('messages.change_password') !!}</h2>
							{!! Form::model($employee,['method' => 'PATCH','route' => ['change-employee-password',$employee->id] ,'class' => 'employee-change-password-form','id' => 'employee-change-password-form']) !!}
							  <div class="form-group flex-form-group">
								{!! Form::input('password','new_password','',['class'=>'form-control','placeholder'=>'Enter New Password'])!!}
							  </div>
							  <div class="form-group flex-form-group">
								{!! Form::input('password','new_password_confirmation','',['class'=>'form-control','placeholder'=>'Enter New Confirm Password'])!!}
							  </div>
							  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']) !!}
							{!! Form::close() !!}
						    </div>
						  </div>
						  @endif
						  <div class="tab-pane animated fadeInRight" id="profile-picture">
						    <div class="user-profile-content-wm">
							<h2>{!! trans('messages.profile_picture') !!}</h2>
								{!! Form::model($employee,['files'=>true,'method' => 'PATCH','action' => ['EmployeeController@profileUpdate',$employee->id] ,'class' => 'employee-profile-picture-form', 'role' => 'form','id' => 'employee-profile-picture-form','data-submit' => 'noAjax']) !!}
			    				  	<div class="form-group flex-form-group">
										<input type="file" name="photo" id="photo" class="btn btn-default" title="{!! trans('messages.select_profile_photo') !!}">
										
										@if($employee->Profile->photo != null)
											@if(File::exists(config('constants.upload_path.profile_image').$employee->Profile->photo))
											<img src="{{ URL::to(config('constants.upload_path.profile_image').$employee->Profile->photo) }}" width="50px" style="margin-left:20px;">
											@endif
											<div class="checkbox">
												<label>
												  {!! Form::checkbox('remove_photo', 1) !!} {!! trans('messages.remove_photo') !!}
												</label>
											</div>
										@endif
									</div>
								{!! Form::hidden('type','profile-picture') !!}
								{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']) !!}
								{!! Form::close() !!}
							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="template">
						    <div class="user-profile-content-wm">
						    	<h2><strong>{!! trans('messages.send').'</strong> '.trans('messages.email') !!}</h2>
					 			{!! Form::model($employee,['method' => 'POST','route' => ['employee.email',$employee->id] ,'class' => 'employee-email-form','id' => 'employee-email-form','data-extra' => $employee->id]) !!}
		    				  	<div class="form-group flex-form-group">
									{!! Form::select('template_id', [null=>trans('messages.select_one')] + $templates,'',['class'=>'form-control input-xlarge select2me','id'=>'template_id','placeholder'=>trans('messages.select_one')])!!}
								</div>
								<div class="form-group flex-form-group">
									{!! Form::input('text','subject','',['class'=>'form-control','placeholder'=>trans('messages.subject'),'id' => 'mail_subject']) !!}
								</div>
								<div class="form-group flex-form-group">
		    						{!! Form::textarea('body','',['size' => '30x3', 'class' => 'form-control summernote-big', 'id' => 'mail_body', 'placeholder' => trans('messages.body')])!!}
								</div>
								{!! Form::submit(trans('messages.send'),['class' => 'btn btn-primary pull-right']) !!}
					 			{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="document">
						    <div class="user-profile-content-wm">
							<h2>{!! trans('messages.add_new').' '.trans('messages.document') !!}</h2>
					 			{!! Form::model($employee,['files'=>true,'method' => 'POST','route' => ['document.store',$employee->id] ,'class' => 'document-form','id' => 'document-form','data-table-alter' => 'document-table']) !!}
			    				  	<div class="col-sm-6">
				    				  	<div class="form-group flex-form-group">
										    {!! Form::label('document_type_id',trans('messages.document_type'),[])!!}
											{!! Form::select('document_type_id', [null=>trans('messages.select_one')] + $document_types,'',['class'=>'form-control input-xlarge select2me','id'=>'document_type_id','placeholder'=>trans('messages.select_one')])!!}
											@if(defaultRole() || Entrust::can('manage_configuration'))
												<div class="help-block"><a href="#" data-href="/document-type/create" data-toggle="modal" data-target="#myModal">{!! trans('messages.add_new') !!}</a></div>
											@endif
										</div>
										<div class="form-group flex-form-group">
										    {!! Form::label('title',trans('messages.document').' '.trans('messages.title'))!!}
											{!! Form::input('text','title','',['class'=>'form-control','placeholder'=>trans('messages.document').' '.trans('messages.title')])!!}
										</div>
		  								<div class="form-group flex-form-group">
											<input type="file" name="attachments" id="attachments" class="btn btn-default" title="{!! trans('messages.select').' '.trans('messages.file') !!}">
										</div>
									</div>
									<div class="col-sm-6">	
										<div class="form-group flex-form-group">
										    {!! Form::label('date_of_expiry',trans('messages.date_of_expiry'))!!}
											{!! Form::input('text','date_of_expiry','',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_expiry'),'readonly' => 'true'])!!}
										</div>
										<div class="form-group flex-form-group">
										    {!! Form::label('description',trans('messages.description'),[])!!}
										    {!! Form::textarea('description','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.description'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1])!!}
										    <span class="countdown"></span>
										</div>
										{!! Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']) !!}
									</div>
								{!! Form::close() !!}

								<div class="clear"></div>
								<h2>{!! trans('messages.list_all').' '.trans('messages.document') !!}</h2>
								<div class="table-responsive">
									<table data-sortable  class="table table-hover table-striped table-bordered table-ajax-load"  id="document-table" data-source="/document/lists" data-extra="&employee_id={{$employee->id}}">
										<thead>
											<tr>
												<th>{!! trans('messages.document_type') !!}</th>
												<th>{!! trans('messages.title') !!}</th>
												<th>{!! trans('messages.date_of_expiry') !!}</th>
												<th>{!! trans('messages.description') !!}</th>
												<th>{!! trans('messages.status') !!}</th>
												<th data-sortable="false">{!! trans('messages.option') !!}</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@stop