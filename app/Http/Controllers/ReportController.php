<?php
namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Carbon\Carbon;
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
      
    // AdvanceDeductionRport
    public function ProbationaryPeriodRport()
    {
        return view('employee.report.ProbationaryPeriodRport', $this->getCommonData());
    }

    public function ProbationaryPeriodRportPOST(Request $request){
        $branch = Branch::where('id', $request->branch)->first();
        $data = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->select('profile.employee_code', 'users.first_name', 'departments.name as department', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch', 'profile.date_of_joining', 'profile.confirm_date');
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
        if ($request->financial_year) {
            $data->whereRaw('YEAR(profile.date_of_joining) = ?', [$request->financial_year]);
        }
        if ($request->month) {
            $data->whereRaw('MONTH(profile.date_of_joining) = ?', [$request->month]);
        }
        $data = $data->get();
        return response()->json([
            'data' => $data,
            'branch' => $branch
        ]);
    }

    public function AdvanceDeductionRport()
    {
        return view('employee.report.AdvanceDeductionRport', $this->getCommonData());
    }

    public function AdvanceDeductionRportPOST(Request $request){
        $branch = Branch::where('id', $request->branch)->first();
        $data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->select('users.id', 'profile.employee_code', 'users.first_name', 'departments.name as department', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch');
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
        if ($request->employee_id) {
            $data->where('users.id', '=', $request->employee_id);
        }

        $employees = $data->get();

        $currentYear = $request->financial_year;
        $last12Months = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i);
            $last12Months[] = [
                'month' => $month->format('F'), 
                'month_number' => $month->format('m') 
            ];
        }
        $result = [];
        foreach ($employees as $employee) {
            $monthsWithAdvanceSalary = [];
            $salaryAdvance = DB::table('salary_advance')
                ->where('employeeId', $employee->id)
                ->where('effectiveDate', '>=', Carbon::now()->subYear())
                ->whereRaw('YEAR(created_at) = ?', [$currentYear])
                ->latest('created_at')
                ->first();
            if ($salaryAdvance) {
                $totalAmount = DB::table('salary_advance_months')
                ->where('salary_advance_id', $salaryAdvance->id)
                ->sum('amount');
            } else {
                $totalAmount = 0; // Default value if no record is found
            }
            foreach ($last12Months as $monthData) {
                $monthName = $monthData['month'];
                $monthNumber = $monthData['month_number'];
                $salaryDetails = DB::table('employee_salary_details')
                    ->where('employee_id', $employee->id)
                    ->whereRaw('YEAR(to_date) = ?', [$currentYear])
                    ->whereRaw('MONTH(to_date) = ?', [$monthNumber])
                    ->latest('created_at')
                    ->first();
                $monthsWithAdvanceSalary[] = [
                    'month' => $monthName,
                    'advance_salary' => $salaryDetails ? $salaryDetails->advance_salary : null
                ];
            }
            $result[] = [
                'employee_name' => $employee->first_name,
                'employee_code' => $employee->employee_code,
                'department' => $employee->department,
                'designation' => $employee->designation,
                'section' => $employee->section,
                'branch' => $employee->branch,
                'months_with_advance_salary' => $monthsWithAdvanceSalary,
                'totalDeduct' => array_sum(array_column($monthsWithAdvanceSalary, 'advance_salary')),
                'total_amount' => $totalAmount
            ];
        }
        // Return the result
        return response()->json([
            'data' => $result,
            'branch' => $branch
        ]);
    }

    public function TaxDeductionRport() {
        $taxFinacialYears = ['2020-2021','2021-2022','2022-2023','2023-2024','2024-2025','2025-2026','2026-2027','2027-2028','2028-2029','2029-2030'];
        return view('Tax.TaxDeductionRport', $this->getCommonData())->with('taxFinacialYears', $taxFinacialYears); 
    }

    public function TaxDeductionRportPOST(Request $request) {
        $branch = Branch::where('id', $request->branch)->first();
        $data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->LeftJoin('tax_month_adjustments', 'users.id', '=', 'tax_month_adjustments.user_id')
        ->select('users.id', 'profile.employee_code', 'users.first_name', 'departments.name as department', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch')
        ->where('tax_month_adjustments.financial_year', $request->financial_year);
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
        if ($request->employee_id) {
            $data->where('users.id', '=', $request->employee_id);
        }

        $employees = $data->get();

        $currentYear = $request->financial_year; // e.g., 2024
        $last12Months = [];

        // Set the start of the financial year
        list($startYear, $endYear) = explode('-', $currentYear);

        // Define the start and end dates
        $startDate = Carbon::createFromDate($startYear, 7, 1); // July 1, 2024
        $endDate = Carbon::createFromDate($endYear, 6, 30);

        // Iterate through the months from July to June
        // $months = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $last12Months[] = [
                'month' => $currentDate->format('F'),
                'year' => $currentDate->year,
                'month_number' => $currentDate->month
            ];
            $currentDate->addMonth();
        }
        // return $last12Months;
        $result = [];
        foreach ($employees as $employee) {
            $monthsWithAdvanceSalary = [];
            foreach ($last12Months as $monthData) {
                $monthName = $monthData['month'];
                $monthNumber = $monthData['month_number'];
                $year = $monthData['year'];
                $salaryDetails = DB::table('employee_salary_details')
                ->where('employee_id', $employee->id)
                    ->whereRaw('YEAR(to_date) = ?', [$year])
                    ->whereRaw('MONTH(to_date) = ?', [$monthNumber])
                    ->latest('created_at')
                    ->first();
                $monthsWithAdvanceSalary[] = [
                    'month' => $monthName,
                    'tax_amount' => $salaryDetails ? $salaryDetails->tax_amount : null
                ];
            }
            $result[] = [
                'employee_name' => $employee->first_name,
                'employee_code' => $employee->employee_code,
                'department' => $employee->department,
                'designation' => $employee->designation,
                'section' => $employee->section,
                'branch' => $employee->branch,
                'months_with_tax_amount' => $monthsWithAdvanceSalary,
                'totalDeduct' => array_sum(array_column($monthsWithAdvanceSalary, 'tax_amount')),
                // 'total_amount' => $totalAmount
            ];
        }
        // Return the result
        return response()->json([
            'data' => $result,
            'branch' => $branch,
            'tax_year' => $currentYear
        ]);
    }
}