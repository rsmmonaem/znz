<?php
namespace App\Classes;

use App\Profile;
use App\User;

class Helpers{
    public static function GetBranchEmployees($branch_id){
        $employees = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name as employee_name', 'users.id','profile.employee_code')
        ->where('profile.branch_id', $branch_id)
        ->get();
        return $employees;
    }

}