<?php $__env->startSection('breadcrumb'); ?>
<ul class="breadcrumb">
		<li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		<li class="active"><?php echo trans('messages.supervisor_employee'); ?></li>
	</ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
		

		<div class="col-sm-12">
			<div class="box-info full">
				<h2><strong><?php echo trans('messages.list_all'); ?> <?php echo trans('messages.supervisor_employee'); ?>:</strong>
				<?php echo '<i>'.$supervisor_data['username'].' ('.$supervisor_data['first_name'].' '.$supervisor_data['last_name'].' '.$supervisor_data['designation'].') </i>';?>
					<div class="additional-btn">

					</div>
				</h2>

				<form id="sup_emp" name="sup_emp" action="/supervisor_employee_add" method="post">
				</form>
				<div class="col-sm-12">

				<?php

				for($i=0;$i<count($user_list);$i++)
				{
					$user_id=$user_list[$i]['id'];
					$user_username=$user_list[$i]['username'];
					$user_first_name=$user_list[$i]['first_name'];
					$user_last_name=$user_list[$i]['last_name'];
					$user_designation=$user_list[$i]['designation'];
					$user_check=$user_list[$i]['check'];

					$checked='';
					if($user_check==1){$checked='checked="checked"';}

					echo '<div class="col-md-4" style="margin-bottom: 5px;">
					<input form="sup_emp" type="checkbox" name="emp_id[]" value="'.$user_id.'" '.$checked.'> '.$user_username.' ('.$user_first_name.' '.$user_last_name.' '.$user_designation.')
					</div>';

				}
				
				?>
					
					<div class="col-sm-12 text-center">
					<hr>
					<input form="sup_emp" type="hidden" name="sup_id" value="<?php echo $_REQUEST['id'];?>">
					<button form="sup_emp" id="button" type="submit" class="btn btn-success" name="button" value="save">Save</button>
					</br></br>
					</div>
					
					</br></br>
				</div>

			</div>
		</div>
	</div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>