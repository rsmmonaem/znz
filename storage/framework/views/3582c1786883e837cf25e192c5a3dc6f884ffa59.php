									<div class="col-sm-5">
										<div class="form-group">
									    <?php echo Form::label('relation',trans('messages.relation')); ?>

										<?php echo Form::select('relation', [null=>trans('messages.select_one')] + $employee_relation,isset($contact->relation) ? $contact->relation : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

										</div>
										<div class="checkbox">
											<label>
											  <?php echo Form::checkbox('is_primary', 1,(isset($contact) && $contact->is_primary) ? 'checked' : ''); ?> <?php echo trans('messages.primary_contact'); ?>

											</label>
											<label>
											  <?php echo Form::checkbox('is_dependent', 1,(isset($contact) && $contact->is_dependent) ? 'checked' : ''); ?> <?php echo trans('messages.dependent'); ?>

											</label>
										</div>
										<div class="form-group">
									    <?php echo Form::label('name',trans('messages.name')); ?>

										<?php echo Form::input('text','name',isset($contact->name) ? $contact->name : '',['class'=>'form-control','placeholder'=>trans('messages.name')]); ?>

										</div>
										<div class="form-group">
									    <?php echo Form::label('work_phone',trans('messages.phone')); ?>

										<div class="row">
											<div class="col-xs-8">
											<?php echo Form::input('text','work_phone',isset($contact->work_phone) ? $contact->work_phone : '',['class'=>'form-control','placeholder'=>trans('messages.work')]); ?>

											</div>
											<div class="col-xs-4">
											<?php echo Form::input('text','work_phone_extension',isset($contact->work_phone_extension) ? $contact->work_phone_extension : '',['class'=>'form-control','placeholder'=>trans('messages.ext')]); ?>

											</div>
										</div>
										<br />
										<?php echo Form::input('text','mobile',isset($contact->mobile) ? $contact->mobile : '',['class'=>'form-control','placeholder'=>trans('messages.mobile')]); ?>

										<br />
										<?php echo Form::input('text','home',isset($contact->home) ? $contact->home : '',['class'=>'form-control','placeholder'=>trans('messages.home')]); ?>

									</div>
								</div>
								<div class="col-sm-7">
			    				  	<div class="form-group">
									    <?php echo Form::label('email',trans('messages.email')); ?>

										<?php echo Form::input('text','work_email',isset($contact->work_email) ? $contact->work_email : '',['class'=>'form-control','placeholder'=>trans('messages.work')]); ?>

										<br />
										<?php echo Form::input('text','personal_email',isset($contact->personal_email) ? $contact->personal_email : '',['class'=>'form-control','placeholder'=>trans('messages.personal')]); ?>

									</div>
									<div class="form-group">
									    <?php echo Form::label('address',trans('messages.address'),[]); ?>

										<?php echo Form::input('text','address_1',isset($contact->address_1) ? $contact->address_1 : '',['class'=>'form-control','placeholder'=>trans('messages.address_line_1')]); ?>

										<br />
										<?php echo Form::input('text','address_2',isset($contact->address_2) ? $contact->address_2 : '',['class'=>'form-control','placeholder'=>trans('messages.address_line_2')]); ?>

										<br />
										<div class="row">
											<div class="col-xs-5">
											<?php echo Form::input('text','city',isset($contact->city) ? $contact->city : '',['class'=>'form-control','placeholder'=>trans('messages.city')]); ?>

											</div>
											<div class="col-xs-4">
											<?php echo Form::input('text','state',isset($contact->state) ? $contact->state : '',['class'=>'form-control','placeholder'=>trans('messages.state')]); ?>

											</div>
											<div class="col-xs-3">
											<?php echo Form::input('text','zipcode',isset($contact->zipcode) ? $contact->zipcode : '',['class'=>'form-control','placeholder'=>trans('messages.zipcode')]); ?>

											</div>
										</div>
										<br />
										<?php echo Form::select('country_id', [null=>trans('messages.select_one')] + config('country'),isset($contact->country_id) ? $contact->country_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

									</div>
									<?php echo Form::hidden('type','contact'); ?>

									<?php echo Form::submit(isset($buttonText) ? $buttonText : trans('messages.add'),['class' => 'btn btn-primary pull-right']); ?>

								</div>
								<div class="clear"></div>