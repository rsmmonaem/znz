<?php

namespace App\Http\Controllers;

use App\EmployeeEducation;
use App\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    use BasicController;

    public function store(Request $request)
    {
        $decodedData = json_decode($request->input('education_data'), true);
        EmployeeEducation::where('user_id', $decodedData[0]['user_id'])->delete();
        if (!empty($decodedData) && is_array($decodedData)) {
            foreach ($decodedData as $education) {
                EmployeeEducation::create([
                    'user_id' => isset($education['user_id']) ? $education['user_id'] : null,
                    'education_level' => isset($education['education_level']) ? $education['education_level'] : null,
                    'subject' => isset($education['subject']) ? $education['subject'] : null,
                    'board' => isset($education['board']) ? $education['board'] : null,
                    'institute' => isset($education['institute']) ? $education['institute'] : null,
                    'result_type' => isset($education['result_type']) ? $education['result_type'] : null,
                    'grade' => isset($education['grade']) ? $education['grade'] : null,
                    'passing_year' => isset($education['passing_year']) ? $education['passing_year'] : null,
                ]);
            }
            return response()->json(['status' => 'success', 'message' => 'Education data inserted successfully'], 200);
        }
        return response()->json(['message' => 'No education data provided'], 400);
    }

    public function work_experience(Request $request)
    {
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


    public function educationLavelCreate()
    {
        return view('employee.Education.educationlavel');
    }

    public function educationLavelList()
    {
        return DB::table('employee_education_lavel')->get();
    }

    public function educationLavelStore(Request $request)
    {

        $level = DB::table('employee_education_lavel')->where('name', $request->name)->first();
        if ($level) {
            return response()->json(['status' => 'error', 'message' => 'Level already exists'], 400);
        }
        DB::table('employee_education_lavel')->insert(['name' => $request->name]);
        return response()->json(['status' => 'success', 'message' => 'Data inserted successfully'], 200);
    }

    public function EducationLavelDelete($id)
    {
        DB::table('employee_education_lavel')->where('id', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully'], 200);
    }

    public function ClassSubjectStore(Request $request)
    {
        $subject = DB::table('employee_education_class_subject')->where('name', $request->name)->first();
        if ($subject) {
            return response()->json(['status' => 'error', 'message' => 'Subject already exists'], 400);
        }
        DB::table('employee_education_class_subject')->insert(['name' => $request->name]);
        return response()->json(['status' => 'success', 'message' => 'Data inserted successfully'], 200);
    }
    public function ClassSubjectDelete($id)
    {
        DB::table('employee_education_class_subject')->where('id', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully'], 200);
    }
    public function ClassSubjectList()
    {
        return DB::table('employee_education_class_subject')->get();
    }
}
