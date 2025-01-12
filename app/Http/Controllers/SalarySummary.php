<?php
namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalarySummary extends Controller
{
    public function salarySummary()
    {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $designation = Designation::all();
        $department = Department::all();
        $section = Section::all();
        // $catrgory = DB::table('category')::all();
        return view('salary_summary.salary-summary', compact('group', 'branch', 'designation', 'department', 'section'));
    }

    public function salarySummaryPost(Request $request)
    {
        $branchDetails = Branch::where('id', $request->branch)->first();
        $data =Branch::leftJoin('profile', 'branchs.id', '=', 'profile.branch_id')
        ->leftJoin('users', 'profile.user_id', '=', 'users.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('employee_separations', 'profile.user_id', '=', 'employee_separations.employee_id')
        ->leftJoin('employee_salary_details', 'profile.user_id','=', 'employee_salary_details.employee_id')
        ->select(
            'branchs.name as branch_name',
            DB::raw('COUNT(DISTINCT profile.id) as active_manpower'),
            DB::raw("COUNT(DISTINCT CASE 
                WHEN employee_separations.effective_date <= '" . Carbon::now() . "' 
                THEN employee_separations.id 
                END) as separated_manpower"),
            DB::raw('SUM(employee_salary_details.net_salary) as net_salary'),
            DB::raw('SUM(employee_salary_details.advance_salary) as advance_salary'),
            DB::raw('SUM(employee_salary_details.total_absents_fee) as attendance_deduction'),
            DB::raw('SUM(employee_salary_details.tax_amount) as tax_amount'),
            DB::raw('SUM(employee_salary_details.arrear_amount) as arrear_amount'),
            DB::raw('SUM(CASE WHEN branchs.id = 7 THEN employee_salary_details.ot_amount ELSE 0 END) as ot_amount'),
            DB::raw('SUM(employee_salary_details.tax_amount) as tax_amount'),
            DB::raw('SUM(employee_salary_details.provident_fund) as provident_fund'),
            DB::raw('SUM(net_salary + arrear_amount + ot_amount - tax_amount - provident_fund - advance_salary) as net_payable')
        )
        ->when($request->branch, function ($query) use ($request) {
            return $query->where('branchs.id', $request->branch);
        })
        ->when($request->department, function ($query) use ($request) {
            return $query->where('designations.department_id', $request->department);
        })
        ->when($request->designation, function ($query) use ($request) {
            return $query->where('users.designation_id', $request->designation);
        })
        ->when($request->section, function ($query) use ($request) {
            return $query->where('profile.section_id', $request->section);
        })
        ->when($request->employee, function ($query) use ($request) {
            return $query->where('profile.user_id', $request->employee);
        })
        ->when($request->financialYear, function ($query) use ($request) {
            // Parse the financialYear as a Carbon instance and get the year
            $year = $request->financialYear;
            return $query->whereRaw('YEAR(employee_salary_details.to_date) = ?', [$year]);
        })
        ->when($request->month, function ($query) use ($request) {
            // Parse the month and get the month number
            $month = $request->month;
            return $query->whereRaw('MONTH(employee_salary_details.to_date) = ?', [$month]);
        })
        ->groupBy('branchs.id', 'branchs.name')
        ->get();
        return response()->json([
            'data' => $data,
            'branch' => $branchDetails,
        ]);
    }
}
    