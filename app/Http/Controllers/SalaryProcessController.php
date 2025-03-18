<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Branch;
use App\Clock;
use App\Department;
use App\Section;
use App\User;
use App\Designation;
use App\UserShift;
use App\WHD;
use Carbon\Carbon;

class SalaryProcessController extends Controller
{
    public function index()
    {
        // return $weeklyHolidays = [Carbon::FRIDAY];
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $designation = Designation::all();
        return view('salary-process.index', compact('group', 'branch', 'department', 'section', 'employee', 'designation'));
    }

    public function SalaryProcessView(Request $request)
    {
    //     $employeeId= 55;
    //     $toDate = date('Y-m-d');

    //     $advanceSalary = DB::table('salary_advance')
    //     ->leftJoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
    //     ->where('employeeId', $employeeId)
    //     ->where('salary_advance.effectiveDate', '<', $toDate)
    //     ->select('salary_advance.grossValue', 'salary_advance.grossOption', 'salary_advance_months.month', 'salary_advance_months.amount')
    //     ->get();
    
    // $monthNumber = (int)date('m', strtotime($toDate));
    // $advanceAmount = 0;
    
    // foreach ($advanceSalary as $record) {
    //     if ($record->month == $monthNumber) {
    //         $advanceAmount = $record->month; 
    //     }
    // }
    // return $advanceAmount;
      DB::beginTransaction();
      try{
            // Define the base query for user data
            $data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
                ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
                ->leftJoin('departments', 'designations.department_id', '=', 'departments.id');

            // Apply filters if present
            if ($request->branch || $request->department || $request->section) {
                $data->whereNotIn('users.id', function ($query) {
                    $query->select('employee_id')->from('employee_separations')
                    ->where('effective_date', '>', Carbon::now());
                });
            }
            if ($request->branch) {
                $data->where('profile.branch_id', '=', $request->branch);
            }
            if ($request->department) {
                $data->where('designations.department_id', '=', $request->department);
            }
            if ($request->employeeId) {
                $data->where('users.id', '=', $request->employeeId);
            }
            if ($request->section) {
                $data->where('profile.section_id', '=', $request->section);
            }

            // Get the employee IDs
            $user_ids = $data->pluck('users.id');
            $processedEmployeeIds = [];

            // $startDate = Carbon::parse($request->formDate);
            // $endDate = Carbon::parse($request->toDate);
            // $TotalDays = $startDate->diffInDays($endDate) + 1;
            // return $TotalDays;
            // Handle salary processing for each user
            foreach ($user_ids as $user_id) {
                // Check if salary already exists for the employee in the given date range
                // $exists = DB::table('employee_salary_details')
                //     ->where('employee_id', $user_id)
                //     ->where('form_date', $request->formDate)
                //     ->where('to_date', $request->toDate)
                //     ->exists();

                // if ($exists) {
                //     continue; // Skip if already processed
                // }


                // Handle special case for branch ID 7
                if ($request->branch == env('BRANCH_ID')) {
                    // Call the SalaryProcess method to process salary for each user
                    $processedId = $this->SalaryProcessByBranch($user_id, $request->formDate, $request->toDate, $request->remarks);
                    if ($processedId !== null) {
                        $processedEmployeeIds[] = $processedId;  // Collect successfully processed employee IDs
                    }
                } else {
                    // Call appropriate salary process method
                    $processedId = $this->SalaryProcess($user_id, $request->formDate, $request->toDate, $request->remarks, $request->branch);
                    if ($processedId !== null) {
                        $processedEmployeeIds[] = $processedId;  // Collect successfully processed employee IDs
                    }
                }
            }
            DB::commit();
            // Return response with processed employee IDs
            return response()->json([
                'status' => 'success',
                'processed_employee_ids' => $processedEmployeeIds,
                'message' => 'Salary processed successfully.',
            ]);
      }catch(Exception $e){
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to process salary: ' . $e->getMessage(),
        ]);
      }
    }


    public function SalaryProcess($employeeId, $formDate, $toDate, $remarks, $branch_id = null)
    {
        // Get Employee
        $User = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->where('users.id', '=', $employeeId)
        ->select('users.id', 'profile.employee_code', 'users.first_name', 'designations.name as designation', 'departments.name as department', 'sections.name as section', 'branchs.name as branch')
        ->first();
        // return $User->employee_code;
        // Total Present
        $getTotalPresent = DB::table('clocks')
        ->whereBetween('date', [$formDate, $toDate])
        ->where('user_id', $employeeId)
        ->distinct('date') 
        ->count('date');

        // Holidays
        $holidays = DB::table('holidays')
        ->whereBetween('date', [$formDate, $toDate])
        // ->where('user_id', $employeeId)
        ->distinct('date') 
        ->count('date');

        //Spacial Holidays
        $spacial_holidays = DB::table('spacial_holidays')
        ->whereBetween('date', [$formDate, $toDate])
        ->where('user_id', $employeeId)
        ->distinct('date') 
        ->count('date');

        // Leave
        // $leave = DB::table('leaves')
        // ->whereBetween('from_date', [$formDate, $toDate])
        // ->where('user_id', $employeeId)
        // ->where('leave_type_id', '!=', 9)
        // ->where('status', 'approved')
        // ->distinct('from_date') 
        // ->count('from_date');

        $leave = DB::table(function ($query) use ($formDate, $toDate, $employeeId) {
            $query->select('from_date as leave_date')
                ->from('leaves')
                ->whereBetween('from_date', [$formDate, $toDate])
                ->where('user_id', $employeeId)
                ->where('leave_type_id', '!=', 9)
                ->where('status', 'approved')
            ->union(
                DB::table('leaves')
                    ->select('to_date as leave_date')
                    ->whereBetween('to_date', [$formDate, $toDate])
                    ->where('user_id', $employeeId)
                    ->where('leave_type_id', '!=', 9)
                    ->where('status', 'approved')
            );
        }, 'leave_dates')
        ->distinct()
        ->count('leave_date');

        // LWP
        $lwp = DB::table('leaves')
        ->whereBetween('from_date', [$formDate, $toDate])
        ->where('user_id', $employeeId)
        ->where('leave_type_id', '==', 9)
        ->where('status', 'approved')
        ->distinct('from_date') 
        ->count('from_date');

        // Total Days Of Month
        $startDate = Carbon::parse($formDate);
        $endDate = Carbon::parse($toDate); 
        $TotalDays = $startDate->diffInDays($endDate) + 1;

        // Initialize an array to store the Friday dates
        $fridays = WHD::where('user_id', $employeeId)->whereBetween('date', [$formDate, $toDate])->pluck('date')->toArray();
        // Total Fridays
        $totalFridays = count($fridays);
        // Sarary Slab
        $salaryslab = DB::table('salary_slab')
        ->where('user_id', $employeeId)
        ->where('effactive_date', '<', $toDate)
        ->select('gross')
        ->latest('id')
        ->first();
        // Fetch earning salary types only once
        $latestSalaryData = DB::table('salary')
        ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
        ->where('salary.user_id', $employeeId)
        ->where('salary_types.salary_type', 'earning')
        ->select('salary.id', 'salary.contract_id', 'salary.salary_type_id', 'salary.amount', 'salary.created_at', 'salary.updated_at', 'salary_types.head', 'salary_types.salary_type')
        ->orderBy('salary.salary_type_id') 
        ->orderBy('salary.created_at', 'desc') 
        ->get(); 
        $latestSalaryData = collect($latestSalaryData);
        $latestSalaryData = $latestSalaryData->unique('salary_type_id');

        // Fetch Deduction salary types only once
        $deductionsData = DB::table('salary')
        ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
        ->where('salary.user_id', $employeeId)
        ->where('salary_types.salary_type', 'deduction')
        ->select('salary.id', 'salary.contract_id', 'salary.salary_type_id', 'salary.amount', 'salary.created_at', 'salary.updated_at', 'salary_types.head', 'salary_types.salary_type')
        ->orderBy('salary.salary_type_id')
        ->orderBy('salary.created_at', 'desc')
        ->get();
        $deductionsData = collect($deductionsData);
        $deductionsData = $deductionsData->unique('salary_type_id');

            $advanceSalary = DB::table('salary_advance')
            ->leftJoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
            ->where('employeeId', $employeeId)
            ->where('salary_advance.effectiveDate', '<', $toDate)
            ->select('salary_advance.grossValue', 'salary_advance.grossOption', 'salary_advance_months.month', 'salary_advance_months.amount')
            ->get();
        
        $monthNumber = (int)date('m', strtotime($toDate));
        $advanceAmount = 0;
        
        foreach ($advanceSalary as $record) {
            if ($record->month == $monthNumber) {
                $advanceAmount = $record->amount; 
            }
        }

        // $totalWorkedDays = $getTotalPresent + $holidays + $leave + $totalFridays + $spacial_holidays;
        // $totalWorkedDays = $getTotalPresent + $holidays + $leave + $totalFridays + $spacial_holidays;
        $totalWorkedDays = $getTotalPresent;
        $totalAbsents = $TotalDays-$totalWorkedDays-$totalFridays-$spacial_holidays-$holidays-$leave;
        $perdaysAmount =  $salaryslab ? $salaryslab->gross / $TotalDays : 0;
        // $GrossAmountSalaryPerDays = $perdaysAmount * $totalWorkedDays;
        $GrossAmountSalaryPerDays = $perdaysAmount * $TotalDays;

        $TotalDiductionAmount = $perdaysAmount * $totalAbsents;

        $TotalFridaysAmount = $perdaysAmount * $totalFridays;
        $GrossSalaryAmountAfterAdvance = $GrossAmountSalaryPerDays;
        // return $deductionsData->where('salary_type_id', 5);
        if(count($deductionsData->where('salary_type_id', 5)) === 0){
            $ProvidentFund = 0;
        }else{
            $ProvidentFund = $deductionsData->where('salary_type_id', 5)->first()->amount;
        }

        $GrossSalaryAmountAfterProvidentFund = $GrossSalaryAmountAfterAdvance - $ProvidentFund;
        
        $monthColumns = [
            1 => 'january',
            2 => 'february',
            3 => 'march',
            4 => 'april',
            5 => 'may',
            6 => 'june',
            7 => 'july',
            8 => 'august',
            9 => 'september',
            10 => 'october',
            11 => 'november',
            12 => 'december',
        ];
        $monthNumber = (int)date('m', strtotime($toDate));
        // Get the column name for the provided month number
        $monthColumn = isset($monthColumns[$monthNumber]) ? $monthColumns[$monthNumber] : null;

        $taxAmount = DB::table('tax_month_adjustments')
        ->where('user_id', $employeeId)
        ->latest('created_at')
            ->first();
        $amount = 0;
        if ($taxAmount) {
            $amount = $taxAmount->$monthColumn;
        }
        // return $taxAmount;
        $netSalary = $GrossSalaryAmountAfterProvidentFund-$amount;
        $netSalaryWIthoutTax = $GrossSalaryAmountAfterProvidentFund;

// Fetch the latest salary bank allocation
$BankAmount = DB::table('salary_bank')
    ->where('user_id', $employeeId)
    // ->where('effective_date', '<=', $formDate)
    ->latest('created_at')
    ->first();

$FinalBankPercentage = 0;
$FinalCashPercentage = 0;
if ($BankAmount) {
    $FinalBankPercentage = $BankAmount->bank_amount / $BankAmount->gross * 100; // Bank percentage
    $FinalCashPercentage = $BankAmount->cash_amount / $BankAmount->gross * 100; // Cash percentage
}

// **Step 1: Divide net salary before tax**
$BankAmountValue = ($FinalBankPercentage / 100) * $netSalary;  // Bank portion before tax
$CashAmountValue = ($FinalCashPercentage / 100) * $netSalary;  // Cash portion before tax

// **Step 2: Deduct tax from bank portion**
$BankAmountValue = max(0, $BankAmountValue - $amount-$advanceAmount); // Deduct Advance amount from bank amount

// **Ensure Cash Pay remains valid**
$CashAmountValue = max(0, $netSalaryWIthoutTax - $amount-$advanceAmount-$BankAmountValue); // Remaining salary goes to cash

$TableData = [
    'total_worked_days' => $totalWorkedDays,
    'total_absents' => $totalAbsents,
    'total_absents_fee' => $TotalDiductionAmount,
    'total_fridays' => $totalFridays,
    'advance_salary' => $advanceAmount,
    'provident_fund' => $ProvidentFund,
    'gross_salary' => $salaryslab ? $salaryslab->gross : 0,
    'net_salary' => $netSalaryWIthoutTax,
    'employee_id' => $employeeId,
    'tax_amount' => $amount,
    'arrear_amount' => '',
    'remarks' => $remarks,
    'form_date' => $formDate,
    'to_date' => $toDate,
    'bankamount' => $BankAmountValue, // Fixed logic
    'cashamount' => $CashAmountValue, // Fixed logic
    'weekendays_amount' => $TotalFridaysAmount ? $TotalFridaysAmount : 0
];

DB::table('employee_salary_payment_details')->insert([
    'PaidAmount' => 0,
    'UnpaidAmount' => 0,
    'NetPayable' => $netSalaryWIthoutTax - $amount-$advanceAmount,
    'EmployeeID' => $employeeId,
    'BankPay' => max(0, $BankAmountValue), // Corrected bank amount
    'CashPay' => max(0, $CashAmountValue), // Corrected cash amount
    'Gross' => $salaryslab ? $salaryslab->gross : 0,
    'TotalPayable' => max(0, $netSalaryWIthoutTax - $amount),
    'TotalDeduction' => $TotalDiductionAmount + $amount + $advanceAmount + $ProvidentFund,
    'FormDate' => $formDate,
    'ToDate' => $toDate,
    'Remarks' => $remarks
]);

// Insert into employee_salary_details
DB::table('employee_salary_details')->insert($TableData);

        return $User->employee_code;
    }

    public function SalaryProcessByBranch($employeeId, $formDate, $toDate, $remarks)
    {
        // Get Employee
        $User = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->where('users.id', '=', $employeeId)
            ->select('users.id', 'profile.employee_code', 'users.first_name', 'designations.name as designation', 'departments.name as department', 'sections.name as section', 'branchs.name as branch')
            ->get();
        // Total Present
        $getTotalPresent = DB::table('clocks')
        ->whereBetween('date', [$formDate, $toDate])
            ->where('user_id', $employeeId)
            ->distinct('date')
            ->count('date');

        // Holidays
        $holidays = DB::table('holidays')
        ->whereBetween('date', [$formDate, $toDate])
            // ->where('user_id', $employeeId)
            ->distinct('date')
            ->count('date');

        //Spacial Holidays
        $spacial_holidays = DB::table('spacial_holidays')
        ->whereBetween('date', [$formDate, $toDate])
        ->where('user_id', $employeeId)
        ->distinct('date')
        ->count('date');

        // Leave
        $leave = DB::table('leaves')
        ->whereBetween('from_date', [$formDate, $toDate])
            ->where('user_id', $employeeId)
            ->where('status', 'approved')
            ->distinct('from_date')
            ->count('from_date');

        // LWP
        $lwp = DB::table('leaves')
        ->whereBetween('from_date', [$formDate, $toDate])
            ->where('user_id', $employeeId)
            ->where('status', 'lwp')
            ->distinct('from_date')
            ->count('from_date');
        // Total Days Of Month
        $startDate = Carbon::parse($formDate);
        $endDate = Carbon::parse($toDate);
        $TotalDays = $startDate->diffInDays($endDate);

        // Initialize an array to store the Friday dates
        $fridays = WHD::where('user_id', $employeeId)->whereBetween('date', [$formDate, $toDate])->pluck('date')->toArray();
        // Total Fridays
        $totalFridays = count($fridays);
        // Sarary Slab
        $salaryslab = DB::table('salary_slab')
        ->where('user_id', $employeeId)
            ->select('gross')
            ->latest('id')
            ->first();
        // Fetch earning salary types only once
        $latestSalaryData = DB::table('salary')
        ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
        ->where('salary.user_id', $employeeId)
            ->where('salary_types.salary_type', 'earning')
            ->select('salary.id', 'salary.contract_id', 'salary.salary_type_id', 'salary.amount', 'salary.created_at', 'salary.updated_at', 'salary_types.head', 'salary_types.salary_type')
            ->orderBy('salary.salary_type_id')
            ->orderBy('salary.created_at', 'desc')
            ->get();
        $latestSalaryData = collect($latestSalaryData);
        $latestSalaryData = $latestSalaryData->unique('salary_type_id');

        // Fetch Deduction salary types only once
        $deductionsData = DB::table('salary')
        ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
        ->where('salary.user_id', $employeeId)
            ->where('salary_types.salary_type', 'deduction')
            ->select('salary.id', 'salary.contract_id', 'salary.salary_type_id', 'salary.amount', 'salary.created_at', 'salary.updated_at', 'salary_types.head', 'salary_types.salary_type')
            ->orderBy('salary.salary_type_id')
            ->orderBy('salary.created_at', 'desc')
            ->get();
        $deductionsData = collect($deductionsData);
        $deductionsData = $deductionsData->unique('salary_type_id');

        $advanceSalary = DB::table('salary_advance')
        ->leftJoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
        ->where('employeeId', $employeeId)
        ->where('salary_advance.effectiveDate', '<', $formDate)
        ->select('salary_advance.grossValue', 'salary_advance.grossOption', 'salary_advance_months.month', 'salary_advance_months.amount')
        ->get();
        $monthNumber = (int)date('m', strtotime($toDate));
        $advanceAmount = 0;
        foreach ($advanceSalary as $record) {
            if ($record->month === $monthNumber
            ) {
                $advanceAmount = $record->amount;
                break;
            }
        }

        // Fetch shift data
        $shiftTime = UserShift::where('user_id', '=', $employeeId)
        ->LeftJoin('office_shifts', 'user_shifts.office_shift_id', '=', 'office_shifts.id')
        ->LeftJoin('office_shift_details', 'user_shifts.office_shift_id', '=', 'office_shift_details.office_shift_id')
        ->select('user_shifts.user_id',
            'office_shifts.name',
            'office_shift_details.in_time',
            'office_shift_details.out_time',
            'office_shifts.id as shift_id'
        )
        ->latest('office_shifts.id')
        ->first();

        // Get attendances
        $attendances = Clock::leftJoin('users', 'clocks.user_id', '=', 'users.id')
        ->whereBetween('date', [$formDate, $toDate])
        ->where('clocks.user_id', '=', $employeeId)
        ->select('clocks.date', 'clocks.clock_in', 'clocks.clock_out', 'users.id as user_id', 'users.first_name')
        ->get();

        $totalOvertimeMinutes = 0;
        $totalLateMinutes = 0;

        if ($shiftTime) {
            $inTime = Carbon::parse($shiftTime->in_time);  // Parse the in_time
            $outTime = Carbon::parse($shiftTime->out_time); // Parse the out_time

            // Calculate the total shift duration in minutes
            $totalShiftMinutes = $inTime->diffInMinutes($outTime);
        }

        if ($shiftTime && $attendances->count() > 0) {
            $inTime = Carbon::parse($shiftTime->in_time);
            $outTime = Carbon::parse($shiftTime->out_time);

            foreach ($attendances as $attendance) {
                if ($attendance->clock_in && $attendance->clock_out
                ) {
                    $clockIn = Carbon::parse($attendance->clock_in);
                    $clockOut = Carbon::parse($attendance->clock_out);

                    // Calculate late time
                    if ($clockIn->gt($inTime)) {
                        $totalLateMinutes += $inTime->diffInMinutes($clockIn);
                    }

                    // Calculate overtime
                    if ($clockOut->gt($outTime)) {
                        $totalOvertimeMinutes += $clockOut->diffInMinutes($outTime);
                    }
                }
            }
        }


        $totalWorkedDays = $getTotalPresent + $holidays + $leave + $totalFridays + $spacial_holidays;
        $totalAbsents = $TotalDays - $totalWorkedDays;
        $perdaysAmount =  $salaryslab ? $salaryslab->gross / $TotalDays : 0;
        $GrossAmountSalaryPerDays = $perdaysAmount * $totalWorkedDays;
        $TotalDiductionAmount = $perdaysAmount * $totalAbsents;

        $GrossSalaryAmountAfterAdvance = $GrossAmountSalaryPerDays - $advanceAmount;
        // return $deductionsData->where('salary_type_id', 5);
        if (count($deductionsData->where('salary_type_id', 5)) === 0) {
            $ProvidentFund = 0;
        } else {
            $ProvidentFund = $deductionsData->where('salary_type_id', 5)->first()->amount;
        }

        $GrossSalaryAmountAfterProvidentFund = $GrossSalaryAmountAfterAdvance - $ProvidentFund;

        

        $totalLateApprove = $attendances->count() * 15;
        // Convert totals to hours and minutes
        $totalOvertimeHrs = floor($totalOvertimeMinutes - 15) / 60;
        // $totalShiftHrs = $totalShiftMinutes?floor($totalShiftMinutes) / 60:0;
        // $totalLateTime = floor($totalLateMinutes - $totalLateApprove) / 60;

        $overtimeSalery = $totalOvertimeHrs * $perdaysAmount;
        $netSalary = $GrossSalaryAmountAfterProvidentFund + $overtimeSalery;
        $monthColumns = [
            1 => 'january',
            2 => 'february',
            3 => 'march',
            4 => 'april',
            5 => 'may',
            6 => 'june',
            7 => 'july',
            8 => 'august',
            9 => 'september',
            10 => 'october',
            11 => 'november',
            12 => 'december',
        ];
        $monthNumber = (int)date('m', strtotime($toDate));
        // Get the column name for the provided month number
        $monthColumn = isset($monthColumns[$monthNumber]) ? $monthColumns[$monthNumber] : null;

        $taxAmount = DB::table('tax_month_adjustments')
        ->where('user_id', $employeeId)
        ->latest('created_at')  
        ->first(); 
        $amount = 0;
        if ($taxAmount) {
            $amount = $taxAmount->$monthColumn;
        }

        $TotalFridaysAmount = $perdaysAmount * $totalFridays;
        $BankAmount = DB::table('salary_bank')
            ->where('user_id', $employeeId)
            ->where('effective_date',
                '<=',
                $formDate
            )
            ->latest('created_at')
            ->first();

        $FinalBankAmount = 0;
        $FinalcashAmount = 0;
        if ($BankAmount) {
            $FinalBankAmount = $BankAmount->bank_amount / $BankAmount->gross * 100;
            $FinalcashAmount = $BankAmount->cash_amount / $BankAmount->gross * 100;
        }

        $ActualBankAmount = max(0,$FinalBankAmount / 100 * $netSalary - $amount);
        $ActualCashAmount = $FinalBankAmount > 0 ? $FinalcashAmount / 100 * $netSalary - $amount : ($FinalcashAmount / 100 * $netSalary - $amount);

        $TableData = [
            'total_worked_days' => $totalWorkedDays,
            'total_absents' => $totalAbsents,
            'total_absents_fee' => $TotalDiductionAmount,
            'total_fridays' => $totalFridays,
            'advance_salary' => $advanceAmount,
            'provident_fund' => $ProvidentFund,
            'gross_salary' => $salaryslab ? $salaryslab->gross : 0,
            'net_salary' => $netSalary,
            'employee_id' => $employeeId,
            'arrear_amount' => '',
            'tax_amount' => $amount,
            'remarks' => $remarks,
            'form_date' => $formDate,
            'to_date' => $toDate,
            'ot_hrs' => $totalOvertimeHrs,
            'ot_amount' => $overtimeSalery,
            'bankamount' => $ActualBankAmount-$advanceAmount,
            'cashamount' => $ActualCashAmount-$advanceAmount,
            'weekendays_amount' => $TotalFridaysAmount ? $TotalFridaysAmount : 0
            ];

        DB::table('employee_salary_payment_details')->insert([
            'PaidAmount' => 0,
            'UnpaidAmount' => 0,
            'NetPayable' => $netSalary-$advanceAmount,
            'EmployeeID' => $employeeId,
            'BankPay' => $ActualBankAmount-$advanceAmount,
            'CashPay' => $ActualCashAmount-$advanceAmount,
            'Gross' => $salaryslab ? $salaryslab->gross : 0,
            'TotalPayable' => max(0, $netSalary - $amount),
            'TotalDeduction' => $TotalDiductionAmount + $amount + $advanceAmount + $ProvidentFund,
            'FormDate' => $formDate,
            'ToDate' => $toDate,
            'Remarks' => $remarks
        ]);
        DB::table('employee_salary_details')->insert($TableData);
        return $employeeId;

    }

    public function indexSalaryShit(){
        
    }
    public function SalaryShit(){
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $designation = Designation::all();
        return view('salary-process.salaryshit', compact('group','branch','department','section','employee','designation'));
    }

    public function SalaryShitPost(Request $request)
    {
        // return $request->all();
        $data = User::leftjoin('employee_salary_details', 'users.id', '=', 'employee_salary_details.employee_id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        // if ($request->category) {
        //     $data->where('profile.category', '=', $request->category);
        // }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        }
        // if ($request->designation) {
        //     $data->where('users.designation_id', '=', $request->designation);
        // }
        if ($request->employeeId) {
            $data->where('employee_salary_details.employee_id', '=', $request->employeeId);
        }
        if ($request->formDate) {
            $data->where('employee_salary_details.form_date', '>=', $request->formDate);
        }
        if ($request->toDate) {
            $data->where('employee_salary_details.to_date', '<=', $request->toDate);
        }
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        $user_ids = $data->pluck('users.id')->unique()->toArray();

        return $this->SalaryData($user_ids, $request->branch);
        // // Get the latest bank account for each user using a subquery
    }

    public function UpdateArrearAmount(Request $request){
        try {
            DB::table('employee_salary_details')
            ->where('id', $request->id)
            ->update([
                'arrear_amount' => $request->arrear_amount,
                'cashamount' => DB::raw("cashamount + {$request->arrear_amount}")
            ]);
            return response()->json(['success' => 'Arrear Amount Updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update arrear amount.']);
        }
    }   
    
    public function UpdateTaxAmount(Request $request){
        try {
            DB::table('employee_salary_details')
            ->where('id', $request->id)
            ->update(['tax_amount' => $request->tax_amount]);
            return response()->json(['success' => 'Tax Amount Updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update tax amount.']);
        }
    }

    public function  SalarySlip() {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $designation = Designation::all();
        return view('salary-process.salary-slip', compact('group','branch','department','section','employee','designation'));
    }

    public function salarySlipPost(Request $request) {
        $data = User::leftjoin('employee_salary_details', 'users.id', '=', 'employee_salary_details.employee_id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        // if ($request->category) {
        //     $data->where('profile.category', '=', $request->category);
        // }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        }
        // if ($request->designation) {
        //     $data->where('users.designation_id', '=', $request->designation);
        // }
        if ($request->employeeId) {
            $data->where('employee_salary_details.employee_id', '=', $request->employeeId);
        }
        if ($request->formDate) {
            $data->where('employee_salary_details.form_date', '>=', $request->formDate);
        }
        if ($request->toDate) {
            $data->where('employee_salary_details.to_date', '<=', $request->toDate);
        }
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        $user_ids = $data->pluck('users.id')->unique()->toArray();

        return $this->SalaryData($user_ids, $request->branch, $request->formDate, $request->toDate);
    }

    public function SalarySheetReport(Request $request) {
        $data = User::leftjoin('employee_salary_details', 'users.id', '=', 'employee_salary_details.employee_id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->LeftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->LeftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->LeftJoin('departments', 'designations.department_id', '=', 'departments.id');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        // if ($request->category) {
        //     $data->where('profile.category', '=', $request->category);
        // }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        }
        // if ($request->designation) {
        //     $data->where('users.designation_id', '=', $request->designation);
        // }
        if ($request->employeeId) {
            $data->where('employee_salary_details.employee_id', '=', $request->employeeId);
        }
        if ($request->formDate) {
            $data->where('employee_salary_details.form_date', '>=', $request->formDate);
        }
        if ($request->toDate) {
            $data->where('employee_salary_details.to_date', '<=', $request->toDate);
        }
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        $user_ids = $data->pluck('users.id')->unique()->toArray();

        return $this->SalaryData($user_ids, $request->branch, $request->formDate, $request->toDate);
    }

    public function SalaryShitReport() {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        $designation = Designation::all();
        return view('salary-process.salary-shit-report', compact('group','branch','department','section','employee','designation'));
    }

    public function SalaryData($user_ids, $branch = null, $formDate = null, $toDate = null)
    {
        if ($branch) {
            $branch = Branch::where('id', $branch)->first();
        }
        // Get the latest bank account for each user using a subquery
        $latestBankAccounts = DB::table('bank_accounts')
        ->select('user_id', DB::raw('MAX(id) as latest_id'))
        ->groupBy('user_id')
        ->get();

        // Create a lookup array for the latest bank account IDs
        $latestBankAccountsLookup = [];
        
        foreach ($latestBankAccounts as $account) {
            $latestBankAccountsLookup[$account->user_id] = $account->latest_id;
        }
        $latestIds = DB::table('employee_salary_details')
        ->selectRaw('MAX(id) as latest_id') 
        ->groupBy('employee_id');

        $uniqueLatestIds = $latestIds->pluck('latest_id'); 

        // Fetch employee salary details and related user data
        $data = DB::table('employee_salary_details')
        ->leftJoin('users', 'employee_salary_details.employee_id', '=', 'users.id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('bank_accounts', function ($join) use ($latestBankAccountsLookup) {
            $join->on('employee_salary_details.employee_id', '=', 'bank_accounts.user_id')
            ->whereIn('bank_accounts.id', $latestBankAccountsLookup);
        })
        ->whereIn('employee_salary_details.id', $uniqueLatestIds)
        ->whereIn('users.id', $user_ids)
            ->orderBy('employee_salary_details.id', 'desc')
            ->select(
                'employee_salary_details.id',
                'users.id as user_id',
                'users.first_name',
                'designations.name as designation',
                'profile.date_of_joining',
                'profile.employee_code',
                'employee_salary_details.total_worked_days',
                'employee_salary_details.total_fridays',
                'employee_salary_details.gross_salary',
                'employee_salary_details.net_salary',
                'employee_salary_details.advance_salary',
                'employee_salary_details.provident_fund',
                'employee_salary_details.tax_amount',
                'employee_salary_details.arrear_amount',
                'bank_accounts.account_number', // Only the latest bank account
                'employee_salary_details.remarks',
                 DB::raw('DATEDIFF(employee_salary_details.to_date, employee_salary_details.form_date) + 1 as date_difference'), // Calculate date difference
                'employee_salary_details.total_absents_fee',
                'employee_salary_details.created_at',
                'employee_salary_details.ot_amount',
                'employee_salary_details.bankamount',
                'employee_salary_details.cashamount',
                'employee_salary_details.weekendays_amount'
            )
            ->get();

        // Prepare a collection to store the latest salary data for each user
        $latestSalaryData = [];

        foreach ($data as $record) {
            // Get the latest bank account for the user (already joined in the query)
            $record->account_number = $record->account_number ? $record->account_number : null;

            // Fetch latest salary data for the specific user
            $salaryData = DB::table('salary')
            ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
            ->where('salary.user_id', $record->user_id)
                ->where('salary_types.salary_type', 'earning')
                ->select(
                    'salary.id',
                    'salary.salary_type_id',
                    'salary.amount',
                    'salary.created_at',
                    'salary_types.head',
                    'salary_types.salary_type'
                )
                ->orderBy('salary.salary_type_id')
                ->orderBy('salary.created_at', 'desc')
                ->get();

            // Filter unique salary types
            $salaryData = collect($salaryData)->unique('salary_type_id');

            // Store the unique salary data in the collection
            $latestSalaryData[$record->user_id] = $salaryData;
        }

        // Add the latest salary data to the main collection
        foreach ($data as $record) {
            $record->salaryData = $latestSalaryData[$record->user_id];
        }

        return response()->json([
            'branch' => $branch, // Include the branch data
            'employee_salary_data' => $data, // Include the employee salary data
            'month' => Carbon::parse($toDate)->format('F Y'), // Include the month
            'to_date' => Carbon::parse($toDate)->format('d F Y'),
            'form_date' => Carbon::parse($formDate)->format('d F Y'),
        ]);
        return $data;
    }
}