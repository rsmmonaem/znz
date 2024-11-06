
			  <div class="form-group">
			    <?php echo Form::label('name',trans('messages.award_type'),[]); ?>

				<?php echo Form::input('text','name',isset($award_type->name) ? $award_type->name : '',['class'=>'form-control','placeholder'=>trans('messages.award_type')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

