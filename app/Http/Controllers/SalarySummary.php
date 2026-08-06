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

    // public function salarySummaryPost(Request $request)
    // {
    //     $branchDetails = Branch::where('id', $request->branch)->first();

    //     // Latest record per employee per month from employee_salary_details
    //     $latestSalarySubquery = "(SELECT esd1.*
    //         FROM employee_salary_details esd1
    //         INNER JOIN (
    //             SELECT employee_id, YEAR(to_date) as year, MONTH(to_date) as month, MAX(id) as last_id
    //             FROM employee_salary_details
    //             GROUP BY employee_id, YEAR(to_date), MONTH(to_date)
    //         ) esd2
    //         ON esd1.id = esd2.last_id
    //     ) as latest_salary";

    //     // Latest record per employee per month from employee_salary_payment_details
    //     $latestPaymentSubquery = "(SELECT espd1.*
    //         FROM employee_salary_payment_details espd1
    //         INNER JOIN (
    //             SELECT EmployeeID, YEAR(ToDate) as year, MONTH(ToDate) as month, MAX(id) as last_id
    //             FROM employee_salary_payment_details
    //             GROUP BY EmployeeID, YEAR(ToDate), MONTH(ToDate)
    //         ) espd2
    //         ON espd1.id = espd2.last_id
    //     ) as latest_payment";

    //     $data = Branch::leftJoin('profile', 'branchs.id', '=', 'profile.branch_id')
    //         ->leftJoin('users', 'profile.user_id', '=', 'users.id')
    //         ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
    //         ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
    //         ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
    //         ->leftJoin('employee_separations', 'profile.user_id', '=', 'employee_separations.employee_id')
    //         // Join latest salary
    //         ->leftJoin(DB::raw($latestSalarySubquery), 'profile.user_id', '=', 'latest_salary.employee_id')
    //         // Join latest payment for TotalPayable
    //         ->leftJoin(DB::raw($latestPaymentSubquery), 'profile.user_id', '=', 'latest_payment.EmployeeID')
    //         ->select(
    //             'branchs.name as branch_name',
    //             DB::raw('COUNT(DISTINCT profile.id) as active_manpower'),
    //             DB::raw("COUNT(DISTINCT CASE 
    //                 WHEN employee_separations.effective_date <= '" . Carbon::now() . "' 
    //                 THEN employee_separations.id 
    //             END) as separated_manpower"),
    //             DB::raw('SUM(latest_salary.net_salary) as net_salary'),
    //             DB::raw('SUM(latest_salary.advance_salary) as advance_salary'),
    //             DB::raw('SUM(latest_salary.total_absents_fee) as attendance_deduction'),
    //             DB::raw('SUM(latest_salary.tax_amount) as tax_amount'),
    //             DB::raw('SUM(latest_salary.arrear_amount) as arrear_amount'),
    //             DB::raw('SUM(CASE WHEN branchs.id = 7 THEN latest_salary.ot_amount ELSE 0 END) as ot_amount'),
    //             DB::raw('SUM(latest_salary.provident_fund) as provident_fund'),
    //             DB::raw('SUM(latest_payment.TotalPayable) as net_payable') // TotalPayable from latest_payment
    //         )
    //         ->when($request->branch, function ($query) use ($request) {
    //             return $query->where('branchs.id', $request->branch);
    //         })
    //         ->when($request->department, function ($query) use ($request) {
    //             return $query->where('designations.department_id', $request->department);
    //         })
    //         ->when($request->designation, function ($query) use ($request) {
    //             return $query->where('users.designation_id', $request->designation);
    //         })
    //         ->when($request->section, function ($query) use ($request) {
    //             return $query->where('profile.section_id', $request->section);
    //         })
    //         ->when($request->employee, function ($query) use ($request) {
    //             return $query->where('profile.user_id', $request->employee);
    //         })
    //         ->when($request->financialYear, function ($query) use ($request) {
    //             $year = $request->financialYear;
    //             return $query->whereRaw('YEAR(latest_salary.to_date) = ?', [$year])
    //                          ->whereRaw('YEAR(latest_payment.ToDate) = ?', [$year]);
    //         })
    //         ->when($request->month, function ($query) use ($request) {
    //             $month = $request->month;
    //             return $query->whereRaw('MONTH(latest_salary.to_date) = ?', [$month])
    //                          ->whereRaw('MONTH(latest_payment.ToDate) = ?', [$month]);
    //         })
    //         ->groupBy('branchs.id', 'branchs.name')
    //         ->get();



    //     return response()->json([
    //         'data' => $data,
    //         'branch' => $branchDetails,
    //     ]);
    // }

    public function salarySummaryPost(Request $request)
    {
        $branchDetails = Branch::where('id', $request->branch)->first();

        // Latest record per employee per month from employee_salary_details
        $latestSalarySubquery = "(SELECT esd1.*
            FROM employee_salary_details esd1
            INNER JOIN (
                SELECT employee_id, YEAR(to_date) as year, MONTH(to_date) as month, MAX(id) as last_id
                FROM employee_salary_details
                GROUP BY employee_id, YEAR(to_date), MONTH(to_date)
            ) esd2
            ON esd1.id = esd2.last_id
        ) as latest_salary";

        $data = Branch::leftJoin('profile', 'branchs.id', '=', 'profile.branch_id')
            ->leftJoin('users', 'profile.user_id', '=', 'users.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('employee_separations', 'profile.user_id', '=', 'employee_separations.employee_id')
            // Join latest salary only
            ->leftJoin(DB::raw($latestSalarySubquery), 'profile.user_id', '=', 'latest_salary.employee_id')
            ->select(
                'branchs.name as branch_name',
                DB::raw('COUNT(DISTINCT profile.id) as active_manpower'),
                DB::raw("COUNT(DISTINCT CASE 
                    WHEN employee_separations.effective_date <= '" . Carbon::now() . "' 
                    THEN employee_separations.id 
                END) as separated_manpower"),
                DB::raw('SUM(latest_salary.net_salary) as net_salary'),
                DB::raw('SUM(latest_salary.advance_salary) as advance_salary'),
                DB::raw('SUM(latest_salary.total_absents_fee) as attendance_deduction'),
                DB::raw('SUM(latest_salary.tax_amount) as tax_amount'),
                DB::raw('SUM(latest_salary.arrear_amount) as arrear_amount'),
                DB::raw('SUM(CASE WHEN branchs.id = 7 THEN latest_salary.ot_amount ELSE 0 END) as ot_amount'),
                DB::raw('SUM(latest_salary.provident_fund) as provident_fund'),
                // net_payable calculated directly from latest_salary
                DB::raw('(SUM(
                    COALESCE(latest_salary.net_salary,0) +
                    COALESCE(latest_salary.arrear_amount,0) +
                    COALESCE(latest_salary.ot_amount,0) +
                    COALESCE(latest_salary.holiday_amount,0) -
                    COALESCE(latest_salary.advance_salary,0) -
                    COALESCE(latest_salary.provident_fund,0) -
                    COALESCE(latest_salary.tax_amount,0)
                )) as net_payable')
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
                $year = $request->financialYear;
                return $query->whereRaw('YEAR(latest_salary.to_date) = ?', [$year]);
            })
            ->when($request->month, function ($query) use ($request) {
                $month = $request->month;
                return $query->whereRaw('MONTH(latest_salary.to_date) = ?', [$month]);
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
        $bankType = DB::table('company_banks')
            ->select('bank_name')
            ->whereNotNull('bank_name')
            ->where('bank_name', '!=', '')
            ->where('bank_name', '!=', ' ')
            ->where('status', 1)
            ->distinct()
            ->get();

        // return $bankType;
        return view('salary_summary.salary-bank-statement', compact('group', 'branch', 'designation', 'department', 'section', 'bankType'));
    }

    public function SalaryBankStatementPost(Request $request)
    {
        $branchData = Branch::where('id', $request->branch)->first();

        // Selected month/year or default running month/year
        $selectedYear = ($request->financialYear && is_numeric($request->financialYear)) ? (int) $request->financialYear : (int) date('Y');
        $selectedMonth = ($request->month && is_numeric($request->month)) ? (int) $request->month : (int) date('n');

        // Latest record per employee per month from employee_salary_details
        $latestSalarySubquery = "(SELECT esd1.*
            FROM employee_salary_details esd1
            INNER JOIN (
                SELECT employee_id, YEAR(to_date) as year, MONTH(to_date) as month, MAX(id) as last_id
                FROM employee_salary_details
                GROUP BY employee_id, YEAR(to_date), MONTH(to_date)
            ) esd2
            ON esd1.id = esd2.last_id
        ) as latest_salary";

        $data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin(DB::raw($latestSalarySubquery), 'profile.user_id', '=', 'latest_salary.employee_id')
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
                'branchs.name as branch_name',
                'departments.name as department_name',
                'latest_bank_account.bank_name as latest_bank_name',
                'latest_bank_account.account_number as latest_bank_account_number',
                'latest_bank_account.account_name as latest_bank_account_name',
                'latest_bank_account.bank_code as latest_bank_code',
                'latest_salary_bank.effective_date as salary_bank_effective_date',
                'latest_salary_bank.bank_amount as salary_bank_amount',
                'latest_salary.bankamount as processed_bankamount',
                'latest_salary_bank.company_bank_id',
                'latest_salary_bank.bank_amounts',
                'profile.user_id'
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
            ->whereRaw('YEAR(latest_salary.to_date) = ?', [$selectedYear])
            ->whereRaw('MONTH(latest_salary.to_date) = ?', [$selectedMonth])
            ->get();

        $groupData = DB::table('com_group')->where('id', $request->group)->first();
        $groupName = $groupData ? $groupData->name : ($branchData ? $branchData->name : 'J & Z Group');

        $companyBanks = collect(DB::table('company_banks')->get())->keyBy('id');
        $firstCompanyBank = $companyBanks->first();

        // Selected header company bank logic
        $headerCompanyBank = null;
        if ($request->bankType) {
            $headerCompanyBank = DB::table('company_banks')
                ->where('bank_name', 'like', '%' . $request->bankType . '%')
                ->first();
        }
        if (!$headerCompanyBank && $firstCompanyBank) {
            $headerCompanyBank = $firstCompanyBank;
        }

        $monthName = Carbon::create()->month($selectedMonth)->format('F');
        $yearName = $selectedYear;
        $remarksText = "Salary month of " . $monthName . "/" . $yearName;

        $splitData = [];

        foreach ($data as $item) {
            $bankIds = json_decode($item->company_bank_id, true);
            $bankAmounts = json_decode($item->bank_amounts, true);
            $processedBankPay = isset($item->processed_bankamount) ? (float) $item->processed_bankamount : (float) $item->salary_bank_amount;
            $totalTarget = (float) $item->salary_bank_amount;

            // Effective date formatting (D/M/Y)
            if ($item->salary_bank_effective_date) {
                $effDate = Carbon::parse($item->salary_bank_effective_date)->format('n/j/Y');
            } else {
                $effDate = date('n/j/Y');
            }

            // Get all bank accounts of the user to match
            $userAccounts = DB::table('bank_accounts')->where('user_id', $item->user_id)->get();

            if (is_array($bankIds) && count($bankIds) > 0) {
                foreach ($bankIds as $index => $bankId) {
                    $companyBank = isset($companyBanks[$bankId]) ? $companyBanks[$bankId] : null;
                    if (!$companyBank)
                        continue;

                    $targetAmt = isset($bankAmounts[$index]) ? (float) $bankAmounts[$index] : 0;

                    // Split Net payment proportionally
                    if ($totalTarget > 0) {
                        $actualAmt = round($processedBankPay * ($targetAmt / $totalTarget), 2);
                    } else {
                        $actualAmt = round($processedBankPay / count($bankIds), 2);
                    }

                    // Find matching user bank account
                    $matchedAccount = null;
                    foreach ($userAccounts as $acc) {
                        if ($acc->bank_name && stripos($acc->bank_name, $companyBank->bank_name) !== false) {
                            $matchedAccount = $acc;
                            break;
                        }
                    }

                    // Fallback to latest/default account if no match found
                    $accName = $matchedAccount ? $matchedAccount->account_name : $item->latest_bank_account_name;
                    $accNum = $matchedAccount ? $matchedAccount->account_number : $item->latest_bank_account_number;
                    $bankName = $companyBank->bank_name ?: ($matchedAccount ? $matchedAccount->bank_name : $item->latest_bank_name);
                    $receivingRouting = ($matchedAccount && !empty($matchedAccount->bank_code)) ? $matchedAccount->bank_code : ($companyBank->routing_number ?: '');

                    $splitData[] = (object) [
                        'employee_code' => $item->employee_code,
                        'first_name' => $item->first_name,
                        'latest_bank_name' => $bankName ?: 'N/A',
                        'latest_bank_account_number' => $accNum ?: 'N/A',
                        'latest_bank_account_name' => $accName ?: 'N/A',
                        'salary_bank_effective_date' => $effDate,
                        'salary_bank_amount' => $actualAmt,
                        'originating_bank_routing_no' => $companyBank->routing_number ?: '',
                        'receiving_bank_routing_no' => $receivingRouting ?: ($companyBank->routing_number ?: ''),
                        'originating_account_no' => $companyBank->account_number ?: '',
                        'originator_name' => $item->branch_name ?: ($branchData ? $branchData->name : 'N/A'),
                        'remarks' => $remarksText
                    ];
                }
            } else {
                // If single bank or legacy setup
                $origRouting = $firstCompanyBank ? $firstCompanyBank->routing_number : '';
                $origAccNo = $firstCompanyBank ? $firstCompanyBank->account_number : '';
                $origName = $item->branch_name ?: ($branchData ? $branchData->name : '');
                $receivingRouting = $item->latest_bank_code ?: $origRouting;
                $displayBankName = $firstCompanyBank ? $firstCompanyBank->bank_name : ($item->latest_bank_name ?: 'N/A');

                $splitData[] = (object) [
                    'employee_code' => $item->employee_code,
                    'first_name' => $item->first_name,
                    'latest_bank_name' => $displayBankName,
                    'latest_bank_account_number' => $item->latest_bank_account_number ?: 'N/A',
                    'latest_bank_account_name' => $item->latest_bank_account_name ?: 'N/A',
                    'salary_bank_effective_date' => $effDate,
                    'salary_bank_amount' => $processedBankPay,
                    'originating_bank_routing_no' => $origRouting,
                    'receiving_bank_routing_no' => $receivingRouting ?: $origRouting,
                    'originating_account_no' => $origAccNo,
                    'originator_name' => $origName ?: 'N/A',
                    'remarks' => $remarksText
                ];
            }
        }

        // Apply bankType filter if requested on the split data
        if ($request->bankType) {
            $splitData = array_values(array_filter($splitData, function ($item) use ($request) {
                return stripos($item->latest_bank_name, $request->bankType) !== false;
            }));
        }

        return response()->json([
            'data' => $splitData,
            'branch' => $branchData,
            'companyBank' => $headerCompanyBank,
            'groupName' => $groupName,
            'bankType' => $request->bankType,
            'financialYear' => $yearName,
            'month' => $monthName,
            'currentDate' => date('n/j/Y')
        ]);
    }

    public function SalaryTransferGlance(Request $request)
    {
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
                'profile.user_id',
                '=',
                'latest_salary_bank.user_id'
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
            ->whereIn('esd.id', function ($query) {
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
            ->orderBy('esd_id', 'DESC')
            ->get();

        return response()->json([
            'data' => $data,
            'branch' => $branchData,
            'financialYear' => $request->financialYear,
            'month' => Carbon::create()->month($request->month)->format('F'),
        ]);
    }
}
