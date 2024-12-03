<?php
namespace App\Http\Controllers;

use App\Branch;
use App\Contract;
use App\Department;
use App\Designation;
use App\Grade;
use App\IncrementsPromotions;
use App\Salary;
use App\Section;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class IncrementAndPromotion extends Controller{
     public function index(){
        $branch = Branch::all();
        $grade = Grade::all();
        $catregory = ['stuff', 'owner'];
        $designation = Designation::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        return view('increment-and-promotion.index',compact('branch', 'catregory', 'employee', 'grade', 'designation'));
     }
     public function ApprovalPanel(){
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $catregory = ['stuff', 'owner'];
        return view('increment-and-promotion.approval-panel',compact('branch', 'department', 'section', 'catregory'));
     }

     public function getUserData(Request $request){
         $id = $request->id;
         $user = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
         ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
         ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
         ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
         ->LeftJoin('contracts', 'users.id', '=', 'contracts.user_id')
         ->LeftJoin('salary', 'contracts.id', '=', 'salary.contract_id')
         ->LeftJoin('grades', 'profile.grade_id', '=', 'grades.id')
         ->where('users.id', '=', $id)
         ->where('salary.salary_type_id', '=', 1)
         ->select('users.id', 'users.first_name', 'profile.employee_code as employee_code', 'profile.date_of_joining', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch', 'salary.amount', 'profile.category', 'grades.name as grade_name')
         ->first();
         return $user;
     }

    public function store(Request $request){
        // Validate the request data
         IncrementsPromotions::create([
            'employee_id'    => $request->input('employee_id'),
            'entry_date'     => $request->input('entry_date'),
            'effective_date' => $request->input('effective_date'),
            'promotion'      => $request->input('promotion'),
            'increment'      => $request->input('increment'),
            'category'       => $request->input('category'),
            'grade'          => $request->input('grade'),
            'amount'         => $request->input('amount'),
            'designation'    => $request->input('designation'),
            'remark'         => $request->input('remark'),
            'old_amount'     => $request->input('old_amount'),
            'status'         => 'pending',
         ]);

         return response()->json(['message' => 'Employee data saved successfully.']);
    }

    public function destroy($id){
        IncrementsPromotions::find($id)->delete();
        return response()->json(['message' => 'Employee data deleted successfully.']);
    }

    public function getIncrementAndPromotionData(Request $request){
        $data = IncrementsPromotions::
          LeftJoin('users', 'increments_promotions.employee_id', '=', 'users.id')
        ->LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('grades', 'increments_promotions.grade', '=', 'grades.id')
        ->select('profile.employee_code', 'users.first_name', 'increments_promotions.*', 'designations.name as designation', 'grades.name as grade_name')
        ->orderby('increments_promotions.id', 'desc')
        ->get();
        return $data;
    }

    public function edit($id){
      $data = IncrementsPromotions::find($id);
      $branch = Branch::all();
      $grade = Grade::all();
      $catregory = ['stuff', 'owner'];
      $designation = Designation::all();
      $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
         ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
         ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
         ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
         ->LeftJoin('contracts', 'users.id', '=', 'contracts.user_id')
         ->LeftJoin('salary', 'contracts.id', '=', 'salary.contract_id')
         ->LeftJoin('grades', 'profile.grade_id', '=', 'grades.id')
         ->where('users.id', '=', $data->employee_id)
         // ->where('salary.salary_type_id', '=', 1)
         ->select('users.id', 'users.first_name', 'profile.employee_code as employee_code', 'profile.date_of_joining', 'designations.name as designation', 'sections.name as section', 'branchs.name as branch', 'salary.amount', 'profile.category', 'grades.name as grade_name')
         ->first();

      // return $employee;
      return view('increment-and-promotion.edit',compact('data', 'branch', 'catregory', 'employee', 'grade', 'designation'));
    }

    public function update(Request $request, $id){
      $data = IncrementsPromotions::find($id);
      $data->entry_date = $request->input('entry_date');
      $data->effective_date = $request->input('effective_date');
      $data->promotion = $request->input('promotion');
      $data->increment = $request->input('increment');
      $data->category = $request->input('category');
      $data->grade = $request->input('grade');
      $data->amount = $request->input('amount');
      $data->designation = $request->input('designation');
      $data->remark = $request->input('remark');
      $data->old_amount = $request->input('old_amount');
      $data->save();
      return response()->json(['message' => 'Employee data updated successfully.']);
    }

    public function ApprovalPanelPost(Request $request){
      $data = IncrementsPromotions::
      LeftJoin('users','increments_promotions.employee_id','=','users.id')
      ->LeftJoin('profile','users.id','=','profile.user_id')
      ->LeftJoin('designations','users.designation_id','=','designations.id')
      ->LeftJoin('departments','designations.department_id','=','departments.id')
      ->LeftJoin('branchs','profile.branch_id','=','branchs.id')
      ->LeftJoin('sections','profile.section_id','=','sections.id')
      ->where('increments_promotions.status','=','pending')
      ->when($request->branch, function ($query) use ($request) {
        return $query->where('profile.branch_id', '=', $request->branch);
      })
      ->when($request->department, function ($query) use ($request) {
        return $query->where('departments.id', '=', $request->department); 
      })
      ->when($request->section, function ($query) use ($request) {
        return $query->where('profile.section_id', '=', $request->section);
      })
      ->when($request->category, function ($query) use ($request) {
        return $query->where('profile.category', '=', $request->category);
      })
      ->select('profile.employee_code','users.first_name','designations.name as designation','departments.name as department', 'increments_promotions.amount as promotedAmount', 'increments_promotions.designation as promotedDesignation', 'increments_promotions.id')
      ->get();

      return $data;
    }

    public function approve(Request $request){
      DB::beginTransaction();
      try {
        // Step 1: Update the status and approval date
        IncrementsPromotions::whereIn('id', $request->ids)
          ->update([
            'status' => 'approved',
            'approved_date' => $request->approved_date
          ]);

        // Step 2: Fetch the user info with the new designation
        $userinfo = IncrementsPromotions::whereIn('increments_promotions.id', $request->ids)
          ->leftJoin('designations as d', 'increments_promotions.designation', '=', 'd.name')
          ->leftJoin('users', 'increments_promotions.employee_id', '=', 'users.id')
          ->leftJoin('salary_slab as s', 'users.id', '=', 's.user_id')
          ->join(DB::raw('(SELECT MAX(id) as id, user_id FROM salary_slab GROUP BY user_id) latest_salary'), 's.id', '=', 'latest_salary.id')
          ->select('increments_promotions.*', 'd.id as new_designation_id', 's.gross')
          ->get();

        // return $userinfo;

        // Step 3: Loop through each record and create contracts and salary records
        foreach ($userinfo as $value) {
          // Prepare contract data
          $contractData = [
            'user_id' => $value->employee_id,
            'designation_id' => $value->new_designation_id,
            'description' => $value->remark,
            'from_date' => $value->entry_date,
            'to_date' => Carbon::parse($value->entry_date)->addYears(1),
            'contract_type_id' => 1,
            'title' => 'Contact '. $value->id
          ];

          // Create a new contract
          $contract = Contract::create($contractData);

          if (!$contract->id) {
              throw new Exception("Failed to create contract for employee ID: {$value->employee_id}");
          }

          $totalBasic = $value->gross * 50 / 100;
          $totalHouseRent = $value->gross * 28 / 100;
          $totalMedical = $value->gross * 9 / 100;
          $totalConveyance = $value->gross * 8 / 100;
          $totalOthers = $value->gross * 5 / 100;

          $salary_type_ids = ['1', '2', '12','8','13'];
          $salaryAmount = [
            'basic' => $totalBasic,
            'house_rent' => $totalHouseRent,
            'medical' => $totalMedical,
            'conveyance' => $totalConveyance,
            'others' => $totalOthers
          ];

          // return $salaryAmount;
          // Map salary types to their respective amounts
          $salary_mapping = array_combine($salary_type_ids, array_values($salaryAmount));

          // Iterate over the mapping to save data type-wise
          foreach ($salary_type_ids as $index => $type_id) {
            $amount = isset($salary_mapping[$type_id]) ? $salary_mapping[$type_id] : 0;
            $salary = new Salary();
            $salary->contract_id = $contract->id;
            $salary->salary_type_id = $type_id;
            $salary->amount = $amount ?: 0;
            $salary->user_id = $value->employee_id;
            $salary->save();
          }
            DB::table('salary_slab')->insert([
              'gross' => $value->gross,
              'user_id' => $value->employee_id,
              'entrydate'=> $value->entry_date,
              'effactive_date' => $value->effective_date,
              'status' => $request->management ? $request->management : 'all'
            ]);
        }
        DB::commit();
        // Return a success response
        return response()->json(['message' => 'Employee data updated successfully.']);
      } catch (Exception $e) {
        DB::rollBack();
        // Return the error message in case of an exception
        return response()->json(['message' => $e->getMessage()]);
      }
    }

    public function reportView(){
      $branch = Branch::all();
      $department = Department::all();
      $designation = Designation::all();
      $section = Section::all();
      $catregory = DB::table('category')->get();
      $group = DB::table('com_group')->get();
      // return $group;
      $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.first_name', 'users.id', 'profile.employee_code')->get();
      return view('increment-and-promotion.report',compact('group','branch', 'department', 'section','designation','catregory','employee'));
    }
    public function reportPost(Request $request){
      $data = IncrementsPromotions::leftJoin('users', 'increments_promotions.employee_id', '=', 'users.id')
      ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
      ->leftJoin('designations','users.designation_id','=','designations.id')
      ->leftJoin('departments','designations.department_id','=','departments.id')
      ->leftJoin('branchs','profile.branch_id','=','branchs.id')
      ->leftJoin('sections','profile.section_id','=','sections.id')
      ->when($request->branch, function ($query) use ($request) {
        return $query->where('profile.branch_id', '=', $request->branch);
      })
      ->when($request->department, function ($query) use ($request) {
        return $query->where('departments.id', '=', $request->department);
      })
      ->when($request->section, function ($query) use ($request) {
        return $query->where('profile.section_id', '=', $request->section);
      })
      ->when($request->category, function ($query) use ($request) {
        return $query->where('profile.category', '=', $request->category);
      })
      ->when($request->designation, function ($query) use ($request) {
        return $query->where('designations.id', '=', $request->designation);
      })      
      ->when($request->employeeId, function ($query) use ($request) {
        return $query->where('users.id', '=', $request->employeeId);
      })
      ->when($request->month && $request->financialYear, function ($query) use ($request) {
        return $query->whereMonth('increments_promotions.entry_date', '=', $request->month)->whereYear('increments_promotions.entry_date', '=', $request->financialYear);
      })
      ->when($request->financialYear && $request->dateFilter, function ($query) use ($request) {
        $year = $request->financialYear; 
        $customDate = '';
        if($request->dateFilter == 'before'){
          $customDate = Carbon::createFromDate($year, 1, 1)->subYears(5);
        }else if($request->dateFilter == 'after'){
          $customDate = Carbon::createFromDate($year, 1, 1)->addYears(5);
        }
        return $query->whereYear('increments_promotions.entry_date', '>=', $customDate);
      })
      ->where('increments_promotions.status','=','approved')
      ->select('users.id','profile.employee_code','users.first_name','designations.name as designation','departments.name as department','branchs.name as branch','sections.name as section','increments_promotions.amount as promotedAmount','increments_promotions.designation as promotedDesignation','increments_promotions.id','profile.date_of_joining', 'increments_promotions.amount as promotedAmount', 'increments_promotions.old_amount','increments_promotions.promotion', 'increments_promotions.increment')
      ->get();
     
      $dataa = [
        'data' => $data,
        'date' => date('Y-m-d')
      ];
      return $dataa;
    }

    public function promotedEmployee(){
    $group = DB::table('com_group')->get();
    $branch = Branch::all();
    $department = Department::all();
    $section = Section::all();
    $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
      ->select('users.first_name', 'users.id', 'profile.employee_code')
      ->get();
    $designation = Designation::all();
      return view('increment-and-promotion.promoted-employee',compact('group','branch', 'department', 'section','designation','employee'));
    }
    public function promotedEmployeePOST(Request $request){
    $userids = IncrementsPromotions::leftJoin('users', 'increments_promotions.employee_id', '=', 'users.id')
      ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
      ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
      ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
      ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
      ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
      ->when($request->employeeId, function ($query) use ($request) {
        return $query->where('users.id', '=', $request->employeeId);
      })
      ->when($request->branch, function ($query) use ($request) {
        return $query->where('profile.branch_id', '=', $request->branch);
      })
      ->when($request->department, function ($query) use ($request) {
        return $query->where('departments.id', '=', $request->department);
      })
      ->when($request->section, function ($query) use ($request) {
        return $query->where('profile.section_id', '=', $request->section);
      })
      ->when($request->formDate && $request->toDate, function ($query) use ($request) {
        return $query->whereBetween('increments_promotions.entry_date', [$request->formDate, $request->toDate]);
      })
      ->select('users.id', 'profile.employee_code', 'users.first_name', 'designations.name as designation', 'departments.name as department', 'branchs.name as branch', 'sections.name as section', 'increments_promotions.amount as promotedAmount', 'increments_promotions.designation as promotedDesignation', 'increments_promotions.id', 'profile.date_of_joining', 'increments_promotions.old_amount', 'increments_promotions.promotion', 'increments_promotions.increment')
      ->where('promotion', '=', '1')
      ->where('increments_promotions.status', '=', 'approved')
      ->groupBy('users.id') // Group by user ID for unique records
      ->orderBy('increments_promotions.entry_date', 'desc') // Order by the latest entry date
      ->get();

    return $userids;

    }
}