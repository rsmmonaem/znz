

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.backup').' '.trans('messages.log'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.backup').' '.trans('messages.log'); ?>

						<div class="additional-btn">
							<?php echo Form::open(['route' => 'backup.store','role' => 'form', 'class'=>'backup-form','id' => 'backup-form','data-form-table' => 'backup_table']); ?>

								<?php echo Form::checkbox('delete_old_backup', '1', '').' <span style="font-size:12px;"> '.trans('messages.delete_old_backup'); ?></span>
								<?php echo Form::submit(trans('messages.create').' '.trans('messages.backup'),['class' => 'btn btn-primary btn-sm']); ?>

							<?php echo Form::close(); ?>

						</div>
					</h2>
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>