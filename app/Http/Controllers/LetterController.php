<?php
namespace App\Http\Controllers;

use App\Branch;
use App\Classes\LetterHelpers;
use App\Department;
use App\Designation;
use App\Http\Controllers;
use App\Section;
use App\User;
use Illuminate\Http\Request;

class LetterController extends Controller {
 
    private $LetterHelpers;
    public function __construct(LetterHelpers $LetterHelpers)
    {
        $this->LetterHelpers = $LetterHelpers;
    }

    public function NOC(){
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $designation = Designation::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.first_name', 'users.id', 'profile.employee_code')->get();
        // return $this->LetterHelpers->NOC();
        return view('Letter.NOC', compact('branch', 'department', 'section', 'employee','designation'));
    }

    public function NOCPOST(Request $request){
        return $request;
        die();
        return $this->LetterHelpers->NOCPOST($request);
    }
    
    public function JEC(){
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $designation = Designation::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.first_name', 'users.id', 'profile.employee_code')->get();
        // return $this->LetterHelpers->NOC();
        return view('Letter.JEC', compact('branch', 'department', 'section', 'employee', 'designation'));
    }

    public function JECPOST(Request $request){
        return $this->LetterHelpers->JECPOST($request);
    }

    public function Increment() {
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $designation = Designation::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.first_name', 'users.id', 'profile.employee_code')->get();
        return view('Letter.Increment', compact('branch', 'department', 'section', 'employee', 'designation'));
    }

    public function IncrementPOST(Request $request) {
        return $this->LetterHelpers->IncrementPOST($request);
    }

    public function IncrementPromotion()
    {
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $designation = Designation::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.first_name', 'users.id', 'profile.employee_code')->get();
        return view('Letter.IncrementAndPromotion', compact('branch', 'department', 'section', 'employee', 'designation'));
    }
    
    public function IncrementPromotionPOST(Request $request) {
        return $this->LetterHelpers->IncrementPromotionPOST($request);
    }

    public function GetLetterUser(Request $request) {
        return $this->LetterHelpers->GetLetterUser($request);
    }
}
