
			  <div class="form-group">
			    <?php echo Form::label('name',trans('messages.leave_type'),[]); ?>

				<?php echo Form::input('text','name',isset($leave_type->name) ? $leave_type->name : '',['class'=>'form-control','placeholder'=>trans('messages.leave_type')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

			  	
