	<?php $__env->startSection('content'); ?>
		<div class="box-info box-messages">
			<div class="row">
				<?php echo $__env->make('message.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="col-md-10">
					<?php echo $__env->make('common.datatable',['col_heads' => $col_heads], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>