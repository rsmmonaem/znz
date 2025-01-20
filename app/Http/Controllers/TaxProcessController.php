<?php
namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxProcessController extends Controller
{

    private function GetCommonData()
    {
        return [
            'groups' => DB::table('com_group')->get(),
            'branches' => DB::table('branchs')->get(),
            'departments' => DB::table('departments')->get(),
            'designation' => DB::table('designations')->get(),
            'section' => DB::table('sections')->get(),
            'tax_cost_unit_type' => DB::table('tax_cost_unit_type')->get()
        ];
    }

    public function CostUnitSetPanel()
    {
        return view('Tax.cost_unit_set_panel', $this->GetCommonData());
    }

    public function CostUnitSetPanelPost(Request $request){
        // return $request->all();
        $id = DB::table('tax_cost_unit')->insertGetId([
            'employee_id' => $request->employeeId,
            'cost_unit_type' => $request->costUnit,
            'effective_date' => $request->effectiveDate,
            'branch_id' => $request->branch,
            'remarks' => $request->remarks,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // Fetch the newly created record using the ID
        $data = DB::table('tax_cost_unit')
        ->leftJoin('users', 'tax_cost_unit.employee_id', '=', 'users.id')
        ->LeftJoin('profile', 'tax_cost_unit.employee_id', '=', 'profile.user_id')
        ->leftJoin('branchs', 'tax_cost_unit.branch_id', '=', 'branchs.id')
        ->leftJoin('tax_cost_unit_type', 'tax_cost_unit.cost_unit_type', '=', 'tax_cost_unit_type.id')
        ->select('profile.employee_code as ID', 'branchs.name as branch','users.first_name', 'tax_cost_unit_type.name as cost_unit_type', 'tax_cost_unit.effective_date', 'tax_cost_unit.remarks','tax_cost_unit.created_at')
        ->where('tax_cost_unit.id', $id)
        ->first();

        return response()->json([
            'success' => true,
            'message' => 'Cost Unit Set Successfully.',
            'data' => $data
        ]);
    }

    public function MonthWiseChallanSetPanel(){
        $costUnitName = DB::table('tax_cost_unit_type')->get();
        $taxFinacialyear = ['2024-2025', '2025-2026', '2026-2027', '2028-2029', '2029-2030', '2031-2032'];
        $finacialyear = ['2024','2025','2026','2027','2028','2029','2030'];
        $taxBank = DB::table('tax_bank')->get();
        return view('Tax.month-wise-challan-set-panel', compact('costUnitName', 'taxFinacialyear', 'finacialyear', 'taxBank'));
    }

    public function GetCostUnitEmployee($id){
        $empoloyee = DB::table('tax_cost_unit')
        ->leftJoin('users', 'tax_cost_unit.employee_id','=', 'users.id')
        ->leftJoin('profile', 'users.id','=', 'profile.user_id')
        ->where('cost_unit_type', $id)
        ->select('users.id as id', 'profile.employee_code as employee_code', 'users.first_name as name')
        ->get();
        return $empoloyee;
    }

    public function GetBankBranch($id){
        $banckBranch = DB::table('tax_bank_branch')->where('tax_bank_id', $id)->get();
        return $banckBranch;
    }

    public function MonthWiseChallanSetPanelPOST(Request $request){
        // return $request->all();
        // return $request->employee_id;
        foreach ($request->employee_id as $value) {
            DB::table('tax_month_wise_challan')->insert([
                'bankbranch' => $request->bankbranch,
                'bankname' => $request->bankname,
                'challan_amount' => $request->challan_amount,
                'challan_no' => $request->challan_no,
                'employee_id' => $value,
                'financialyear' => $request->financialyear,
                'month' => $request->month,
                'paymentdate' => $request->paymentdate,
                'taxfinancialyear' => $request->taxfinancialyear,
                'unitname' => $request->unitname
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tax Month Wise Cost Unit Set Successfully.',
        ]);
    }

    public function MonthWiseChallanSetPanelGetData(){
        $data = DB::table('tax_month_wise_challan')
        ->leftJoin('users', 'tax_month_wise_challan.employee_id', '=', 'users.id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('tax_cost_unit_type', 'tax_month_wise_challan.unitname', '=', 'tax_cost_unit_type.id')
        ->leftJoin('tax_bank', 'tax_month_wise_challan.bankname', '=', 'tax_bank.id')
        ->leftJoin('tax_bank_branch', 'tax_month_wise_challan.bankbranch', '=', 'tax_bank_branch.id')
        ->select('tax_month_wise_challan.*', 'users.first_name', 'profile.employee_code as employee_code', 'tax_cost_unit_type.name as unitname', 'tax_bank.name as bankname', 'tax_bank_branch.name as bankbranchname')
        ->limit(150)
        ->orderby('tax_month_wise_challan.id', 'desc')
        ->get();
        return $data;
    }

    public function MonthWiseChallanDelete(Request $request){
        // return $request->all();
        DB::table('tax_month_wise_challan')->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Tax Month Wise Cost Unit Delete Successfully.',
        ]);
    }

    public function MonthWiseAdjutmentPanel(){
        $taxFinacialyear = ['2024-2025', '2025-2026', '2026-2027', '2028-2029', '2029-2030', '2031-2032'];
        $branch = Branch::all();
        return view('Tax.month-wise-adjutment-panel', compact('taxFinacialyear', 'branch'));
    }

    public function MonthWiseAdjutmentPanelPOSTSearch(Request $request){
        // return $request->all();
        $data = User::where('users.id', $request->employee_id)
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('profile.employee_code as employee_code', 'users.first_name as name')
        ->first();
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function MonthWiseAdjutmentPanelPOST(Request $request){
        // return $request->all();
        DB::table('tax_month_adjustments')->insert([
            'user_id' => $request->employee_id,
            'name' => $request->name,
            'financial_year' => $request->finacialyear,
            'july' => $request->july,
            'august' => $request->aug,
            'september' => $request->sep,
            'october' => $request->oct,
            'november' => $request->nov,
            'december' => $request->dec,
            'january' => $request->jan,
            'february' => $request->feb,
            'march' => $request->mar,
            'april' => $request->apr,
            'may' => $request->may,
            'june' => $request->jun,
            'total' => $request->total
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tax Month Wise Cost Unit Set Successfully.',
        ]);
    }


    public function CostUnitWiseChallanList(){
        $tax_cost_unit_type = DB::table('tax_cost_unit_type')->get();
        return view('Tax.CostUnitWiseChallanList', compact('tax_cost_unit_type'));
    }

    public function CostUnitWiseChallanListPOST(Request $request){
        $data = DB::table('tax_month_wise_challan')
        ->leftJoin('users', 'tax_month_wise_challan.employee_id', '=', 'users.id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftjoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('tax_month_adjustments', 'tax_month_wise_challan.employee_id', '=', 'tax_month_adjustments.user_id')
        ->select('branchs.name as branch','users.first_name','designations.name as designation', 'departments.name as department', 'profile.employee_code as employee_code','sections.name as section', 'tax_month_wise_challan.challan_no', 'tax_month_wise_challan.challan_amount', 'tax_month_adjustments.*', 'tax_month_wise_challan.paymentdate')
        ->where('tax_month_wise_challan.unitname', $request->costUnit);
        return $data->get();
    }
    
}