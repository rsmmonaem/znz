@extends('layouts.default')

	@section('breadcrumb')
		<ul class="breadcrumb">
		    <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
		    <li class="active">{!! trans('messages.grade') !!}</li>
		</ul>
	@stop
	
	@section('content')
		<div class="row">
			@if(Entrust::can('create_designation'))
			<div class="col-sm-12 collapse" id="box-detail">
				<div class="box-info">
					<h2><strong>{!! trans('messages.add_new') !!}</strong> {!! trans('messages.grade') !!}
					<div class="additional-btn">
						<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#box-detail"><i class="fa fa-minus icon"></i> {!! trans('messages.hide') !!}</button>
					</div></h2>
					{!! Form::open(['route' => 'grades.store','role' => 'form', 'class'=>'designation-form','id' => 'designation-form','data-form-table' => 'designation_table']) !!}
						@include('Grade._form')
					{!! Form::close() !!}
				</div>
			</div>
			@endif

			<div class="col-sm-12">
				<div class="box-info full">
					<h2><strong>{!! trans('messages.list_all') !!}</strong> {!! trans('messages.grade') !!}
					<div class="additional-btn">
						@if(Entrust::can('create_designation'))
							<a href="#" data-toggle="collapse" data-target="#box-detail"><button class="btn btn-sm btn-primary"><i class="fa fa-plus icon"></i> {!! trans('messages.add_new') !!}</button></a>
						@endif
					</div>
					</h2>
					<div class="table-responsive">
						<table class="table table-hover" id="designation_table">
							<thead>
								<tr>
									<th>Action</th>
									<th>#</th>
									<th>Name</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>
								@foreach($branch as $designation)
									<tr>
										<td><div class="btn-group btn-group-xs">{!! Entrust::can('edit_designation') ? '<a href="#" data-href="/grades/'.$designation->id.'/edit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit" data-toggle="tooltip" title="'.trans('messages.edit').'"></i></a> ' : '' !!}
										{!! Entrust::can('delete_designation') ? delete_form(['grades.destroy',$designation->id],'designation',1) : ''  !!}</div></td>
										<td>{{ $designation->id }}</td>
										<td>{{ $designation->name }}</td>
										<td>{{ $designation->description }}</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
							</tfoot>
						</table>
					</div>
					{{-- @include('common.datatable',['col_heads' => $col_heads]) --}}
				</div>
			</div>
		</div>
	@stop

	@section('javascript')
		<script type="text/javascript">
			$(document).ready(function() {
				$('#designation_table').DataTable();
			});

			$('.save-section').on('click',function(e){
				e.preventDefault();
				$.ajax({
					url: $('#designation-form').attr('action'),
					data: $('#designation-form').serialize(),
					type: 'POST',
					success: function(data){
						$('#myModal').modal('hide');
						window.location.reload();
					}	
				});
			});

			$('.update_section').on('click',function(e){
				e.preventDefault();
				$.ajax({
					url: $('#designation-form-edit').attr('action'),
					data: $('#designation-form-edit').serialize(),
					type: 'PUT',
					success: function(data){
						$('#myModal').modal('hide');
						window.location.reload();
					}	
				});
			})

			
		</script>
	@stop