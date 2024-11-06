

	<?php $__env->startSection('breadcrumb'); ?>
		<ul class="breadcrumb">
		    <li><a href="/dashboard"><?php echo trans('messages.dashboard'); ?></a></li>
		    <li><a href="/ticket"><?php echo trans('messages.ticket'); ?></a></li>
		    <li class="active"><?php echo $ticket->subject; ?></li>
		</ul>
	<?php $__env->stopSection(); ?>
	
	<?php $__env->startSection('content'); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info full">
					<h2><strong><?php echo trans('messages.ticket').'</strong> '.trans('messages.detail'); ?></h2>
					<div class="table-responsive">
						<table class="table table-hover table-striped show-table">
							<tbody>
								<tr><th><?php echo trans('messages.subject'); ?></th><td><?php echo $ticket->subject; ?></td></tr>
								<tr><th><?php echo trans('messages.employee'); ?></th><td><?php echo $ticket->UserAdded->full_name_with_designation; ?></td></tr>
								<tr><th><?php echo trans('messages.date'); ?></th><td><?php echo showDate($ticket->created_at); ?></td></tr>
								<tr><th><?php echo trans('messages.priority'); ?></th><td><?php echo trans('messages.'.$ticket->priority); ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>

				<?php if(Entrust::can('assign_ticket')): ?>
				<div class="box-info">
					<h2><strong><?php echo trans('messages.assigned_to'); ?></strong></h2>
					  <?php echo Form::model($ticket,['method' => 'POST','route' => ['ticket.assign-ticket',$ticket->id] ,'class' => 'ticket-assign-form','id' => 'ticket-assign-form','data-div-alter' => 'ticket-assigned-user','data-no-form-clear' => 1]); ?>

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
								<div class="the-notes info"><?php echo $ticket->description; ?></div>
								<div class="col-md-6">
									<h2><strong><?php echo trans('messages.assigned_to'); ?></strong></h2>
									<ul class="media-list" id="ticket-assigned-user">
									  <?php foreach($ticket->User as $user): ?>
									  <li class="media">
										<?php echo \App\Classes\Helper::getAvatar($user->id); ?>

										<div class="media-body" style="vertical-align:middle; padding-left:10px;">
										  <h4 class="media-heading"><a href="#"><?php echo e($user->full_name); ?></a> <br /> <small><?php echo e($user->Designation->full_designation); ?></small></h4>
										  <?php if($user->id == $ticket->user_id): ?>
											<span class="label label-danger pull-right">Admin</span>
										  <?php endif; ?>
										</div>
									  </li>
									  <?php endforeach; ?>
									</ul>
								</div>
								<div class="col-md-6">
									<?php if(Entrust::can('update_ticket_status')): ?>
									<h2><strong><?php echo trans('messages.update').' </strong> '.trans('messages.status'); ?></h2>
									  <?php echo Form::model($ticket,['method' => 'POST','route' => ['ticket.update-ticket-status',$ticket->id] ,'class' => 'ticket-status-form','id' => 'ticket-status-form','data-no-form-clear' => 1]); ?>

									  	<div class="form-group">
										    <?php echo Form::label('status',trans('messages.status'),[]); ?>

										    <?php echo Form::select('status', [null=>trans('messages.select_one')] + $status
										    	, isset($ticket->status) ? $ticket->status : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

									    </div>
										  <div class="form-group">
										    <?php echo Form::label('admin_remarks',trans('messages.remarks'),[]); ?>

										    <?php echo Form::textarea('admin_remarks',isset($ticket->admin_remarks) ? $ticket->admin_remarks : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => trans('messages.admin_remarks')]); ?>

										    <span class="countdown"></span>
										  </div>
									    <?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

									  <?php echo Form::close(); ?>

									<?php else: ?>
										<h2><strong><?php echo trans('messages.ticket').' </strong> '.trans('messages.status'); ?></h2>
										<div class="table-responsive">
											<table class="table table-hover table-striped show-table">
												<tbody>
													<tr><th><?php echo trans('messages.status'); ?></th><td>
														<?php if($ticket->status == 'open'): ?>
															<span class="badge badge-danger"><?php echo trans('messages.open'); ?></span>
														<?php else: ?>
															<span class="badge badge-success"><?php echo trans('messages.close'); ?></span>
														<?php endif; ?>
													</td></tr>
													<?php if($ticket->status == 'close'): ?>
													<tr><th><?php echo trans('messages.closed_at'); ?></th><td><?php echo showDate($ticket->closed_at); ?></td></tr>
													<tr><th><?php echo trans('messages.remarks'); ?></th><td><?php echo $ticket->admin_remarks; ?></td></tr>
													<?php endif; ?>
												</tbody>
											</table>
											</div>
									<?php endif; ?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="comment">
							<div class="user-profile-content">
								<?php echo Form::model($ticket,['method' => 'POST','route' => ['ticket-comment.store',$ticket->id] ,'class' => 'ticket-comment-form','id' => 'ticket-comment-form','data-list-alter' => 'ticket-comment-lists']); ?>

								  <div class="form-group">
								    <?php echo Form::textarea('comment','',['size' => '30x3', 'class' => 'form-control ', 'placeholder' => trans('messages.comment'),'data-autoresize' => 1]); ?>

								    <span class="countdown"></span>
								  </div>
								  <?php echo Form::submit(trans('messages.post'),['class' => 'btn btn-primary pull-right btn-sm']); ?>

								<?php echo Form::close(); ?>

								<div class="clear"></div>

								<h2><strong><?php echo trans('messages.comment'); ?></strong> <?php echo trans('messages.list'); ?></h2>
								<div class="scroll-widget" id="ticket-comment-lists">
									<ul class="media-list">
									<?php if($ticket->TicketComment): ?>
										<?php foreach($ticket->TicketComment->sortByDesc('id') as $ticket_comment): ?>
										  <li class="media">
											<a class="pull-left" href="#">
											  <?php echo App\Classes\Helper::getAvatar($ticket_comment->user_id); ?>

											</a>
											<div class="media-body">
											  <h4 class="media-heading"><a href="#"><?php echo $ticket_comment->User->full_name; ?></a> <small><?php echo showDateTime($ticket_comment->created_at); ?></small>
											  <?php if(Auth::user()->id == $ticket_comment->user_id): ?>
												<div class="pull-right"><?php echo delete_form(['ticket-comment.destroy',$ticket_comment->id]); ?></div>
											  </h4>
										      <?php endif; ?>
											  <div class="the-notes danger" style="margin-top:10px; background-color:#f1f1f1;"><?php echo $ticket_comment->comment; ?></div>
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
								<?php echo Form::model($ticket,['method' => 'POST','route' => ['ticket-note.store',$ticket->id] ,'class' => 'ticket-note-form','id' => 'ticket-note-form','data-no-form-clear' => 1]); ?>

								   <div class="form-group">
								    <?php echo Form::textarea('note',(count($ticket->TicketNote) && $ticket->TicketNote->whereLoose('user_id',Auth::user()->id)) ? $ticket->TicketNote->whereLoose('user_id',Auth::user()->id)->first()->note : '',['size' => '30x10', 'class' => 'form-control notebook', 'placeholder' => trans('messages.note')]); ?>

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
								<?php echo Form::model($ticket,['files'=>'true','method' => 'POST','route' => ['ticket-attachment.store',$ticket->id] ,'class' => 'ticket-attachment-form','id' => 'ticket-attachment-form','data-table-alter' => 'ticket-attachment-table']); ?>

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
									<table class="table table-hover table-striped table-bordered table-ajax-load"  id="ticket-attachment-table" data-source="/ticket-attachment/<?php echo e($ticket->id); ?>/lists">
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