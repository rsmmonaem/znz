
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.job').' '.trans('messages.application'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($job_application,['files' => true,'method' => 'PATCH','route' => ['job-application.update',$job_application] ,'class' => 'job-application-form','data-submit' => 'noAjax']); ?>

			<?php echo $__env->make('job_application._form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>