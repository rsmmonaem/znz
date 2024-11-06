
	<?php $__env->startSection('content'); ?>
		<div class="box-info box-messages">
			<div class="row">
				<?php echo $__env->make('message.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="col-md-10">
					<p class="text-right"><strong><?php echo date('d M Y, h:i A',strtotime($message->created_at)); ?></strong></p>
					<table class="table">
						<tbody>
							<tr>
								<td colspan="2">
									<a href="<?php echo URL::to('/message/'.$message->id.'/delete/'.$token); ?>" class="btn btn-danger btn-sm alert_delete"><i class="fa fa-trash-o"></i> <?php echo trans('messages.trash'); ?></a>
								</td>
							</tr>
							<tr>
								<td style="width: 100px;"><strong><?php echo trans('messages.from_to'); ?></strong></td>
								<td><?php echo $user->full_name_with_designation; ?></td>
							</tr>
							<tr>
								<td><strong><?php echo trans('messages.subject'); ?></strong></td>
								<td><?php echo $message->subject; ?></td>
							</tr>
							<tr>
								<td colspan="2">
								<p style="text-align: justify">
								<?php echo $message->body; ?>

								</p>
								</td>
							</tr>
							<?php if($message->attachments): ?>
							<tr>
								<td><strong><?php echo trans('messages.attachment'); ?></strong></td>
								<td><a href="/message/<?php echo e($message->id); ?>/download"><strong><?php echo trans('messages.download'); ?></strong></a></td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>