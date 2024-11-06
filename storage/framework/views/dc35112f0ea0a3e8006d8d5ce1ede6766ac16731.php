

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/leave"><?php echo trans('messages.leave'); ?></a></li>
		    <li class="active"><?php echo trans('messages.leave').' '.trans('messages.detail'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.leave').'</strong> '.trans('messages.detail'); ?></h2>
					<div class="table-responsive">
						<table class="table table-hover table-striped show-table">
							<tbody>
								<tr><th><?php echo trans('messages.leave'); ?> #</th><td><?php echo str_pad($leave->id, 3, 0, STR_PAD_LEFT); ?></td></tr>
								<tr><th><?php echo trans('messages.employee'); ?></th><td><?php echo $leave->User->full_name_with_designation; ?></td></tr>
								<tr><th><?php echo trans('messages.leave_type'); ?></th><td><?php echo $leave->LeaveType->name; ?></td></tr>
								<tr><th><?php echo trans('messages.date_of_request'); ?></th><td><?php echo showDate($leave->created_at); ?></td></tr>
								<tr><th><?php echo trans('messages.from_date'); ?></th><td><?php echo showDate($leave->from_date); ?></td></tr>
								<tr><th><?php echo trans('messages.to_date'); ?></th><td><?php echo showDate($leave->to_date); ?></td></tr>
							</tbody>
						</table>
					</div>
					<br />
					<div class="the-notes info"><?php echo $leave->remarks; ?></div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<?php if(Entrust::can('update_leave_status') && ($leave->user_id != Auth::user()->id || defaultRole())): ?>
					 <?php echo Form::model($leave,['method' => 'POST','route' => ['leave.update-status',$leave->id] ,'class' => 'leave-status-form','id' => 'leave-status-form','data-no-form-clear'=>1,'data-leave-statistics' => 1]); ?>

					<h2><strong><?php echo trans('messages.update'); ?></strong> <?php echo trans('messages.status'); ?></h2>
					  <div class="form-group">
					    <?php echo Form::label('status',trans('messages.leave').' '.trans('messages.status'),[]); ?>

						<?php echo Form::select('status', $status, $leave->status,['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one'),'id' => 'status']); ?>

					  </div>
					  <div class="form-group show-hide-approved-date">
					    <?php echo Form::label('approved_date',trans('messages.date'),[]); ?>

						<?php echo Form::input('text','approved_date',isset($leave->approved_date) ? $leave->approved_date : '',['class'=>'form-control mdatepicker','placeholder'=>trans('messages.date'),'readonly' => 'true']); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('admin_remarks',trans('messages.remarks'),[]); ?>

					    <?php echo Form::textarea('admin_remarks',isset($leave->admin_remarks) ? $leave->admin_remarks : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.remarks'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1]); ?>

					    <span class="countdown"></span>
					  </div>
					  <?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary']); ?>

					<?php echo Form::close(); ?>

					<?php else: ?>
					<h2><strong><?php echo trans('messages.leave'); ?></strong> <?php echo trans('messages.status'); ?></h2>
						<?php if($leave->status == 'pending'): ?>
							<span class="label label-info btn-lg"><?php echo trans('messages.pending'); ?></span>
						<?php elseif($leave->status == 'approved'): ?>
							<span class="label label-success btn-lg"><?php echo trans('messages.approved'); ?></span>
						<?php else: ?>
							<span class="label label-danger btn-lg"><?php echo trans('messages.rejected'); ?></span>
						<?php endif; ?>
						<div class="the-success info"><?php echo $leave->admin_remarks; ?></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo e(trans('messages.leave')); ?></strong> <?php echo e(trans('messages.statistics')); ?></h2>
					<div id="leave-statistics" data-user-id="<?php echo e($leave->User->id); ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.other'); ?></strong> <?php echo trans('messages.leave').' "'.$leave->User->full_name_with_designation.'"'; ?></h2>

					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th><?php echo trans('messages.from_date'); ?></th>
									<th><?php echo trans('messages.to_date'); ?></th>
									<th><?php echo trans('messages.leave_type'); ?></th>
									<th><?php echo trans('messages.remarks'); ?></th>
									<th><?php echo trans('messages.status'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($other_leaves as $other_leave): ?>
									<tr>
										<td><?php echo showDate($other_leave->from_date); ?></td>
										<td><?php echo showDate($other_leave->to_date); ?></td>
										<td><?php echo $leave->LeaveType->name; ?></td>
										<td><?php echo $other_leave->remarks; ?></td>
										<td><?php echo trans('messages.'.$other_leave->status); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>