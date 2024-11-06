
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.contract'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($contract,['method' => 'PATCH','route' => ['contract.update',$contract->id] ,'class' => 'contract-form','id' => 'contract-edit-form','data-table-alter' => 'contract-table']); ?>

			<?php echo $__env->make('employee._contract_form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>
