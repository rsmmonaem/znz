

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/employee"><?php echo trans('messages.employee'); ?></a></li>
		    <li class="active"><?php echo $user->full_name_with_designation; ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info full">
					<br />
					<div class="media box-padding">
						<div class="media-body">
							<a class="pull-right" href="#">
								<?php echo \App\Classes\Helper::getAvatar($user->id); ?>

							</a>
							<h4 class="media-heading"><strong><?php echo $user->full_name; ?> </strong></h4>
							<h6><?php echo $user->Designation->full_designation; ?></h6>
							<div class="clear"></div>
							<?php echo trans('messages.last_login'); ?> <strong><?php echo ((showDateTime($user->last_login)) ? : trans('messages.na')).'</strong><br />'.trans('messages.from').' <strong>'.(($user->last_login_ip) ? : trans('messages.na')); ?></strong></span>
						</div>
					</div>
					<div id="social">
						<a href="<?php echo e(($user->Profile->facebook_link) ? : '#'); ?>" target="_blank" data-toggle="tooltip" title="Facebook">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle facebook fa-stack-2x"></i>
							  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="<?php echo e(($user->Profile->twitter_link) ? : '#'); ?>" target="_blank" data-toggle="tooltip" title="Twitter">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle twitter fa-stack-2x"></i>
							  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="<?php echo e(($user->Profile->googleplus_link) ? : '#'); ?>" target="_blank" data-toggle="tooltip" title="Google Plus">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle gplus fa-stack-2x"></i>
							  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="<?php echo e(($user->Profile->blogger_link) ? : '#'); ?>" target="_blank" data-toggle="tooltip" title="Blogger">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle blogger fa-stack-2x"></i>
							  <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="<?php echo e(($user->Profile->linkedin_link) ? : '#'); ?>" target="_blank" data-toggle="tooltip" title="Linkedin">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle linkedin fa-stack-2x"></i>
							  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</div>
					<?php if($user->id == Auth::user()->id): ?>
					<div class="user-button box-padding">
						<div class="row">
							<div class="col-md-6">
								<a href="/message" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> <?php echo e(trans('messages.go_to_inbox')); ?></a>
							</div>
							<div class="col-md-6">
								<a href="/change-password" class="btn btn-default btn-sm btn-block"><i class="fa fa-key"></i> <?php echo e(trans('messages.change_password')); ?></a>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<div class="table-responsive">
						<table class="table show-table table-hover table-striped table-condensed">
							<tbody>
								<tr>
									<td><?php echo e(trans('messages.employee_code')); ?></td>
									<td><?php echo e($user->Profile->employee_code); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.primary').' '.trans('messages.email')); ?></td>
									<td><?php echo e($user->email); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.primary').' '.trans('messages.contact_number')); ?></td>
									<td><?php echo e($user->Profile->contact_number); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.gender')); ?></td>
									<td><?php echo e(($user->Profile->gender) ? trans('messages.'.$user->Profile->gender) : ''); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.marital_status')); ?></td>
									<td><?php echo e(($user->Profile->marital_status) ? trans('messages.'.$user->Profile->marital_status) : ''); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.date_of_birth')); ?></td>
									<td><?php echo e(showDate($user->Profile->date_of_birth)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.date_of_joining')); ?></td>
									<td><?php echo e(showDate($user->Profile->date_of_joining)); ?></td>
								</tr>
								<tr>
									<td><?php echo e(trans('messages.date_of_leaving')); ?></td>
									<td><?php echo e(showDate($user->Profile->date_of_leaving)); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="box-info full">
					<h2><i class="fa fa-trophy icon" style="margin-right:5px;"></i> <strong><?php echo e(trans('messages.award').' '.trans('messages.received')); ?></strong>
					<span class="badge badge-<?php echo e(count($user->award) ? 'success' : 'danger'); ?> pull-right"><?php echo e(count($user->award)); ?></span>
					</h2>
					<?php if(count($user->award)): ?>
						<div class="table-responsive">
							<table data-sortable class="table show-table table-hover table-striped ">
								<thead>
									<tr>
										<th><?php echo trans('messages.award'); ?></th>
										<th><?php echo trans('messages.month_and_year'); ?></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($user->award as $award): ?>
									<tr>
										<td><?php echo $award->AwardType->name; ?></td>
										<td><?php echo trans('messages.'.$award->month).' '.$award->year; ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="box-info full">
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#contact" data-toggle="tab"><i class="fa fa-phone"></i> <?php echo trans('messages.contact'); ?></a></li>
					  <li><a href="#bank-account" data-toggle="tab"><i class="fa fa-laptop"></i> <?php echo trans('messages.account'); ?></a></li>
					  <li><a href="#document" data-toggle="tab"><i class="fa fa-file"></i> <?php echo trans('messages.document'); ?></a></li>
					  <li><a href="#contract" data-toggle="tab"><i class="fa fa-pencil"></i> <?php echo trans('messages.contract'); ?></a></li>
					  <li><a href="#office-shift" data-toggle="tab"><i class="fa fa-clock-o"></i> <?php echo trans('messages.shift'); ?></a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane animated active fadeInRight" id="contact">
							<div class="user-profile-content">
						    	<?php if(count($user->Contact)): ?>
									<div class="table-responsive">
										<table data-sortable class="table show-table table-hover table-striped table-bordered">
											<thead>
												<tr>
													<th><?php echo trans('messages.name'); ?></th>
													<th><?php echo trans('messages.relation'); ?></th>
													<th><?php echo trans('messages.email'); ?></th>
													<th><?php echo trans('messages.mobile'); ?></th>
													<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($user->Contact as $contact): ?>
												<tr>
													<td><?php echo $contact->name.' <br />'.(($contact->is_primary) ? '<span class="label label-success">'.trans('messages.primary').'</span>' : '').' '.(($contact->is_dependent) ? '<span class="label label-danger">'.trans('messages.dependent').'</span>' : ''); ?></td>
													<td><?php echo trans('messages.'.$contact->relation); ?></td>
													<td><?php echo $contact->work_email; ?></td>
													<td><?php echo $contact->mobile; ?></td>
													<td>
														<div class="btn-group btn-group-xs">
															<a href="<?php echo URL::to('/contact/'.$contact->id); ?>" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' ><i class='fa fa-arrow-circle-right' data-toggle="tooltip" title="<?php echo trans('messages.view'); ?>"></i></a>
														</div>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									<?php else: ?>
										<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<?php endif; ?>
						    </div>
						</div>
						<div class="tab-pane animated fadeInRight" id="bank-account">
						    <div class="user-profile-content">
						    	<?php if(count($user->BankAccount)): ?>
									<div class="table-responsive">
										<table data-sortable class="table table-hover table-striped table-bordered">
											<thead>
												<tr>
													<th><?php echo trans('messages.account_name'); ?></th>
													<th><?php echo trans('messages.account_number'); ?></th>
													<th><?php echo trans('messages.bank_name'); ?></th>
													<th><?php echo trans('messages.bank_code'); ?></th>
													<th><?php echo trans('messages.branch'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($user->BankAccount as $bankAccount): ?>
												<tr>
													<td><?php echo $bankAccount->account_name.' <br /> '.(($bankAccount->is_primary) ? '<span class="label label-success">'.trans('messages.primary').'</span>' : ''); ?></td>
													<td><?php echo $bankAccount->account_number; ?></td>
													<td><?php echo $bankAccount->bank_name; ?></td>
													<td><?php echo $bankAccount->bank_code; ?></td>
													<td><?php echo $bankAccount->bank_branch; ?></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									<?php else: ?>
										<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<?php endif; ?>
						    </div>
						</div>
						<div class="tab-pane animated fadeInRight" id="document">
						    <div class="user-profile-content">
						    	<?php if(count($user->Document)): ?>
									<div class="table-responsive">
										<table data-sortable  class="table show-table table-hover table-striped table-bordered">
											<thead>
												<tr>
													<th><?php echo trans('messages.document_type'); ?></th>
													<th><?php echo trans('messages.title'); ?></th>
													<th><?php echo trans('messages.date_of_expiry'); ?></th>
													<th><?php echo trans('messages.description'); ?></th>
													<th><?php echo trans('messages.status'); ?></th>
													<th data-sortable="false"><?php echo trans('messages.option'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($user->Document as $document): ?>
												<tr>
													<td><?php echo $document->DocumentType->name; ?></td>
													<td><?php echo $document->title; ?></td>
													<td><?php echo showDate($document->date_of_expiry); ?></td>
													<td><?php echo $document->description; ?></td>
													<td><?php echo ($document->status) ? '<span class="badge badge-success">'.trans('messages.active').'</span>' : '<span class="badge badge-danger">'.trans('messages.in_active').'</span>'; ?></td>
													<td>
														<div class="btn-group btn-group-xs">
														<a href="/document/download/<?php echo $document->id; ?>" class="btn btn-xs btn-default" data-toggle="tooltip" title="<?php echo trans('messages.view'); ?>"> <i class="fa fa-download"></i></a>
														</div>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									<?php else: ?>
										<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									<?php endif; ?>
						    </div>
						</div>
						<div class="tab-pane animated fadeInRight" id="contract">
						    <div class="user-profile-content">
						    <?php if(count($user->contract)): ?>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th><?php echo trans('messages.duration'); ?></th>
												<th><?php echo trans('messages.title'); ?></th>
												<th><?php echo trans('messages.contract_type'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($user->contract as $contract_user): ?>
												<tr>
													<td>
														<?php echo showDate($contract_user->from_date); ?> to
														<?php echo showDate($contract_user->to_date).' '.
														((date('Y-m-d') >= $contract_user->from_date && date('Y-m-d') <= $contract_user->to_date) ? '<span class="label label-success">'.trans('messages.active').'</span>' : ''); ?>

													</td>
													<td><?php echo $contract_user->title; ?></td>
													<td><?php echo $contract_user->ContractType->name; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<?php else: ?>
									<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php endif; ?>
						    </div>
						</div>
						<div class="tab-pane animated fadeInRight" id="office-shift">
						    <div class="user-profile-content">
						    <?php if(count($user->userShift)): ?>
								<div class="table-responsive">
									<table data-sortable class="table table-hover table-striped table-bordered">
										<thead>
											<tr>
												<th><?php echo trans('messages.date'); ?></th>
												<th><?php echo trans('messages.shift'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($user->userShift as $user_shift): ?>
												<tr>
													<td>
														<?php echo showDate($user_shift->from_date); ?> to
														<?php echo showDate($user_shift->to_date); ?>

													</td>
													<td><?php echo $user_shift->OfficeShift->name; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<?php else: ?>
								<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php endif; ?>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<?php if(\App\Classes\Helper::getContract()): ?>
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong><?php echo e(trans('messages.leave').': '.\App\Classes\Helper::getContract()->full_contract_date); ?></strong>
					</h2>
					<?php if(count($contract)): ?>
						<div class="table-responsive">
							<table data-sortable class="table show-table table-hover table-striped ">
								<thead>
									<tr>
										<?php foreach(\App\LeaveType::all() as $leave_type): ?>
										<th><?php echo $leave_type->name; ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<tr>
									<?php foreach(\App\LeaveType::all() as $leave_type): ?>
										<td>
											<?php echo ($contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->count()) ? $contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->first()->leave_used.'/'.$contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->first()->leave_count : 0; ?>

										</td>
									<?php endforeach; ?>
									</tr>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong><?php echo e(trans('messages.salary').': '.\App\Classes\Helper::getContract()->full_contract_date); ?></strong>
					</h2>
					<?php if(count($contract)): ?>
						<div class="table-responsive">
							<table data-sortable class="table show-table table-hover table-striped ">
								<thead>
									<tr>
										<?php foreach(\App\SalaryType::all() as $salary_type): ?>
										<th><?php echo $salary_type->head.' <br />'.(($salary_type->salary_type == 'earning') ? '<span class="badge badge-success">+</span>' : '<span class="badge badge-danger">-</span>'); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<tr>
									<?php foreach(\App\SalaryType::all() as $salary_type): ?>
										<td>
											<?php echo ($contract->Salary->whereLoose('salary_type_id',$salary_type->id)->count()) ? currency($contract->Salary->whereLoose('salary_type_id',$salary_type->id)->first()->amount) : 0; ?>

										</td>
									<?php endforeach; ?>
									</tr>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.no_data_found')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>