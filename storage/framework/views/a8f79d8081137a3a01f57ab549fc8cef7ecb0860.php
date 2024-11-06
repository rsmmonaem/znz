
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.add_new').' '.trans('messages.leave_type'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::open(['route' => 'leave-type.store','role' => 'form', 'class'=>'leave-type-form','id' => 'leave-type-form']); ?>

			<?php echo $__env->make('leave_type._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>
	<script>
	</script>
