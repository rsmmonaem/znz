@extends('layouts.default')

	@section('breadcrumb')
		<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li class="active">{!! trans('messages.employee') !!}</li>
		</ul>
	@stop
	
	@section('content')
		<div class="row">
			@if(Entrust::can('create_employee'))
			<div class="col-sm-12 collapse" id="box-detail">
				<div class="box-info">
					<h2><strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.employee') !!}
					<div class="additional-btn">
						<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i class="fa fa-minus icon"></i> {!! trans('messages.hide') !!}</button>
					</div></h2>

					{!! Form::open(['route' => 'auth.register','role' => 'form', 'class'=>'employee-form','id' => 'employee-form','data-form-table' => 'employee_table']) !!}
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('first_name',trans('messages.first_name'),['class' => 'control-label'])!!}
									{!! Form::input('text','first_name','',['class'=>'form-control','placeholder'=>trans('messages.first_name')])!!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('last_name',trans('messages.last_name'),['class' => 'control-label'])!!}
									{!! Form::input('text','last_name','',['class'=>'form-control','placeholder'=>trans('messages.last_name')])!!}
								</div>
							</div>
						</div>	
						<div class="form-group">
						    {!! Form::label('username',trans('messages.username'),['class' => 'control-label'])!!}
							{!! Form::input('text','username','',['class'=>'form-control','placeholder'=>trans('messages.username')])!!}
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('designation_id',trans('messages.designation'),['class' => 'control-label'])!!}
									{!! Form::select('designation_id', [''=>''] + $designations,'',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
								</div>	
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('role_id',trans('messages.role'),['class' => 'control-label'])!!}
									{!! Form::select('role_id', [''=>''] + $roles,'',['class'=>'form-control input-xlarge select2me','placeholder'=>trans('messages.select_one')])!!}
								</div>	
							</div>
						</div>
						<div class="form-group">
							<div class="radio">
								<label>
									{!! Form::checkbox('send_welcome_email', '1', '').' '.trans('messages.send_welcome_email') !!}
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('date_of_joining',trans('messages.date_of_joining'))!!}
									{!! Form::input('date','date_of_joining','',['class'=>'form-control datepicker','placeholder'=>trans('messages.date_of_joining'),'readonly' => 'true'])!!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('employee_code',trans('messages.employee_code'),['class' => 'control-label'])!!}
									{!! Form::input('text','employee_code','',['class'=>'form-control','placeholder'=>trans('messages.employee_code')])!!}
								</div>
							</div>
						</div>
						<div class="form-group">
						    {!! Form::label('email',trans('messages.email'),['class' => 'control-label'])!!}
							{!! Form::input('text','email','',['class'=>'form-control','placeholder'=>trans('messages.email')])!!}
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('password',trans('messages.password'),['class' => 'control-label'])!!}
									{!! Form::input('password','password','',['class'=>'form-control','placeholder'=>trans('messages.password')])!!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								    {!! Form::label('password_confirmation',trans('messages.confirm_password'),['class' => 'control-label'])!!}
									{!! Form::input('password','password_confirmation','',['class'=>'form-control','placeholder'=>trans('messages.confirm_password')])!!}
								</div>
							</div>
						</div>
					</div>
					{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			@endif

			<div class="col-sm-12">
				<div class="box-info full" style="padding-left:30px; padding-right:30px">
					<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.employee') !!}
						<div class="additional-btn">
							@if(Entrust::can('create_employee'))
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add_new') !!}</button></a>
							@endif
						</div>
					</h2>
					  <div class="panel-section">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <select class="form-control" id="group">
                                            <option value="">Select</option>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select class="form-control" id="branch">
                                            <option value="">Select</option>
                                            @foreach ($branch as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department">
                                            <option value="">Select</option>
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="department">Designation</label>
                                        <select class="form-control" id="designation">
                                            <option value="">Select</option>
                                            @foreach ($designation as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="employeeId">Employee ID</label>
                                        <select class="form-control" id="employeeId">
                                            <option value="">Select</option>
                                            {{-- @foreach ($employee as $e)
                                                <option value="{{ $e->id }}">{{ $e->first_name }} -
                                                    {{ $e->employee_code }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6">
								   <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" id="section">
                                            <option value="">Select</option>
                                            @foreach ($section as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="grade">Grade</label>
                                        <select class="form-control" id="grade">
                                            <option value="">Select</option>
                                            @foreach ($grade as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
									
									<div class="form-group">
                                        <label for="grade">Category</label>
                                        {{-- <select class="form-control" id="category">
                                            <option value="">Select</option>
                                            @foreach ($category as $s)
                                                <option value="{{ $s->name }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select> --}}
										 @include('common.category')
                                    </div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary pull-center" id="submit">Check</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


					  {{-- @include('common.datatable',['col_heads' => $col_heads]) --}}
					<!-- Add a scrollable container for the table -->
                    <div class="table-responsive" id="table-container" style="display: none">
                        <table id="employeeTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
								    <th>Action</th>
                                    <th>SL No</th>
                                    <th>Photo</th>
									<th>ID</th>
									<th>Name</th>
									<th>Designation</th>
									<th>Department</th>
									<th>Category</th>
									<th>Date of Joining</th>
									<th>Date of Birth</th>
									<th>Blood Group</th>
									<th>Job Nature</th>
									<th>Contact Number</th>
									<th>Gender</th>
									<th>Branch</th>
									<th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic data should populate here -->
                            </tbody>
                        </table>
                    </div>
                    <!-- End of scrollable container -->


					</div>
				</div>
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.employee') !!}</strong> {!! trans('messages.statistics') !!} (Designation Wise)</h2>
					<div id="designation_wise_user_graph"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.employee') !!}</strong> {!! trans('messages.statistics') !!} (Status Wise)</h2>
					<div id="status_wise_user_graph"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.employee') !!}</strong> {!! trans('messages.statistics') !!} (Department Wise)</h2>
					<div id="department_wise_user_graph"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.employee') !!}</strong> {!! trans('messages.statistics') !!} (Role Wise)</h2>
					<div id="role_wise_user_graph"></div>
				</div>
			</div>
		</div> --}}

	@stop

	@section('javascript')
	<script type="text/javascript">
		$(document).ready(function() {
			 $('#branch').on('change', function() {
				var branch_id = $(this).val();
				$('#femployee').val('').trigger('change');
				HandleBranchWiseEmployees(branch_id, '#femployee');
			});
			$('#submit').on('click', function(){
				const table_container = $('#table-container');
				$('#submit').attr("disabled", true);
                $('#submit').text('Processing...');
                let formData = {
                    group: $('#group').val(),
                    branch: $('#branch').val(),
                    department: $('#department').val(),
                    section: $('#section').val(),
                    employeeId: $('#employeeId').val(),
                    formDate: $('#formDate').val(),
                    toDate: $('#toDate').val(),
					designation: $('#designation').val(),
					category: $('#category').val(),
					grade: $('#grade').val()
                };
				$.ajax({
					url: '/employee/lists',
					method: 'post',
					data: formData,
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
					},
					success: function (data) {
						table_container.removeAttr("style")
						$('#submit').attr("disabled", false);
                        $('#submit').text('Check');
						populateEmployeeTable(data);
					},
					error: function (xhr, status, error) {
						$('#submit').attr("disabled", false);
                        $('#submit').text('Check');
					}
				});
			});


function populateEmployeeTable(data) {
    const datatable = $('#employeeTable');
    datatable.DataTable().destroy(); // Destroy existing table instance if exists
    let tableBody = $('#employeeTable tbody');
    tableBody.empty(); // Clear existing rows

    // Append the data row
    data.forEach((item, index) => {
		const deleteAction = `
            <form method="POST" onsubmit="return confirm('Are you sure?')" action="/employee/${item.id}" style="display:inline;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                <button type="submit" class="btn btn-danger btn-xs" title="Delete">
                    <i class="fa fa-trash"></i>
                </button>
            </form>`;

        const actions = `
            <div class="btn-group btn-group-xs">
                <a href="/employee/${item.id}" class="btn btn-default btn-xs" data-toggle="tooltip" title="View">
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
                ${item.id == 1 ? '' : deleteAction}
            </div>`;
        
        const photoContent = item.photo
            ? `<img src="/uploads/profile_image/${item.photo}" alt="${item.first_name}" style="width: 50px; height: 50px;">`
            : ` `;

			function formatDate(dateStr) {
    if (!dateStr) return 'N/A';
    const date = new Date(dateStr);
    if (isNaN(date)) return 'Invalid Date';
    
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const dd = String(date.getDate()).padStart(2, '0');
    const yyyy = String(date.getFullYear()).padStart(4, '0');
	
    return `${mm}-${dd}-${yyyy}`;
}

tableBody.append(`
    <tr>
        <td>${actions}</td>
        <td>${index + 1}</td>
        <td>${photoContent}</td>
        <td>${item.employee_code || 'N/A'}</td>
        <td>${item.first_name || 'N/A'}</td>
        <td>${item.designation_name || 'N/A'}</td>
        <td>${item.department_name || 'N/A'}</td>
        <td>${item.category || 'N/A'}</td>
        <td>${formatDate(item.date_of_joining)}</td>
        <td>${formatDate(item.date_of_birth)}</td>
        <td>${item.blood_group || 'N/A'}</td>
        <td>${item.job_nature || 'N/A'}</td>
        <td>${item.contact_number || 'N/A'}</td>
        <td>${item.gender || 'N/A'}</td>
        <td>${item.branch_name || 'N/A'}</td>
        <td>${item.status || 'N/A'}</td>
    </tr>
`);

    });

    const table = datatable.DataTable({
        lengthMenu: [10, 20, 50, 100],
        paging: true,
        autoWidth: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'Employee Details',
            },
            {
                extend: 'print',
                text: 'Print',
                title: 'Employee Details',
                customize: function (win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },
            },
        ],
        columnDefs: [
            { 
                targets: [0], // SL No sortable
                orderable: true 
            },
            {
                targets: [3], // Employee code column is the 4th column (index 3)
                orderable: true // Make sure this column is sortable
            },
        ],
        order: [[3, 'asc']] // Sort by employee code (index 3) in ascending order by default
    });
}


			// $('#employee_code').attr("disabled", true) 
			$('#employee_code').prop('readonly', true);	
			$('#first_name').on('change', function () {
				$.ajax({
					url: '/employee/latest-id',
					method: 'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
					},
					success: function (data) {
						if (data.employee_code) {
							$('#employee_code').val(data.employee_code).attr('value', data.employee_code);
						}
					},
					error: function (xhr, status, error) {
						console.error('Error fetching employee code:', error);
					}
				});
			});
		});
	</script>
	@stop