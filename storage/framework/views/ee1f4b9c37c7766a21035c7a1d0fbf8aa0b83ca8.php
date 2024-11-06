	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.configuration'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>

		<div class="row">
			<div class="col-sm-12">
				<div class="box-info full">
					<div class="tabs-left">	
						<ul class="nav nav-tabs col-md-2" style="padding-right:0;">
						  <li class="active"><a href="#general" data-toggle="tab"><span class="fa fa-cog"></span> <?php echo trans('messages.general'); ?></a></li>
						  <li><a href="#comp_logo" data-toggle="tab"><span class="fa fa-image"></span> <?php echo trans('messages.logo'); ?></a></li>
						  <li><a href="#system" data-toggle="tab"><span class="fa fa-cogs"></span> <?php echo trans('messages.system'); ?></a></li>
						  <li><a href="#menu" data-toggle="tab"><span class="fa fa-list"></span> <?php echo trans('messages.menu'); ?></a></li>
						  <li><a href="#role" data-toggle="tab"><span class="fa fa-key"></span> <?php echo trans('messages.role'); ?></a></li>
						  <li><a href="#attendance" data-toggle="tab"><span class="fa fa-book"></span> <?php echo trans('messages.attendance'); ?></a></li>
						  <li><a href="#payroll" data-toggle="tab"><span class="fa fa-credit-card"></span> <?php echo trans('messages.payroll'); ?></a></li>
						  <li><a href="#mail" data-toggle="tab"><span class="fa fa-envelope"></span> <?php echo trans('messages.mail'); ?></a></li>
						  <li><a href="#office-shift" data-toggle="tab"><span class="fa fa-clock-o"></span> <?php echo trans('messages.office_shift'); ?></a></li>
						  <li><a href="#contract-type" data-toggle="tab"><span class="fa fa-pencil"></span> <?php echo trans('messages.contract'); ?></a></li>
						  <li><a href="#award" data-toggle="tab"><span class="fa fa-trophy"></span> <?php echo trans('messages.award'); ?></a></li>
						  <li><a href="#leave" data-toggle="tab"><span class="fa fa-coffee"></span> <?php echo trans('messages.leave'); ?></a></li>
						  <li><a href="#document" data-toggle="tab"><span class="fa fa-file"></span> <?php echo trans('messages.document'); ?></a></li>
						  <li><a href="#salary" data-toggle="tab"><span class="fa fa-money"></span> <?php echo trans('messages.salary'); ?></a></li>
						  <li><a href="#expense" data-toggle="tab"><span class="fa fa-credit-card"></span> <?php echo trans('messages.expense'); ?></a></li>
						  <li><a href="#job" data-toggle="tab"><span class="fa fa-bullhorn"></span> <?php echo trans('messages.job'); ?></a></li>
						  <li><a href="#api" data-toggle="tab"><span class="fa fa-ellipsis-h"></span> <?php echo trans('messages.api_configuration'); ?></a></li>
						  <li><a href="#ip" data-toggle="tab"><span class="fa fa-ban"></span> <?php echo trans('messages.ip_restriction'); ?></a></li>
						  <li><a href="#scheduler" data-toggle="tab"><span class="fa fa-hourglass"></span> <?php echo trans('messages.scheduler'); ?></a></li>
				        </ul>
				        <div id="myTabContent" class="tab-content col-md-10"  style="padding:5px;">
				        
						  <div class="tab-pane animated active fadeInRight" id="general">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.general'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form','id' => 'config-form','data-no-form-clear' => 1]); ?>

									<?php echo $__env->make('configuration._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="menu">
						    <div class="user-profile-content-wm">
								<?php echo Form::open(['route' => 'configuration.menu-store','role' => 'form', 'class'=>'config-menu-form','id' => 'config-menu-form','data-draggable' => 1,'data-no-form-clear' => 1,'data-sidebar' => 1]); ?>

								<h2><strong><?php echo trans('messages.menu'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<div class="draggable-container">
									<?php $i = 0; ?>
									<?php foreach(\App\Menu::orderBy('order')->orderBy('id')->get() as $menu_item): ?>
										<?php $i++; ?>
									  <div class="draggable" data-name="<?php echo e($menu_item->name); ?>" data-index="<?php echo e($i); ?>">
									    <p><input type="checkbox" name="<?php echo e($menu_item->name); ?>-visible" value="1" <?php echo e(($menu_item->visible) ? 'checked' : ''); ?>> <span style="margin-left:50px;"><?php echo e(\App\Classes\Helper::toWord($menu_item->name)); ?></span></p>
									  </div>
									<?php endforeach; ?>
								</div>
								<?php echo Form::hidden('config_type','menu'); ?>

			  					<?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="comp_logo">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.logo'); ?></strong></h2>
								<?php echo Form::open(['files' => true, 'route' => 'configuration.logo-store','role' => 'form', 'class'=>'config-company-logo-form','id' => 'config-company-logo-form','data-submit' => 'noAjax']); ?>

								  	<div class="form-group">
										<input type="file" name="logo" id="logo" class="btn btn-default" title="<?php echo trans('messages.select').' '.trans('messages.logo'); ?>">
										<?php if(config('config.logo') && File::exists(config('constants.upload_path.logo').config('config.logo'))): ?>
										<img src="<?php echo e(URL::to(config('constants.upload_path.logo').config('config.logo'))); ?>" width="150px" style="margin-left:20px;">
										<div class="checkbox">
											<label>
											  <?php echo Form::checkbox('remove_logo', 1); ?> <?php echo trans('messages.remove_logo'); ?>

											</label>
										</div>
										<?php endif; ?>
									</div>
								<?php echo Form::hidden('config_type','comp_logo'); ?>

			  					<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="scheduler">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.scheduler'); ?></strong></h2>
								<p>Add below cron command in your server:</p>
								<div class="well">
									php /path-to-artisan schedule:run >> /dev/null 2>&1
								</div>
								<div class="table-responsive">
									<table class="table table-stripped table-bordered table-hover">
										<thead>
											<tr>
												<th>Action</th>
												<th>Status</th>
												<th>Frequency</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Employee Status Update</td>
												<td>Yes</td>
												<td>Once per day</td>
											</tr>
											<tr>
												<td>Employee Designation Update</td>
												<td>Yes</td>
												<td>Once per day</td>
											</tr>
											<tr>
												<td>Daily Backup</td>
												<td>Yes</td>
												<td>Once per day</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="system">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.system'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form','id' => 'system-form','data-no-form-clear' => 1]); ?>

									<?php echo $__env->make('configuration._system', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="attendance">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.attendance'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form','id' => 'attendance-form','data-no-form-clear' => 1]); ?>

									<div class="form-group">
										<?php echo Form::label('auto_clock_authentication',trans('messages.auto_clock_authentication'),['class' => ' control-label']); ?>

										<div class="radio">
											<label>
												<?php echo Form::radio('auto_clock_authentication', '1', (config('config.auto_clock_authentication')) ? 'checked' : '').' '.trans('messages.yes'); ?>

											</label>
											<label>
												<?php echo Form::radio('auto_clock_authentication', '0', (!config('config.auto_clock_authentication')) ? 'checked' : '').' '.trans('messages.no'); ?>

											</label>
										</div>
								  	</div>
									<!-- <div class="form-group">
										<?php echo Form::label('auto_lock_attendance_days',trans('messages.auto_lock_attendance_label'),[]); ?>

										<?php echo Form::input('number','auto_lock_attendance_days',(config('config.auto_lock_attendance_days')) ? : '1',['class'=>'form-control','placeholder'=>trans('messages.auto_lock_attendance_label')]); ?>

									</div>
									<div class="form-group">
										<?php echo Form::label('enable_future_attendance',trans('messages.enable_future_attendance'),[]); ?>

										<?php echo Form::input('number','enable_future_attendance',(config('config.enable_future_attendance')) ? : '0',['class'=>'form-control','placeholder'=>'Allow future attendance for days']); ?>

									</div>
									<div class="form-group">
										<?php echo Form::label('late_comer_grace_time',trans('messages.grace_time_label').' ('.trans('messages.minute').')',[]); ?>

										<?php echo Form::input('number','late_comer_grace_time',(config('config.late_comer_grace_time')) ? : '0',['class'=>'form-control','placeholder'=>trans('messages.grace_time_label')]); ?>

									</div> -->
			  						<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="payroll">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.payroll'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form','id' => 'payroll-form','data-no-form-clear' => 1]); ?>

									<div class="form-group">
										<?php echo Form::label('payroll_contribution_field',trans('messages.enable_payroll_contribution_field'),['class' => ' control-label']); ?>

										<div class="radio">
											<label>
												<?php echo Form::radio('payroll_contribution_field', '1', (config('config.payroll_contribution_field')) ? 'checked' : '').' '.trans('messages.yes'); ?>

											</label>
											<label>
												<?php echo Form::radio('payroll_contribution_field', '0', (!config('config.payroll_contribution_field')) ? 'checked' : '').' '.trans('messages.no'); ?>

											</label>
										</div>
								  	</div>
			  						<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

								<?php echo Form::close(); ?>

							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="mail">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.mail'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.mail-store','role' => 'form', 'class'=>'mail-form','id' => 'mail-form','data-no-form-clear' => 1]); ?>

									<?php echo $__env->make('configuration._mail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

						    </div>
						  </div>
						  <!-- <div class="tab-pane animated fadeInRight" id="sms">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.sms'); ?></strong> <?php echo trans('messages.configuration'); ?> (Default Twilio SMS Integrated)</h2>
								<?php echo Form::open(['route' => 'configuration.sms-store','role' => 'form', 'class'=>'sms-form','id' => 'sms-form','data-no-form-clear' => 1]); ?>

									<?php echo $__env->make('configuration._sms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

						    </div>
						  </div> -->
						  <div class="tab-pane animated fadeInRight" id="job">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.job'); ?></strong> <?php echo trans('messages.configuration'); ?></h2>
								<?php echo Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'job-configuration-form','id' => 'job-configuration-form','data-no-form-clear' => 1]); ?>

									<?php echo $__env->make('configuration._job', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo Form::close(); ?>

						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="role">
						    <div class="user-profile-content-wm">
								
								<div class="col-sm-4">
									<div class="box-info">
										<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.role'); ?> </h2>
										<?php echo Form::open(['route' => 'role.store','role' => 'form', 'class'=>'role-form','id' => 'role-form','data-table-alter' => 'role-table']); ?>

											<?php echo $__env->make('role._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
										<?php echo Form::close(); ?>

									</div>
								</div>
								<div class="col-sm-8">
									<div class="box-info full">
										<h2><strong><?php echo trans('messages.list_all').'</strong> '.trans('messages.role'); ?> </h2>
										<div class="table-responsive">
											<table data-sortable class="table table-hover table-striped table-ajax-load" id="role-table" data-source="/role/lists">
												<thead>
													<tr>
														<th><?php echo trans('messages.role_name'); ?></th>
														<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="office-shift">
						    <div class="user-profile-content-wm">
								<h2><strong><?php echo trans('messages.office').'</strong> '.trans('messages.shift'); ?></h2>
								<div class="row">
									<div class="col-sm-12">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.office_shift'); ?></h2>
											<?php echo Form::open(['route' => 'office-shift.store','role' => 'form', 'class'=>'office-shift-form','id' => 'office-shift-form','data-table-alter' => 'office-shift-table']); ?>

												<?php echo $__env->make('office_shift._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.office_shift'); ?></h2>
											<div class="table-responsive">
												<table data-sortable class="table table-hover table-striped table-ajax-load"  id="office-shift-table" data-source="/office-shift/lists">
													<thead>
														<tr>
															<th><?php echo trans('messages.day'); ?></th>
															<th><?php echo trans('messages.option'); ?></th>
															<?php foreach(config('lists.week') as $key => $day): ?>
															<th><?php echo trans('messages.'.$key); ?></th>
															<?php endforeach; ?>
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
						  <div class="tab-pane animated fadeInRight" id="award">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.award_type'); ?></h2>
											<?php echo Form::open(['route' => 'award-type.store','role' => 'form', 'class'=>'award-type-form','id' => 'award-type-form','data-table-alter' => 'award-type-table']); ?>

												<?php echo $__env->make('award_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.award_type'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load"  id="award-type-table" data-source="/award-type/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.award_type'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="contract-type">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.contract_type'); ?></h2>
											<?php echo Form::open(['route' => 'contract-type.store','role' => 'form', 'class'=>'contract-type-form','id' => 'contract-type-form','data-table-alter' => 'contract-type-table']); ?>

												<?php echo $__env->make('contract_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.contract_type'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load" id="contract-type-table" data-source="/contract-type/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.contract_type'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="leave">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.leave_type'); ?></h2>
											<?php echo Form::open(['route' => 'leave-type.store','role' => 'form', 'class'=>'leave-type-form','id' => 'leave-type-form','data-table-alter' => 'leave-type-table']); ?>

												<?php echo $__env->make('leave_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.leave_type'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load"  id="leave-type-table" data-source="/leave-type/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.leave_type'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="document">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.document_type'); ?></h2>
											<?php echo Form::open(['route' => 'document-type.store','role' => 'form', 'class'=>'document-type-form','id' => 'document-type-form','data-table-alter' => 'document-type-table']); ?>

												<?php echo $__env->make('document_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.document_type'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load"  id="document-type-table" data-source="/document-type/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.document_type'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="salary">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.salary_type'); ?></h2>
											<?php echo Form::open(['route' => 'salary-type.store','role' => 'form', 'class'=>'salary-type-form','id' => 'salary-type-form','data-table-alter' => 'salary-type-table']); ?>

												<?php echo $__env->make('salary_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.salary_type'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load"  id="salary-type-table" data-source="/salary-type/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.salary_type'); ?></th>
																<th><?php echo trans('messages.type'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="expense">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.expense_head'); ?></h2>
											<?php echo Form::open(['route' => 'expense-head.store','role' => 'form', 'class'=>'expense-head-form','id' => 'expense-head-form','data-table-alter' => 'expense-head-table']); ?>

												<?php echo $__env->make('expense_head._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.expense_head'); ?></h2>
												<div class="table-responsive">
													<table data-sortable class="table table-hover table-striped table-ajax-load"  id="expense-head-table" data-source="/expense-head/lists">
														<thead>
															<tr>
																<th><?php echo trans('messages.expense_head'); ?></th>
																<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
						  <div class="tab-pane animated fadeInRight" id="api">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-12">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.api').'</strong> '.trans('messages.configuration'); ?></h2>
											<?php echo Form::open(['route' => 'configuration.api','role' => 'form', 'class'=>'api-configuration-form','id'=>'api-configuration-form','data-no-form-clear' => 1]); ?>

												<div class="auth_token" id="auth_token" style="margin:20px 0px;">
												    <?php echo (Auth::user()->auth_token) ? Auth::user()->auth_token : ''; ?>

												</div>
													<?php echo Form::hidden('config_type','api'); ?>

													<?php echo Form::submit((Auth::user()->auth_token) ? trans('messages.regenerate_token') : trans('messages.generate_token'),['class' => 'btn btn-primary']); ?>

											<?php echo Form::close(); ?>

										</div>
									</div>
								</div>
							</div>
						   </div>
						  <div class="tab-pane animated fadeInRight" id="ip">
						    <div class="user-profile-content-wm">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.ip_restriction'); ?></h2>
											<?php echo Form::open(['route' => 'ip.store','role' => 'form', 'class'=>'ip-form','id' => 'ip-form','data-table-alter' => 'ip-table']); ?>

												<?php echo $__env->make('ip._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
											<?php echo Form::close(); ?>

										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info full">
											<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.ip_restriction'); ?></h2>
											<div class="table-responsive">
												<table data-sortable class="table table-hover table-striped table-ajax-load"  id="ip-table" data-source="/ip/lists">
													<thead>
														<tr>
															<th><?php echo e(trans('messages.start')); ?></th>
															<th><?php echo e(trans('messages.end')); ?></th>
															<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
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
				</div>
			</div>
		</div>
				
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>