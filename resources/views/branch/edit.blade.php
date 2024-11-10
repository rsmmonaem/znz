	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.edit').' '.trans('messages.branch') !!}</h4>
	</div>
	<div class="modal-body">
		
		{!! Form::model($id,['method' => 'PATCH','route' => ['branch.update',$id] ,'class' => 'designation-form','id' => 'designation-form-edit','data-form-table' => 'designation_table']) !!}
			@include('branch._form', ['buttonText' => trans('messages.update')])
		{!! Form::close() !!}
		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>