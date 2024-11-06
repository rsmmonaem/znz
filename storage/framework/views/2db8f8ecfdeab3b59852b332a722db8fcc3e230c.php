
			  <div class="form-group">
			    <?php echo Form::label('date',trans('messages.date'),[]); ?>

				<?php if(!isset($buttonText)): ?>
				<?php echo Form::input('text','date',isset($holiday->date) ? $holiday->date : '',['class'=>'form-control mdatepicker','placeholder'=>trans('messages.date'),'readonly' => 'true']); ?>

			  	<?php else: ?>
			  	<?php echo Form::input('text','date',isset($holiday->date) ? $holiday->date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date'),'readonly' => 'true']); ?>

			  	<?php endif; ?>
			  </div>
			  <div class="form-group">
			    <?php echo Form::label('description',trans('messages.description'),[]); ?>

			    <?php echo Form::textarea('description',isset($holiday->description) ? $holiday->description : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.description'),"data-show-counter" => 1,"data-limit" => config('config.textarea_limit'),'data-autoresize' => 1]); ?>

			    <span class="countdown"></span>
			  </div>
			  	<?php echo e(App\Classes\Helper::getCustomFields('holiday-form',$custom_field_values)); ?>

			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

