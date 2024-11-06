

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/job-application"><?php echo trans('messages.job_application'); ?></a></li>
		    <li class="active"><?php echo e($job_application->name.' ('.$job_application->Job->full_job_title.')'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.job_application'); ?></strong> <?php echo trans('messages.detail'); ?></h2>
					<ul class="list-group">
					  <li class="list-group-item">
						<span class="pull-right"><?php echo $job_application->Job->full_job_title; ?></span>
						<?php echo trans('messages.title'); ?>

					  </li>
					  <li class="list-group-item">
						<span class="pull-right"><?php echo $job_application->name; ?></span>
						<?php echo trans('messages.candidate_name'); ?>

					  </li>
					  <li class="list-group-item">
						<span class="pull-right"><?php echo $job_application->email; ?></span>
						<?php echo trans('messages.email'); ?>

					  </li>
					  <li class="list-group-item">
						<span class="pull-right"><?php echo $job_application->contact_number; ?></span>
						<?php echo trans('messages.contact_number'); ?>

					  </li>
					  <li class="list-group-item">
						<span class="pull-right"><?php echo showDate($job_application->date_of_application); ?></span>
						<?php echo trans('messages.date_of_application'); ?>

					  </li>
					  <?php if($job_application->status != 'applied'): ?>
					  <li class="list-group-item">
						<span class="pull-right"><?php echo trans('messages.'.$job_application->status); ?></span>
						<?php echo trans('messages.status'); ?>

					  </li>
					  <li class="list-group-item">
						<?php echo $job_application->remarks; ?>

					  </li>
					  <?php endif; ?>
					</ul>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box-info">
				<h2><strong><?php echo trans('messages.update').' </strong>'.trans('messages.status'); ?></h2>
					<?php echo Form::model($job_application,['method' => 'PATCH','route' => ['job-application.update-status',$job_application] ,'class' => 'job-application-status-form','id' => 'job-application-status-form','data-submit' => 'noAjax']); ?>

					  <div class="form-group">
					    <?php echo Form::label('status',trans('messages.status'),[]); ?>

						<?php echo Form::select('status', [''=>''] + $job_application_status,isset($job_application->status) ? $job_application->status : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('remarks',trans('messages.remarks'),[]); ?>

					    <?php echo Form::textarea('remarks',isset($job_application) ? $job_application->remarks : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.remarks')]); ?>

					    <span class="countdown"></span>
					  </div>
			  		  <?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>