<?php
namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusProcess extends Controller
{
    private function getCommonData()
    {
        return [
            'groups' => DB::table('com_group')->get(),
            'branches' => DB::table('branchs')->get(),
            'departments' => DB::table('departments')->get(),
            'designation' => DB::table('designations')->get(),
            'section' => DB::table('sections')->get(),
            'bonusType' => DB::table('bonus_types')->get(),
        ];
    }
    public function index()
    {
        return view('bonus.BonusProcessPanel', $this->getCommonData());
    }

    public function indexPost(Request $request)
    {
        $EmployeeData = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->select('users.id', 'profile.date_of_joining');
        if($request->branch){
            $EmployeeData->where('profile.branch_id', $request->branch);
        }
        if($request->department){
            $EmployeeData->where('designations.department_id', $request->department);
        }
        if($request->section){
            $EmployeeData->where('profile.section_id', $request->section);
        }
        if($request->designation){
            $EmployeeData->where('users.designation_id', $request->designation);
        }
        if($request->employee_id){
            $EmployeeData->where('users.id', $request->employee_id);
        }
        if($request->religion){
            $EmployeeData->where('profile.religion', $request->religion);
        }
        $EmployeeData = $EmployeeData->get();
        try{
            foreach ($EmployeeData as $value) {
                $this->getBonus($value->id, $value->date_of_joining, $request);
            }
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
        return response()->json(['status' => 'success', 'message' => 'Bonus Processed Successfully']);
    }
    private function getBonus($id, $dateofjoining = null, $request = null)
    {
        $dateofjoining = Carbon::parse($dateofjoining);
        $effectiveDate = Carbon::parse($request->effectiveDate);
        // Get the total difference in days
        $totalDays = $dateofjoining->diffInDays($effectiveDate);
        // Check if the difference is more than 30 days
        if ($totalDays > 30) {
            // Get the gross salary of the user
            $grossSalary = DB::table('salary_slab')
            ->where('user_id', $id)
            ->where('effactive_date', '<=', Carbon::now())
            ->orderBy('id', 'desc')
            ->value('gross');

            // Get the total months of difference
            $totalMonths = $dateofjoining->diffInMonths($effectiveDate);

            // Bonus calculation logic
            if ($totalMonths < 6) {
                // Less than 12 months, calculate at 50% per month
                $bonus = ($grossSalary / 12) * 0.5 * $totalMonths;
            } else {
                // 12 months or more, calculate for 12 months at 50%
                $bonus = ($grossSalary / 12) * 0.5 * 12;
            }
            DB::table('bonus')->insert([
                'employee_id' => $id,
                'religion' => $request->religion,
                'month' => $request->month,
                'bonus_type' => $request->bonusType,
                'effective_date' => $effectiveDate,
                'entry_date' => Carbon::now(),
                'branch' => $request->branch,
                'amount' => $bonus,
                'gross' => $grossSalary?$grossSalary:0
            ]);
        } else {
            // Less than 30 days, no bonus
            $bonus = 0;
        }
    }

    public function summary() {
        return view('bonus.BonusProcessSummary', $this->getCommonData());
    }

    public function summaryPost(Request $request) {
        $branch = Branch::where('id', $request->branch)->first();
        $Data = Branch::leftJoin('profile', 'branchs.id', '=', 'profile.branch_id')
        ->leftJoin('users', 'profile.user_id', '=', 'users.id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('bonus', 'branchs.id', '=', 'bonus.branch')
        ->select(
            'branchs.id',
            'branchs.name as branch',
            DB::raw('COUNT(DISTINCT bonus.employee_id) as total_employees'),
            DB::raw('SUM(DISTINCT bonus.amount) as total_bonus'),
            DB::raw('SUM(DISTINCT bonus.gross) as total_gross')
        )
        ->groupBy('branchs.id', 'branchs.name');

        if ($request->branch) {
            $Data->where('bonus.branch', $request->branch);
        }
        if ($request->department) {
            $Data->where('departments.id', $request->department);
        }
        if ($request->section) {
            $Data->where('sections.id', $request->section);
        }
        if ($request->designation) {
            $Data->where('designations.id', $request->designation);
        }
        if ($request->employee_id) {
            $Data->where('users.id', $request->employee_id);
        }
        if ($request->financial_year) {
            $Data->whereRaw('YEAR(bonus.effective_date) = ?', [$request->financial_year]);
        }
        if ($request->bonus_type) {
            $Data->where('bonus.bonus_type', $request->bonus_type);
        }
        // Execute the query
        $Data = $Data->get();
        $bonusType =  DB::table('bonus_types')->where('id', $request->bonus_type)->first();
        return response()->json([
         'status' => 'success',
         'data' => $Data, 
         'branch' => $branch,
         'type' => $bonusType
        ]);
        // return view('bonus.BonusProcessSummaryPost', ['data' => $Data, 'request' => $request]);
    }

    public function report(){
        return view('bonus.BonusReport', $this->getCommonData());
    }

    public function reportPost(Request $request){
        $branch = Branch::where('id', $request->branch)->first();
        $Data =// User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        DB::table('bonus')
        ->LeftJoin('users', 'bonus.employee_id', '=', 'users.id')
        ->LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->LeftJoin('bank_accounts', 'users.id', '=', 'bank_accounts.user_id')
        //->leftJoin('bonus', 'branchs.id', '=', 'bonus.branch')
        ->select(
            'users.id',
            'users.first_name',
            'profile.employee_code',
            'branchs.name as branch',
            'designations.name as designation',
            'departments.name as department',
            'sections.name as section',
            'bank_accounts.account_number',
            'profile.date_of_joining',
            'bonus.amount as bonus_amount',
            'bonus.gross as gross_amount'
        );
        if ($request->branch) {
            $Data->where('bonus.branch', $request->branch);
        }
        if ($request->department) {
            $Data->where('departments.id', $request->department);
        }
        if ($request->section) {
            $Data->where('sections.id', $request->section);
        }
        if ($request->designation) {
            $Data->where('designations.id', $request->designation);
        }
        if ($request->employee_id) {
            $Data->where('users.id', $request->employee_id);
        }
        if ($request->financial_year) {
            $Data->whereRaw('YEAR(bonus.effective_date) = ?', [$request->financial_year]);
        }
        if ($request->bonus_type) {
            $Data->where('bonus.bonus_type', $request->bonus_type);
        }
        // Execute the query
        $Data = $Data->get();
        $bonusType =  DB::table('bonus_types')->where('id', $request->bonus_type)->first();
        return response()->json([
            'status' => 'success',
            'data' => $Data,
            'branch' => $branch,
            'type' => $bonusType
        ]);
    }
}