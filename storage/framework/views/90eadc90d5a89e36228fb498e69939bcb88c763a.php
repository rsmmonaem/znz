				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label <?php echo !isset($user_shift) ? 'class="sr-only"' : ''; ?> for="from_date"><?php echo trans('messages.from_date'); ?></label>
							<input type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="<?php echo trans('messages.from_date'); ?>" readonly="true" value="<?php echo isset($user_shift->from_date) ? $user_shift->from_date : ''; ?>">
					  	</div>
					</div>
					<div class="col-sm-4">
					  	<div class="form-group">
							<label <?php echo !isset($user_shift) ? 'class="sr-only"' : ''; ?> for="to_date"><?php echo trans('messages.to_date'); ?></label>
							<input type="text" class="form-control datepicker" id="to_date" name="to_date" placeholder="<?php echo trans('messages.to_date'); ?>" readonly="true" value="<?php echo isset($user_shift->to_date) ? $user_shift->to_date : ''; ?>">
					  	</div>
				  	</div>
					<div class="col-sm-4">
					  	<div class="form-group">
						    <?php echo Form::label('office_shift_id',trans('messages.office_shift'),['class' => !isset($user_shift) ? 'sr-only' : '']); ?>

							<?php echo Form::select('office_shift_id', [null=>trans('messages.select_one')] + $office_shifts,isset($user_shift->office_shift_id) ? $user_shift->office_shift_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

						</div>
					</div>
				  	<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

				</div>
				<div class="clear"></div>