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

{{-- /////////////////////////////////////// --}}
{{-- Traning Part Start --}}
{{-- /////////////////////////////////////// --}}

<div class="container">
    <h3>Training Details</h3>
    <form id="trainingForm">
        @forelse ($training as $trainingitem)
            <div class="training-container">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="trainingArea">Training Area</label>
                        <input type="text" class="form-control" name="training_area[]" value="{{ $trainingitem->training_area }}">
                    </div>
                    <div class="col-md-6">
                        <label for="institute">Institute</label>
                        <input type="text" class="form-control" name="institute[]" value="{{ $trainingitem->institute }}">
                    </div>
                    <div class="col-md-6">
                        <label for="certificate">Certificate</label>
                        <input type="text" class="form-control" name="certificate[]" value="{{ $trainingitem->certificate }}">
                    </div>
                    <div class="col-md-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]" value="{{ $trainingitem->start_date }}">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]" value="{{ $trainingitem->end_date }}">
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty form structure when no work experience data is found -->
            <div class="training-container">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="trainingArea">Training Area</label>
                        <input type="text" class="form-control" name="training_area[]">
                    </div>
                    <div class="col-md-6">
                        <label for="institute">Institute</label>
                        <input type="text" class="form-control" name="institute[]">
                    </div>
                    <div class="col-md-6">
                        <label for="certificate">Certificate</label>
                        <input type="text" class="form-control" name="certificate[]">
                    </div>
                    <div class="col-md-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]">
                    </div>
                </div>
            </div>
        @endforelse

    </form>
    <button type="button" class="btn btn-default" id="add-training">Add More</button>
    <button type="button" class="btn btn-danger" id="remove-training">Remove Last</button>
    <button type="button" class="btn btn-primary" id="save-training">Save Training</button>
</div>

{{-- /////////////////////////////////////// --}}
{{-- Certification Part Start --}}
{{-- /////////////////////////////////////// --}}

<div class="container">
    <h3>Certification Details</h3>
    <form id="certificationForm">
        @forelse ($certification as $certificationitem)
            <div class="certification-container">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="certificationName">Certification Name</label>
                        <input type="text" class="form-control" name="certification[]" value="{{ $certificationitem->certification }}">
                    </div>
                    <div class="col-md-6">
                        <label for="organization">Name Of the Organization</label>
                        <input type="text" class="form-control" name="organization[]" value="{{ $certificationitem->organization }}">
                    </div>
                    <div class="col-md-3">
                        <label for="year">Year</label>
                        <input type="number" name="year[]" class="form-control" placeholder="YYYY" min="1900" max="2100" value="{{ $certificationitem->year }}">
                    </div>
                    <div class="col-md-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]" value="{{ $certificationitem->start_date }}">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]" value="{{ $certificationitem->end_date }}">
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty form structure when no work experience data is found -->
            <div class="certification-container">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="certificationName">Certification Name</label>
                        <input type="text" class="form-control" name="certification[]">
                    </div>
                    <div class="col-md-6">
                        <label for="organization">Name Of the Organization</label>
                        <input type="text" class="form-control" name="organization[]">
                    </div>
                    <div class="col-md-3">
                        <label for="year">Year</label>
                        <input type="number" name="year[]" class="form-control" placeholder="YYYY" min="1900" max="2100">
                    </div>
                    <div class="col-md-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" name="end_date[]">
                    </div>
                </div>
            </div>
        @endforelse

    </form>
    <button type="button" class="btn btn-default" id="add-certification">Add More</button>
    <button type="button" class="btn btn-danger" id="remove-certification">Remove Last</button>
    <button type="button" class="btn btn-primary" id="save-certification">Save Certification</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addTrainingBtn = document.getElementById('add-training');
        const removeTrainingBtn = document.getElementById('remove-training');
        const trainingFormContainer = document.querySelector('.training-container');
        const saveTrainingBtn = document.getElementById('save-training');

        // Add new work experience form
        addTrainingBtn.addEventListener('click', function() {
            // Clone the experience form container without copying its data (deep = false)
            const clonedTrainingContainer = trainingFormContainer.cloneNode(true);

            // Clear the values in the form fields of the cloned container
            const inputFields = clonedTrainingContainer.querySelectorAll('input');
            inputFields.forEach(input => {
                input.value = ''; // Reset the value of input fields
            });

            // Append the cloned, empty experience container to the parent form
            document.querySelector('#trainingForm').appendChild(clonedTrainingContainer);
        });

        // Remove the last added work experience form
        removeTrainingBtn.addEventListener('click', function() {
            const allTrainingContainers = document.querySelectorAll('.training-container');
            if (allTrainingContainers.length > 1) { // Ensure at least one form container remains
                allTrainingContainers[allTrainingContainers.length - 1].remove();
            }
        });

        // Handle form data and save as JSON
        saveTrainingBtn.addEventListener('click', function() {
            const trainingData = [];

            // Collect form data from all training containers
            document.querySelectorAll('.training-container').forEach(function(form) {
                const formData = {
                    training_area: form.querySelector('input[name="training_area[]"]').value,
                    institute: form.querySelector('input[name="institute[]"]').value,
                    certificate: form.querySelector('input[name="certificate[]"]').value,
                    start_date: form.querySelector('input[name="start_date[]"]').value,
                    end_date: form.querySelector('input[name="end_date[]"]').value,
                    user_id: {{ $employee->id }}                    
                };
                trainingData.push(formData);
            });

            // Save work experience data as JSON
            console.log(JSON.stringify(trainingData));
            // Example of sending the data via AJAX
            $.ajax({
                url: "{{ url('/training') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    training_data: JSON.stringify(trainingData),
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addCertificationBtn = document.getElementById('add-certification');
        const removeCertificationBtn = document.getElementById('remove-certification');
        const certificationFormContainer = document.querySelector('.certification-container');
        const saveCertificationBtn = document.getElementById('save-certification');

        // Add new work experience form
        addCertificationBtn.addEventListener('click', function() {
            // Clone the experience form container without copying its data (deep = false)
            const clonedCertificationContainer = certificationFormContainer.cloneNode(true);

            // Clear the values in the form fields of the cloned container
            const inputFields = clonedCertificationContainer.querySelectorAll('input');
            inputFields.forEach(input => {
                input.value = ''; // Reset the value of input fields
            });

            // Append the cloned, empty experience container to the parent form
            document.querySelector('#certificationForm').appendChild(clonedCertificationContainer);
        });

        // Remove the last added work experience form
        removeCertificationBtn.addEventListener('click', function() {
            const allCertificationContainers = document.querySelectorAll('.certification-container');
            if (allCertificationContainers.length > 1) { // Ensure at least one form container remains
                allCertificationContainers[allCertificationContainers.length - 1].remove();
            }
        });

        // Handle form data and save as JSON
        saveCertificationBtn.addEventListener('click', function() {
            const certificationData = [];

            // Collect form data from all training containers
            document.querySelectorAll('.certification-container').forEach(function(form) {
                const formData = {
                    certification: form.querySelector('input[name="certification[]"]').value,
                    organization: form.querySelector('input[name="organization[]"]').value,
                    year: form.querySelector('input[name="year[]"]').value,
                    start_date: form.querySelector('input[name="start_date[]"]').value,
                    end_date: form.querySelector('input[name="end_date[]"]').value,
                    user_id: {{ $employee->id }}                    
                };
                certificationData.push(formData);
            });

            // Save work experience data as JSON
            console.log(JSON.stringify(certificationData));
            // Example of sending the data via AJAX
            $.ajax({
                url: "{{ url('/certification') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    certification_data: JSON.stringify(certificationData),
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
