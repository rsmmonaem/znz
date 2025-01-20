
							<li {!! (in_array('dashboard',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'dashboard') !!}><a href="{!! URL::to('/') !!}"><i class="fa fa-home icon"></i> {!! trans('messages.dashboard') !!}</a></li>
							
							@if(Entrust::can('list_employee'))

							<li  {!! (in_array('employee',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'employee') !!}><a href="#"><i class="fa fa-users icon"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.employee') !!}</a>
							    <ul {!! (in_array('employee_list',$menu) ||
											in_array('employee_list',$menu) ||
											in_array('employee_list',$menu)
								     ) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('employee_list',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_list') !!} </a></li>
									<li {!! (in_array('employee_transfer',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee/transfer') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_transfer') !!} </a></li>
									 <li {!! (in_array('employee-create',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('employee-create') !!}"><i class="fa fa-angle-right"></i> {!! trans('Create Employee') !!} </a></li>
									{{--<li {!! (in_array('employee_transfer_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('employee-transfer/report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_transfer_report') !!} </a></li> --}}
								</ul>
							</li> 
							@endif

							@if(Entrust::can('employee_separetion'))
							<li data-position="22" {!! (in_array('employee_separetion',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'employee_separetion') !!}><a href="#"><i class="fa fa-users icon"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.employee_separetion') !!}</a>
							    <ul {!! (in_array('employee_list',$menu) ||
											in_array('employee_list',$menu) ||
											in_array('employee_list',$menu)
								     ) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('employee-separation',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee-separation') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_separetion') !!} </a></li>
									<li {!! (in_array('employee_separetion_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee-separation-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_separetion_report') !!} </a></li>
								</ul>
							</li> 
							@endif

							@if(Entrust::can('promotion_increment'))
							<li data-position="23" {!! (in_array('promotion_increment',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'promotion_increment') !!}><a href="#"><i class="fa fa-trophy"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.promotion_increment') !!}</a>
							    <ul {!! (in_array('employee_list',$menu) ||
											in_array('employee_list',$menu) ||
											in_array('employee_list',$menu)
								     ) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('promotion_increment',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/increment-and-promotion') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.promotion_increment') !!} </a></li>
									@if(Entrust::can('promotion_increment_aprrove'))
									<li {!! (in_array('promotion_increment_approval',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/increment-and-promotion-approval') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.promotion_increment_approval') !!} </a></li>
									@endif
									@if(Entrust::can('promoted_employee_list'))
									<li {!! (in_array('promoted_employee_list',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/promoted-employee') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.promoted_employee_list') !!} </a></li>
									@endif
								</ul>
							</li> 
							@endif

							@if(Entrust::can('all_report'))
							<li data-position="21" {!! (in_array('reports',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'reports') !!}><a href="#"><i class="fa fa-bar-chart"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.reports') !!}</a>
							    <ul {!! (in_array('employee_list',$menu) ||
											in_array('employee_list',$menu) ||
											in_array('employee_list',$menu)
								     ) ? 'class="visible"' : '' !!}>
									{{-- Employee Report --}}
									<li {!! (in_array('employee_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee/report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_report') !!} </a></li>
									{{-- Employee Transfer Report --}}
									<li {!! (in_array('employee_transfer_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('employee-transfer/report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_transfer_report') !!} </a></li>
									{{-- Attendance Report --}}
									<li {!! (in_array('attandance_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/attendance-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.attandance_report') !!} </a></li>
									{{-- Daily Attendence Report --}}
									<li {!! (in_array('daily-attendance-report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/daily-attendance-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.daily-attendance-report') !!} </a></li>
									{{-- Leave Report --}}
									<li {!! (in_array('/leave-report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/leave-report') !!}"><i class="fa fa-angle-right"></i> Leave Report </a>
									</li>
									{{-- Employee Separetion Report --}}
									<li {!! (in_array('employee_separetion_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/employee-separation-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.employee_separetion_report') !!} </a></li>
									{{-- Promotion Increment Report --}}
									<li {!! (in_array('increment-and-promotion-report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/increment-and-promotion-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.promotion_increment_report') !!} </a></li>
									{{-- Salary Slab Report --}}
									<li {!! (in_array('salary_report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/salary-report') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.salary_slab_report') !!} </a></li>
									{{-- Salary Slip Report --}}
									<li {!! (in_array('salary-slip',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/salary-slip') !!}"><i class="fa fa-angle-right"></i> Salary Slip Panel </a></li>
									{{-- Salary Report --}}
									<li {!! (in_array('slary-shit-report',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/slary-shit-report') !!}"><i class="fa fa-angle-right"></i> Salary Report</a></li>
								</ul>
							</li> 
							@endif

							@if(Entrust::can('Salary'))
								<li data-position="24" {!! (in_array('Salary',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'Salary') !!}><a href="#"><i class="fa fa-money icon"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Salary') !!}</a>
									<ul {!! (in_array('Salary',$menu) ||
												in_array('Salary',$menu) ||
												in_array('Salary',$menu)
										) ? 'class="visible"' : '' !!}>
										@if (Entrust::can('Salary_slab'))
											<li {!! (in_array('salary_slab',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/salary-slab') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.salary_slab') !!} </a></li>
										@endif
										@if (Entrust::can('Salary_BankPart'))
											<li {!! (in_array('Salary_BankPart',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/salary-bank-part') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Salary_BankPart') !!} </a></li>
										@endif
										@if (Entrust::can('salary_advance'))
											<li {!! (in_array('salary_advance',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/salary-advance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.salary_advance') !!} </a></li>
										@endif
										@if (Entrust::can('Salary_Process'))
											<li {!! (in_array('/slary-process',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/slary-process') !!}"><i class="fa fa-angle-right"></i> Salary Process </a></li>
										@endif
										@if (Entrust::can('Salary_Sheet'))
											<li {!! (in_array('/slary-shit',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/slary-shit') !!}"><i class="fa fa-angle-right"></i> Salary Sheet </a></li>
										@endif
									</ul>
								</li> 
							@endif
							<li data-position="35" {!! (in_array('supervisor_list',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'supervisor_list') !!}><a href="#"><i class="fa fa-user-secret icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.supervisor_list_menu') !!}</a>
								<ul {!! (in_array('supervisor_list',$menu) ||
											in_array('supervisor_add',$menu) ||
											in_array('supervisor_employee',$menu)
								) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('supervisor_list',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/supervisor_list') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.supervisor_list') !!} </a></li>
									</ul>
							</li>
							
						 <li data-position="28" {!! (in_array('appraisal',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'appraisal') !!}><a href="#"><i class="fa fa-graduation-cap icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.appraisal') !!}</a>
								<ul {!! (in_array('appraisal_user',$menu) ||
											in_array('appraisal_user_edit',$menu) ||
											in_array('appraisal_user_view',$menu) ||
											in_array('appraisal_user_report',$menu)
								) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('appraisal_user',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/appraisal_user') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.appraisal_user') !!} </a></li>
								</ul>
							</li>
							
							<li data-position="29" {!! (in_array('appraisal_rating',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'appraisal_rating') !!}><a href="#"><i class="fa fa-star icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.appraisal_rating_menu') !!}</a>
								<ul {!! (in_array('appraisal_rating',$menu) ||
											in_array('appraisal_rating_edit',$menu) ||
											in_array('appraisal_rating_view',$menu) ||
											in_array('appraisal_task_add',$menu) || 
											in_array('appraisal_task_edit',$menu) || 
											in_array('appraisal_task_view',$menu)

								) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('appraisal_rating',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/appraisal_rating') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.appraisal_rating') !!} </a></li>

									<li {!! (in_array('appraisal_task_add',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/appraisal_task_add') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.appraisal_task_add') !!} </a></li>

								</ul>
							</li>
							
							<li data-position="30" {!! (in_array('appraisal_review',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'appraisal_review') !!}><a href="#"><i class="fa fa-star-o icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.appraisal_review_menu') !!}</a>
								<ul {!! (in_array('appraisal_review',$menu) 
								) ? 'class="visible"' : '' !!}>
									<li {!! (in_array('appraisal_review',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/appraisal_review') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.appraisal_review') !!} </a></li>

									
								</ul>
							</li>
							 
							
							<li data-position="23" {!! (in_array('attendance',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'attendance') !!}><a href="#"><i class="fa fa-book icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.attendance') !!}</a>
								<ul {!! (in_array('daily_attendance',$menu) ||
											in_array('date_wise_attendance',$menu) ||
											in_array('date_wise_summary_attendance',$menu) ||
											in_array('shift_detail',$menu) ||
											in_array('update_attendance',$menu)
								) ? 'class="visible"' : '' !!}>
									{{-- <li {!! (in_array('daily_attendance',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/attendance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.daily_attendance') !!} </a></li>
									<li {!! (in_array('date_wise_attendance',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/date-wise-attendance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.date_wise').' '.trans('messages.attendance') !!} </a></li>
									<li {!! (in_array('date_wise_summary_attendance',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/date-wise-summary-attendance') !!}"><i class="fa fa-angle-right"></i> <small>{!! trans('messages.date_wise').' '.trans('messages.summary').' '.trans('messages.attendance') !!}</small> </a></li>
									<li {!! (in_array('shift_detail',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/shift-detail') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.shift_detail') !!} </a></li>--}}
									@if(Entrust::can('update_attendance')) 
									<li {!! (in_array('update_attendance',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/update-attendance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.update_attendance') !!} </a></li>
									@endif
									
								</ul>
							</li>
							@if(Entrust::can('list_holiday'))
							<li {!! (in_array('holiday',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'holiday') !!}><a href="{!! URL::to('/holiday') !!}"><i class="fa fa-fighter-jet icon"></i> {!! trans('messages.holiday') !!}</a></li>
							@endif
							@if(Entrust::can('id_card'))
							 <li data-position="26" {!! (in_array('id_card',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'id_card') !!}><a href="{!! URL::to('/id-card-checklist') !!}"><i class="fa fa-tasks icon"></i> ID Card CheckList</a></li>
							@endif

							@if(Entrust::can('spacial_holiday'))
							 <li data-position="27" {!! (in_array('spacial-holiday',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'spacial_holiday') !!}><a href="{!! URL::to('/spacial-holiday') !!}"><i class="fa fa-fighter-jet icon"></i> {!! trans('Special Holiday') !!}</a></li>
							@endif
							@if(Entrust::can('whd'))
							 <li data-position="27" {!! (in_array('whd',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'whd') !!}><a href="{!! URL::to('/whd') !!}"><i class="fa fa-fighter-jet icon"></i> WHD </a></li>
							@endif

							@if(Entrust::can('whd'))
								<li data-position="27" {!! (in_array('bonus',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'bonus') !!}><a href="#"><i class="fa fa-book icon"></i><i class="fa fa-angle-double-down i-right"></i>Bonus</a>
									<ul {!! (in_array('bonus-process',$menu)) ? 'class="visible"' : '' !!}>
										@if(Entrust::can('bonus-process')) 
										<li {!! (in_array('bonus-process',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/bonus-process') !!}"><i class="fa fa-angle-right"></i> Bonus Process </a></li>
										@endif
										{{--  --}}
										@if(Entrust::can('bonus-process-summary')) 
										<li {!! (in_array('bonus-process-summary',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/bonus-process-summary') !!}"><i class="fa fa-angle-right"></i> Bonus Process Summary </a></li>
										@endif
										
									</ul>
								</li>
							@endif
							
							@if(Entrust::can('cost_unit_set_panel')) 
								<li data-position="27" {!! (in_array('bonus',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'bonus') !!}><a href="#"><i class="fa fa-money icon"></i><i class="fa fa-angle-double-down i-right"></i>Tax Process</a>
									<ul {!! (in_array('cost_unit_set_panel',$menu)) ? 'class="visible"' : '' !!}>
										@if(Entrust::can('cost_unit_set_panel')) 
										   <li {!! (in_array('cost-unit-set-panel',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/cost-unit-set-panel') !!}"><i class="fa fa-angle-right"></i> Cost Unit Set Panel</a></li>
										@endif
										@if(Entrust::can('month_wise_challan_set_panel')) 
										   <li {!! (in_array('month-wise-challan-set-panel',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/month-wise-challan-set-panel') !!}"><i class="fa fa-angle-right"></i>Month Wise Challan Set Panel</a></li>
										@endif
									
										@if(Entrust::can('month_wise_adjutment_panel')) 
										   <li {!! (in_array('month-wise-adjutment-panel',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/month-wise-adjutment-panel') !!}"><i class="fa fa-angle-right"></i>Month Wise Adjutment Panel</a></li>
										@endif
										@if(Entrust::can('cost_unit_wise_challan_list')) 
										   <li {!! (in_array('cost-unit-wise-challan-list',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/cost-unit-wise-challan-list') !!}"><i class="fa fa-angle-right"></i>Cost Unit Wise Challan List</a></li>
										@endif
										{{--  --}}
										@if(Entrust::can('tax_bank_show')) 
										   <li {!! (in_array('tax-bank-show',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/tax-bank-show') !!}"><i class="fa fa-angle-right"></i> Tax Bank </a></li>
										@endif
										@if(Entrust::can('tax_bank_branch_show')) 
										   <li {!! (in_array('tax-bank-branch-show',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/tax-bank-branch-show') !!}"><i class="fa fa-angle-right"></i> Tax Bank Branch</a></li>
										@endif
										@if(Entrust::can('tax_cost_unit_type_show')) 
										   <li {!! (in_array('tax-cost-unit-type-show',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/tax-cost-unit-type-show') !!}"><i class="fa fa-angle-right"></i> Tax Cost Unit </a></li>
										@endif
										
									</ul>
								</li>
							@endif
                          
							<li {!! (in_array('leave',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'leave') !!}><a href="#"><i class="fa fa-coffee icon"></i> <i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.leave') !!}</a>
							    <ul {!! (in_array('leave',$menu) ||
											in_array('leave',$menu) ||
											in_array('leave',$menu)
								     ) ? 'class="visible"' : '' !!}>
									@if(Entrust::can('manage_all_leave'))
									<li {!! (in_array('/leave',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/leave') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.leave_request') !!} </a>
									</li>
									@endif
									<li {!! (in_array('/leave-check',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/leave-check') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.leave_blance_check') !!} </a>
									</li>
									@if (Entrust::can('request_leave'))	
										<li {!! (in_array('/leave-apply',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/leave-apply') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.leave_apply') !!} </a>
										</li>
									@endif
									@if (Entrust::can('request_leave'))	
										<li {!! (in_array('/LeaveBulk',$menu)) ? 'class="active"' : '' !!} class="no-sort"><a href="{!! URL::to('/LeaveBulk') !!}"><i class="fa fa-angle-right"></i> {!! trans('Set Leave') !!} </a>
										</li>
									@endif
									@if (Entrust::can('manage_leave'))	
										<li {!! (in_array('leave-lists-manager',$menu)) ? 'class="active"' : '' !!} class="no-sort">
											<a href="{!! URL::to('/leave/lists-manager') !!}"><i class="fa fa-angle-right"></i> Manage Leave </a>
										</li>
									@endif
								</ul>
							</li> 


							{{-- <li {!! (in_array('leave',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'leave') !!}><a href="{!! URL::to('/leave') !!}"><i class="fa fa-coffee icon"></i> {!! trans('messages.leave') !!}</a></li> --}}


							{{-- <li {!! (in_array('payroll',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'payroll') !!}><a href="{!! URL::to('/payroll') !!}"><i class="fa fa-money icon"></i> {!! trans('messages.payroll') !!}</a></li> --}}
							@if(Entrust::can('list_announcement'))
							<li {!! (in_array('announcement',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'announcement') !!}><a href="{!! URL::to('/announcement') !!}"><i class="fa fa-list-alt icon"></i> {!! trans('messages.announcement') !!}</a></li>
							@endif
							@if(Entrust::can('list_award'))
							<li {!! (in_array('award',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'award') !!}><a href="{!! URL::to('/award') !!}"><i class="fa fa-trophy icon"></i> {!! trans('messages.award') !!}</a></li>
							@endif
							@if(Entrust::can('list_expense'))
							<li {!! (in_array('expense',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'expense') !!}><a href="{!! URL::to('/expense') !!}"><i class="fa fa-credit-card icon"></i> {!! trans('messages.expense') !!}</a></li>
							@endif
							@if(Entrust::can('list_task'))
							<li {!! (in_array('task',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'task') !!}><a href="{!! URL::to('/task') !!}"><i class="fa fa-tasks icon"></i> {!! trans('messages.task') !!}</a></li>
							@endif
							@if(Entrust::can('list_ticket'))
							<li {!! (in_array('ticket',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'ticket') !!}><a href="{!! URL::to('/ticket') !!}"><i class="fa fa-ticket icon"></i> {!! trans('messages.ticket') !!}</a></li>
							@endif
							@if(Entrust::can('manage_message'))
							<li {!! (in_array('message',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'message') !!}><a href="{!! URL::to('/message') !!}"><i class="fa fa-envelope icon"></i> {!! trans('messages.message') !!}</a></li>
							@endif
							@if(Entrust::can('list_job'))
								@if(Entrust::can('create_job'))
									<li {!! (in_array('list_job',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'job') !!}><a href="{!! URL::to('/job') !!}"><i class="fa fa-bullhorn icon"></i> {!! trans('messages.list_all').' '.trans('messages.job') !!}</a></li>
								@endif
								<li {!! (in_array('job_application',$menu)) ? 'class="active"' : '' !!} {!! menuAttr($menus,'job_application') !!}><a href="{!! URL::to('/job-application') !!}"><i class="fa fa-file-text-o icon"></i> {!! trans('messages.job').' '.trans('messages.application') !!}</a></li>
							@endif