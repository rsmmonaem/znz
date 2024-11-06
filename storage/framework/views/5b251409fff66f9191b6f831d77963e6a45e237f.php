
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title"><?php echo trans('messages.edit').' '.trans('messages.template'); ?></h4>
	</div>
	<div class="modal-body">
		<?php echo Form::model($template,['method' => 'PATCH','route' => ['template.update',$template] ,'class' => 'email-template-form','id' => 'email-template-form-edit','data-form-table' => 'template_table']); ?>

			<div class="form-group">
		    <?php echo Form::label('subject',trans('messages.subject'),[]); ?>

			<?php echo Form::input('text','subject',isset($template->subject) ? $template->subject : '',['class'=>'form-control','placeholder'=>trans('messages.subject')]); ?>

		  </div>
		  <div class="form-group">
		    <?php echo Form::label('body',trans('messages.body'),[]); ?>

		    <?php echo Form::textarea('body',isset($template->body) ? $template->body : '',['size' => '30x3', 'class' => 'form-control summernote-big', 'placeholder' => trans('messages.body')]); ?>

		  	<div class="help-block"><strong><?php echo trans('messages.available').' '.trans('messages.field'); ?></strong> : <?php echo ($template->is_default) ? config('template.'.$template->category.'.fields') : config('template-field.'.$template->category); ?> <br /> <?php echo e(trans('messages.template_field_instruction')); ?></div>
		  </div>
		  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

		<?php echo Form::close(); ?>

		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>