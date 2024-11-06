

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.update_attendance'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.update_attendance'); ?></strong></h2>
					
					<?php echo Form::open(['route' => 'clock.update-attendance','role' => 'form','class'=>'update-attendance-form','id'=>'update-attendance-form','data-submit' => 'noAjax']); ?>

					  <div class="form-group">
					    <?php echo Form::label('user_id',trans('messages.employee'),['class' => 'control-label']); ?>

					    <?php echo Form::select('user_id', [null => trans('messages.select_one')] + $users, $user->id,['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('date',trans('messages.date'),[]); ?>

						<?php echo Form::input('text','date',$date,['class'=>'form-control datepicker','placeholder'=>trans('messages.date'),'readonly' => 'true']); ?>

					  </div>
					  <?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.get'),['class' => 'btn btn-primary']); ?>

					<?php echo Form::close(); ?>

				</div>
			</div>
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.update_attendance'); ?></strong></h2>
					<h4><?php echo $user->full_name_with_designation; ?></h4>
					<p><strong><?php echo showDate($date).' '.$label; ?></strong></p>
					<p><strong>Office Shift: <?php echo showDateTime($my_shift->in_time); ?> to <?php echo showDateTime($my_shift->out_time); ?></strong></p>
					
					<div class="row">
						<?php echo Form::model($user,['method' => 'POST','route' => ['clock.clock-update',$user->id,$date] ,'class' => 'clock-form','id' => 'clock-form','data-table-alter' => 'clock-list-table','data-submit' => 'noAjax']); ?>

							<div class="col-md-4"><?php echo Form::input('text','clock_in','',['class'=>'form-control datetimepicker','placeholder'=>trans('messages.clock_in'),'readonly' => true]); ?></div>
							<div class="col-md-4"><?php echo Form::input('text','clock_out','',['class'=>'form-control datetimepicker','placeholder'=>trans('messages.clock_out'),'readonly' => true]); ?></div>
							<div class="col-md-4"><button type="submit" class="btn btn-success"><?php echo trans('messages.add_new'); ?></button></div>
						<?php echo Form::close(); ?>

					</div>

					<div class="table-responsive">
						<table class="table table-hover table-striped" id="clock-list-table">
							<thead>
								<tr>
									<th><?php echo trans('messages.in_time'); ?></th>
									<th><?php echo trans('messages.out_time'); ?></th>
									<th><?php echo trans('messages.option'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($clocks as $clock): ?>
								<tr>
									<td><?php echo showDateTime($clock->clock_in); ?></td>
									<td><?php echo showDateTime($clock->clock_out); ?></td>
									<td>
										<div class="btn-group btn-group-xs">
									  		<a href="#" data-href="/clock/<?php echo e($clock->id); ?>/edit" class='btn btn-xs btn-default' data-toggle="modal" data-target="#myModal"> <i class='fa fa-edit' data-toggle="tooltip" title="<?php echo trans('messages.edit'); ?>"></i> </a>
									  		<?php echo delete_form(['clock.destroy',$clock->id]); ?>

									  	</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>