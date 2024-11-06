

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/task"><?php echo trans('messages.task'); ?></a></li>
		    <li class="active"><?php echo $task->title; ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.task').'</strong> '.trans('messages.detail'); ?></h2>
					<div class="table-responsive">
						<table class="table table-hover table-striped show-table">
							<tbody>
								<tr><th><?php echo trans('messages.title'); ?></th><td><?php echo $task->title; ?></td></tr>
								<tr><th><?php echo trans('messages.created_by'); ?></th><td><?php echo $task->userAdded->full_name_with_designation; ?></td></tr>
								<tr><th><?php echo trans('messages.start_date'); ?></th><td><?php echo showDate($task->start_date); ?></td></tr>
								<tr><th><?php echo trans('messages.start_date'); ?></th><td><?php echo showDate($task->start_date); ?></td></tr>
								<tr><th><?php echo trans('messages.date_of_due'); ?></th><td><?php echo showDate($task->due_date); ?></td></tr>
								<tr><th><?php echo trans('messages.hours'); ?></th><td><?php echo isset($task->hours)? $task->hours.' '.trans('messages.hours') : trans('messages.na'); ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>

				<?php if(Entrust::can('assign_task')): ?>
				<div class="box-info">
					<h2><strong><?php echo trans('messages.assigned_to'); ?></strong></h2>
					  <?php echo Form::model($task,['method' => 'POST','route' => ['task.assign-task',$task->id] ,'class' => 'task-assign-form','id' => 'task-assign-form','data-div-alter' => 'task-assigned-user','data-no-form-clear' => 1]); ?>

					  	<div class="form-group">
						    <?php echo Form::label('user_id',trans('messages.employee'),[]); ?>

						    <?php echo Form::select('user_id[]', [''=>'']+$users
						    	, $selected_user,['class'=>'form-control input-xlarge select2me','multiple'=>true,'placeholder'=>trans('messages.select_one')]); ?>

					    </div>
					    <?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

					  <?php echo Form::close(); ?>

				</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-8">
				<div class="box-info full">
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-home"></i> <?php echo trans('messages.detail'); ?></a></li>
					  <li><a href="#comment" data-toggle="tab"><i class="fa fa-comment"></i> <?php echo trans('messages.comment'); ?></a></li>
					  <li><a href="#note" data-toggle="tab"><i class="fa fa-pencil"></i> <?php echo trans('messages.note'); ?></a></li>
					  <li><a href="#attachment" data-toggle="tab"><i class="fa fa-paperclip"></i> <?php echo trans('messages.attachment'); ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane animated active fadeInRight" id="detail">
							<div class="user-profile-content">
								<div class="the-notes info"><?php echo $task->description; ?></div>
								<div class="col-md-6">
									<h2><strong><?php echo trans('messages.assigned_to'); ?></strong></h2>
									<ul class="media-list" id="task-assigned-user">
									  <?php foreach($task->User as $user): ?>
									  <li class="media">
										<?php echo \App\Classes\Helper::getAvatar($user->id); ?>

										<div class="media-body" style="vertical-align:middle; padding-left:10px;">
										  <h4 class="media-heading"><a href="#"><?php echo e($user->full_name); ?></a> <br /> <small><?php echo e($user->Designation->full_designation); ?></small></h4>
										  <?php if($user->id == $task->user_id): ?>
											<span class="label label-danger pull-right">Admin</span>
										  <?php endif; ?>
										</div>
									  </li>
									  <?php endforeach; ?>
									</ul>
								</div>
								<div class="col-md-6">
									<h2><strong><?php echo trans('messages.update').' </strong> '.trans('messages.status'); ?></h2>
									<div class="progress" id="task-progress-bar">
									  <div class="progress-bar progress-bar-<?php echo App\Classes\Helper::activityTaskProgressColor($task->progress); ?>" role="progressbar" aria-valuenow="<?php echo e($task->progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($task->progress); ?>%;">
									    <?php echo e($task->progress); ?>%
									  </div>
									</div>

									<?php if(Entrust::can('update_task_progress')): ?>
									  <?php echo Form::model($task,['method' => 'POST','route' => ['task.update-task-progress',$task->id] ,'class' => 'task-progress-form','id' => 'task-progress-form','data-div-alter' => 'task-progress-bar','data-no-form-clear' => 1]); ?>

									  	<div class="form-group">
										    <?php echo Form::label('progress','Progress',[]); ?>

											<div class="input-group">
												<?php echo Form::input('number','progress',isset($task->progress) ? $task->progress : '',['class'=>'form-control','placeholder'=>'Enter Task Progress']); ?>

									    		<span class="input-group-btn">
									    			<button class="btn btn-default btn-primary" type="submit"><?php echo e(trans('messages.save')); ?></button>
												</span>
									    	</div>
									    </div>
									  <?php echo Form::close(); ?>

									<?php endif; ?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="comment">
							<div class="user-profile-content">
								<?php echo Form::model($task,['method' => 'POST','route' => ['task-comment.store',$task->id] ,'class' => 'task-comment-form','id' => 'task-comment-form','data-list-alter' => 'task-comment-lists']); ?>

								  <div class="form-group">
								    <?php echo Form::textarea('comment','',['size' => '30x3', 'class' => 'form-control ', 'placeholder' => trans('messages.comment'),'data-autoresize' => 1]); ?>

								    <span class="countdown"></span>
								  </div>
								  <?php echo Form::submit(trans('messages.post'),['class' => 'btn btn-primary pull-right btn-sm']); ?>

								<?php echo Form::close(); ?>

								<div class="clear"></div>

								<h2><strong><?php echo trans('messages.comment'); ?></strong> <?php echo trans('messages.list'); ?></h2>
								<div class="scroll-widget" id="task-comment-lists">
									<ul class="media-list">
									<?php if(count($task->TaskComment)): ?>
										<?php foreach($task->TaskComment->sortByDesc('id') as $task_comment): ?>
										  <li class="media">
											<a class="pull-left" href="#">
											  <?php echo App\Classes\Helper::getAvatar($task_comment->user_id); ?>

											</a>
											<div class="media-body">
											  <h4 class="media-heading"><a href="#"><?php echo $task_comment->User->full_name; ?></a> <small><?php echo showDateTime($task_comment->created_at); ?></small>
											  <?php if(Auth::user()->id == $task_comment->user_id): ?>
												<div class="pull-right"><?php echo delete_form(['task-comment.destroy',$task_comment->id]); ?></div>
											  </h4>
										      <?php endif; ?>
											  <div class="the-notes danger" style="margin-top:10px; background-color:#f1f1f1;"><?php echo $task_comment->comment; ?></div>
											</div>
										  </li>
										<?php endforeach; ?>
									<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="note">
							<div class="user-profile-content">
								<?php echo Form::model($task,['method' => 'POST','route' => ['task-note.store',$task->id] ,'class' => 'task-note-form','id' => 'task-note-form','data-no-form-clear' => 1]); ?>

								   <div class="form-group">
								    <?php echo Form::textarea('note',(count($task->TaskNote) && $task->TaskNote->whereLoose('user_id',Auth::user()->id)) ? $task->TaskNote->whereLoose('user_id',Auth::user()->id)->first()->note : '',['size' => '30x10', 'class' => 'form-control notebook', 'placeholder' => trans('messages.note'),'data-autoresize' => 1]); ?>

								    <span class="countdown"></span>
								   </div>
							 	<?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

								<?php echo Form::close(); ?>

								<div class="clear"></div>
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="attachment">
							<div class="user-profile-content">
								<h2><strong><?php echo trans('messages.attachment'); ?></strong></h2>
								<?php echo Form::model($task,['files'=>'true','method' => 'POST','route' => ['task-attachment.store',$task->id] ,'class' => 'task-attachment-form','id' => 'task-attachment-form','data-table-alter' => 'task-attachment-table']); ?>

								  <div class="form-group">
								    <?php echo Form::label('title',trans('messages.title'),[]); ?>

									<?php echo Form::input('text','title','',['class'=>'form-control','placeholder'=>trans('messages.title')]); ?>

								  </div>
								  <div class="form-group">
								  	<input type="file" name="attachments" id="attachments" class="btn btn-default" title="<?php echo trans('messages.select').' '.trans('messages.file'); ?>">
								  </div>
								  <div class="form-group">
								    <?php echo Form::textarea('description','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.description')]); ?>

								    <span class="countdown"></span>
								  </div>
								  <?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>	
								<?php echo Form::close(); ?>

								<div class="clear"></div>
								<h2><strong><?php echo trans('messages.attachment'); ?></strong> <?php echo trans('messages.list'); ?></h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped table-bordered table-ajax-load"  id="task-attachment-table" data-source="/task-attachment/<?php echo e($task->id); ?>/lists">
										<thead>
											<tr>
												<th><?php echo trans('messages.option'); ?></th>
												<th><?php echo trans('messages.title'); ?></th>
												<th><?php echo trans('messages.description'); ?></th>
												<th><?php echo trans('messages.date_time'); ?></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>