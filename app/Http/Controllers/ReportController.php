<?php
namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private function getCommonData()
    {
        return [
            'groups' => DB::table('com_group')->get(),
            'branches' => DB::table('branchs')->get(),
            'departments' => DB::table('departments')->get(),
            'designation' => DB::table('designations')->get(),
            'section' => DB::table('sections')->get(),
        ];
    }
    public function GenderWiseRport()
    {
        return view('employee.report.GenderWiseReport', $this->getCommonData());
    }

    public function ReligionWiseRport()
    {
        return view('employee.report.ReligionWiseReport', $this->getCommonData());
    }

    public function DesignationWiseRport()
    {
        return view('employee.report.DesignationWiseReport', $this->getCommonData());
    }

    public function GenderWiseRportPOST(Request $request){
        return $this->GetReport($request, $request->gender, 'gender');
    }

    public function ReligionWiseRportPOST(Request $request){
        return $this->GetReport($request, $request->reliagion, 'religion');
    }

    public function DesignationWiseRportPOST(Request $request){
        return $this->GetReport($request, null, 'grade_id');
    }

    private function GetReport($request, $type=null, $key=null){
        $branch = Branch::where('id', $request->branch)->first();
        $data = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('grades', 'profile.grade_id', '=', 'grades.id')
        ->select('profile.employee_code', 'users.first_name', 'departments.name as department', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch', 'profile.'. $key , 'grades.name as grade');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        }
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        if ($request->designation) {
            $data->where('users.designation_id', '=', $request->designation);
        }
        if($request->employee_id){
            $data->where('users.id', '=', $request->employee_id);
        }
        if ($type) {
            $data->where('profile.'.$key, '=', $type);
        }
        $data = $data->get();
        return response()->json([
            'data' => $data,
            'branch' => $branch
        ]);
    }
      
}