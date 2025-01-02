<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Employee;
use App\Designation;
use App\Department;
use App\Branch;
use App\Section;
use App\Grade;

class EmpoloyeeCreate extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        $departments = Department::all();
        $branches = Branch::all();
        $sections = Section::all();
        $grades = Grade::all();
        return view('employee.create-employee',compact('designations','departments','branches','sections','grades'));
    }
}