			<div class="col-sm-6">
			  <div class="form-group">
			    <?php echo Form::label('application_name',trans('messages.application_name'),[]); ?>

				<?php echo Form::input('text','application_name',(config('config.application_name')) ? : '',['class'=>'form-control','placeholder'=>trans('messages.application_name')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('timezone_id',trans('messages.timezone'),[]); ?>

				<?php echo Form::select('timezone_id', [null=>trans('messages.select_one')] + config('timezone'),(config('config.timezone_id')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('default_currency',trans('messages.default_currency'),[]); ?>

				<?php echo Form::input('text','default_currency',(config('config.default_currency')) ? : '',['class'=>'form-control','placeholder'=>trans('messages.default_currency')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('default_currency_symbol',trans('messages.default_currency_symbol'),[]); ?>

				<?php echo Form::input('text','default_currency_symbol',(config('config.default_currency_symbol')) ? : '',['class'=>'form-control','placeholder'=>trans('messages.default_currency_symbol')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('currency_decimal',trans('messages.currency_decimal'),[]); ?>

				<?php echo Form::input('number','currency_decimal',(config('config.currency_decimal')) ? : '',['max' => '5','min' => 0, 'class'=>'form-control','placeholder'=>trans('messages.currency_decimal')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('currency_position',trans('messages.currency_position'),[]); ?>

				<?php echo Form::select('currency_position', ['prefix' => trans('messages.prefix'), 'suffix' => trans('messages.suffix')],(config('config.currency_position')) ? : 'prefix',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('default_language',trans('messages.default_language'),[]); ?>

				<?php echo Form::select('default_language', [null=>trans('messages.select_one')] + $languages,(config('config.default_language')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('direction',trans('messages.direction'),[]); ?>

				<?php echo Form::select('direction', ['ltr'=>trans('messages.ltr'),
					'rtl' => trans('messages.rtl')],(config('config.direction')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

			  </div>
			  <div class="form-group">
			    <?php echo Form::label('allowed_upload_file',trans('messages.allowed_upload_file_type'),[]); ?>

				<?php echo Form::input('text','allowed_upload_file',(config('config.allowed_upload_file')) ? : '',['class'=>'form-control select2dynamictag','placeholder'=>trans('messages.allowed_upload_file_type')]); ?>

			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    <?php echo Form::label('notification_position',trans('messages.notification_position'),[]); ?>

				<?php echo Form::select('notification_position', [
					'toast-top-right'=>trans('messages.top_right'),
					'toast-top-left' => trans('messages.top_left'),
					'toast-bottom-right' => trans('messages.bottom_right'),
					'toast-bottom-left' => trans('messages.bottom_left')
					],(config('config.notification_position')) ? : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

			  </div>
			  <div class="form-group">
				<?php echo Form::label('application_setup_info',trans('messages.application_setup_info'),['class' => ' control-label']); ?>

				<div class="radio">
					<label>
						<?php echo Form::radio('application_setup_info', '1', (config('config.application_setup_info')) ? 'checked' : '').' '.trans('messages.yes'); ?>

					</label>
					<label>
						<?php echo Form::radio('application_setup_info', '0', (!config('config.application_setup_info')) ? 'checked' : '').' '.trans('messages.no'); ?>

					</label>
				</div>
			  </div>
			  <div class="form-group">
			    <?php echo Form::label('error_display',trans('messages.error_display'),['class' => 'control-label ']); ?>

				<div class="radio">
					<label>
						<?php echo Form::radio('error_display', 1, (config('config.error_display') == 1) ? 'checked' : '').' '.trans('messages.show'); ?>

					</label>
					<label>
						<?php echo Form::radio('error_display', 0, (config('config.error_display') == 0) ? 'checked' : '').' '.trans('messages.hide'); ?>

					</label>
				</div>
			  </div>
			  <div class="form-group">
			    <?php echo Form::label('time_format',trans('messages.time_format'),['class' => 'control-label']); ?>

				<div class="radio">
					<label>
						<?php echo Form::radio('time_format', '24hrs', (config('config.time_format') == '24hrs') ? 'checked' : '').' 24 '.trans('messages.hours'); ?>

					</label>
					<label>
						<?php echo Form::radio('time_format', '12hrs', (config('config.time_format') == '12hrs') ? 'checked' : '').' 12 '.trans('messages.hours'); ?>

					</label>
				</div>
			  </div>
			  <div class="form-group">
			    <?php echo Form::label('date_format',trans('messages.date_format'),['class' => 'control-label']); ?>

				<div class="radio">
					<label>
						<?php echo Form::radio('date_format', 'dd mm YYYY', (config('config.date_format') == 'dd mm YYYY') ? 'checked' : ''); ?> dd-mm-YYYY (<?php echo date('d-m-Y'); ?>)
					</label>
				</div>
				<div class="radio">
					<label>
						<?php echo Form::radio('date_format', 'mm dd YYYY', (config('config.date_format') == 'mm dd YYYY') ? 'checked' : ''); ?> mm-dd-YYYY (<?php echo date('m-d-Y'); ?>)
					</label>
				</div>
				<div class="radio">
					<label>
						<?php echo Form::radio('date_format', 'dd MM YYYY', (config('config.date_format') == 'dd MM YYYY') ? 'checked' : ''); ?> dd-MM-YYYY (<?php echo date('d-M-Y'); ?>)
					</label>
				</div>
				<div class="radio">
					<label>
						<?php echo Form::radio('date_format', 'MM dd YYYY', (config('config.date_format') == 'MM dd YYYY') ? 'checked' : ''); ?> MM-dd-YYYY (<?php echo date('M-d-Y'); ?>)
					</label>
				</div>
			  </div>
			  	<?php echo Form::hidden('config_type','system'); ?>

			  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

			</div>
			<div class="clear"></div>