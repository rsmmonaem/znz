
			  <div class="form-group">
			    <?php echo Form::label('name',trans('messages.contract_type'),[]); ?>

				<?php echo Form::input('text','name',isset($contract_type->name) ? $contract_type->name : '',['class'=>'form-control','placeholder'=>trans('messages.contract_type')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

