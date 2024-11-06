			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php echo Form::label('expense_head_id',trans('messages.expense_head'),['class' => 'control-label']); ?>

								<?php echo Form::select('expense_head_id', [''=>''] + ($expense_heads), isset($expense->expense_head_id) ? $expense->expense_head_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

								<?php if((defaultRole() || Entrust::can('manage_configuration')) && !isset($expense)): ?>
									<p class="help-block"><a href="#" data-href="/expense-head/create" data-toggle="modal" data-target="#myModal"><?php echo trans('messages.add_new'); ?></a></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<?php echo Form::label('date_of_expense',trans('messages.date_of_expense'),[]); ?>

							<?php echo Form::input('text','date_of_expense',isset($expense->date_of_expense) ? $expense->date_of_expense : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_expense'),'readonly' => 'true']); ?>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php echo Form::label('amount',trans('messages.amount'),[]); ?>

								<?php echo Form::input('number','amount',isset($expense->amount) ? round($expense->amount,config('config.currency_decimal')) : '',['class'=>'form-control','step' => $currency_decimal_value, 'placeholder'=>trans('messages.amount'),'min' => 0]); ?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php echo Form::input('file','attachments','',['class'=>'btn btn-default','title' => trans('messages.select').' '.trans('messages.file')]); ?>

								<?php if(isset($expense) && $expense->attachments != null): ?>
									<div class="checkbox">
										<label>
											<?php echo Form::checkbox('remove', 1); ?> <?php echo trans('messages.remove'); ?>

										</label>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('remarks',trans('messages.remarks'),[]); ?>

						<?php echo Form::textarea('remarks',isset($expense->remarks) ? $expense->remarks : '',['size' => '30x6', 'class' => 'form-control', 'placeholder' => trans('messages.remarks'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1]); ?>

						<span class="countdown"></span>
					</div>
				</div>
			</div>
		  	<?php echo e(App\Classes\Helper::getCustomFields('expense-form',$custom_field_values)); ?>

		  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

