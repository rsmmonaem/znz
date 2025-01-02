@extends('layouts.default')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/dashboard">{!! trans('messages.dashboard') !!}</a></li>
        <li class="active">{!! trans('Create Employee') !!}</li>
    </ul>
@stop

@section('content')
    <style>
        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .panel-heading .fa {
            transition: transform 0.3s ease;
            color: green;
        }

        .panel-heading.collapsed .fa {
            transform: rotate(180deg);
        }
        a.file-input-wrapper.btn.form-control {
            display: none !important;
        }
        span.file-input-name {
            display: none !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group" id="accordion">
                <!-- Personal Details -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-target="#personalDetails" aria-expanded="true">
                        <h4 class="panel-title">Personal Details</h4>
                        <i class="fa fa-minus"></i>
                    </div>
                    <div id="personalDetails" class="panel-collapse collapse in">
                        <div class="container" style="width: 100%;">
                            <!-- Row 1 -->
                            <div class="row">
                                <!-- Employee Code -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="employee_id">Employee Code</label>
                                        <input class="form-control" placeholder="Employee Code" readonly="readonly"
                                            name="employee_id" type="text" value="" id="employee_id">
                                    </div>
                                </div>
                                    <!-- Profile Picture -->
                                {{-- <div class="col-sm-6 text-right">
                                    <div class="image-container" style="position: relative; display: inline-block;">
                                    <img src="{{ URL::to(config('constants.upload_path.profile_image') . 'blank_profile.webp') }}"
                                        alt="Profile Picture" class="imagePreview rounded-circle" id="Up_preview"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ccc;">
                                    <label for="imageInput" class="image-upload-label"
                                        style="position: absolute; bottom: 10px; right: 10px; cursor: pointer;
                                        background-color: rgba(0, 0, 0, 0.6); padding: 5px 10px; border-radius: 50%;
                                        color: #fff; font-size: 18px;">
                                        <i class="fa fa-camera"></i> <!-- Icon for camera -->
                                    </label>
                                    <span class="text-danger">Image Not Selected</span>
                                </div>
                                <input class="form-control" id="imageInput" name="photo" type="file" accept="image/*"
                                    onchange="Up_preview.src = window.URL.createObjectURL(this.files[0])"
                                    style="display: none;" >
                                </div> --}}
                            </div>
                            <!-- End Row 1 -->

                            <!-- Row 2 -->
                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label">Full Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Full Name" name="first_name" type="text"
                                            value="" id="first_name">
                                    </div>
                                </div>
                                <!-- Bangla Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">Bangla Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Bangla Name" name="last_name"
                                            type="text" value="" id="last_name">
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 2 -->

                            <!-- Row 3 -->
                            <div class="row">
                                <!-- Category -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="category" class="control-label">Category <span
                                                class="text-danger">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach ($category as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Job Nature -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="job_nature" class="control-label">Job Nature</label>
                                        <input class="form-control" placeholder="Job Nature" name="job_nature"
                                            type="text" value="" id="job_nature">
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 3 -->

                            <!-- Row 4 -->
                            <div class="row">
                                <!-- Father's Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fathers_name" class="control-label">Father's Name</label>
                                        <input class="form-control" placeholder="Father's Name" name="fathers_name"
                                            type="text" value="" id="fathers_name">
                                    </div>
                                </div>
                                <!-- Mother's Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mothers_name" class="control-label">Mother's Name</label>
                                        <input class="form-control" placeholder="Mother's Name" name="mothers_name"
                                            type="text" value="" id="mothers_name">
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 4 -->

                            <!-- Row 5 -->
                            <div class="row">
                                <!-- Email -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input class="form-control" placeholder="Email" name="email" type="text"
                                            value="" id="email">
                                    </div>
                                </div>
                                <!-- Branch -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="branch_id" class="control-label">Branch <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="branch_id" name="branch_id">
                                            <option value="">Select One</option>
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 5 -->

                            <!-- Row 6 -->
                            <div class="row">
                                <!-- Section -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="section_id" class="control-label">Section <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="section_id" name="section_id">
                                            <option value="">Select One</option>
                                            @foreach ($sections as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Grade -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="grade_id" class="control-label">Grade <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="grade_id" name="grade_id">
                                            <option value="">Select One</option>
                                            @foreach ($grades as $g)
                                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 6 -->
                            <div class="row">
                                <!-- Designation -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="designation_id" class="control-label">Designation <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control input-xlarge select2me select2-offscreen"
                                            placeholder="Designation" id="designation_id" name="designation_id"
                                            title="Designation" tabindex="-1">
                                            <option value="">Select One</option>
                                            @foreach ($designations as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="date_of_brith">Date of Birth <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control datepicker" placeholder="Date of Birth"
                                            readonly="true" name="date_of_birth" type="text" value=""
                                            id="date_of_birth">
                                    </div>
                                </div>
                            </div>
                            <!-- Row 7 -->
                            <div class="row">
                                <!-- Gender -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="gender" class="control-label">Gender</label>
                                        <select class="form-control input-xlarge select2me select2-offscreen"
                                            placeholder="Select One" id="gender" name="gender" title="Gender"
                                            tabindex="-1">
                                            <option value="" selected="selected">Select One</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="transgender">Transgender</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Marital Status -->
                                    <div class="form-group flex-form-group">
                                        <label for="marital_status" class="control-label">Marital Status</label>
                                        <select class="form-control input-xlarge select2me select2-offscreen"
                                            placeholder="Select One" id="marital_status" name="marital_status"
                                            title="Marital Status" tabindex="-1">
                                            <option value="">Select One</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="widowed">Widowed</option>
                                            <option value="divorced_separated">Divorced or Separated</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Date of Joining -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="date_of_joining">Date of Joining <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control datepicker" placeholder="Date of Joining"
                                            readonly="true" name="date_of_joining" type="text" value=""
                                            id="date_of_joining">
                                    </div>
                                </div>
                                <!-- Religion -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="reliagion">Religion</label>
                                        <select class="form-control input-xlarge select2me select2-offscreen"
                                            placeholder="Select One" id="reliagion" name="reliagion" title="Religion"
                                            tabindex="-1">
                                            <option value="">Select One</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Judaism">Judaism</option>
                                            <option value="Sikhism">Sikhism</option>
                                            <option value="Jainism">Jainism</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end Row -->

                                <div class="col-sm-3">
                                    <div class="form-group flex-form-group">
                                        <label for="height">Height</label>
                                        <input class="form-control" placeholder="Height" name="height" type="text"
                                            value="" id="height">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group flex-form-group">
                                        <label for="weight">Weight</label>
                                        <input class="form-control" placeholder="Weight" name="weight" type="text"
                                            value="" id="weight">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="contact_number">Employee Number</label>
                                        <input class="form-control" placeholder="Employee Number" name="contact_number"
                                            type="text" value="" id="contact_number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="nationality">Nationality</label>
                                        <input class="form-control" placeholder="Nationality" name="nationality"
                                            type="text" value="" id="nationality">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <input class="form-control" placeholder="Blood Group" name="blood_group"
                                            type="text" value="" id="blood_group">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="nid">NID</label>
                                        <input class="form-control" placeholder="NID" name="nid" type="text"
                                            value="" id="nid">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="brith">Birth</label>
                                        <input class="form-control" placeholder="Birth" name="brith" type="text"
                                            value="" id="brith">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="passport">Passport</label>
                                        <input class="form-control" placeholder="Passport" name="passport"
                                            type="text" value="" id="passport">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="tin">TIN</label>
                                        <input class="form-control" placeholder="TIN" name="tin" type="text"
                                            value="" id="tin">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @include('employee.Create_page.PresentAdd')

                @include('employee.Create_page.PermanentAdd')

                @include('employee.Create_page.BankAcc')
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-fill-line btn-primary btn-block text-uppercase rounded-0" title="Save"
                            type="submit" id="save-employee">Save
                            Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).on('click', '.panel-heading', function() {
            // Toggle the plus/minus icon
            var icon = $(this).find('.fa');
            if (icon.hasClass('fa-plus')) {
                icon.removeClass('fa-plus').addClass('fa-minus');
            } else {
                icon.removeClass('fa-minus').addClass('fa-plus');
            }
        });

        // Ensure the first panel is always open and its icon is set correctly
        $(document).ready(function() {
            // get User Id Dynamically
           $('#employee_id').prop('readonly', true);	
            async function getUserId() {
                try {
                    const response = await $.ajax({
                        url: '/employee/latest-id',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        }
                    });

                    if (response.employee_code) {
                        $('#employee_id').val(response.employee_code).attr('value', response.employee_code);
                    }
                } catch (error) {
                    console.error('Error fetching employee code:', error);
                }
            }
            getUserId()
            // Open the first panel
            $('#personalDetails').addClass('in');
            $('.panel-heading[data-target="#personalDetails"] .fa').removeClass('fa-plus').addClass('fa-minus');

            $('#save-employee').on('click', function() {
                btncontroll();
                const FormDate = {
                    employee_id: $('#employee_id').val(),
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    section_id: $('#section_id').val(),
                    grade_id: $('#grade_id').val(),
                    branch_id: $('#branch_id').val(),
                    category: $('#category').val(),
                    job_nature: $('#job_nature').val(),
                    fathers_name: $('#fathers_name').val(),
                    mothers_name: $('#mothers_name').val(),
                    email: $('#email').val(),
                    designation_id: $('#designation_id').val(),
                    date_of_joining: $('#date_of_joining').val(),
                    marital_status: $('#marital_status').val(),
                    religion: $('#reliagion').val(),
                    gender: $('#gender').val(),
                    height: $('#height').val(),
                    weight: $('#weight').val(),
                    brith: $('#brith').val(),
                    passport: $('#passport').val(),
                    tin: $('#tin').val(),
                    nid: $('#nid').val(),
                    contact_number: $('#contact_number').val(),
                    date_of_birth: $('#date_of_birth').val(),
                    nationality: $('#nationality').val(),
                    blood_group: $('#blood_group').val(),
                    // Present Address
                    pres_house: $('#pres_house').val(),
                    pres_road: $('#pres_road').val(),
                    pres_division: $('#pres_division').val(),
                    pres_post: $('#pres_post').val(),
                    pres_district: $('#pres_district').val(),
                    pres_thana: $('#pres_thana').val(),
                    pres_upazila: $('#pres_upazila').val(),
                    pres_post_code: $('#pres_post_code').val(),

                    // Permanent Address
                    per_house: $('#house').val(),
                    per_road: $('#road').val(),
                    per_division: $('#division').val(),
                    per_post: $('#post').val(),
                    per_district: $('#district').val(),
                    per_thana: $('#thana').val(),
                    per_upazila: $('#upazila').val(),
                    per_post_code: $('#post_code').val(),

                    // Bank Account
                    bank_name: $('#bank_name').val(),
                    bank_branch: $('#bank_branch').val(),
                    account_name: $('#account_name').val(),
                    account_number: $('#account_number').val(),
                    bank_code: $('#bank_code').val(),
                    // photo: $('#imageInput')[0].files[0],
                };

                if (FormDate.first_name.length == 0) {
                   return validate('Please enter a Full name.');
                }

                if (FormDate.last_name.length == 0) {
                    return validate('Please enter a Bangla name.');
                }
                if (FormDate.section_id.length == 0) {
                    return validate('Please select a section.');
                }
                if (FormDate.branch_id.length == 0) {
                    return validate('Please select a branch.');
                }
                if (FormDate.category.length == 0) {
                    return validate('Please select a category.');
                }
                if (FormDate.designation_id.length == 0) {
                    return validate('Please select a designation.');
                }
                if (FormDate.date_of_joining.length == 0) {
                    return validate('Please select a date of joining.');
                }
                if (FormDate.date_of_birth.length == 0) {
                    return validate('Please select a date of birth.');
                }
                console.log(FormDate);

                $.ajax({
                    url: "{{ url('employee-create') }}",
                    method: "POST",
                    data: FormDate,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(response) {
                        getUserId();
                        if (response.message == 'success') {
                            toastr.success('User, Profile, and Bank Account created successfully!');
                            $('#save-employee').attr('disabled', false);
                            $('#save-employee').text('Save');
                            // location.reload();
                        } else {
                            $('#save-employee').attr('disabled', false);
                            $('#save-employee').text('Save');
                            console.log(response.message);
                        }
                    },
                    error(xhr) {
                        $('#save-employee').attr('disabled', false);
                        $('#save-employee').text('Save');
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            function btncontroll() {
                $('#save-employee').attr('disabled', true);
                $('#save-employee').text('Processing...');
            }

            function validate(data) {
                $('#save-employee').attr('disabled', false);
                $('#save-employee').text('Save');
                return toastr.error(data);
            }
        });
    </script>
@stop
