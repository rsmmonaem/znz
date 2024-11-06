
	<?php $__env->startSection('content'); ?>
		<div class="box-info box-messages">
			<div class="row">
			<?php echo $__env->make('message.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			
				<div class="col-md-10">
					<?php echo Form::open(['files'=>'true','route' => 'message.store','role' => 'form', 'class'=>'compose-form','id' => 'compose-form','data-submit' => 'noAjax']); ?>

						<div class="form-group">
							<?php echo Form::select('to_user_id', [null=>trans('messages.select_one')] + $users, '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

						</div>
						<div class="form-group">
							<?php echo Form::input('text','subject','',['class'=>'form-control','placeholder'=>trans('messages.subject')]); ?>

						</div>
						<div class="form-group">
							<?php echo Form::textarea('body','',['class' => 'form-control summernote-big', 'placeholder' => trans('messages.body')]); ?>

						</div>
						<div class="form-group">
							<input type="file" name="file" id="file" class="btn btn-default" title="<?php echo trans('messages.select').' '.trans('messages.attachment'); ?>">
						</div>
						<div class="row">
							<div class="col-xs-8">
								<button type="submit" class="btn btn-success btn-sm"><?php echo trans('messages.send'); ?></button>
								<a href="/message/compose" class="btn btn-danger btn-sm"><?php echo trans('messages.discard'); ?></a>
							</div>
						</div>	
					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>