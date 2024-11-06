

	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box-info">
					<div class="draggable-container">
					  <div class="draggable" id="0">
					    <p>dummy text</p>
					  </div>

					  <div class="draggable" id="1">
					    <p>dummy text dummy text</p>
					  </div>

					  <div class="draggable" id="2">
					    <p>dummy text dummy text dummy text</p>
					  </div>
					  <div class="draggable" id="3">
					    <p>dummy text dummy text dummy text</p>
					  </div>
					</div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>