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
use Carbon\Carbon;

class SalaryProcessController extends Controller
{
    public function index()
    {
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
                    $query->select('employee_id')->from('employee_separations');
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

            return $user_ids;
            // Handle salary processing for each user
            foreach ($user_ids as $user_id) {
                // Check if salary already exists for the employee in the given date range
                $exists = DB::table('employee_salary_details')
                    ->where('employee_id', $user_id)
                    ->where('form_date', $request->formDate)
                    ->where('to_date', $request->toDate)
                    ->exists();

                if ($exists) {
                    continue; // Skip if already processed
                }

                // Handle special case for branch ID 7
                if ($request->branch == env('BRANCH_ID')) {
                    // Call the SalaryProcess method to process salary for each user
                    $processedId = $this->SalaryProcessByBranch($user_id, $request->formDate, $request->toDate, $request->remarks);
                    if ($processedId !== null) {
                        $processedEmployeeIds[] = $processedId;  // Collect successfully processed employee IDs
                    }
                } else {
                    // Call appropriate salary process method
                    $processedId = $this->SalaryProcess($user_id, $request->formDate, $request->toDate, $request->remarks);
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


    public function SalaryProcess($employeeId, $formDate, $toDate, $remarks)
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

        // Define an array of weekly holidays
        $weeklyHolidays = [Carbon::FRIDAY];

        // Initialize an array to store the Friday dates
        $fridays = [];
        // Loop through the date range
        while ($startDate <= $endDate) {
            if (in_array($startDate->dayOfWeek, $weeklyHolidays)) {
                $fridays[] = $startDate->format('Y-m-d');  // Store the Friday date in the array
            }
            // Move to the next day
            $startDate->addDay();
        }
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
        ->leftjoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
        ->where('employeeId', $employeeId)
        ->whereBetween('salary_advance.session', [
            date('Y', strtotime($formDate)),
            date('Y', strtotime($toDate))
        ])
        ->whereBetween('salary_advance_months.month', [
            date('m', strtotime($formDate)),
            date('m', strtotime($toDate))
        ])
        ->select('salary_advance.grossValue', 'salary_advance.grossOption')
        ->first();

        $totalWorkedDays = $getTotalPresent + $holidays + $leave + $totalFridays;
        $totalAbsents = $TotalDays - $totalWorkedDays;
        $perdaysAmount =  $salaryslab ? $salaryslab->gross / $TotalDays : 0;
        $GrossAmountSalaryPerDays = $perdaysAmount * $totalWorkedDays;
        $TotalDiductionAmount = $perdaysAmount * $totalAbsents;

        $advanceAmount = '';
        if ($advanceSalary) {
            if ($advanceSalary->grossOption == 'percentage') {
                $advanceAmount = $GrossAmountSalaryPerDays * ($advanceSalary->grossValue / 100);
            } else {
                $advanceAmount = $advanceSalary->grossValue;
            }
        }

        $GrossSalaryAmountAfterAdvance = $GrossAmountSalaryPerDays - $advanceAmount;
        // return $deductionsData->where('salary_type_id', 5);
        if(count($deductionsData->where('salary_type_id', 5)) === 0){
            $ProvidentFund = 0;
        }else{
            $ProvidentFund = $deductionsData->where('salary_type_id', 5)->first()->amount;
        }

        $GrossSalaryAmountAfterProvidentFund = $GrossSalaryAmountAfterAdvance - $ProvidentFund;

        $netSalary = $GrossSalaryAmountAfterProvidentFund;

        $TableData = [
            'total_worked_days' => $totalWorkedDays,
            'total_absents' => $totalAbsents,
            'total_absents_fee' => $TotalDiductionAmount,
            'total_fridays' => $totalFridays,
            'advance_salary' => $advanceAmount,
            'provident_fund' => $ProvidentFund,
            'gross_salary' => $salaryslab?$salaryslab->gross:0,
            'net_salary' => $netSalary,
            'employee_id' => $employeeId,
            'arrear_amount' => '',
            'remarks' => $remarks,
            'form_date' => $formDate,
            'to_date' => $toDate
        ];

        // Check if record exists for the same employee and date range
        $exists = DB::table('employee_salary_details')
            ->where('employee_id', $employeeId)
            ->where('form_date', $formDate)
            ->where('to_date', $toDate)
            ->exists();

        if (!$exists) {
            // Insert the new record into the database
            DB::table('employee_salary_details')->insert($TableData);
            return $employeeId;  // Return the processed employee ID for successful insertion
        } else {
            return null;  // Return null if the record already exists
        }
        // if (!$exists) {
        //     // Insert new record if not exists
        //     DB::table('employee_salary_details')->insert($TableData);
        //     return response()->json(['message' => 'Record inserted successfully.']);
        // } else {
        //     return response()->json(['message' => 'Record already exists for the same employee and date range.']);
        // }
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

        // Define an array of weekly holidays
        $weeklyHolidays = [Carbon::FRIDAY];

        // Initialize an array to store the Friday dates
        $fridays = [];
        // Loop through the date range
        while ($startDate <= $endDate) {
            if (in_array($startDate->dayOfWeek, $weeklyHolidays)) {
                $fridays[] = $startDate->format('Y-m-d');  // Store the Friday date in the array
            }
            // Move to the next day
            $startDate->addDay();
        }
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
        ->leftjoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
        ->where('employeeId', $employeeId)
            ->whereBetween('salary_advance.session', [
                date('Y', strtotime($formDate)),
                date('Y', strtotime($toDate))
            ])
            ->whereBetween('salary_advance_months.month', [
                date('m', strtotime($formDate)),
                date('m', strtotime($toDate))
            ])
            ->select('salary_advance.grossValue', 'salary_advance.grossOption')
            ->first();

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


        $totalWorkedDays = $getTotalPresent + $holidays + $leave + $totalFridays;
        $totalAbsents = $TotalDays - $totalWorkedDays;
        $perdaysAmount =  $salaryslab ? $salaryslab->gross / $TotalDays : 0;
        $GrossAmountSalaryPerDays = $perdaysAmount * $totalWorkedDays;
        $TotalDiductionAmount = $perdaysAmount * $totalAbsents;

        $advanceAmount = '';
        if ($advanceSalary) {
            if ($advanceSalary->grossOption == 'percentage') {
                $advanceAmount = $GrossAmountSalaryPerDays * ($advanceSalary->grossValue / 100);
            } else {
                $advanceAmount = $advanceSalary->grossValue;
            }
        }

        $GrossSalaryAmountAfterAdvance = $GrossAmountSalaryPerDays - $advanceAmount;
        // return $deductionsData->where('salary_type_id', 5);
        if (count($deductionsData->where('salary_type_id', 5)) === 0) {
            $ProvidentFund = 0;
        } else {
            $ProvidentFund = $deductionsData->where('salary_type_id', 5)->first()->amount;
        }

        $GrossSalaryAmountAfterProvidentFund = $GrossSalaryAmountAfterAdvance - $ProvidentFund;

        $netSalary = $GrossSalaryAmountAfterProvidentFund;

        $totalLateApprove = $attendances->count() * 15;
        // Convert totals to hours and minutes
        $totalOvertimeHrs = floor($totalOvertimeMinutes - 15) / 60;
        // $totalShiftHrs = $totalShiftMinutes?floor($totalShiftMinutes) / 60:0;
        // $totalLateTime = floor($totalLateMinutes - $totalLateApprove) / 60;

        $overtimeSalery = $totalOvertimeHrs * $perdaysAmount;

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
            'remarks' => $remarks,
            'form_date' => $formDate,
            'to_date' => $toDate,
            'ot_hrs' => $totalOvertimeHrs,
            'ot_amount' => $overtimeSalery
        ];

        // Check if record exists for the same employee and date range
        $exists = DB::table('employee_salary_details')
        ->where('employee_id', $employeeId)
            ->where('form_date', $formDate)
            ->where('to_date', $toDate)
            ->exists();

        if (!$exists) {
            // Insert the new record into the database
            DB::table('employee_salary_details')->insert($TableData);
            return $employeeId;  // Return the processed employee ID for successful insertion
        } else {
            return null;  // Return null if the record already exists
        }
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

    // public function SalaryShitPost(Request $request){
    //     $data = DB::table('employee_salary_details')
    //     ->leftjoin('users', 'employee_salary_details.employee_id', '=', 'users.id')
    //     ->leftjoin('profile', 'users.id', '=', 'profile.user_id')
    //     // ->leftjoin('salary_slab', 'employee_salary_details.employee_id', '=', 'salary_slab.user_id')
    //     ->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
    //     ->leftjoin('bank_accounts', 'employee_salary_details.employee_id','=','bank_accounts.user_id')
    //     ->orderBy('employee_salary_details.id', 'desc')
    //     // ->orderBy('bank_accounts.id', 'desc')
    //     ->select(
    //         'employee_salary_details.id',
    //         'users.id as user_id',
    //         'users.first_name',
    //         'designations.name as designation',
    //         'profile.date_of_joining',
    //         'profile.employee_code',
    //         'employee_salary_details.total_worked_days',
    //         'employee_salary_details.gross_salary',
    //         'employee_salary_details.net_salary',
    //         'employee_salary_details.advance_salary',
    //         'employee_salary_details.provident_fund',
    //         'employee_salary_details.tax_amount',
    //         'employee_salary_details.arrear_amount',
    //         'bank_accounts.account_number',
    //         'employee_salary_details.remarks'
    //     )
    //     ->get();

    //     // Get the latest bank account ID for each user
    //     $latestBankAccounts = DB::table('bank_accounts')
    //     ->select('user_id', DB::raw('MAX(id) as latest_id'))
    //     ->groupBy('user_id')
    //     ->get();
    //     // Create a lookup array for latest bank account IDs
    //     $latestBankAccountsLookup = [];
    //     foreach ($latestBankAccounts as $account) {
    //         $latestBankAccountsLookup[$account->user_id] = $account->latest_id;
    //     }

    //     // Prepare a collection to store the latest salary data for each user
    //     $latestSalaryData = [];

    //     foreach ($data as $record) {
    //         // Get the latest bank account for the user
    //         $latestBankAccountId = isset($latestBankAccountsLookup[$record->user_id]) ? $latestBankAccountsLookup[$record->user_id] : null;

    //         if ($latestBankAccountId) {
    //             // Fetch the latest bank account details for this user
    //             $bankAccount = DB::table('bank_accounts')
    //                 ->where('id', $latestBankAccountId)
    //                 ->first();

    //             // Attach the bank account number to the record
    //             $record->account_number = $bankAccount ? $bankAccount->account_number : null;
    //         } else {
    //             // If no bank account is found, set account number to null
    //             $record->account_number = null;
    //         }
    //         // Fetch latest salary data for the specific user
    //         $salaryData = DB::table('salary')
    //             ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
    //             ->where('salary.user_id', $record->user_id)
    //             ->where('salary_types.salary_type', 'earning')
    //             ->select(
    //                 'salary.id',
    //                 // 'salary.contract_id',
    //                 'salary.salary_type_id',
    //                 'salary.amount',
    //                 'salary.created_at',
    //                 // 'salary.updated_at',
    //                 'salary_types.head',
    //                 'salary_types.salary_type'
    //             )
    //             ->orderBy('salary.salary_type_id')
    //             ->orderBy('salary.created_at', 'desc')
    //             ->get();

    //         // Filter unique salary types
    //         $salaryData = collect($salaryData)->unique('salary_type_id');

    //         // Store the unique salary data in the collection
    //         $latestSalaryData[$record->user_id] = $salaryData;
    //     }

    //     // Add the latest salary data to the main collection
    //     foreach ($data as $record) {
    //         $record->salaryData = $latestSalaryData[$record->user_id];
    //     }
    //     return $data;
    // }
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
        // $latestBankAccounts = DB::table('bank_accounts')
        // ->select('user_id', DB::raw('MAX(id) as latest_id'))
        // ->groupBy('user_id')
        // ->get();

        // // Create a lookup array for the latest bank account IDs
        // $latestBankAccountsLookup = [];
        // foreach ($latestBankAccounts as $account) {
        //     $latestBankAccountsLookup[$account->user_id] = $account->latest_id;
        // }

        // // Fetch employee salary details and related user data
        // $data = DB::table('employee_salary_details')
        // ->leftJoin('users', 'employee_salary_details.employee_id', '=', 'users.id')
        // ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        // ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        // ->leftJoin('bank_accounts', function ($join) use ($latestBankAccountsLookup) {
        //     $join->on('employee_salary_details.employee_id', '=', 'bank_accounts.user_id')
        //     ->whereIn('bank_accounts.id', $latestBankAccountsLookup);
        // })
        //     ->orderBy('employee_salary_details.id', 'desc')
        //     ->select(
        //         'employee_salary_details.id',
        //         'users.id as user_id',
        //         'users.first_name',
        //         'designations.name as designation',
        //         'profile.date_of_joining',
        //         'profile.employee_code',
        //         'employee_salary_details.total_worked_days',
        //         'employee_salary_details.gross_salary',
        //         'employee_salary_details.net_salary',
        //         'employee_salary_details.advance_salary',
        //         'employee_salary_details.provident_fund',
        //         'employee_salary_details.tax_amount',
        //         'employee_salary_details.arrear_amount',
        //         'bank_accounts.account_number', // Only the latest bank account
        //         'employee_salary_details.remarks'
        //     )
        //     ->get();

        // // Prepare a collection to store the latest salary data for each user
        // $latestSalaryData = [];

        // foreach ($data as $record) {
        //     // Get the latest bank account for the user (already joined in the query)
        //     $record->account_number = $record->account_number ? $record->account_number : null;

        //     // Fetch latest salary data for the specific user
        //     $salaryData = DB::table('salary')
        //     ->join('salary_types', 'salary.salary_type_id', '=', 'salary_types.id')
        //     ->where('salary.user_id', $record->user_id)
        //         ->where('salary_types.salary_type', 'earning')
        //         ->select(
        //             'salary.id',
        //             'salary.salary_type_id',
        //             'salary.amount',
        //             'salary.created_at',
        //             'salary_types.head',
        //             'salary_types.salary_type'
        //         )
        //         ->orderBy('salary.salary_type_id')
        //         ->orderBy('salary.created_at', 'desc')
        //         ->get();

        //     // Filter unique salary types
        //     $salaryData = collect($salaryData)->unique('salary_type_id');

        //     // Store the unique salary data in the collection
        //     $latestSalaryData[$record->user_id] = $salaryData;
        // }

        // // Add the latest salary data to the main collection
        // foreach ($data as $record) {
        //     $record->salaryData = $latestSalaryData[$record->user_id];
        // }

        // return $data;
    }

    public function UpdateArrearAmount(Request $request){
        try {
            DB::table('employee_salary_details')
            ->where('id', $request->id)
            ->update(['arrear_amount' => $request->arrear_amount]);
            return response()->json(['success' => 'Arrear Amount Updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update arrear amount.']);
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

        // Fetch employee salary details and related user data
        $data = DB::table('employee_salary_details')
        ->leftJoin('users', 'employee_salary_details.employee_id', '=', 'users.id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('bank_accounts', function ($join) use ($latestBankAccountsLookup) {
            $join->on('employee_salary_details.employee_id', '=', 'bank_accounts.user_id')
            ->whereIn('bank_accounts.id', $latestBankAccountsLookup);
        })
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
                'employee_salary_details.gross_salary',
                'employee_salary_details.net_salary',
                'employee_salary_details.advance_salary',
                'employee_salary_details.provident_fund',
                'employee_salary_details.tax_amount',
                'employee_salary_details.arrear_amount',
                'bank_accounts.account_number', // Only the latest bank account
                'employee_salary_details.remarks',
                 DB::raw('DATEDIFF(employee_salary_details.to_date, employee_salary_details.form_date) as date_difference'), // Calculate date difference
                'employee_salary_details.total_absents_fee',
                'employee_salary_details.created_at',
                'employee_salary_details.ot_amount'
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