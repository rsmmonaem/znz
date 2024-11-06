	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Employer Zone <?php echo trans('messages.update'); ?></h4>
	</div>
	<div class="modal-body">
		<?php if(!count($data)): ?>
			<?php echo $__env->make('common.notification',['type' => 'danger','message' => trans('messages.check_internet_connection')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php elseif($data['status'] == 'error'): ?>
			<?php echo $__env->make('common.notification',['type' => 'danger','message' => 'Invalid build. Please contact app author.'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php else: ?>
		<div class="table-responsive">
			<table class="table table-stripped table-bordered table-hover">
				<thead>
					<tr>
						<th>Version</th>
						<th>Build</th>
						<th>Release Date</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo e($data['current_version']); ?> <span class="label label-info">Current Version</span></td>
						<td><?php echo e(config('code.build')); ?></td>
						<td><?php echo e($data['current_date']); ?></td>
					</tr>
					<?php if(array_key_exists('version',$data)): ?>
					<tr>
						<td><?php echo e($data['version']); ?> <span class="label label-success">Update Available</span></td>
						<td><?php echo e($data['build']); ?></td>
						<td><?php echo e($data['date']); ?></td>
					</tr>
					<?php else: ?>
					<tr>
						<td colspan="3"><span class="label label-danger">No update available.</span></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php endif; ?>
	</div>
	<div class="modal-footer">
	</div>