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
                                 <select class="form-control select2-offscreen" name="education_level[]" tabindex="-1"
                                     title="">
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
                                 <select class="form-control select2-offscreen" name="subject[]" tabindex="-1"
                                     title="">
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
                                 <input type="text" class="form-control" name="board[]" value="">
                             </div>
                         </div>
                         <div class="form-group row education-form">
                             <div class="col-md-4">
                                 <label for="instituteName">Institute Name</label>
                                 <input type="text" class="form-control" name="institute[]" value="">
                             </div>
                             <div class="col-md-2">
                                 <label for="result">Result</label>
                                 <select class="form-control select2-offscreen" name="result_type[]" tabindex="-1"
                                     title="">
                                     <option value="">Select Result Type</option>
                                     <option value="gpa">GPA (Grade Point Average)</option>
                                     <option value="cgpa">CGPA (Cumulative Grade Point Average)
                                     </option>
                                 </select>
                             </div>
                             <div class="col-md-2">
                                 <label for="grade">Grade</label>
                                 <input type="text" class="form-control" name="grade[]" value="">
                             </div>
                             <div class="col-md-4">
                                 <label for="passingYear">Passing Year</label>
                                 <select class="form-control select2-offscreen" name="passing_year[]" tabindex="-1"
                                     title="">
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
