	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.attendance'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.set_date'); ?></strong></h2>
					<?php echo Form::open(['route' => 'clock.attendance','role' => 'form','class'=>'form-inline','id' => 'daily_attendance','data-form-table' => 'daily_attendance_table','data-no-form-clear' => 1]); ?>

						<div class="form-group">
							<label class="sr-only" for="date"><?php echo trans('messages.date'); ?></label>
							<input type="text" class="form-control datepicker" id="date" name="date" placeholder="<?php echo trans('messages.date'); ?>" readonly="true" value="<?php echo $date; ?>">
							<button type="submit" class="btn btn-default btn-success"><?php echo trans('messages.get'); ?></button>
					  	</div>

					<?php echo Form::close(); ?>

				</div>
			</div>
			<div class="col-sm-2 pull-right" id="attendance_summary"></div>
			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.attendance'); ?></strong> <?php echo trans('messages.for'); ?> <?php echo date('d-M-Y',strtotime($date)); ?></h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

		<div class="row" id="daily-attendance-graph">
			<div class="col-md-12">
				<div class="box-info">
					<div id="attendance-late-graph"></div>
				</div>
				<div class="box-info">
					<div id="attendance-early-graph"></div>
				</div>
				<div class="box-info">
					<div id="attendance-working-graph"></div>
				</div>
				<div class="box-info">
					<div id="attendance-rest-graph"></div>
				</div>
				<div class="box-info">
					<div id="attendance-overtime-graph"></div>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>