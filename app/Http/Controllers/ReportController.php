<?php
namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function GenderWiseRport()
    {
        $groups = DB::table('com_group')->get();
        $branches = DB::table('branchs')->get();
        $departments = DB::table('departments')->get();
        $designation = DB::table('designations')->get();
        $section = DB::table('sections')->get();
        return view('employee.report.GenderWiseReport', compact('groups', 'branches', 'departments', 'designation', 'section'));
    }

    public function ReligionWiseRport()
    {
        return view('reports.index');
    }

    public function DesignationWiseRport()
    {
        return view('reports.index');
    }

    public function GenderWiseRportPOST(Request $request){
        $branch = Branch::where('id', $request->branch)->first();
        $data = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->select('profile.employee_code','users.first_name', 'departments.name as department', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch','profile.gender');
        if($request->branch){
            $data->where('profile.branch_id', '=', $request->branch);
        }
        if($request->department){
            $data->where('designations.department_id', '=', $request->department);
        }
        if($request->section){
            $data->where('profile.section_id', '=', $request->section);
        }
        if($request->designation){
            $data->where('users.designation_id', '=', $request->designation);
        }
        if($request->gender){
            $data->where('profile.gender', '=', $request->gender);
        }
        $data = $data->get();

        return response()->json([
            'data' => $data,
            'branch' => $branch
        ]);
    }
}