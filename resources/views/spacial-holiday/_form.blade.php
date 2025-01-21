@if (!isset($holiday->id))
    <div class="form-group">
        {!! Form::label('date', trans('Branch'), []) !!}
        <select class="form-control" name="branch" id="branch">
            <option value="">Select Branch</option>
            @php
                $branch = \App\Branch::all();
                $department = \App\Department::all();
                $section = \App\Section::all();
                $designation = \App\Designation::all();
                $employee = \App\User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
                    ->select('users.first_name', 'users.id', 'profile.employee_code')
                    ->get();
            @endphp
            @foreach ($branch as $b)
                <option value="{{ $b->id }}"
                    {{ isset($holiday->branch) && $holiday->branch == $b->id ? 'selected' : '' }}>{{ $b->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Department</label>
        <select class="form-control" name="department">
            <option value="">Select Department</option>
            @foreach ($department as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Section</label>
        <select class="form-control" name="section">
            <option value="">Select Section</option>
            @foreach ($section as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Designation</label>
        <select class="form-control" name="designation">
            <option value="">Select Designation</option>
            @foreach ($designation as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Employee IDs</label>
        <select class="form-control" name="multiple_id" id="multiple_id" multiple>
          {{-- <option value="">Select Employee</option> --}}
        {{-- @foreach ($employee as $d)
            <option value="{{ $d->id }}">{{ $d->first_name }} - {{ $d->employee_code }}</option>
        @endforeach --}}
       </select>
        {{-- <input type="text" name="multiple_id" class="form-control" placeholder="ID1, ID2, ID3"> --}}
    </div>
@endif
<div class="form-group">
    {!! Form::label('date', trans('messages.date'), []) !!}
    @if (!isset($buttonText))
        {!! Form::input('text', 'date', isset($holiday->date) ? $holiday->date : '', [
            'class' => 'form-control mdatepicker',
            'placeholder' => trans('messages.date'),
            'id' => 'date',
            'readonly' => 'true',
        ]) !!}
    @else
        {!! Form::input('text', 'date', isset($holiday->date) ? $holiday->date : '', [
            'class' => 'form-control datepicker',
            'placeholder' => trans('messages.date'),
            'id' => 'date',
            'readonly' => 'true',
        ]) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('description', trans('messages.description'), []) !!}
    {!! Form::textarea('description', isset($holiday->description) ? $holiday->description : '', [
        'size' => '30x3',
        'class' => 'form-control',
        'id' => 'description',
        'placeholder' => trans('messages.description'),
        'data-show-counter' => 1,
        'data-limit' => config('config.textarea_limit'),
        'data-autoresize' => 1,
    ]) !!}
    <span class="countdown"></span>
</div>
{{ App\Classes\Helper::getCustomFields('holiday-form', $custom_field_values) }}
{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.save'), [
    'class' => 'btn btn-primary Spacial-Holiday-save',
    'id' => isset($holiday->id) ? 'Update_Spacial_Holiday' : '',
    'data-id' => isset($holiday->id) ? $holiday->id : '',
]) !!}

<script>
    document.querySelector('.Update_Spacial_Holiday').addEventListener('click', function() {
        // Collect form data
        const formData = {
            date: document.querySelector('[name="date"]').value,
            branch: document.querySelector('[name="branch"]').value,
            description: document.getElementById('description').value,
        };

        // Get the ID from the button's data-id attribute
        const id = this.getAttribute('data-id');

        // Check if ID is set
        if (!id) {
            console.error('ID is missing.');
            return;
        }

        // Perform the AJAX request
        fetch(`/spacial-holiday/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token
                },
                body: JSON.stringify(formData),
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((data) => {
                getSeparationData();
                toastr.success('Spacial Holiday Updated Successfully');
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
</script>
