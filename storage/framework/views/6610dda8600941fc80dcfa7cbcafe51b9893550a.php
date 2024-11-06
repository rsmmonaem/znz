			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('leave_type_id',trans('messages.leave_type'),['class' => 'control-label']); ?>

						<?php echo Form::select('leave_type_id', [''=>''] + $leave_types, isset($leave->leave_type_id) ? $leave->leave_type_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

						<?php if((defaultRole() || Entrust::can('manage_configuration')) && !isset($leave)): ?>
							<p class="help-block"><a href="#" data-href="/leave-type/create" data-toggle="modal" data-target="#myModal"><?php echo trans('messages.add_new'); ?></a></p>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php echo Form::label('from_date',trans('messages.from_date'),[]); ?>

								<?php echo Form::input('text','from_date',isset($leave->from_date) ? $leave->from_date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.from_date'),'readonly' => 'true']); ?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<?php echo Form::label('to_date',trans('messages.to_date'),[]); ?>

								<?php echo Form::input('text','to_date',isset($leave->to_date) ? $leave->to_date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.to_date'),'readonly' => 'true']); ?>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('remarks',trans('messages.remarks'),[]); ?>

						<?php echo Form::textarea('remarks',isset($leave->remarks) ? $leave->remarks : '',['size' => '30x6', 'class' => 'form-control', 'placeholder' => trans('messages.remarks'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1]); ?>

						<span class="countdown"></span>
					</div>
				</div>
			</div>
		  	<?php echo e(App\Classes\Helper::getCustomFields('leave-form',$custom_field_values)); ?>

		  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

