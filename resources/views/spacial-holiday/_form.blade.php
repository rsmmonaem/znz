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
  {!! Form::label('date', trans('Branch'), []) !!}
  <select class="form-control" name="branch" id="branch">
     <option value="">Select Branch</option>
     @php $branch = \App\Branch::all(); @endphp
     @foreach ($branch as $b)
        <option value="{{ $b->id }}" {{ isset($holiday->branch) && $holiday->branch == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
     @endforeach
  </select>
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
{!! Form::submit(
    isset($buttonText) ? $buttonText : trans('messages.save'), 
    [
        'class' => 'btn btn-primary Spacial-Holiday-save',
        'id' => isset($holiday->id) ? 'Update_Spacial_Holiday' : '',
        'data-id' => isset($holiday->id) ? $holiday->id : ''
    ]
) !!}

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