
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.salary_type'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($salary_type,['method' => 'PATCH','route' => ['salary-type.update',$salary_type->id] ,'class' => 'salary-type-form','id' => 'salary-type-form-edit','data-table-alter' => 'salary-type-table']); ?>

			<?php echo $__env->make('salary_type._form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>
