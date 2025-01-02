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
                                        <label for="employee_code">Employee Code</label>
                                        <input class="form-control" placeholder="Employee Code" readonly="readonly"
                                            name="employee_code" type="text" value="1" id="employee_code">
                                    </div>
                                </div>
                                <!-- Profile Picture -->
                                <div class="col-sm-6">
                                    <div class="form-group"
                                        style="display: flex; align-items: center; margin-bottom: 30px;">
                                        <img src="{{ URL::to(config('constants.upload_path.profile_image') . 'blank_profile.webp') }}" alt="Profile Picture" class="imagePreview"
                                            style="width: 100px; height: 100px; object-fit: cover;" id="Up_preview">
                                        <input class="form-control" id="imageInput" class="file" accept="image/*"
                                            onchange="Up_preview.src = window.URL.createObjectURL(this.files[0])"
                                            name="photo" type="file">
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 1 -->

                            <!-- Row 2 -->
                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label">Full Name</label>
                                        <input class="form-control" placeholder="Full Name" name="first_name" type="text"
                                            value="Saida Islam Setu" id="first_name">
                                    </div>
                                </div>
                                <!-- Bangla Name -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">Bangla Name</label>
                                        <input class="form-control" placeholder="Bangla Name" name="last_name"
                                            type="text" value="Saida Islam Setu" id="last_name">
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 2 -->

                            <!-- Row 3 -->
                            <div class="row">
                                <!-- Category -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="category" class="control-label">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select One</option>
                                            <option value="stuff">Stuff</option>
                                            <option value="owner">Owner</option>
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
                                        <label for="branch_id" class="control-label">Branch</label>
                                        <select class="form-control" id="branch_id" name="branch_id">
                                            <option value="">Select One</option>
                                            <option value="7">Mohakhali Branch</option>
                                            <option value="17">Kasundi Restora Ltd. (Dhanmondi Branch)</option>
                                            <option value="19" selected="selected">Kasundi Restora Ltd.
                                                (Khilkhet Branch)
                                            </option>
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
                                        <label for="section_id" class="control-label">Section</label>
                                        <select class="form-control" id="section_id" name="section_id">
                                            <option value="">Select One</option>
                                            <option value="10" selected="selected">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Grade -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="grade_id" class="control-label">Grade</label>
                                        <select class="form-control" id="grade_id" name="grade_id">
                                            <option value="">Select One</option>
                                            <option value="6" selected="selected">7</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row 6 -->
                            <div class="row">
                                <!-- Designation -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="designation_id" class="control-label">Designation</label>
                                        <select class="form-control input-xlarge select2me select2-offscreen"
                                            placeholder="Designation" id="designation_id" name="designation_id"
                                            title="Designation" tabindex="-1">
                                            <option value="">Select One</option>
                                            <option value="1">System Administrator (System Administration)
                                            </option>
                                            <option value="8" selected="selected">Asst. Manager (HR &amp;
                                                Admin)</option>
                                            <option value="9">Manager (HR &amp; Admin)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input class="form-control datepicker" placeholder="Date of Birth"
                                            readonly="true" name="date_of_birth" type="text" value="1994-08-28"
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
                                            <option value="married" selected="selected">Married</option>
                                            <option value="widowed">Widowed</option>
                                            <option value="divorced_separated">Divorced or Separated</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Date of Joining -->
                                <div class="col-sm-6">
                                    <div class="form-group flex-form-group">
                                        <label for="date_of_joining">Date of Joining</label>
                                        <input class="form-control datepicker" placeholder="Date of Joining"
                                            readonly="true" name="date_of_joining" type="text" value="2024-12-17"
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
                                            <option value="Islam" selected="selected">Islam</option>
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
                                            type="text" value="B+" id="blood_group">
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

                <!-- Present Address -->
                <div class="panel panel-default">
                    <div class="panel-heading collapsed" data-toggle="collapse" data-target="#presentAddress">
                        <h4 class="panel-title">Present Address</h4>
                        <i class="fa fa-plus"></i>
                    </div>
                    <div id="presentAddress" class="panel-collapse collapse">
                        <div class="container" style="width: 100%;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_house">House</label>
                                        <input class="form-control" placeholder="House" name="pres_house" type="text"
                                            value="" id="pres_house">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_road">Road</label>
                                        <input class="form-control" placeholder="Road" name="pres_road" type="text"
                                            value="" id="pres_road">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_division">Division</label>
                                        <input class="form-control" placeholder="Division" name="pres_division"
                                            type="text" value="" id="pres_division">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_post">Post</label>
                                        <input class="form-control" placeholder="Post" name="pres_post" type="text"
                                            value="" id="pres_post">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_district">District</label>
                                        <input class="form-control" placeholder="District" name="pres_district"
                                            type="text" value="" id="pres_district">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_thana">Thana</label>
                                        <input class="form-control" placeholder="Thana" name="pres_thana" type="text"
                                            value="" id="pres_thana">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_upazila">Upazila</label>
                                        <input class="form-control" placeholder="Upazila" name="pres_upazila"
                                            type="text" value="" id="pres_upazila">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="pres_post_code">Post Code</label>
                                        <input class="form-control" placeholder="Post Code" name="pres_post_code"
                                            type="text" value="" id="pres_post_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permanent Address -->
                <div class="panel panel-default">
                    <div class="panel-heading collapsed" data-toggle="collapse" data-target="#permanentAddress">
                        <h4 class="panel-title">Permanent Address</h4>
                        <i class="fa fa-plus"></i>
                    </div>
                    <div id="permanentAddress" class="panel-collapse collapse">
                        <div class="container" style="width: 100%;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="house">House</label>
                                        <input class="form-control" placeholder="House" name="house" type="text"
                                            value="" id="house">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="road">Road</label>
                                        <input class="form-control" placeholder="Road" name="road" type="text"
                                            value="" id="road">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="division">Division</label>
                                        <input class="form-control" placeholder="Division" name="division"
                                            type="text" value="" id="division">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="post">Post</label>
                                        <input class="form-control" placeholder="Post" name="post" type="text"
                                            value="" id="post">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="district">District</label>
                                        <input class="form-control" placeholder="District" name="district"
                                            type="text" value="" id="district">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="thana">Thana</label>
                                        <input class="form-control" placeholder="Thana" name="thana" type="text"
                                            value="" id="thana">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="upazila">Upazila</label>
                                        <input class="form-control" placeholder="Upazila" name="upazila" type="text"
                                            value="" id="upazila">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group flex-form-group">
                                        <label for="post_code">Post Code</label>
                                        <input class="form-control" placeholder="Post Code" name="post_code"
                                            type="text" value="" id="post_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div class="panel panel-default">
                    <div class="panel-heading collapsed" data-toggle="collapse" data-target="#education">
                        <h4 class="panel-title">Education</h4>
                        <i class="fa fa-plus"></i>
                    </div>
                    <div id="education" class="panel-collapse collapse">
                        <div class="user-profile-content-wm">
                            <div class="container" style="width: 100%;">
                                <h3>Education Details</h3>
                                <form id="educationForm">
                                    <div class="form-container">
                                        <div class="form-group row education-form">
                                            <div class="col-md-4">
                                                <label for="educationLevel">Education Level</label>
                                                <select class="form-control select2-offscreen" name="education_level[]"
                                                    tabindex="-1" title="">
                                                    <option value="">Select Education Level</option>
                                                    <option value="primary">Primary Education</option>
                                                    <option value="junior_secondary">Junior Secondary Education
                                                    </option>
                                                    <option value="secondary">Secondary Education</option>
                                                    <option value="higher_secondary">Higher Secondary Education
                                                    </option>
                                                    <option value="undergraduate">Undergraduate/Bachelor’s Degree
                                                    </option>
                                                    <option value="postgraduate">Postgraduate/Master’s Degree
                                                    </option>
                                                    <option value="doctoral">Doctoral/Ph.D. Programs</option>
                                                    <option value="vocational">Vocational and Technical Education
                                                    </option>
                                                    <option value="madrasah">Madrasah Education</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="classSubject">Class/Subject</label>
                                                <select class="form-control select2-offscreen" name="subject[]"
                                                    tabindex="-1" title="">
                                                    <option value="">Select Subject</option>
                                                    <option value="bangla">Bangla</option>
                                                    <option value="english">English</option>
                                                    <option value="mathematics">Mathematics</option>
                                                    <option value="science">Science</option>
                                                    <option value="social_science">Social Science</option>
                                                    <option value="religion">Religion</option>
                                                    <option value="physics">Physics</option>
                                                    <option value="chemistry">Chemistry</option>
                                                    <option value="biology">Biology</option>
                                                    <option value="economics">Economics</option>
                                                    <option value="accounting">Accounting</option>
                                                    <option value="business_studies">Business Studies</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="boardUniversity">Board/University</label>
                                                <input type="text" class="form-control" name="board[]"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="form-group row education-form">
                                            <div class="col-md-4">
                                                <label for="instituteName">Institute Name</label>
                                                <input type="text" class="form-control" name="institute[]"
                                                    value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="result">Result</label>
                                                <select class="form-control select2-offscreen" name="result_type[]"
                                                    tabindex="-1" title="">
                                                    <option value="">Select Result Type</option>
                                                    <option value="gpa">GPA (Grade Point Average)</option>
                                                    <option value="cgpa">CGPA (Cumulative Grade Point Average)
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="grade">Grade</label>
                                                <input type="text" class="form-control" name="grade[]"
                                                    value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="passingYear">Passing Year</label>
                                                <select class="form-control select2-offscreen" name="passing_year[]"
                                                    tabindex="-1" title="">
                                                    <option value="">Select Passing Year</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2000">2000</option>
                                                    <option value="1999">1999</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1980">1980</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-default" id="add-education">Add
                                    More</button>
                                <button type="button" class="btn btn-danger" id="remove-education">Remove
                                    Last</button>
                                <button type="submit" class="btn btn-primary" id="save-education">Save
                                    Education</button>
                            </div>
                            <div class="container" style="width: 100%;">
                                <h3>Work Experience Details</h3>
                                <form id="workExperienceForm">
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

                                </form>
                                <button type="button" class="btn btn-default" id="add-work-experience">Add
                                    More</button>
                                <button type="button" class="btn btn-danger" id="remove-work-experience">Remove
                                    Last</button>
                                <button type="button" class="btn btn-primary" id="save-work-experience">Save
                                    Experience</button>
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

                                    // Education
                                    const addBtn = document.getElementById('add-education');
                                    const removeBtn = document.getElementById('remove-education');
                                    const formContainer = document.querySelector('.form-container');
                                    const saveBtn = document.getElementById('save-education');

                                    addBtn.addEventListener('click', function() {
                                        // Clone the form container without copying its data (deep = false)
                                        const clonedFormContainer = formContainer.cloneNode(true);

                                        // Clear the values in the form fields of the cloned container
                                        const inputs = clonedFormContainer.querySelectorAll('input, select');
                                        inputs.forEach(input => {
                                            input.value = ''; // Reset the value of input fields and selects
                                            if (input.type === 'select-one') {
                                                input.selectedIndex = 0; // Reset the selected option in select dropdowns
                                            }
                                        });

                                        // Append the cloned, empty form container to the parent container
                                        document.querySelector('#educationForm').appendChild(clonedFormContainer);
                                    });

                                    // Function to remove the last added education form
                                    removeBtn.addEventListener('click', function() {
                                        const allFormContainers = document.querySelectorAll('.form-container');
                                        if (allFormContainers.length > 1) { // Ensure at least one form container remains
                                            allFormContainers[allFormContainers.length - 1].remove();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <!-- Add New Bank Account -->
                <div class="panel panel-default">
                    <div class="panel-heading collapsed" data-toggle="collapse" data-target="#bankAccount">
                        <h4 class="panel-title">Add New Bank Account</h4>
                        <i class="fa fa-plus"></i>
                    </div>
                    <div id="bankAccount" class="panel-collapse collapse">
                        <div class="container" style="width: 100%;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="account_name">Account Name</label>
                                        <input class="form-control" placeholder="Account Name" name="account_name"
                                            type="text" value="" id="account_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input class="form-control" placeholder="Account Number" name="account_number"
                                            type="text" value="" id="account_number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input class="form-control" placeholder="Bank Name" name="bank_name"
                                            type="text" value="" id="bank_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_code">Bank Code</label>
                                        <input class="form-control" placeholder="Bank Code" name="bank_code"
                                            type="text" value="" id="bank_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_branch">Bank Branch</label>
                                        <input class="form-control" placeholder="Bank Branch" name="bank_branch"
                                            type="text" value="" id="bank_branch">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-fill-line btn-block text-uppercase rounded-0" title="Save"
                            type="submit">Save
                            Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script>
        $(document).on('click', '.panel-heading', function () {
            // Toggle the plus/minus icon
            var icon = $(this).find('.fa');
            if (icon.hasClass('fa-plus')) {
                icon.removeClass('fa-plus').addClass('fa-minus');
            } else {
                icon.removeClass('fa-minus').addClass('fa-plus');
            }
        });

        // Ensure the first panel is always open and its icon is set correctly
        $(document).ready(function () {
            $('#personalDetails').addClass('in');
            $('.panel-heading[data-target="#personalDetails"] .fa').removeClass('fa-plus').addClass('fa-minus');

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
                designation: $('#designation').val(),
                date_of_joining: $('#date_of_joining').val(),
                marital_status: $('#marital_status').val(),
                religion: $('#reliagion').val(),
                gender: $('#gender').val(),
                religion: $('#reliagion').val(),
                height: $('#height').val(),
                weight: $('#weight').val(),
                brith: $('#brith').val(),
                passport: $('#passport').val(),
                tin: $('#tin').val(),
                nid: $('#nid').val(),
                contact_number: $('#contact_number').val(),
                date_of_brith: $('#date_of_brith').val(),
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
                per_house: $('#per_house').val(),
                per_road: $('#per_road').val(),
                per_division: $('#per_division').val(),
                per_post: $('#per_post').val(),
                per_district: $('#per_district').val(),
                per_thana: $('#per_thana').val(),
                per_upazila: $('#per_upazila').val(),
                per_post_code: $('#per_post_code').val(),

                // present_address: $('#present_address').val(),
                // permanent_address: $('#permanent_address').val(),
                // education: $('#education').val(),
                // bank_account: $('#bank_account').val(),
            };
        });
    </script>
@stop