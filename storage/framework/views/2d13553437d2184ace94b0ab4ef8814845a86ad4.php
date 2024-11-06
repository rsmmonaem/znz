


<?php $__env->startSection('breadcrumb'); ?>
<ul class="breadcrumb">
		<li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		<li class="active"><?php echo trans('messages.appraisal_task_edit'); ?></li>
	</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
		
		<div class="col-sm-12">
			<div class="box-info">
				<h2><strong><?php echo trans('messages.edit'); ?></strong> Task
				</h2>
				<!--write content start-->

				
				<div class="col-sm-12">
				<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
				<!--body form start-->

				<form class="" id="update_task_form" name="update_task_form" action="/appraisal_task_update" method="post">
				</form>
				<div class="form-group">
				<label for="" class="control-label">Time Period*</label>
				<select form="update_task_form" class="form-control" title="Time Period" name="time_period" required="required">
				
				<?php
				
				$time_period=$appraisal_data_array[0]['time_period'];
				 for($i=2020; $i<=date('Y')+2;$i++)
				{
					$selected='';

					if($time_period==$i){$selected='selected="selected"';}

					echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
				} 

				?>
				</select> 
				</div>
				<div class="form-group">
				<label for="" class="control-label">Employee*</label>
				<input type="text" class="form-control" title="Employee" value="<?php				
					echo $appraisal_data_array[0]['emp_username'].' ('.$appraisal_data_array[0]['emp_first_name'].' '.$appraisal_data_array[0]['emp_last_name'].' '.$appraisal_data_array[0]['emp_designation'].')';
				?>
				" readonly="readonly"/> 
				</div>

				<div class="form-group">
				<label for="" class="control-label">Objective*</label>
				<textarea form="update_task_form" class="form-control" name="objective" rows="3" required="required"><?php echo $appraisal_data_array[0]['objective'];?></textarea>
				</div>

				<div class="form-group">
				<label for="" class="control-label">Expected Result*</label>
				<textarea form="update_task_form" class="form-control" name="expected_result" rows="3" required="required"><?php echo $appraisal_data_array[0]['expected_result'];?></textarea>
				</div>

				<div id="task_section">

				<?php

				for($i=0;$i<count($appraisal_task_array);$i++){

					$num=$i+1;
					$id=$appraisal_task_array[$i]['id'];
					$uid=$appraisal_task_array[$i]['uid'];
					$objective=$appraisal_task_array[$i]['objective'];
					$expected_result=$appraisal_task_array[$i]['expected_result'];
					$task=$appraisal_task_array[$i]['task'];
					$deadline=$appraisal_task_array[$i]['deadline'];
					$priority=$appraisal_task_array[$i]['priority'];

				echo '
				
				<div id="field_3_'.$uid.'" class="form-group">
				<div class="row">
				<div class="col-md-7">
				<label for="" class="control-label">Task Title '.$num.'</label>
				<input form="update_task_form" type="text" class="form-control" name="old_task[]" value="'.$task.'" required="required">
				<input form="update_task_form" type="hidden" name="old_task_uid[]" value="'.$uid.'">
				</div>
				<div class="col-md-3">
				<label for="" class="control-label">Deadline</label>
				<input form="update_task_form" type="date" class="form-control" name="old_date[]" required="required" value="'.$deadline.'">
				</div>
				<div class="col-md-2">
				<label for="" class="control-label">Priority</label>
				<select form="update_task_form" class="form-control" name="old_priority[]" required="required">';
				

				for($j=0;$j<=10;$j++)
				{
					$selected='';
					if($priority==$j){$selected='selected="selected"';}
					echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
				}
				
				
				
				echo '</select> 
				<i title="Delete" class="btn btn-danger btn-xs fa fa-trash-o" style="position: absolute;top: 33px;right: -10px;border-radius: 50%;" onclick="remove_task_field(\''.$uid.'\')"></i>
				</div>
				</div>
				
				</div>';
			}

				?>
				


				</div>

				<div class="form-group text-right">
				<i id="" class="btn btn-success btn-xs fa fa-plus-circle" title="Add new" onclick="add_new_task_field_2('update_task_form');"> Add New</i>
				</div>
				<div class="form-group">
				<input form="update_task_form" type="hidden" name="appraisal_uid" value="<?php echo $appraisal_data_array[0]['uid'];?>">
				<button form="update_task_form" type="submit" class="btn btn-success" name="button" value="update">Update</button>
				</div>

				
				<!--body form end-->
				</div>
				<div class="col-md-3">
				</div>
				</div>

				</div>
				


				<!--write content end-->
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>