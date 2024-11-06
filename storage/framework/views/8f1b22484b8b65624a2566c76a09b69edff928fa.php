

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/payroll"><?php echo trans('messages.payroll'); ?></a></li>
		    <li class="active"><?php echo $user->full_name_with_designation.' '.trans('messages.payslip').' '.trans('messages.from').' '.showDate($payroll_slip->from_date).' '.trans('messages.to').' '.showDate($payroll_slip->to_date); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
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
			</div>
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong><?php echo e(trans('messages.payslip')); ?></strong>
					<div class="additional-btn">
						<a href="/payroll/generate/mail/<?php echo e($payroll_slip->id); ?>" data-toggle="tooltip" title="<?php echo e(trans('messages.mail')); ?>"><button class="btn btn-xs btn-success"><i class="fa fa-envelope icon"></i></button></a>
						<a href="/payroll/generate/print/<?php echo e($payroll_slip->id); ?>" target="_blank" data-toggle="tooltip" title="<?php echo e(trans('messages.print')); ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-print icon"></i></button></a>
						<a href="/payroll/generate/pdf/<?php echo e($payroll_slip->id); ?>" data-toggle="tooltip" title="<?php echo e(trans('messages.generate_pdf')); ?>"><button class="btn btn-xs btn-warning"><i class="fa fa-file-pdf-o icon"></i></button></a>
						<a href="/payroll/<?php echo e($payroll_slip->id); ?>/edit" data-toggle="modal" data-target="#myModal"><button class="btn btn-xs btn-default" data-toggle="tooltip" title="<?php echo e(trans('messages.edit')); ?>"><i class="fa fa-edit icon"></i></button></a>
						<?php echo delete_form(['payroll.destroy',$payroll_slip->id]); ?>

					</div>
					</h2>
					<div class="table-responsive">
						<table class="table table-stripped table-hover table-bordered">
							<tr>
								<th><?php echo trans('messages.name'); ?> </th>
								<th><?php echo $user->full_name; ?></th>
								<th><?php echo trans('messages.employee_code'); ?> </th>
								<th><?php echo $user->Profile->employee_code; ?></th>
							</tr>
							<tr>
								<th><?php echo trans('messages.department'); ?> </th>
								<th><?php echo $user->Designation->Department->name; ?></th>
								<th><?php echo trans('messages.designation'); ?> </th>
								<th><?php echo $user->Designation->name; ?></th>
							</tr>
							<tr>
								<th><?php echo trans('messages.duration'); ?> </td>
								<th><?php echo showDate($payroll_slip->from_date).' '.trans('messages.to').' '.showDate($payroll_slip->to_date); ?></th>
								<th><?php echo trans('messages.payslip_no'); ?> </td>
								<th><?php echo str_pad($payroll_slip->id, 3, 0, STR_PAD_LEFT); ?></th>
							</tr>
							<tr>
								<td colspan = "2" valign="top" style="padding:0px;">
									<table class="table" style="border:0px">
										<thead>
											<tr>
												<th><?php echo trans('messages.earning_salary'); ?> </th>
												<td align="right"><?php echo trans('messages.amount'); ?> </td>
											</tr>
										</thead>
										<?php $total_earning = 0; ?>
										<tbody>
										<?php foreach($earning_salary_types as $earning_salary_type): ?>
										<tr>
											<td><?php echo $earning_salary_type->head; ?></td>
											<td align="right"><?php echo array_key_exists($earning_salary_type->id, $payroll) ? currency($payroll[$earning_salary_type->id]) : 0; ?></td>
										</tr>
										<?php $total_earning += array_key_exists($earning_salary_type->id, $payroll) ? ($payroll[$earning_salary_type->id]) : 0; ?>
										<?php endforeach; ?>
										</tbody>
									</table>
								</td>
								<td colspan = "2" valign="top" style="padding:0px;">
									<table class="table">
										<thead>
										<tr>
											<th><?php echo trans('messages.deduction_salary'); ?> </th>
											<td align="right"><?php echo trans('messages.amount'); ?> </td>
										</tr>
										</thead>
										<?php $total_deduction = 0; ?>
										<tbody>
										<?php foreach($deduction_salary_types as $deduction_salary_type): ?>
										<tr>
											<td><?php echo $deduction_salary_type->head; ?></td>
											<td align="right"><?php echo array_key_exists($deduction_salary_type->id, $payroll) ? currency($payroll[$deduction_salary_type->id]) : 0; ?></td>
										</tr>
										<?php $total_deduction += array_key_exists($deduction_salary_type->id, $payroll) ? ($payroll[$deduction_salary_type->id]) : 0; ?>
										<?php endforeach; ?>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="padding:0px;">
									<table class="table">
										<thead>
											<tr>
												<td class="strong-text"><?php echo trans('messages.total_earning'); ?> </td>
												<td class="pull-right strong-text"><?php echo currency($total_earning); ?></td>
											</tr>
										</thead>
									</table>
								</td>
								<td colspan="2" style="padding:0px;">
									<table class="table">
										<thead>
											<tr>
												<td class="strong-text"><?php echo trans('messages.total_deduction'); ?> </td>
												<td class="pull-right strong-text"><?php echo currency($total_deduction); ?></td>
											</tr>
										</thead>
									</table>
								</td>
							</tr>
							<tr>
								<th><?php echo trans('messages.net_salary'); ?> </th>
								<th colspan="3"><?php echo currency($total_earning-$total_deduction)." (".ucwords(App\Classes\Helper::inWords($total_earning-$total_deduction)).")"; ?> </th>
							</tr>
						</table>
						<p class="pull-right" style="margin-top:20px;margin-right:10px;"><?php echo trans('messages.authorised_signatory'); ?></p>
					</div>
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
		</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>