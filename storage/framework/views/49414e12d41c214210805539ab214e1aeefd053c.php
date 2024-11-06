	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.date_wise').' '.trans('messages.summary').' '.trans('messages.attendance'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.select').' '.trans('messages.date'); ?></strong></h2>
					<?php echo Form::open(['route' => 'clock.date-wise-summary-attendance','role' => 'form','class'=>'form-inline','id' => 'date_wise_summary_attendance','data-form-table' => 'date_wise_summary_attendance_table','data-no-form-clear' => 1]); ?>

						<div class="form-group">
							<?php echo Form::input('text','from_date',isset($from_date) ? $from_date : date('Y-m-d'),['class'=>'form-control datepicker','placeholder'=>trans('messages.from_date'),'readonly' => 'true']); ?>

						</div>
						<div class="form-group">
							<?php echo Form::input('text','to_date',isset($to_date) ? $to_date : date('Y-m-d'),['class'=>'form-control datepicker','placeholder'=>trans('messages.to_date'),'readonly' => 'true']); ?>

						</div>
					  <?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.get'),['class' => 'btn btn-primary']); ?>

					<?php echo Form::close(); ?>

				</div>
			</div>
			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.attendance'); ?></strong> </h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>


		<div class="row" id="date-wise-summary-attendance-graph">
			<div class="col-md-12">
				<div class="box-info">
					<div id="date-wise-summary-attendance-late-graph"></div>
				</div>
				<div class="box-info">
					<div id="date-wise-summary-attendance-early-graph"></div>
				</div>
				<div class="box-info">
					<div id="date-wise-summary-attendance-working-graph"></div>
				</div>
				<div class="box-info">
					<div id="date-wise-summary-attendance-rest-graph"></div>
				</div>
				<div class="box-info">
					<div id="date-wise-summary-attendance-overtime-graph"></div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>