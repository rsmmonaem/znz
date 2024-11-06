
			  <div class="form-group">
			    <?php echo Form::label('name',trans('messages.document_type'),[]); ?>

				<?php echo Form::input('text','name',isset($document_type->name) ? $document_type->name : '',['class'=>'form-control','placeholder'=>trans('messages.document_type')]); ?>

			  </div>
			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

			  	
