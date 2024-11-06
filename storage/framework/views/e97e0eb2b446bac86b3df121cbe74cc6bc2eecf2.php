

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.leave'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<?php if(Entrust::can('request_leave')): ?>
			<div class="col-sm-12 collapse" id="box-detail">
				<div class="row">
					<div class="col-sm-4">
						<div class="box-info">
							<h2><strong><?php echo e(trans('messages.leave')); ?></strong> <?php echo e(trans('messages.statistics')); ?></h2>
							<div id="leave-statistics">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="box-info">
							<h2><strong><?php echo trans('messages.request'); ?></strong> <?php echo trans('messages.leave'); ?>

							<div class="additional-btn">
								<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i class="fa fa-minus icon"></i> <?php echo trans('messages.hide'); ?></button>
							</div></h2>
							<?php echo Form::open(['route' => 'leave.store','role' => 'form', 'class'=>'leave-form','id' => 'leave-form','data-form-table' => 'leave_table']); ?>

								<?php echo $__env->make('leave._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo Form::close(); ?>

						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.leave').' '.trans('messages.request'); ?>

					<?php if(Entrust::can('request_leave')): ?>
					<div class="additional-btn">
						<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> <?php echo trans('messages.request'); ?></button></a>
					</div>
					<?php endif; ?>
					</h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

		<div class="row" id="leave-graph">
		<?php foreach($leave_types as $leave_type): ?>
				<div class="col-md-12">
					<div class="box-info">
						<div id="<?php echo e(\App\Classes\Helper::createSlug($leave_type)); ?>-graph"></div>
					</div>
				</div>
		<?php endforeach; ?>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>