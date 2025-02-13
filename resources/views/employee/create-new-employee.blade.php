@extends('layouts.default')

@section('content')
    <style>
        .accordion .card {
            border: none;
            margin-bottom: 10px;
        }

        .accordion .card-header {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            cursor: pointer;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            background: #1B1E24;
            color: #ddd;
        }

        .accordion .card-body {
            border: 1px solid #ddd;
            border-top: none;
            padding: 15px;
        }

        .accordion .card-body input,
        .accordion .card-body select {
            margin-bottom: 15px;
        }

    </style>

    <div class="container">

        <div class="accordion" id="employeeAccordion">
            <!-- Basic Information -->
            <div class="card">
                <div class="card-header" id="basicInfoHeader">
                    Basic Information
                </div>
                <div id="basicInfo" >
                    <div class="card-body" id="basicInfoBody">
                        <div id="create-form">
                            
                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" required>
                                    </div>
                                </div>

                                <!-- Designation -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation_id">Designation:</label>
                                        <select name="designation_id" id="designation_id" class="form-control" required>
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $designation)
                                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                                <div class="row">
                                 <!--Gender -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Gender:</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                        
                                 <!--Marital Status -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="marital_status">Marital Status:</label>
                                        <select name="marital_status" id="marital_status" class="form-control">
                                            <option value="">Select Marital Status</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                </div>
                        
                                 <!--Employee Code -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_code">Employee Code:</label>
                                        <input type="text" name="employee_code" id="employee_code" class="form-control" placeholder="Enter Employee Code" required>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                 <!--Date of Birth -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth:</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                    </div>
                                </div>
                        
                                 <!--Date of Joining -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_joining">Date of Joining:</label>
                                        <input type="date" name="date_of_joining" id="date_of_joining" class="form-control">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="confirm_date">Employee Confirmation Date:</label>
                                        <input type="date" name="confirm_date" id="confirm_date" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                 <!--Category -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <div class="d-flex">
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                                 <!--roles -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role_id">role:</label>
                                        <div class="d-flex">
                                            <select name="role_id" id="role_id" class="form-control" required>
                                                <option value="">Select role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                        
                                 <!--Job Nature -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_nature">Job Nature:</label>
                                        <input type="text" name="job_nature" id="job_nature" class="form-control" placeholder="Enter Job Nature">
                                    </div>
                                </div>
                        
                                 <!--Father's Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fathers_name">Father's Name:</label>
                                        <input type="text" name="fathers_name" id="fathers_name" class="form-control" placeholder="Enter Father's Name">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                 <!--Mother's Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mothers_name">Mother's Name:</label>
                                        <input type="text" name="mothers_name" id="mothers_name" class="form-control" placeholder="Enter Mother's Name">
                                    </div>
                                </div>
                        
                                 <!--Religion -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="religion">Religion:</label>
                                        <select name="religion" id="religion" class="form-control select2" required>
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
                        
                                 <!--Blood Group -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group:</label>
                                        <input type="text" name="blood_group" id="blood_group" class="form-control" placeholder="Enter Blood Group">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                 <!--Height -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Height:</label>
                                        <input type="text" name="height" id="height" class="form-control" placeholder="Enter Height">
                                    </div>
                                </div>
                        
                                 <!--Weight -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="weight">Weight:</label>
                                        <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter Weight">
                                    </div>
                                </div>
                        
                                 <!--Contact Number -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number:</label>
                                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                 <!--Upload Photo -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="photo">Photo:</label>
                                        <input type="file" name="photo" id="photo" class="form-control">
                                    </div>
                                </div>
                        
                                 <!--Branch ID -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="branch_id">Branch:</label>
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($branchs as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        
                                 <!--Grade ID -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="grade_id">Grade:</label>
                                        <select name="grade_id" id="grade_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nationality">Nationality:</label>
                                        <input type="text" name="nationality" id="nationality" class="form-control" value="{{ old('nationality') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pres_house">Present House:</label>
                                        <input type="text" name="pres_house" id="pres_house" class="form-control" value="{{ old('pres_house') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="section_id">Section:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                
                            </div>

                            
                                <div class="address_area">
                                    <!-- Personal Information -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nid">NID:</label>
                                                <input type="text" id="nid" name="nid" class="form-control" placeholder="Enter NID" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="birth">Date of Birth:</label>
                                                <input type="date" id="birth" name="birth" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="passport">Passport Number:</label>
                                                <input type="text" id="passport" name="passport" class="form-control" placeholder="Enter Passport Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tin">TIN Number:</label>
                                                <input type="text" id="tin" name="tin" class="form-control" placeholder="Enter TIN">
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Permanent Address -->
                                    <h3>Permanent Address</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_house">House:</label>
                                                <input type="text" id="perm_house" name="perm_house" class="form-control" placeholder="Enter House Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_road">Road:</label>
                                                <input type="text" id="perm_road" name="perm_road" class="form-control" placeholder="Enter Road Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_division">Division:</label>
                                                <input type="text" id="perm_division" name="perm_division" class="form-control" placeholder="Enter Division Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_post">Post:</label>
                                                <input type="text" id="perm_post" name="perm_post" class="form-control" placeholder="Enter Post" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_district">District:</label>
                                                <input type="text" id="perm_district" name="perm_district" class="form-control" placeholder="Enter District" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_thana">Thana:</label>
                                                <input type="text" id="perm_thana" name="perm_thana" class="form-control" placeholder="Enter Thana" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_upazila">Upazila:</label>
                                                <input type="text" id="perm_upazila" name="perm_upazila" class="form-control" placeholder="Enter Upazila" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="perm_post_code">Post Code:</label>
                                                <input type="text" id="perm_post_code" name="perm_post_code" class="form-control" placeholder="Enter Post Code" required>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <!-- Present Address -->
                                    <h3>Present Address</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_house">House:</label>
                                                <input type="text" id="pres_house" name="pres_house" class="form-control" placeholder="Enter House Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_road">Road:</label>
                                                <input type="text" id="pres_road" name="pres_road" class="form-control" placeholder="Enter Road Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_division">Division:</label>
                                                <input type="text" id="pres_division" name="pres_division" class="form-control" placeholder="Enter Division Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_post">Post:</label>
                                                <input type="text" id="pres_post" name="pres_post" class="form-control" placeholder="Enter Post" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_district">District:</label>
                                                <input type="text" id="pres_district" name="pres_district" class="form-control" placeholder="Enter District" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_thana">Thana:</label>
                                                <input type="text" id="pres_thana" name="pres_thana" class="form-control" placeholder="Enter Thana" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_upazila">Upazila:</label>
                                                <input type="text" id="pres_upazila" name="pres_upazila" class="form-control" placeholder="Enter Upazila" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pres_post_code">Post Code:</label>
                                                <input type="text" id="pres_post_code" name="pres_post_code" class="form-control" placeholder="Enter Post Code" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            
                            
                            <div class="mt-3">
                                <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Document Information -->
            <div class="card accordion">
                <div class="card-header" id="documentInfoHeader">
                    Document Information
                </div>
                <div id="documentInfo">
                    <div class="card-body" id="documentInfoBody">
                        <div id="document-form">
                            <div class="row">
                                <!-- User ID -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id">User ID:</label>
                                        <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Enter User ID" required>
                                    </div>
                                </div>

                                <!-- Document Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="document_type_id">Document Type:</label>
                                        <select name="document_type_id" id="document_type_id" class="form-control" required>
                                            <option value="">Select Document Type</option>
                                            
                                                <option value="">Select One</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <!-- Date of Expiry -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_of_expiry">Date of Expiry:</label>
                                        <input type="date" name="date_of_expiry" id="date_of_expiry" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter Description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Attachments -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attachments">Attachments:</label>
                                        <input type="file" name="attachments[]" id="attachments" class="form-control" multiple>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button id="documentSubmitBtn" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
@stop

@section('javascript')


    <script>
    
    
    $(document).ready(function () {
    // Toggle accordion content
    $('.card-header').on('click', function () {
        const body = $(this).next();
        body.toggle();
    });

    // Submit button click handler
    $('#submitBtn').on('click', function () {
        const formData = new FormData();

        // Collect form data
        formData.append('first_name', $('#first_name').val());
        formData.append('last_name', $('#last_name').val());
        formData.append('designation_id', $('#designation_id').val());
        formData.append('username', $('#username').val());
        formData.append('email', $('#email').val());
        formData.append('status', $('#status').val());
        formData.append('gender', $('#gender').val());
        formData.append('marital_status', $('#marital_status').val());
        formData.append('employee_code', $('#employee_code').val());
        formData.append('date_of_birth', $('#date_of_birth').val());
        formData.append('date_of_joining', $('#date_of_joining').val());
        formData.append('confirm_date', $('#confirm_date').val());
        formData.append('category', $('#category').val());
        formData.append('job_nature', $('#job_nature').val());
        formData.append('fathers_name', $('#fathers_name').val());
        formData.append('mothers_name', $('#mothers_name').val());
        formData.append('religion', $('#religion').val());
        formData.append('blood_group', $('#blood_group').val());
        formData.append('height', $('#height').val());
        formData.append('weight', $('#weight').val());
        formData.append('contact_number', $('#contact_number').val());
        formData.append('photo', $('#photo')[0].files[0]);
        formData.append('branch_id', $('#branch_id').val());
        formData.append('grade_id', $('#grade_id').val());
        formData.append('nationality', $('#nationality').val());
        formData.append('pres_house', $('#pres_house').val());
        formData.append('section_id', $('#section_id').val());

        // Adding new inputs
        formData.append('nid', $('#nid').val());
        formData.append('birth', $('#birth').val());
        formData.append('passport', $('#passport').val());
        formData.append('perm_house', $('#perm_house').val());
        formData.append('perm_road', $('#perm_road').val());
        formData.append('perm_division', $('#perm_division').val());
        formData.append('perm_post', $('#perm_post').val());
        formData.append('perm_district', $('#perm_district').val());
        formData.append('perm_thana', $('#perm_thana').val());
        formData.append('perm_upazila', $('#perm_upazila').val());
        formData.append('perm_post_code', $('#perm_post_code').val());

        formData.append('pres_house', $('#pres_house').val());
        formData.append('pres_road', $('#pres_road').val());
        formData.append('pres_division', $('#pres_division').val());
        formData.append('pres_post', $('#pres_post').val());
        formData.append('pres_district', $('#pres_district').val());
        formData.append('pres_thana', $('#pres_thana').val());
        formData.append('pres_upazila', $('#pres_upazila').val());
        formData.append('pres_post_code', $('#pres_post_code').val());

        // AJAX request
        $.ajax({
            url: "{{ route('store-new-employee') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                alert(response.message);
            },
            error: function (xhr) {
                console.log(xhr.responseJSON);
                alert(xhr.responseJSON.message);
            }
        });
    });
});


    </script>
@stop
