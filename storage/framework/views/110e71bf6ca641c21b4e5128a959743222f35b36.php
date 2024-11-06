
			  <div class="form-group">
			    <?php echo Form::label('head',trans('messages.expense_head'),[]); ?>

				<?php echo Form::input('text','head',isset($expense_head->head) ? $expense_head->head : '',['class'=>'form-control','placeholder'=>trans('messages.expense_head')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

