<?php
namespace App\Classes;

use App\Leave;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Helpers{
    public static function GetBranchEmployees($branch_id){
        $employees = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name as employee_name', 'users.id','profile.employee_code')
        ->where('profile.branch_id', $branch_id)
        ->get();
        return $employees;
    }

    public function GetUserLeaves($id, $financialYear, $leave_type_id){
        $date_of_joining = Profile::where('user_id', $id)->select('date_of_joining')->first();
        $date_of_joining = $date_of_joining->date_of_joining;
        if($date_of_joining == null){
            return response()->json(['message' => 'Date of joining not found', 'status' => 'error'], 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        $parcentage = $this->calculateMonths($date_of_joining, $financialYear);
        $leave = $this->GetUserLeaveCount($financialYear, $leave_type_id, $parcentage);
        return $leave;
    }
    public function GetUserLeavesReaming($id, $year, $leave_type_id){
        $leave = Leave::where('user_id', $id)
        ->where('approved_date', '>', $year)
        ->where('status', '=', 'approved')
        ->where('leave_type_id', $leave_type_id)->count();
        return $leave;
    }


    /**
     * Calculate the number of leaves a user can take based on the number of months they have been with the company.
     *
     * @param string $financial_year The financial year in question.
     * @param int $leave_type_id The ID of the type of leave.
     * @param int $parcentage The percentage of the year that the user has been with the company.
     * @return int The number of leaves the user can take.
     */
    private function GetUserLeaveCount($financial_year, $leave_type_id, $parcentage)
    {
        $leave = DB::table('leave_manage')
        ->where('financial_year', $financial_year)
        ->where('leave_type_id', $leave_type_id)
        ->first();
        $leave_count = ($leave->leave_count * $parcentage) / 100;
        return $this->roundToGround($leave_count);
    }

    /**
     * Rounds a number to the nearest whole number, rounding up if the fractional
     * part is 0.1 or greater.
     *
     * @param float $number The number to be rounded.
     * @return int The rounded number.
     */
    private function roundToGround($number)
    {
        if ($number - floor($number) >= 0.1) {
            return ceil($number);
        }
        return floor($number);
    }
    /**
     * Calculate the number of months between the date of joining and the end of the financial year.
     *
     * @param string $date_of_joining The date the user joined, in 'Y-m-d' format.
     * @param int $financialYear The financial year as a four-digit year.
     * @return int The number of months from the date of joining to the end of the financial year,
     *             constrained to a maximum of 12 months.
     */
    private function calculateMonths($date_of_joining, $financialYear)
    {
        $startDate = $date_of_joining;
        $currentDate = $financialYear;
        $startDateObj = Carbon::createFromFormat('Y-m-d', $startDate);
        $currentDateObj = Carbon::createFromFormat('Y', $currentDate)->endOfYear();
        if ($currentDateObj->lt($startDateObj)) {
            $monthsCount = 12;
        } else {
            if ($currentDateObj->year == $startDateObj->year) {
                $monthsCount = $currentDateObj->month - $startDateObj->month;
            } else {
                $monthsCount = 12;
            }
        }
        if ($monthsCount > 12) {
            $monthsCount = 12;
        }
        $percentage = ($monthsCount / 12) * 100;
        return $percentage;
    }
}