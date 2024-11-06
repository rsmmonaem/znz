

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/payroll"><?php echo trans('messages.payroll'); ?></a></li>
		    <li class="active"><?php echo trans('messages.generate'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.select'); ?> </strong> <?php echo trans('messages.option'); ?></h2>
					<?php echo Form::open(['route' => 'payroll.create','role' => 'form', 'class'=>'payroll-form','id' => 'payroll-form','data-submit' => 'noAjax']); ?>

					  <div class="form-group">
					    <?php echo Form::label('from_date',trans('messages.from_date'),[]); ?>

						<?php echo Form::input('text','from_date',isset($from_date) ? $from_date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.from_date'),'readonly' => 'true']); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('to_date',trans('messages.to_date'),[]); ?>

						<?php echo Form::input('text','to_date',isset($to_date) ? $to_date : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.to_date'),'readonly' => 'true']); ?>

					  </div>
					  <div class="form-group">
					    <?php echo Form::label('user_id',trans('messages.employee'),['class' => 'control-label']); ?>

					    <?php echo Form::select('user_id', [''=>''] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

					  </div>
					  <?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.get'),['class' => 'btn btn-primary pull-right','name' => 'submit']); ?>

					<?php echo Form::close(); ?>

				</div>
				<?php if(isset($att_summary)): ?>
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.attendance').' </strong>'.trans('messages.summary'); ?></h2>
					<div class="table-responsive">
						<table class="table table-hover table-striped show-table">
							<tbody>
								<tr>
									<th><?php echo trans('messages.absent'); ?></th>
									<td><?php echo $att_summary['A']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.holiday'); ?></th>
									<td><?php echo $att_summary['H']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.present'); ?></th>
									<td><?php echo $att_summary['P']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.leave'); ?></th>
									<td><?php echo $att_summary['L']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.late'); ?></th>
									<td><?php echo $att_summary['Late']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.overtime'); ?></th>
									<td><?php echo $att_summary['Overtime']; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.early').' '.trans('messages.leaving'); ?></th>
									<td><?php echo $att_summary['Early']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php endif; ?>
				<?php if(isset($summary)): ?>
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.hour').' </strong>'.trans('messages.summary'); ?></h2>
					<div class="table-responsive">
						<table class="table table-hover table-striped show-table">
							<tbody>
								<tr>
									<th><?php echo trans('messages.total_late'); ?></th>
									<td><?php echo array_key_exists('total_late',$summary) ? $summary['total_late'] : '-'; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.total_early'); ?></th>
									<td><?php echo array_key_exists('total_early',$summary) ? $summary['total_early'] : '-'; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.total_rest'); ?></th>
									<td><?php echo array_key_exists('total_rest',$summary) ? $summary['total_rest'] : '-'; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.total_overtime'); ?></th>
									<td><?php echo array_key_exists('total_overtime',$summary) ? $summary['total_overtime'] : '-'; ?></td>
								</tr>
								<tr>
									<th><?php echo trans('messages.total_work'); ?></th>
									<td><?php echo array_key_exists('total_working',$summary) ? $summary['total_working'] : '-'; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php endif; ?>
			</div>

			<?php if(isset($user)): ?>
			<div class="col-sm-8">
				<div class="box-info">
					<?php echo Form::open(['route' => 'payroll.store','role' => 'form', 'class'=>'payroll-store-form','id' => 'payroll-store-form','data-submit' => 'noAjax']); ?>

					<?php echo Form::hidden('user_id',$user_id); ?>

					<?php echo Form::hidden('from_date',$from_date); ?>

					<?php echo Form::hidden('to_date',$to_date); ?>

						<?php echo $__env->make('payroll._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo Form::close(); ?>	
				</div>
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.monthly'); ?></strong> <?php echo trans('messages.salary'); ?> <?php echo $user->full_name_with_designation; ?></h2>
					<?php if(count($salaries)): ?>
					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th><?php echo trans('messages.salary_head'); ?></th>
									<th><?php echo trans('messages.type'); ?></th>
									<th><?php echo trans('messages.amount'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($salaries as $salary): ?>
									<tr>
										<td><?php echo $salary->SalaryType->head; ?></td>
										<td><?php echo ucfirst($salary->SalaryType->salary_type); ?></td>
										<td><?php echo currency($salary->amount); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php else: ?>
						<?php echo $__env->make('common.notification',['message' => trans('messages.salary_not_set'),'type' => 'danger'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>