<div class="container">
    <h3>Education Details</h3>
    <form id="educationForm">
      @include('employee.tab-contant._educationForm')
    </form>
    <button type="button" class="btn btn-default" id="add-education">Add More</button>
    <button type="button" class="btn btn-danger" id="remove-education">Remove Last</button>
    <button type="submit" class="btn btn-primary" id="save-education">Save Education</button>
    @section('javascript')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('add-education');
            const removeBtn = document.getElementById('remove-education');
            const formContainer = document.querySelector('.form-container');
            const saveBtn = document.getElementById('save-education');

            addBtn.addEventListener('click', function() {
                $(formContainer).find('select').select2('destroy');
                const clonedFormContainer = formContainer.cloneNode(true);
                const inputs = clonedFormContainer.querySelectorAll('input, select');
                inputs.forEach(input => {
                    if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0; 
                    } else {
                        input.value = ''; 
                    }
                });
                document.querySelector('#educationForm').appendChild(clonedFormContainer);
                $('#educationForm select').select2();
            });

            // Function to remove the last added education form
            removeBtn.addEventListener('click', function() {
                const allFormContainers = document.querySelectorAll('.form-container');
                if (allFormContainers.length > 1) {  // Ensure at least one form container remains
                    allFormContainers[allFormContainers.length - 1].remove();
                }
            });

            // Function to handle form data and save as JSON
            saveBtn.addEventListener('click', function() {
                const educationData = [];

                // Collect form data from all .form-container sections
                document.querySelectorAll('.form-container').forEach(function(form) {
                    const formData = {
                        education_level: form.querySelector('select[name="education_level[]"]')?.value || '',
                        subject: form.querySelector('select[name="subject[]"]')?.value || '',
                        board: form.querySelector('input[name="board[]"]')?.value || '',
                        institute: form.querySelector('input[name="institute[]"]')?.value || '',
                        result_type: form.querySelector('select[name="result_type[]"]')?.value || '',
                        grade: form.querySelector('input[name="grade[]"]')?.value || '',
                        passing_year: form.querySelector('select[name="passing_year[]"]')?.value || '',
                        user_id: {{ $employee->id }}
                    };
                    educationData.push(formData);
                });

                // Save education data as JSON
                console.log(JSON.stringify(educationData));
                $.ajax({
                    url: "{{ route('education.store') }}",
                    method: "POST",
                    data: {
                        education_data: JSON.stringify(educationData)
                    },
                    success: function(response) {
                        response.status == 'success' ? toastr.success(response.message) : toastr
                            .error(response.message);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                })
            });
        });

        $(document).ready(function() {
            
        });
    </script>
    @endsection
</div>
