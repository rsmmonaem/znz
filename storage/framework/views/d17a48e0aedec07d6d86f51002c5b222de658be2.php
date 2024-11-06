
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.payroll'); ?></h4>
	</div>
	<div class="modal-body">
		<p><?php echo $payroll_slip->User->full_name_with_designation.' '.trans('messages.payslip').' '.trans('messages.from').' '.showDate($payroll_slip->from_date).' '.trans('messages.to').' '.showDate($payroll_slip->to_date); ?></p>
		<?php echo Form::model('',['method' => 'PATCH','route' => ['payroll.update',$payroll_slip->id] ,'class' => 'payroll-form','id' => 'payroll-form-edit','data-submit' => 'noAjax']); ?>

			<?php echo $__env->make('payroll._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>