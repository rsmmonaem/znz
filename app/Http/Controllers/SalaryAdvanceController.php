<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use App\Http\Controllers\Controller;
use App\SalaryAdvance;
use App\Section;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryAdvanceController extends Controller
{
    /**
     * Display the salary advance index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $branch = Branch::all();
        $department = Department::all();
        $designation = Designation::all();
        $section = Section::all();
        $category = DB::table('category')->get();
        $group = DB::table('com_group')->get();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->select('users.first_name', 'users.id', 'profile.employee_code')
            ->get();
        return view('salary-advance.index', compact('group', 'branch', 'department', 'section', 'employee', 'designation', 'category'));
    }

    public function GetAllDate()
    {
        $result = DB::table('salary_advance')
            ->select(
                'salary_advance.*',
                'users.first_name',
                'profile.employee_code',
                'designations.name AS designation',
                'departments.name AS department',
                'sections.name AS section',

                // Concatenate all month names ordered
                DB::raw('GROUP_CONCAT(month_names.month_name ORDER BY salary_advance_months.month ASC) AS months'),

                // Advance amounts for each month
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 1 THEN salary_advance_months.amount END) AS january_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 2 THEN salary_advance_months.amount END) AS february_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 3 THEN salary_advance_months.amount END) AS march_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 4 THEN salary_advance_months.amount END) AS april_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 5 THEN salary_advance_months.amount END) AS may_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 6 THEN salary_advance_months.amount END) AS june_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 7 THEN salary_advance_months.amount END) AS july_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 8 THEN salary_advance_months.amount END) AS august_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 9 THEN salary_advance_months.amount END) AS september_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 10 THEN salary_advance_months.amount END) AS october_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 11 THEN salary_advance_months.amount END) AS november_advance_amount'),
                DB::raw('MAX(CASE WHEN salary_advance_months.month = 12 THEN salary_advance_months.amount END) AS december_advance_amount')
            )
            ->join('users', 'salary_advance.employeeId', '=', 'users.id')
            ->join('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
            ->leftJoin(DB::raw('(
                    SELECT 1 AS month_number, "January" AS month_name
                    UNION SELECT 2, "February"
                    UNION SELECT 3, "March"
                    UNION SELECT 4, "April"
                    UNION SELECT 5, "May"
                    UNION SELECT 6, "June"
                    UNION SELECT 7, "July"
                    UNION SELECT 8, "August"
                    UNION SELECT 9, "September"
                    UNION SELECT 10, "October"
                    UNION SELECT 11, "November"
                    UNION SELECT 12, "December"
                ) AS month_names'), 'salary_advance_months.month', '=', 'month_names.month_number')
            ->groupBy('salary_advance.id')
            ->get();

        return $result;
    }




    public function salaryAdvancePost(Request $request)
    {
        DB::beginTransaction();
        try {
            $totalMonths = (int) $request->input('months');       // e.g., 2
            $totalAmount = (float) $request->input('grossValue'); // e.g., 2000

            if ($totalMonths <= 0 || $totalAmount <= 0) {
                throw new \Exception('Invalid month or amount input.');
            }

            // Calculate per month amount
            $perMonthAmount = round($totalAmount / $totalMonths, 2);

            // Create array of months with amount
            $months = [];
            for ($i = 1; $i <= $totalMonths; $i++) {
                $months[$i] = $perMonthAmount;
            }

            // Break into chunks of 12 months for yearly storage
            $chunkSize = 12;
            $monthValues = array_values($months);
            $chunks = array_chunk($monthValues, $chunkSize);

            // Starting month from effectiveDate
            $effectiveMonth = (int) date('n', strtotime($request->effectiveDate)); // 1-12

            foreach ($chunks as $chunkIndex => $chunk) {
                $salary_advance_id = DB::table('salary_advance')->insertGetId([
                    'employeeId'    => $request->employeeId,
                    'date'          => Carbon::now(),
                    'effectiveDate' => $request->effectiveDate,
                    'grossOption'   => "fixed",
                    'grossValue'    => $request->grossValue,
                ]);

                foreach ($chunk as $i => $amount) {
                    // Calculate month number starting from effectiveMonth, wrap after 12
                    $monthNumber = ($effectiveMonth + $i - 1) % 12 + 1;

                    DB::table('salary_advance_months')->insert([
                        'salary_advance_id' => $salary_advance_id,
                        'month'             => $monthNumber,
                        'amount'            => $amount,
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Salary Advance saved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }



    public function DeleteSalaryAdvance(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::table('salary_advance')->where('id', $request->id)->delete();
            DB::table('salary_advance_months')->where('salary_advance_id', $request->id)->delete();
            DB::commit();
            return response()->json(['success', 'Salary Advance deleted successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error', $e->getMessage()]);
        }
    }


    public function UserData(Request $request)
    {
        $employee = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->select('users.id', 'profile.employee_code', 'users.first_name', 'designations.name as designation', 'departments.name as department', 'sections.name as section', 'branchs.name as branch', 'profile.category')
            ->where('users.id', $request->employeeId)
            ->first();
        return $employee;
    }

    public function EditSalaryAdvance($id)
    {
        $entry = DB::table('salary_advance')
            ->select(
                'salary_advance.*',
                'users.first_name',
                'profile.employee_code',
                'designations.name as designation',
                'departments.name as department',
                'sections.name as section',
                DB::raw('GROUP_CONCAT(salary_advance_months.month ORDER BY salary_advance_months.month ASC) as months')
            )
            ->join('users', 'salary_advance.employeeId', '=', 'users.id')
            ->join('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('salary_advance_months', 'salary_advance.id', '=', 'salary_advance_months.salary_advance_id')
            ->groupBy('salary_advance.id')
            ->where('salary_advance.id', $id)
            ->first();

        if (!$entry) {
            return redirect('salary-advance')->with('error', 'Salary Advance entry not found!');
        }

        $branch = Branch::all();
        $department = Department::all();
        $designation = Designation::all();
        $section = Section::all();
        $category = DB::table('category')->get();
        $group = DB::table('com_group')->get();
        $employee = DB::table('users')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->select('users.first_name', 'users.id', 'profile.employee_code')
            ->get();

        $salary_advance_data = DB::table('salary_advance_months')
            ->where('salary_advance_id', $id)
            ->get();

        return view('salary-advance.edit', compact(
            'entry',
            'group',
            'branch',
            'department',
            'section',
            'employee',
            'designation',
            'category',
            'salary_advance_data'
        ));
    }

    public function UpdateSalaryAdvance(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::table('salary_advance')->where('id', $id)->update([
                'employeeId' => $request->employeeId,
                'date' => Carbon::now(),
                'effectiveDate' => $request->effectiveDate,
                'grossOption' => $request->grossOption,
                'grossValue' => $request->grossValue,
            ]);

            // Delete old months
            DB::table('salary_advance_months')->where('salary_advance_id', $id)->delete();

            // Insert selected months with amounts
            $months = $request->month;
            if ($months) {
                foreach ($months as $month) {
                    DB::table('salary_advance_months')->insert([
                        'salary_advance_id' => $id,
                        'month' => $month,
                        'amount' => isset($request->amounts[$month]) ? $request->amounts[$month] : 0
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Salary Advance updated successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }


    public function monthFields(Request $request)
    {
        $months = $request->months;
        $entryId = $request->entry_id;

        $salaryData = DB::table('salary_advance_months')
            ->where('salary_advance_id', $entryId)
            ->get();

        return view('salary_advance.month_fields', compact('months', 'salaryData'))->render();
    }
}
