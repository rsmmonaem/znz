<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Designation;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use App\WHD;
use Illuminate\Support\Facades\DB;

class whdController extends Controller{

    public function index(){
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = DB::table('departments')->get();
        $designation = Designation::all();
        $section = Section::all();
        return view('whd.index', compact('whd', 'group', 'branch', 'department', 'section', 'designation'));
    }

    public function lists(Request $request){
        if (!empty($request->branch_id) || !empty($request->employee_id) || !empty($request->department_id) || !empty($request->designation_id) || !empty($request->section_id)) {
            $query = DB::table('whd')
                ->leftJoin('users', 'whd.user_id', '=', 'users.id')
                ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
                ->select(
                    'whd.*',
                    'users.first_name as user_name',
                    'profile.employee_code'
                );

            // Add conditional filters
            if (!empty($request->employee_id)) {
                $query->where('whd.user_id', $request->employee_id);
            }

            if (!empty($request->branch_id)) {
                $query->where('profile.branch_id', $request->branch_id);
            }

            if (!empty($request->department_id)) {
                $query->where('departments.id', $request->department_id);
            }

            if (!empty($request->designation_id)) {
                $query->where('designations.id', $request->designation_id);
            }

            if (!empty($request->section_id)) {
                $query->where('profile.section_id', $request->section_id);
            }

            if (!empty($request->form_date)) {
                $query->where('whd.date', '>=', $request->form_date);
            }

            if (!empty($request->to_date)) {
                $query->where('whd.date', '<=', $request->to_date);
            }

            // Finalize the query
            $getData = $query->orderBy('whd.date', 'asc')->get();
            return $getData;
        }
    }

    public function create(){
        $branch = Branch::all();
        $group = DB::table('com_group')->get();
        return view('whd.create', compact('branch', 'group'));
    }

    public function store(Request $request){
        $dates = explode(',', $request->date);
        if($request->employee_id != null){
            foreach ($dates as $value) {
                WHD::updateOrCreate(
                    ['user_id' => $request->employee_id, 'date' => $value], 
                    ['user_id' => $request->employee_id, 'date' => $value] 
                );
            }
            return response()->json(['success', 'WHD Created Successfully.']);
        }else{
            $users = Profile::where('branch_id', $request->branch_id)->get();
            foreach ($users as $e) {
                foreach ($dates as $value) {
                    WHD::updateOrCreate(
                        ['user_id' => $e->user_id, 'date' => $value], 
                        ['user_id' => $e->user_id, 'date' => $value] 
                    );
                }
            }
            return response()->json(['success', 'WHD Created Successfully.']);
        }
    }

    public function destroy($id){
        WHD::find($id)->delete();
        return response()->json(['success', 'WHD Deleted Successfully.']);
    }
}