<?php
namespace App\Http\Controllers;
use App\EmployeeEducation;
use App\WorkExperience;
use Illuminate\Http\Request;

class EducationController extends Controller{
    use BasicController;

    public function store(Request $request){
        $decodedData = json_decode($request->input('education_data'), true);
        EmployeeEducation::where('user_id', $decodedData[0]['user_id'])->delete();
        if (!empty($decodedData) && is_array($decodedData)) {
            foreach ($decodedData as $education) {
                EmployeeEducation::updateOrCreate(
                    [
                        'user_id' => $education['user_id'],
                        'education_level' => $education['education_level'],
                        'subject' => $education['subject'],
                    ],
                    [
                        'board' => $education['board'],
                        'institute' => $education['institute'],
                        'result_type' => $education['result_type'],
                        'grade' => $education['grade'],
                        'passing_year' => $education['passing_year'],
                    ]
                );
            }
            return response()->json(['status'=> 'success' ,'message' => 'Education data inserted successfully'], 200);
        }
        return response()->json(['message' => 'No education data provided'], 400);
    }

    public function work_experience(Request $request){
        $decodedData = json_decode($request->input('experience_data'), true);

        // Remove existing work experience data for the user
        WorkExperience::where('user_id', $decodedData[0]['user_id'])->delete();

        // Check if the decoded data is not empty and is an array
        if (!empty($decodedData) && is_array($decodedData)) {
            foreach ($decodedData as $experience) {
                WorkExperience::updateOrCreate(
                    [
                        'user_id' => $experience['user_id'],
                        'company_name' => $experience['company_name'],
                        'start_date' => $experience['start_date'],
                        'end_date' => $experience['end_date'],
                    ],
                    [
                        'department' => $experience['department'],
                        'role' => $experience['role'],
                        'experience_years' => $experience['experience_years'],
                    ]
                );
            }
            return response()->json(['status' => 'success', 'message' => 'Work experience data inserted successfully'], 200);
        }

        return response()->json(['message' => 'No work experience data provided'], 400);
    }
}