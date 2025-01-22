@php
  $educationLavel = DB::table('employee_education_lavel')->get();
  $employee_education_class_subject = DB::table('employee_education_class_subject')->get();
@endphp
@forelse ($education as $item)
    <div class="form-container">
        <div class="form-group row education-form">
            <div class="col-md-4">
                <label for="educationLevel">Education Level</label>
                <select class="form-control" name="education_level[]">
                    <option value="">Select Education Level</option>
                     @foreach ($educationLavel as $subject)
                         <option value="{{ $subject->name }}" {{ $subject->name == $item->name ? 'selected' : '' }}>{{ $subject->name }}</option>
                     @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="classSubject">Class/Subject</label>
                <select class="form-control" name="subject[]">
                    <option value="">Select Subject</option>
                    @foreach ($employee_education_class_subject as $subject)
                        <option value="{{ $subject->name }}" {{ $subject->name == $item->subject ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
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
                    <option value="gpa" {{ $item->result_type == 'gpa' ? 'selected' : '' }}>GPA</option>
                    <option value="cgpa" {{ $item->result_type == 'cgpa' ? 'selected' : '' }}>CGPA</option>
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
                    @for ($year = 2060; $year >= 1980; $year--)
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
                        @foreach ($educationLavel as $edulavel)
                            <option value="{{ $edulavel->name }}">{{ $edulavel->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="classSubject">Class/Subject</label>
                <select class="form-control" name="subject[]">
                    <option value="">Select Subject</option>
                    @foreach ($employee_education_class_subject as $subject)
                        <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                    @endforeach
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
                    <option value="gpa">GPA</option>
                    <option value="cgpa">CGPA</option>
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
                    @for ($year = 2060; $year >= 1980; $year--)
                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
@endforelse
