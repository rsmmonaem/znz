

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.language'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.language'); ?></h2>
					<?php echo Form::open(['route' => 'language.store','role' => 'form', 'class'=>'language-form','id' => 'language-form','data-form-table' => 'language_table']); ?>

						<?php echo $__env->make('language._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo Form::close(); ?>

				</div>
			</div>
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.language'); ?></h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>

		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>