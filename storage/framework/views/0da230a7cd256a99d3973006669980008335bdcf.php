
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.ticket'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($ticket,['method' => 'PATCH','route' => ['ticket.update',$ticket] ,'class' => 'ticket-form','id' => 'ticket-form-edit','data-form-table' => 'ticket_table']); ?>

			<?php echo $__env->make('ticket._form', ['buttonText' => trans('messages.update')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>