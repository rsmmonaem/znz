
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.office_shift'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($office_shift,['method' => 'PATCH','route' => ['office-shift.update',$office_shift->id] ,'class' => 'office-shift-form','id' => 'office-shift-form-edit','data-table-alter' => 'office-shift-table']); ?>

			<?php echo $__env->make('office_shift._form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>
