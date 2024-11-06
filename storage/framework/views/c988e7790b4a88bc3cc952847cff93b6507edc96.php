

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.shift_detail'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.set_date'); ?></strong></h2>
					<?php echo Form::open(['route' => 'clock.shift','role' => 'form','class'=>'form-inline','id' => 'shift_detail','data-form-table' => 'shift_detail_table','data-no-form-clear' => 1]); ?>

						<div class="form-group">
							<label class="sr-only" for="date"><?php echo trans('messages.date'); ?></label>
							<input type="text" class="form-control datepicker" id="date" name="date" placeholder="<?php echo trans('messages.date'); ?>" readonly="true" value="<?php echo $date; ?>">
							<button type="submit" class="btn btn-default btn-success"><?php echo trans('messages.get'); ?></button>
					  	</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.shift_detail'); ?></strong> <?php echo trans('messages.for'); ?> <?php echo date('d-M-Y',strtotime($date)); ?></h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>