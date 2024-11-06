		<div class="row">
			<div class="col-md-6">	
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<?php echo Form::label('title',trans('messages.job').' '.trans('messages.title'),[]); ?>

							<?php echo Form::input('text','title',isset($job->title) ? $job->title : '',['class'=>'form-control','placeholder'=>trans('messages.job').' '.trans('messages.title')]); ?>

						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<?php echo Form::label('no_of_post',trans('messages.no_of_post'),[]); ?>

							<?php echo Form::input('number','no_of_post',isset($job->no_of_post) ? $job->no_of_post : '',['class'=>'form-control','placeholder'=>trans('messages.no_of_post'),'min' => '1']); ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<?php echo Form::label('location',trans('messages.location'),[]); ?>

							<?php echo Form::input('text','location',isset($job->location) ? $job->location : '',['class'=>'form-control','placeholder'=>trans('messages.location')]); ?>

						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<?php echo Form::label('designation_id',trans('messages.designation'),[]); ?>

							<?php echo Form::select('designation_id', [null => trans('messages.select_one')] + $designations,isset($job->designation_id) ? $job->designation_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<?php echo Form::label('job_type',trans('messages.job_type'),[]); ?>

							<?php echo Form::select('job_type', [null => trans('messages.select_one')] + $job_types,isset($job->job_type) ? $job->job_type : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.job_type')]); ?>

						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<?php echo Form::label('date_of_closing',trans('messages.date_of_closing'),[]); ?>

						<?php echo Form::input('text','date_of_closing',isset($job->date_of_closing) ? $job->date_of_closing : '',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_closing'),'readonly' => 'true']); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">	
				<div class="form-group">
					<?php echo Form::label('description',trans('messages.description'),[]); ?>

					<?php echo Form::textarea('description',isset($job->description) ? $job->description : '',['size' => '30x9', 'class' => 'form-control summernote-big', 'placeholder' => trans('messages.description')]); ?>

				</div>
			</div>
		</div>
		<?php echo e(App\Classes\Helper::getCustomFields('job-form',$custom_field_values)); ?>

		<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>