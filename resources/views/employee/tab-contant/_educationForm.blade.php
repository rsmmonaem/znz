@forelse ($education as $item)
    <div class="form-container">
        <div class="form-group row education-form">
            <div class="col-md-4">
                <label for="educationLevel">Education Level</label>
                <select class="form-control" name="education_level[]">
                    <option value="">Select Education Level</option>
                    <option value="primary" {{ $item->education_level == 'primary' ? 'selected' : '' }}>Primary Education</option>
                    <option value="junior_secondary" {{ $item->education_level == 'junior_secondary' ? 'selected' : '' }}>Junior Secondary Education</option>
                    <option value="secondary" {{ $item->education_level == 'secondary' ? 'selected' : '' }}>Secondary Education</option>
                    <option value="higher_secondary" {{ $item->education_level == 'higher_secondary' ? 'selected' : '' }}>Higher Secondary Education</option>
                    <option value="undergraduate" {{ $item->education_level == 'undergraduate' ? 'selected' : '' }}>Undergraduate/Bachelor’s Degree</option>
                    <option value="postgraduate" {{ $item->education_level == 'postgraduate' ? 'selected' : '' }}>Postgraduate/Master’s Degree</option>
                    <option value="doctoral" {{ $item->education_level == 'doctoral' ? 'selected' : '' }}>Doctoral/Ph.D. Programs</option>
                    <option value="vocational" {{ $item->education_level == 'vocational' ? 'selected' : '' }}>Vocational and Technical Education</option>
                    <option value="madrasah" {{ $item->education_level == 'madrasah' ? 'selected' : '' }}>Madrasah Education</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="classSubject">Class/Subject</label>
                <select class="form-control" name="subject[]">
                    <option value="">Select Subject</option>
                    <option value="bangla" {{ $item->subject == 'bangla' ? 'selected' : '' }}>Bangla</option>
                    <option value="english" {{ $item->subject == 'english' ? 'selected' : '' }}>English</option>
                    <option value="mathematics" {{ $item->subject == 'mathematics' ? 'selected' : '' }}>Mathematics</option>
                    <option value="science" {{ $item->subject == 'science' ? 'selected' : '' }}>Science</option>
                    <option value="social_science" {{ $item->subject == 'social_science' ? 'selected' : '' }}>Social Science</option>
                    <option value="religion" {{ $item->subject == 'religion' ? 'selected' : '' }}>Religion</option>
                    <option value="physics" {{ $item->subject == 'physics' ? 'selected' : '' }}>Physics</option>
                    <option value="chemistry" {{ $item->subject == 'chemistry' ? 'selected' : '' }}>Chemistry</option>
                    <option value="biology" {{ $item->subject == 'biology' ? 'selected' : '' }}>Biology</option>
                    <option value="economics" {{ $item->subject == 'economics' ? 'selected' : '' }}>Economics</option>
                    <option value="accounting" {{ $item->subject == 'accounting' ? 'selected' : '' }}>Accounting</option>
                    <option value="business_studies" {{ $item->subject == 'business_studies' ? 'selected' : '' }}>Business Studies</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="boardUniversity">Board/University</label>
                <input type="text" class="form-control" name="board[]" value="{{ $item->board }}">
            </div>
        </div>
        <div class="form-group row education-form">
            <div class="col-md-4">
                <label for="instituteName">Institute Name</label>
                <input type="text" class="form-control" name="institute[]" value="{{ $item->institute }}">
            </div>
            <div class="col-md-2">
                <label for="result">Result</label>
                <select class="form-control" name="result_type[]">
                    <option value="">Select Result Type</option>
                    <option value="gpa" {{ $item->result_type == 'gpa' ? 'selected' : '' }}>GPA (Grade Point Average)</option>
                    <option value="cgpa" {{ $item->result_type == 'cgpa' ? 'selected' : '' }}>CGPA (Cumulative Grade Point Average)</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="grade">Grade</label>
                <input type="text" class="form-control" name="grade[]" value="{{ $item->grade }}">
            </div>
            <div class="col-md-4">
                <label for="passingYear">Passing Year</label>
                <select class="form-control" name="passing_year[]">
                    <option value="">Select Passing Year</option>
                    @for ($year = date('Y'); $year >= 1980; $year--)
                        <option value="{{ $year }}" {{ $item->passing_year == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
@empty
    <!-- Empty form structure when no education data is found -->
    <div class="form-container">
        <div class="form-group row education-form">
            <div class="col-md-4">
                <label for="educationLevel">Education Level</label>
                <select class="form-control" name="education_level[]">
                    <option value="">Select Education Level</option>
                    <option value="primary">Primary Education</option>
                    <option value="junior_secondary">Junior Secondary Education</option>
                    <option value="secondary">Secondary Education</option>
                    <option value="higher_secondary">Higher Secondary Education</option>
                    <option value="undergraduate">Undergraduate/Bachelor’s Degree</option>
                    <option value="postgraduate">Postgraduate/Master’s Degree</option>
                    <option value="doctoral">Doctoral/Ph.D. Programs</option>
                    <option value="vocational">Vocational and Technical Education</option>
                    <option value="madrasah">Madrasah Education</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="classSubject">Class/Subject</label>
                <select class="form-control" name="subject[]">
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
                <input type="text" class="form-control" name="board[]">
            </div>
        </div>
        <div class="form-group row education-form">
            <div class="col-md-4">
                <label for="instituteName">Institute Name</label>
                <input type="text" class="form-control" name="institute[]">
            </div>
            <div class="col-md-2">
                <label for="result">Result</label>
                <select class="form-control" name="result_type[]">
                    <option value="">Select Result Type</option>
                    <option value="gpa">GPA (Grade Point Average)</option>
                    <option value="cgpa">CGPA (Cumulative Grade Point Average)</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="grade">Grade</label>
                <input type="text" class="form-control" name="grade[]">
            </div>
            <div class="col-md-4">
                <label for="passingYear">Passing Year</label>
                <select class="form-control" name="passing_year[]">
                    <option value="">Select Passing Year</option>
                    @for ($year = date('Y'); $year >= 1980; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
@endforelse
