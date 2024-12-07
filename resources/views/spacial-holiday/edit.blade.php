
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="modal-title">{!! trans('messages.edit').' '.trans('messages.holiday') !!}</h4>
	</div>
	<div class="modal-body">
		{!! Form::model($holiday,['method' => 'PATCH','route' => ['spacial-holiday.update',$holiday] ,'class' => 'holiday-form','id' => 'spacial-holiday-form-edit','data-form-table' => 'holiday_table']) !!}
			@include('spacial-holiday._form', ['buttonText' => trans('messages.update')])
		{!! Form::close() !!}
		<div class="clear"></div>
	</div>
	<div class="modal-footer">
	</div>

	