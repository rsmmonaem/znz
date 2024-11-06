

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.custom_field'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.custom_field'); ?>

					</h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
				<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.custom_field'); ?>

					</h2>
					<?php echo Form::open(['route' => 'custom-field.store','role' => 'form', 'class'=>'custom-field-form','id' => 'custom-field-form','data-form-table' => 'custom_field_table']); ?>

					
					  <div class="form-group">
					    <?php echo Form::label('form',trans('messages.form'),[]); ?>

						<?php echo Form::select('form', [
							''=>''] + config('custom-field'),'',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('type',trans('messages.type'),[]); ?>

						<?php echo Form::select('type', [
							''=>'',
							'text' => 'Text Box',
							'number' => 'Number',
							'email' => 'Email',
							'url' => 'URL',
							'date' => 'Date',
							'select' => 'Select Box',
							'radio' => 'Radio Button',
							'checkbox' => 'Check Box',
							'textarea' => 'Textarea'
							],'',['id' => 'type', 'class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <div class="showhide-textarea">
						<div class="form-group">
						    <?php echo Form::label('options',trans('messages.option'),[]); ?>

							<?php echo Form::input('text','options','',['class'=>'form-control select2dynamictag','placeholder'=>trans('messages.option')]); ?>

						</div>
					  </div>
					  <div class="form-group">
					    <?php echo Form::label('title',trans('messages.title'),[]); ?>

						<?php echo Form::input('text','title','',['class'=>'form-control','placeholder'=>trans('messages.title')]); ?>

					  </div>
					  <div class="form-group">
					   <div class="checkbox">
							<label>
							  <input type="checkbox" name="is_required" value="1"> <?php echo trans('messages.required'); ?>

							</label>
						</div>
					  </div>
					  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

	
					<?php echo Form::close(); ?>

				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>