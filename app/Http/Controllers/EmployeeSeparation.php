<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use App\EmployeeSeparation as AppEmployeeSeparation;
use App\Section;
use Illuminate\Http\Request;
use App\User;
use Stripe\Refund;
use DB;

class EmployeeSeparation extends Controller
{
    public function index()
    {
        $separetionType = [
            "Retirement",
            "Voluntary termination",
            "Involuntary termination",
            "Resignation",
            "Dismissal",
            "Layoff",
            "Mutual termination",
            "Termination policy",
            "Wrongful termination",
            "Expiration or completion of contract",
            "Retrenchment",
            "Employment at-will",
            "Death of an employee",
            "Dismissal of employee",
            "Fired",
            "Constructive discharge",
            "Death",
            "Employee disciplinary action",
            "Job dissatisfaction",
            "Physical disability"
        ];
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        return view('employee-separation.create', compact('separetionType', 'employee'));
    }
    
    // Get Employee Separetion Data Store
    public function store(Request $request)
    {
        try {
            // Insert data into the table
            $separation = new AppEmployeeSeparation();
            $separation->employee_id = $request->input('employeeId');
            $separation->employee_name = $request->input('employeeName');
            $separation->branch = $request->input('branch');
            $separation->designation = $request->input('designation');
            $separation->doj = $request->input('doj');
            $separation->section = $request->input('section');
            $separation->separation_type = $request->input('separationType');
            $separation->reason = $request->input('reason');
            $separation->entry_date = $request->input('entryDate');
            $separation->separation_arise_date = $request->input('separationAriseDate');
            $separation->last_working_day = $request->input('lastWorkingDay');
            $separation->effective_date = $request->input('effectiveDate');
            $separation->notice_period = $request->input('noticePeriod');
            $separation->mandatory_notice = $request->input('mandatoryNotice');
            $separation->short_day = $request->input('shortDay');
            // Save the model
            $separation->save();
            // Return response

            $user = User::find($request->input('employeeId'));
            if ($user) {
                $user->status = 'Separated';
                $user->save();
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Employee separation record saved successfully.',
                'data' => $separation,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save employee separation record.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function quickInsert(Request $request)
    {
        try {
            $code = $request->input('employee_code');
            if (!$code) {
                return response()->json(['status' => 'error', 'message' => 'Employee code is required.']);
            }

            $profile = DB::table('profile')->where('employee_code', $code)->first();

            if (!$profile) {
                return response()->json(['status' => 'error', 'message' => 'No employee found for this code.']);
            }

            $user = DB::table('users')->where('id', $profile->user_id)->first();
            $branch = DB::table('branchs')->where('id', $profile->branch_id)->value('name');
            $section = DB::table('sections')->where('id', $profile->section_id)->value('name');
            $designation = DB::table('designations')->where('id', $user->designation_id)->value('name');

            DB::table('employee_separations')->insert([
                'employee_id' => $user->id,
                'employee_name' => $user->first_name,
                'branch' => $branch,
                'separation_type' => 'Resignation',
                'designation' => $designation,
                'doj' => $profile->date_of_joining,
                'section' => $section,
                'entry_date' => now(),
                'separation_arise_date' => now(),
                'last_working_day' => now(),
                'created_at' => now(),
            ]);

            DB::table('users')->where('id', $user->id)->update(['status' => 'Separated']);

            return response()->json(['status' => 'success', 'message' => 'Employee separation inserted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to insert separation record.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    // Get Employee Separetion Lists
    public function lists()
    {
        $separation = AppEmployeeSeparation::LeftJoin('profile', 'employee_separations.employee_id', '=', 'profile.user_id')
        ->select(
            'employee_separations.employee_name', 
            'employee_separations.id', 
            'employee_separations.designation',
            'employee_separations.branch',
            'employee_separations.doj',
            'employee_separations.section',
            'employee_separations.separation_type',
            'employee_separations.reason',
            'employee_separations.entry_date',
            'employee_separations.separation_arise_date',
            'employee_separations.last_working_day',
            'employee_separations.effective_date',
            'employee_separations.notice_period',
            'employee_separations.mandatory_notice',
            'employee_separations.short_day',
            'profile.employee_code as employee_id'
        )
        ->orderby('id','desc')
        ->get();
        return $separation;
    }

    public function destroy($id)
    {
        $separation = AppEmployeeSeparation::find($id);
        $user = User::find($separation->employee_id);
        if ($user) {
            $user->status = 'active';
            $user->save();
        }
        $separation->delete();
        return response()->json(['status' => 'success', 'message' => 'Employee separation record deleted successfully.']);
    }
    // Get Employee Separetion Edit
    public function edit($id)
    {
        $separationType = [
            "Retirement",
            "Voluntary termination",
            "Involuntary termination",
            "Resignation",
            "Dismissal",
            "Layoff",
            "Mutual termination",
            "Termination policy",
            "Wrongful termination",
            "Expiration or completion of contract",
            "Retrenchment",
            "Employment at-will",
            "Death of an employee",
            "Dismissal of employee",
            "Fired",
            "Constructive discharge",
            "Death",
            "Employee disciplinary action",
            "Job dissatisfaction",
            "Physical disability"
        ];
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $separation = AppEmployeeSeparation::find($id);
        // return $separation;
        return view('employee-separation.edit', compact('separation','employee', 'separationType'));
    }
    // Get Employee Separetion Update
    public function update(Request $request, $id)
    {
        $separation = AppEmployeeSeparation::find($id);
        $separation->employee_name = $request->input('employeeName');
        $separation->branch = $request->input('branch');
        $separation->designation = $request->input('designation');
        $separation->doj = $request->input('doj');
        $separation->section = $request->input('section');
        $separation->separation_type = $request->input('separationType');
        $separation->reason = $request->input('reason');
        $separation->entry_date = $request->input('entryDate');
        $separation->separation_arise_date = $request->input('separationAriseDate');
        $separation->last_working_day = $request->input('lastWorkingDay');
        $separation->effective_date = $request->input('effectiveDate');
        $separation->notice_period = $request->input('noticePeriod');
        $separation->mandatory_notice = $request->input('mandatoryNotice');
        $separation->short_day = $request->input('shortDay');
        // Save the model
        $separation->save();
        // Return response
        return response()->json([
            'status' => 'success',
            'message' => 'Employee separation record updated successfully.',
            'data' => $separation,
        ]);
    }
    // Get UserData Function
    public function getUserData(Request $request)
    {
        $id = $request->id;
        $user = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->select('users.id', 'users.first_name', 'profile.employee_code', 'profile.date_of_joining', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch','profile.category')
        ->where('users.id', '=', $id)->first();
        return $user;
    }
    public function  Report()
    {
        $branch = Branch::get();
        $designation = Designation::get();
        $section = Section::get();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $department = Department::get();
        return view('employee-separation.report', compact('branch', 'designation', 'section', 'employee','department'));
    }

    public function  reportPost(Request $request){
        // return $request->all();
        $data = AppEmployeeSeparation::leftJoin('users', 'employee_separations.employee_id', '=', 'users.id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        if ($request->category) {
            $data->where('profile.category', '=', $request->category);
        }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        }
        if ($request->designation) {
            $data->where('users.designation_id', '=', $request->designation);
        }
        if ($request->employee) {
            $data->where('employee_separations.employee_id', '=', $request->employee);
        }
        if ($request->fromDate) {
            $data->where('employee_separations.entry_date', '>=', $request->fromDate);
        }
        if ($request->toDate) {
            $data->where('employee_separations.entry_date', '<=', $request->toDate);
        }
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        $data = $data->select(
            'profile.employee_code',
            'users.first_name',
            'users.designation_id',
            'designations.name as designation',
            'departments.name as department',
            'sections.name as section',
            'branchs.name as branch_name',
            'profile.date_of_joining',
            'profile.date_of_birth',
            'profile.blood_group',
            'profile.job_nature',
            'profile.category',
            'profile.contact_number',
            'profile.gender',
            'employee_separations.last_working_day',
            'employee_separations.entry_date as date'
        )->get();

        $response = array();
        $response['data'] = $data;
        $response['date'] = $request->fromDate. ' to ' . $request->toDate;
        return $response;
    }
}
