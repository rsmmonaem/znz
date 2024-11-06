	<?php $__env->startSection('breadcrumb'); ?>
		brod
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
	<?php
	$arr=$user;
	print_r($user);
	?>
	<?php $__env->stopSection(); ?>

	
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>