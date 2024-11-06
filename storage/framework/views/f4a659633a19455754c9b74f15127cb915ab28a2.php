<title><?php echo config('config.application_name') ? : config('constants.default_title'); ?></title>
<style>
*{font-family:helvetica; font-size:12px;}
table.fancy {  font-size:11px; border-collapse: collapse;  width:99%;  margin:0 auto;  margin-bottom:10px; margin-top:10px;}
table.fancy th{  border: 1px #2e2e2e solid;  padding: 0.2em;  padding-left:10px; vertical-align:top}
table.fancy th {  border:1px solid #2e2e2e; background: whitesmoke;  background: gainsboro;  text-align: left;}
table.fancy caption {  margin-left: inherit;  margin-right: inherit;}
table.fancy tr:hover{background-color:#ddd;}

table.fancy-detail {  font-size:11px; background: whitesmoke;   border-collapse: collapse;  width:99%;  margin:0 auto;  margin-bottom:10px; margin-top:10px;}
table.fancy-detail-detail-detail th{  border: 1px #2e2e2e solid;  padding: 0.2em;  padding-left:10px; vertical-align:top}
table.fancy-detail-detail th, table.fancy-detail td  {  padding: 0.2em;  padding-left:10px; border:1px solid #2e2e2e; text-align: left;}
table.fancy-detail caption {  margin-left: inherit;  margin-right: inherit;}
table.fancy-detail tr:hover{background-color:#ddd;}

</style>
<p style='text-align:center;font-size:16px; font-weight:bold;'><?php echo config('config.company_name'); ?></h2>
<p style='text-align:center;font-size:14px; font-weight:bold;'><?php echo config('config.address'); ?>

<?php echo config('config.zipcode'); ?></p>
<p style='text-align:center;'><?php echo trans('messages.email'); ?> : <?php echo config('config.email'); ?> | <?php echo trans('messages.phone'); ?> : <?php echo config('config.phone'); ?></p>
<table class="fancy">
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
		<td colspan = "2" valign="top">
			<table class="fancy-detail">
				<tr>
					<th><?php echo trans('messages.earning_salary'); ?> </th>
					<th><?php echo trans('messages.amount'); ?> </th>
				</tr>
				<?php foreach($earning_salary_types as $earning_salary_type): ?>
				<tr>
					<td><?php echo $earning_salary_type->head; ?></td>
					<td><?php echo array_key_exists($earning_salary_type->id, $payroll) ? currency($payroll[$earning_salary_type->id]) : 0; ?></td>
				</tr>
				<?php $total_earning += array_key_exists($earning_salary_type->id, $payroll) ? ($payroll[$earning_salary_type->id]) : 0; ?>
				<?php endforeach; ?>
			</table>
		</td>
		<td colspan = "2" valign="top">
			<table class="fancy-detail">
				<tr>
					<th><?php echo trans('messages.deduction_salary'); ?> </th>
					<th><?php echo trans('messages.amount'); ?> </th>
				</tr>
				<?php foreach($deduction_salary_types as $deduction_salary_type): ?>
				<tr>
					<td><?php echo $deduction_salary_type->head; ?></td>
					<td><?php echo array_key_exists($deduction_salary_type->id, $payroll) ? currency($payroll[$deduction_salary_type->id]) : 0; ?></td>
				</tr>
				<?php $total_deduction += array_key_exists($deduction_salary_type->id, $payroll) ? ($payroll[$deduction_salary_type->id]) : 0; ?>
				<?php endforeach; ?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan = "2">
			<table class="fancy-detail">
				<tr>
					<th><?php echo trans('messages.total_earning'); ?> </th>
					<th><?php echo currency($total_earning); ?></th>
				</tr>
			</table>
		</td>
		<td colspan = "2">
			<table class="fancy-detail">
				<tr>
					<th><?php echo trans('messages.total_deduction'); ?> </th>
					<th><?php echo currency($total_deduction); ?></th>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th><?php echo trans('messages.net_salary'); ?> </th>
		<th colspan = "3"><?php echo currency($total_earning-$total_deduction)." (".ucwords(App\Classes\Helper::inWords($total_earning-$total_deduction)).")"; ?> </th>
	</tr>
</table>
<p style='text-align:right;margin-right:20px;'><?php echo trans('messages.authorised_signatory'); ?></p>