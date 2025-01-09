               @php $department = \App\Department::all(); @endphp
			   <div class="form-group">
					<label for="department">Department Name</label>
					<select class="form-control" name="department_id" id="department_id">
						<option value="">Select</option>
						@foreach ($department as $d)
							<option value="{{ $d->id }}" {{isset($b->department_id) ? ($b->department_id == $d->id ? 'selected' : '') : ''}}>{{ $d->name }}</option>
						@endforeach
					</select>
				</div>
			   <div class="form-group">
				   {!! Form::label('name',trans('messages.name'),[])!!}
				   {!! Form::input('text','name',isset($b->name) ? $b->name : '',['class'=>'form-control','placeholder'=>trans('messages.name')])!!}
				</div>
				
				<div class="form-group">
					{!! Form::label('name',trans('messages.description'),[])!!}
					{!! Form::input('text','description',isset($b->description) ? $b->description : '',['class'=>'form-control','placeholder'=>trans('messages.description')])!!}
				</div>
				{{ App\Classes\Helper::getCustomFields('designation-form',$custom_field_values) }}
				{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'),['class' => 'btn btn-primary save-section ' . (isset($b->name) ? 'update_section' : '')]) !!}
