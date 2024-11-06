

	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.job').'</strong> '.trans('messages.openings'); ?>

					</h2>

					<ul class="media-list search-result">
					<?php foreach($jobs as $job): ?>
					  <li class="media">
						<div class="media-body">
						  <h4 class="media-heading"><a href="#" target="_blank"><?php echo $job->title; ?></a> <span class="label label-warning pull-right"><?php echo trans('messages.date_of_closing').' '.showDate($job->date_of_closing); ?></span></h4>
						  <a href="#" target="_blank"><?php echo $job->Designation->full_designation; ?> <span class="label label-success"><?php echo $job->location; ?></span></a>
						  <p><?php echo $job->description; ?> <span class="label label-primary pull-right"> <i class="fa fa-clock-o"></i> <?php echo trans('messages.posted_on').' '.showDateTime($job->created_at); ?></span></p>
						</div>
					  </li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.apply').'</strong> '.trans('messages.now'); ?></h2>

					<?php echo Form::open(['files' => true, 'route' => 'job-application.store','role' => 'form', 'class'=>'job-application-form','id' => 'job-application-form']); ?>

					  <div class="form-group">
					    <?php echo Form::label('job_id',trans('messages.job'),[]); ?>

						<?php echo Form::select('job_id', [null => trans('messages.select_one')] + $job_list,'',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('name',trans('messages.name'),[]); ?>

						<?php echo Form::input('text','name','',['class'=>'form-control','placeholder'=>trans('messages.name')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('email',trans('messages.email'),[]); ?>

						<?php echo Form::input('email','email','',['class'=>'form-control','placeholder'=>trans('messages.email')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('contact_number',trans('messages.contact_number'),[]); ?>

						<?php echo Form::input('text','contact_number','',['class'=>'form-control','placeholder'=>trans('messages.contact_number')]); ?>

					  </div>
					  	<div class="form-group">
							<input type="file" name="resume" id="resume" class="btn btn-default" title="<?php echo trans('messages.select').' '.trans('messages.resume'); ?>">
						</div>
					  	<?php echo e(App\Classes\Helper::getCustomFields('job-application-form',$custom_field_values)); ?>

					  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.submit'),['class' => 'btn btn-primary pull-right']); ?>

					<?php echo Form::close(); ?>


					</h2>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.blank', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>