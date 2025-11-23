<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\User;
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
        $data = Branch::leftJoin('profile', 'branchs.id', '=', 'profile.branch_id')
            ->leftJoin('users', 'profile.user_id', '=', 'users.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('employee_separations', 'profile.user_id', '=', 'employee_separations.employee_id')
            ->leftJoin('employee_salary_details', 'profile.user_id', '=', 'employee_salary_details.employee_id')
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


    public function SalaryBankStatement(Request $request)
    {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $designation = Designation::all();
        $department = Department::all();
        $section = Section::all();
        $bankType = DB::table('bank_accounts')
            ->select('bank_name')
            ->where('bank_name', '!=', ' ')
            ->distinct()
            ->get();

        // return $bankType;
        return view('salary_summary.salary-bank-statement', compact('group', 'branch', 'designation', 'department', 'section', 'bankType'));
    }

    public function SalaryBankStatementPost(Request $request)
    {
        $branchData = Branch::where('id', $request->branch)->first();
        $data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('employee_salary_details', 'profile.user_id', '=', 'employee_salary_details.employee_id')
            ->leftJoin(
                DB::raw('(SELECT * FROM bank_accounts WHERE id IN (SELECT MAX(id) FROM bank_accounts GROUP BY user_id)) as latest_bank_account'),
                'profile.user_id',
                '=',
                'latest_bank_account.user_id'
            )
            ->leftJoin(
                DB::raw('(SELECT * FROM salary_bank WHERE effective_date <= CURDATE() AND status = 0 AND id IN (SELECT MAX(id) FROM salary_bank GROUP BY user_id)) as latest_salary_bank'),
                'profile.user_id',
                '=',
                'latest_salary_bank.user_id'
            )
            ->select(
                'profile.employee_code',
                'users.first_name',
                'latest_bank_account.bank_name as latest_bank_name',
                'latest_bank_account.account_number as latest_bank_account_number',
                'latest_bank_account.account_name as latest_bank_account_name',
                'latest_salary_bank.effective_date as salary_bank_effective_date',
                'latest_salary_bank.bank_amount as salary_bank_amount'
            )
            ->when($request->branch, function ($query) use ($request) {
                return $query->where('profile.branch_id', $request->branch);
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
            ->when($request->bankType, function ($query) use ($request) {
                return $query->where('latest_bank_account.bank_name', $request->bankType);
            })
            ->get();

        return response()->json([
            'data' => $data,
            'branch' => $branchData,
            'financialYear' => $request->financialYear,
            'month' => Carbon::create()->month($request->month)->format('F'),
        ]);
    }

    public function SalaryTransferGlance(Request $request){
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $designation = Designation::all();
        $department = Department::all();
        $section = Section::all();
        $category = DB::table('category')->get();
        return view('salary_summary.salary-transfer-glace', compact('group', 'category', 'branch', 'designation', 'department', 'section'));
    }



    public function SalaryTransferGlancePost(Request $request)
    {
        $branchData = Branch::where('id', $request->branch)->first();
    
        $data = DB::table('employee_salary_details as esd')
            ->leftJoin('users', 'esd.employee_id', '=', 'users.id')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('category', 'profile.category', '=', 'category.id')
            ->leftJoin(
                DB::raw('(SELECT * FROM salary_bank 
                            WHERE effective_date <= CURDATE() 
                            AND status = 0 
                            AND id IN (SELECT MAX(id) FROM salary_bank GROUP BY user_id)
                         ) as latest_salary_bank'),
                'profile.user_id', '=', 'latest_salary_bank.user_id'
            )
            ->select(
                'esd.id as esd_id',
                'branchs.name as branch_name',
                'profile.employee_code',
                'users.first_name',
                'designations.name as designation_name',
                'departments.name as department_name',
                'sections.name as section_name',
                'esd.total_absents_fee as attendance_deduction',
                'esd.tax_amount',
                'esd.arrear_amount',
                'esd.provident_fund',
                'esd.advance_salary',
                'esd.net_salary',
                'esd.ot_amount',
                'esd.gross_salary',
                'esd.bankamount',
                'esd.cashamount'
            )
            // ---------------- Latest salary per employee ---------------- //
            ->whereIn('esd.id', function($query){
                $query->select(DB::raw('MAX(id)'))
                      ->from('employee_salary_details')
                      ->groupBy('employee_id');
            })
            // ---------------- Filters ---------------- //
            ->when($request->branch, function ($q) use ($request) {
                return $q->where('branchs.id', $request->branch);
            })
            ->when($request->department, function ($q) use ($request) {
                return $q->where('designations.department_id', $request->department);
            })
            ->when($request->designation, function ($q) use ($request) {
                return $q->where('users.designation_id', $request->designation);
            })
            ->when($request->section, function ($q) use ($request) {
                return $q->where('profile.section_id', $request->section);
            })
            ->when($request->employee, function ($q) use ($request) {
                return $q->where('profile.user_id', $request->employee);
            })
            ->when($request->month, function ($q) use ($request) {
                return $q->whereRaw('MONTH(esd.to_date) = ?', [$request->month]);
            })
            ->when($request->financialYear, function ($q) use ($request) {
                return $q->whereRaw('YEAR(esd.to_date) = ?', [$request->financialYear]);
            })
            ->when($request->category, function ($q) use ($request) {
                return $q->where('category.name', $request->category);
            })
            ->orderBy('profile.employee_code', 'DESC')
            ->get();
    
        return response()->json([
            'data'          => $data,
            'branch'        => $branchData,
            'financialYear' => $request->financialYear,
            'month'         => Carbon::create()->month($request->month)->format('F'),
        ]);
    }




}
