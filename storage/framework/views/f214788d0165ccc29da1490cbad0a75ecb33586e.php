	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.holiday'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<?php if(Entrust::can('create_holiday')): ?>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.add_new'); ?></strong></h2>
					<?php echo Form::open(['route' => 'holiday.store','role' => 'form', 'class'=>'holiday-form','id' => 'holiday-form','data-form-table' => 'holiday_table']); ?>

						<?php echo $__env->make('holiday._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo Form::close(); ?>

				</div>
			</div>
			<?php endif; ?>
			<?php if(Entrust::can('list_holiday')): ?>
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.holiday'); ?></h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box-info">
					<div id="holiday-graph"></div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>