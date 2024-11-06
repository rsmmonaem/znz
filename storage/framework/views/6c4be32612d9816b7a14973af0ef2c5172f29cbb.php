
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.expense').' '.trans('messages.update_status'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($expense,['method' => 'PATCH','route' => ['expense.update-status',$expense->id] ,'class' => 'expense-update-status-form','id' => 'expense-update-status-form','data-form-table' => 'expense_table']); ?>

		  <div class="form-group">
		    <?php echo Form::label('status',trans('messages.status'),[]); ?>

			<?php echo Form::select('status', $expense_status,isset($expense->status) ? $expense->status : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

		  </div>
		  <div class="form-group">
		    <?php echo Form::label('admin_remarks',trans('messages.comment'),[]); ?>

		    <?php echo Form::textarea('admin_remarks',isset($expense) ? $expense->admin_remarks : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.comment'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1]); ?>

		    <span class="countdown"></span>
		  </div>
		  <?php echo Form::submit(trans('messages.update'),['class' => 'btn btn-primary pull-right']); ?>

		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
