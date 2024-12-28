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

}