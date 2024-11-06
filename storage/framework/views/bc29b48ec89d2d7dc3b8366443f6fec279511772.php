									<?php if(isset($contract_lists)): ?>
									<div class="form-group">
									    <?php echo Form::label('salary_contract_id',trans('messages.contract'),['class' => '']); ?>

										<?php echo Form::select('salary_contract_id', [null=>trans('messages.select_one')] + $contract_lists,isset($contract) ? $contract->id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')]); ?>

									</div>
									<?php endif; ?>
									<div class="row">
										<div class="col-sm-6">
			    				  			<h6>(<?php echo trans('messages.earning_salary'); ?>)</h6>
					    				  	<?php foreach($earning_salary_types as $earning_salary_type): ?>
					    				  	<div class="form-group">
											    <?php echo Form::label($earning_salary_type->id,$earning_salary_type->head,[]); ?>

												<?php echo Form::input('number',$earning_salary_type->id,(isset($contract) && array_key_exists($earning_salary_type->id,$salaries)) ? round($salaries[$earning_salary_type->id]) : '',['min'=>'0','class'=>'form-control','placeholder'=> trans('messages.salary_amount'),'step' => $currency_decimal_value]); ?>

											</div>
											<?php endforeach; ?>
										</div>
			    				  		<div class="col-sm-6">
			    				  			<h6>(<?php echo trans('messages.deduction_salary'); ?>)</h6>
					    				  	<?php foreach($deduction_salary_types as $deduction_salary_type): ?>
					    				  	<div class="form-group">
											    <?php echo Form::label($deduction_salary_type->id,$deduction_salary_type->head,[]); ?>

												<?php echo Form::input('number',$deduction_salary_type->id, (isset($contract) && array_key_exists($deduction_salary_type->id,$salaries)) ? round($salaries[$deduction_salary_type->id]) : '',['min'=>'0','class'=>'form-control','placeholder'=> trans('messages.salary_amount'),'step' => $currency_decimal_value]); ?>

											</div>
											<?php endforeach; ?>
										</div>
									</div>
									<?php if(count($earning_salary_types) || count($deduction_salary_types)): ?>
									<?php echo Form::submit(trans('messages.save'),['class' => 'btn btn-primary pull-right']); ?>

									<?php endif; ?>
									<div class="clear"></div>