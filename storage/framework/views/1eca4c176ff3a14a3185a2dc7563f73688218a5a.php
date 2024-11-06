
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.announcement'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($announcement,['method' => 'PATCH','route' => ['announcement.update',$announcement] ,'class' => 'announcement-form','id' => 'announcement-form-edit','data-form-table' => 'announcement_table']); ?>

			<?php echo $__env->make('announcement._form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>