<?php 
namespace App\Http\Controllers;

use App\Classes\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonDependencyController extends Controller{
    private $Helpers;
    public function __construct(Helpers $Helpers){
        $this->Helpers = $Helpers;
    }

    public function branchEmployees(Request $request){
        return $this->Helpers->GetBranchEmployees($request->branch_id);
    }

    public function branchSeparatedEmployees(Request $request)
    {
        return $this->Helpers->GetBranchSeparatedEmployees($request->branch_id);
    }

    public function getUserByEmployeeCode(Request $request)
    {
        $employee_code = $request->employee_code;
        $user = \App\User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->where('profile.employee_code', $employee_code)
            ->select('users.id', 'users.first_name', 'profile.employee_code')
            ->first();
        
        return response()->json($user);
    }

}