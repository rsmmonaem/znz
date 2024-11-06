
			  <div class="form-group">
			    <?php echo Form::label('name',trans('messages.role_name'),[]); ?>

				<?php echo Form::input('text','name',isset($role->name) ? $role->name : '',['class'=>'form-control','placeholder'=>trans('messages.role_name')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

