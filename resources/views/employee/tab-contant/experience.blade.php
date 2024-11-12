<div class="container">
    <h3>Work Experience Details</h3>
    <form id="workExperienceForm">
        @forelse ($experience as $item)
            <div class="experience-container">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" name="company_name[]" value="{{ $item->company_name }}">
                    </div>
                    <div class="col-md-2">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]" value="{{ $item->start_date }}">
                    </div>
                    <div class="col-md-2">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]" value="{{ $item->end_date }}">
                    </div>
                    <div class="col-md-4">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" name="department[]" value="{{ $item->department }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role[]" value="{{ $item->role }}">
                    </div>
                    <div class="col-md-4">
                        <label for="experienceYears">Experience (Years)</label>
                        <input type="text" class="form-control" name="experience_years[]"
                            value="{{ $item->experience_years }}">
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty form structure when no work experience data is found -->
            <div class="experience-container">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" name="company_name[]">
                    </div>
                    <div class="col-md-2">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]">
                    </div>
                    <div class="col-md-2">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]">
                    </div>
                    <div class="col-md-4">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" name="department[]">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role[]">
                    </div>
                    <div class="col-md-4">
                        <label for="experienceYears">Experience (Years)</label>
                        <input type="text" class="form-control" name="experience_years[]">
                    </div>
                </div>
            </div>
        @endforelse

    </form>
    <button type="button" class="btn btn-default" id="add-work-experience">Add More</button>
    <button type="button" class="btn btn-danger" id="remove-work-experience">Remove Last</button>
    <button type="button" class="btn btn-primary" id="save-work-experience">Save Experience</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addExperienceBtn = document.getElementById('add-work-experience');
        const removeExperienceBtn = document.getElementById('remove-work-experience');
        const experienceFormContainer = document.querySelector('.experience-container');
        const saveExperienceBtn = document.getElementById('save-work-experience');

        // Add new work experience form
        addExperienceBtn.addEventListener('click', function() {
            // Clone the experience form container without copying its data (deep = false)
            const clonedExperienceContainer = experienceFormContainer.cloneNode(true);

            // Clear the values in the form fields of the cloned container
            const inputFields = clonedExperienceContainer.querySelectorAll('input');
            inputFields.forEach(input => {
                input.value = ''; // Reset the value of input fields
            });

            // Append the cloned, empty experience container to the parent form
            document.querySelector('#workExperienceForm').appendChild(clonedExperienceContainer);
        });

        // Remove the last added work experience form
        removeExperienceBtn.addEventListener('click', function() {
            const allExperienceContainers = document.querySelectorAll('.experience-container');
            if (allExperienceContainers.length > 1) { // Ensure at least one form container remains
                allExperienceContainers[allExperienceContainers.length - 1].remove();
            }
        });

        // Handle form data and save as JSON
        saveExperienceBtn.addEventListener('click', function() {
            const workExperienceData = [];

            // Collect form data from all experience containers
            document.querySelectorAll('.experience-container').forEach(function(form) {
                const formData = {
                    company_name: form.querySelector('input[name="company_name[]"]').value,
                    start_date: form.querySelector('input[name="start_date[]"]').value,
                    end_date: form.querySelector('input[name="end_date[]"]').value,
                    department: form.querySelector('input[name="department[]"]').value,
                    role: form.querySelector('input[name="role[]"]').value,
                    experience_years: form.querySelector('input[name="experience_years[]"]')
                        .value,
                    user_id: {{ $employee->id }}
                };
                workExperienceData.push(formData);
            });

            // Save work experience data as JSON
            console.log(JSON.stringify(workExperienceData));

            // Example of sending the data via AJAX
            $.ajax({
                url: "{{ url('/work_experience') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    experience_data: JSON.stringify(workExperienceData),
                    // You can add additional data like user_id if needed
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
