<?php $__env->startSection('breadcrumb'); ?>
<ul class="breadcrumb">
		<li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		<li class="active"><?php echo trans('messages.appraisal_rating'); ?></li>
	</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
	

		<div class="col-sm-12">
			<div class="box-info full">
				<h2><strong><?php echo trans('messages.list_all'); ?></strong> (<?php echo count($appraisal_list_array);?>)
				<div class="additional-btn">
					<a href="/appraisal_task_add" target="_blank"><button class="btn btn-sm btn-primary" type="button"><i class="fa fa-plus icon"></i> Add New</button></a>
					</div>
				</h2>
				
				
				<div class="table-responsive">
					<div id="leave_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="row">
					<div class="col-sm-5 margin-left-10">
					<div class="dataTables_length" id="leave_table_length">
					<!--Show number of rows-->
					</div>
					<div class="dataTables_info" id="leave_table_info" role="status" aria-live="polite">
					</div>
					</div>
					<div class="col-sm-5 pull-right margin-right-10">
					<div id="leave_table_filter" class="dataTables_filter">
					<!--Search section-->
					</div></div></div>
					
					<div class="row">
					<div class="col-sm-12">
					
					<table class="table table-hover" id="supervisor_table" width="100%">

						<thead>
							<tr role="row">

							<th class="text-center" style="width: 5%;">SN.</th>
							<th class="text-center" style="width:5%;">ID</th>
							<th class="text-center" style="width:10%;">Supervisor</th>
							<th class="text-center" style="width:10%;">Employee</th>
							<th class="text-center" style="width:7%;">Period</th>
							<th class="text-center" style="width:9%;">Emp Appr</th>
							<th class="text-center" style="width:9%;">Sup Appr</th>
							<th class="text-center" style="width:8%;">HR Appr</th>
							<th class="text-center" style="width:7%;">Status</th>
							<th class="text-center" style="width:7%;">Rating</th>
							<th class="text-center" style="width:10%;">Date</th>
							<th class="text-center" style="width:13%;">Action</th>
							
							</tr>
						</thead>
						<tbody>
						
						<?php
						
						$count=count($appraisal_list_array);
						for($i=0;$i<$count;$i++)
						{
							$sn=$i+1;
							
							$id=$appraisal_list_array[$i]['id'];
							$uid=$appraisal_list_array[$i]['uid'];
							$emp_id=$appraisal_list_array[$i]['emp_id'];
							$sup_id=$appraisal_list_array[$i]['sup_id'];
							$sup_user_id=$appraisal_list_array[$i]['sup_user_id'];
							$time_period=$appraisal_list_array[$i]['time_period'];
							$user_approve=$appraisal_list_array[$i]['user_approve'];
							$sup_approve=$appraisal_list_array[$i]['sup_approve'];
							$hr_approve=$appraisal_list_array[$i]['hr_approve'];
							$status=$appraisal_list_array[$i]['status'];
							$date=$appraisal_list_array[$i]['date'];
							$time=$appraisal_list_array[$i]['time'];

							$emp_username=$appraisal_list_array[$i]['emp_username'];
							$emp_first_name=$appraisal_list_array[$i]['emp_first_name'];
							$emp_last_name=$appraisal_list_array[$i]['emp_last_name'];
							$emp_designation=$appraisal_list_array[$i]['emp_designation'];

							$sup_username=$appraisal_list_array[$i]['sup_username'];
							$sup_first_name=$appraisal_list_array[$i]['sup_first_name'];
							$sup_last_name=$appraisal_list_array[$i]['sup_last_name'];
							$sup_designation=$appraisal_list_array[$i]['sup_designation'];
							$rating=$appraisal_list_array[$i]['rating'];

							if($status==1){$status='Finished';}else{$status='Running';}
							if($user_approve==1){$user_approve='Yes';}else{$user_approve='No';}
							if($sup_approve==1){$sup_approve='Yes';}else{$sup_approve='No';}
							if($hr_approve==1){$hr_approve='Yes';}else{$hr_approve='No';}

							echo '<tr>
							<td class="text-center">'.$sn.'</td>
							<td class="text-center">'.$id.'</td>
							<td class="text-center">'.$sup_username.'<br>'.$sup_first_name.' '.$sup_last_name.'<br>'.$sup_designation.'</td>
							<td class="text-center">'.$emp_username.'<br>'.$emp_first_name.' '.$emp_last_name.'<br>'.$emp_designation.'</td>
							<td class="text-center">'.$time_period.'</td>
							<td class="text-center">'.$user_approve.'</td>
							<td class="text-center">'.$sup_approve.'</td>
							<td class="text-center">'.$hr_approve.'</td>
							<td class="text-center">'.$status.'</td>
							<td class="text-center">'.$rating.'</td>
							<td class="text-center">'.$date.'<br>'.$time.'</td>
							<td class="text-center">

							<a href="/appraisal_rating_view/?uid='.$uid.'" target="_blank">
							<button data-toggle="tooltip" title="View" class="btn btn-success btn-xs" type="button"><i class="fa fa-eye"></i> </button>
							</a>

							<a href="/appraisal_task_edit/?uid='.$uid.'" target="_blank">
							<button data-toggle="tooltip" title="Task Edit" class="btn btn-success btn-xs" type="button"><i class="fa fa-edit"></i> </button>
							</a>

							<a href="/appraisal_rating_edit/?uid='.$uid.'" target="_blank">
							<button data-toggle="tooltip" title="Rating" class="btn btn-success btn-xs" type="button"><i class="fa fa-star"></i> </button>
							</a>

							<form method="POST" action="/appraisal_rating_delete" class="form-inline" id="appraisal_delete">
							<input id="uid" name="uid" type="hidden" value="'.$uid.'">
							
							<button data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs" data-submit-confirm-text="Yes" type="submit" data-original-title="Delete"><i class="fa fa-trash-o"></i> </button></form>
							</td>
							</tr>';
						
						}

						?>
						
						
						</tbody>
						<tfoot>
						</tfoot>
					</table>
					</div>
					</div>
					
					
					<div class="row">

					<div class="col-sm-4 margin-left-10">
					<div class="dt-buttons btn-group">
					<!--print-->
					</div></div>
					
					<div class="col-sm-6 pull-right margin-right-10">
					<div class="dataTables_paginate paging_simple_numbers" id="leave_table_paginate">
					<!--Pagination-->
					</div>
					
					</div>
					</div>
					
					</div>

				</div>

			</div>
		</div>
	</div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>