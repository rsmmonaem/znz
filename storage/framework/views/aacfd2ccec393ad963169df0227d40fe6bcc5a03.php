<?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<div class="container">
	<div class="logo-brand header sidebar rows">
		<div class="logo">
			<h1><a href="<?php echo URL::to('/'); ?>"><?php echo config('config.application_name').' '.config('constants.version'); ?></a></h1>
		</div>
	</div>
	
    <div class="content-page">
        <div class="body content rows scroll-y">
			
			<?php echo $__env->yieldContent('content'); ?>
		
			<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	

		
	
	
	