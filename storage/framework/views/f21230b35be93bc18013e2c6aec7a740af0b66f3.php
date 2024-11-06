			<div class="col-sm-12">
				<?php echo Form::label('enable_job_application_candidates',trans('messages.enable_job_application_candidates'),['class' => 'control-label']); ?>

				<div class="radio">
					<label>
						<?php echo Form::radio('enable_job_application_candidates', '1', (config('config.enable_job_application_candidates') == '1') ? 'checked' : ''); ?> <?php echo trans('messages.yes'); ?>

					</label>
					<label>
						<?php echo Form::radio('enable_job_application_candidates', '0', (config('config.enable_job_application_candidates') != '1') ? 'checked' : ''); ?> <?php echo trans('messages.no'); ?>

					</label>
				</div>
			  <div class="form-group">
			    <?php echo Form::label('application_format',trans('messages.job_application_file_format'),['class' => 'control-label']); ?>

				<?php echo Form::input('text','application_format',(config('config.application_format')) ? : '',['class'=>'form-control select2dynamictag','placeholder'=>trans('messages.application_format')]); ?>

			  </div>
			  <?php echo Form::hidden('config_type','job'); ?>

				<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary']); ?>

			</div>
			<div class="clear"></div>
