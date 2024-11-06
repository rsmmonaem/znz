	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li class="active"><?php echo trans('messages.permission'); ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.manage'). '</strong> '.trans('messages.permission'); ?></h2>
					<?php echo Form::open(['route' => 'configuration.save-permission','role' => 'form', 'class'=>'permission-form','id' => 'permission-form','data-no-form-clear' => 1]); ?>

					  <p class="alert alert-info"><strong><?php echo trans('messages.subordinate_definition'); ?></strong></p>
					  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right','style' => 'margin:10px;']); ?>

					  	<br /><br />
					  <table class="table table-hover table-striped">
					  	<thead>
					  		<tr>
					  			<th><?php echo trans('messages.permission'); ?></th>
					  			<?php foreach(\App\Role::all() as $role): ?>
					  			<th><?php echo \App\Classes\Helper::toWord($role->name); ?></th>
					  			<?php endforeach; ?>
					  		</tr>
					  		</tr>
					  	</thead>
					  	<tbody>
					  		<?php foreach($permissions as $permission): ?>
					  			<?php if($permission->category != $category): ?>
					  			<tr style="background-color:#3498DB;color:#ffffff;"><td colspan="<?php echo count(\App\Role::all())+1; ?> "><strong><?php echo \App\Classes\Helper::toWord($permission->category).' '.trans('messages.module'); ?></strong></td></tr>
					  			<?php $category = $permission->category; ?>
					  			<?php endif; ?>
					  			<tr>
					  				<td><?php echo \App\Classes\Helper::toWord($permission->name); ?></td>
						  			<?php foreach(\App\Role::all() as $role): ?>
						  			<th><input type="checkbox" name="permission[<?php echo $role->id; ?>][<?php echo $permission->id; ?>]" value = '1' <?php echo (in_array($role->id.'-'.$permission->id,$permission_role)) ? 'checked' : ''; ?> <?php if($role->is_hidden): ?> disabled <?php endif; ?>></th>
						  			<?php endforeach; ?>
					  			</tr>
					  		<?php endforeach; ?>
					  	</tbody>
					  </table>
					  <br /><br />
					  <?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right','style' => 'margin:10px;']); ?>

					<?php echo Form::close(); ?>

					<div class="clear"></div>
				</div>
			</div>
		</div>
	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>