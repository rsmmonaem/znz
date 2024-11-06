


	<?php $__env->startSection('breadcrumb'); ?>
	<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.supervisor_list'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>

	<div class="row">
			<!-- <?php if(Entrust::can('create_employee')): ?> -->
			<div class="col-sm-12 collapse" id="box-detail">
				<div class="box-info">
					<h2><strong><?php echo trans('messages.add_new'); ?></strong> <?php echo trans('messages.supervisor_list_menu'); ?>

					<div class="additional-btn">
						<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i class="fa fa-minus icon"></i> <?php echo trans('messages.hide'); ?></button>
					</div></h2>

					<div class="col-md-12">


					<form id="supervisor_add" name="supervisor_add" action="/supervisor_add" method="post">
					
					<div class="row">
						<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="form-group">
								
								    <label for="designation_id" class="control-label">Select Employer</label>

									<select id="user_id" class="form-control" title="Supervisor" name="user_id" requard="requard">
									
								<?php
								
									$count=count($user_list);
									for($i=0;$i<$count;$i++)
									{
										$user_id=$user_list[$i]['id'];
										$user_username=$user_list[$i]['username'];
										$user_first_name=$user_list[$i]['first_name'];
										$user_last_name=$user_list[$i]['last_name'];
										$designation=$user_list[$i]['designation'];
										
										echo '<option value="'.$user_id.'">'.$user_username.' ('.$user_first_name.' '.$user_last_name.' '.$designation.')</option>';
									}
								
								?>
									</select>
								</div>
							</div>

						<div class="col-md-2">
							<div class="form-group">
							
									<button type="submit" class="btn btn-primary" name="button" value="add" style="margin-top: 23px;">Add</button>
								</div>
							</div>

						</div>
					</div>

					</form>

					
				</div>
			</div>
			<!-- <?php endif; ?> -->

			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.list_all'); ?></strong> <?php echo trans('messages.supervisor_list_menu'); ?> (<?php echo count($supervis_list);?>)
						<div class="additional-btn">
							<!-- <?php if(Entrust::can('create_employee')): ?> -->
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> <?php echo trans('messages.add_new'); ?></button></a>
						<!-- 	<?php endif; ?> -->
						
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
								<th class="text-center" style="width:10%;">ID</th>
								<th class="text-center" style="width:10%;">User Name</th>
								<th class="text-center" style="width:10%;">Name</th>
								<th class="text-center" style="width:15%;">Designations</th>
								<th class="text-center" style="width:10%;">Mail</th>
								<th class="text-center" style="width:10%;">Employee</th>
								<th class="text-center" style="width:10%;">Date</th>
								<th class="text-center" style="width:10%;">Time</th>
								<th class="text-center" style="width:10%;">Action</th>
								
								</tr>
							</thead>
							<tbody>
							
							<?php
							
							$count=count($supervis_list);
							for($i=0;$i<$count;$i++)
							{
								$sn=$i+1;
								$supervis_id=$supervis_list[$i]['id'];
								$supervis_user_id=$supervis_list[$i]['user_id'];
								$supervis_username=$supervis_list[$i]['username'];
								$supervis_first_name=$supervis_list[$i]['first_name'];
								$supervis_last_name=$supervis_list[$i]['last_name'];
								$supervis_mail=$supervis_list[$i]['mail'];
								$supervis_designation=$supervis_list[$i]['designation'];
								$supervis_status=$supervis_list[$i]['status'];
								$supervis_date=$supervis_list[$i]['date'];
								$supervis_time=$supervis_list[$i]['time'];
								$supervis_employee=$supervis_list[$i]['employee'];

								echo '<tr>
								<td class="text-center">'.$sn.'</td>
								<td class="text-center">'.$supervis_user_id.'</td>
								<td class="text-center">'.$supervis_username.'</td>
								<td class="text-center">'.$supervis_first_name.' '.$supervis_last_name.'</td>
								<td class="text-center">'.$supervis_designation.'</td>
								<td class="text-center">'.$supervis_mail.'</td>
								<td class="text-center">'.$supervis_employee.'</td>
								<td class="text-center">'.$supervis_date.'</td>
								<td class="text-center">'.$supervis_time.'</td>
								<td class="text-center">

								<a href="/supervisor_employee/?id='.$supervis_id.'&user_id='.$supervis_user_id.'" target="_blank">
								<button data-toggle="tooltip" title="Add Employee" class="btn btn-success btn-xs" type="button" data-original-title="Add Employee"><i class="fa fa-user-plus"></i> </button>
								</a>

								<form method="POST" action="/supervisor_delete" class="form-inline" id="supervisor_delete">
								<input id="id" name="id" type="hidden" value="'.$supervis_id.'">
								
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