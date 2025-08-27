<?php 

namespace App\Classes;

use App\EmployeeSeparation;
use App\User;
use Carbon\Carbon;

class LetterHelpers {
    public function NOCPOST($request){
        
        $exits = EmployeeSeparation::where('employee_id', $request->employeeId)->latest('id')->first();
        if($exits){

            $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('employee_separations', 'users.id', '=', 'employee_separations.employee_id')
            ->select(
                'users.id',
                'users.first_name as employee_name',
                'profile.employee_code',
                'profile.date_of_joining',
                'designations.name as designation_name',
                'employee_separations.entry_date'
            )
            ->where('users.id', '=', $request->employeeId)
            ->latest('employee_separations.id')
            ->first();
            // Format the dates
            if ($userData) {
                $userData->date_of_joining = Carbon::parse($userData->date_of_joining)->format('d M Y');

                
                if (!empty($request->effectiveDate)) {
                    $userData->entry_date = Carbon::parse($request->effectiveDate)->format('d M Y');
                    $dateOfJoining = Carbon::parse($userData->date_of_joining);
                    $entryDate     = Carbon::parse($request->effectiveDate);
                } else {
                    $userData->entry_date = Carbon::parse($userData->entry_date)->format('d M Y');
                    $dateOfJoining = Carbon::parse($userData->date_of_joining);
                    $entryDate     = Carbon::parse($userData->entry_date);
                }

                
                $diff = $dateOfJoining->diff($entryDate);
                $userData->date_diff = $diff->format('%y years, %m months, %d days');
            }
            return $userData;
        }else{
            
            $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->select(
                    'users.id',
                    'users.first_name as employee_name',
                    'profile.employee_code',
                    'profile.date_of_joining',
                    'designations.name as designation_name'
                )
                ->where('users.id', '=', $request->employeeId)
                ->first();

            if ($userData) {
                
                $userData->date_of_joining = Carbon::parse($userData->date_of_joining)->format('d M Y');

                
                if (!empty($request->effectiveDate)) {
                    $userData->entry_date = Carbon::parse($request->effectiveDate)->format('d M Y');

                    
                    $dateOfJoining = Carbon::parse($userData->date_of_joining);
                    $entryDate = Carbon::parse($request->effectiveDate);
                    $diff = $dateOfJoining->diff($entryDate);
                    $userData->date_diff = $diff->format('%y years, %m months, %d days');
                } else {
                    $userData->entry_date = null;
                    $userData->date_diff = null;
                }
            }
            return $userData;
        }
    }

    public function JECPOST($request){
        // $exits = EmployeeSeparation::where('employee_id', $request->employeeId)->latest('id')->first();
        // if($exits){
        //     $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        //     ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        //     ->leftJoin('employee_separations', 'users.id', '=', 'employee_separations.employee_id')
        //     ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        //     ->select(
        //         'users.id',
        //         'users.first_name as employee_name',
        //         'profile.employee_code',
        //         'profile.date_of_joining',
        //         'designations.name as designation_name',
        //         'employee_separations.entry_date',
        //         'departments.name as department_name'
        //     )
        //     ->where('users.id', '=', $request->employeeId)
        //     ->latest('employee_separations.id')
        //     ->first();
        //     if ($userData) {
        //         $userData->date_of_joining = Carbon::parse($userData->date_of_joining)->format('d M Y');
        //         $userData->entry_date = Carbon::parse($userData->entry_date)->format('d M Y');
        //         $dateOfJoining = Carbon::parse($userData->date_of_joining);
        //         $entryDate = Carbon::parse($userData->entry_date);
        //         $diff = $dateOfJoining->diff($entryDate);
        //         $userData->date_diff = $diff->format('%y years, %m months, %d days');
        //         $userData->department_name = $userData->department_name;
        //         $userData->designation_name = $userData->designation_name;
        //     }
        //     return $userData;
        // }else{
        //     return response()->json(['message' => 'No data found']);
        // }

        $exits = EmployeeSeparation::where('employee_id', $request->employeeId)
            ->latest('id')
            ->first();

        if ($exits) {
            
            $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->leftJoin('employee_separations', 'users.id', '=', 'employee_separations.employee_id')
                ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
                ->select(
                    'users.id',
                    'users.first_name as employee_name',
                    'profile.employee_code',
                    'profile.date_of_joining',
                    'designations.name as designation_name',
                    'employee_separations.entry_date',
                    'departments.name as department_name'
                )
                ->where('users.id', '=', $request->employeeId)
                ->latest('employee_separations.id')
                ->first();

            if ($userData) {
                $userData->date_of_joining = Carbon::parse($userData->date_of_joining)->format('d M Y');

                if (!empty($request->effectiveDate)) {
                    
                    $userData->entry_date = Carbon::parse($request->effectiveDate)->format('d M Y');
                    $entryDate = Carbon::parse($request->effectiveDate);
                } else {
                    
                    $userData->entry_date = Carbon::parse($userData->entry_date)->format('d M Y');
                    $entryDate = Carbon::parse($userData->entry_date);
                }

                $dateOfJoining = Carbon::parse($userData->date_of_joining);
                $diff = $dateOfJoining->diff($entryDate);
                $userData->date_diff = $diff->format('%y years, %m months, %d days');
            }

            return $userData;
        } else {
            
            $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
                ->select(
                    'users.id',
                    'users.first_name as employee_name',
                    'profile.employee_code',
                    'profile.date_of_joining',
                    'designations.name as designation_name',
                    'departments.name as department_name'
                )
                ->where('users.id', '=', $request->employeeId)
                ->first();

            if ($userData) {
                $userData->date_of_joining = Carbon::parse($userData->date_of_joining)->format('d M Y');

                if (!empty($request->effectiveDate)) {
                    
                    $userData->entry_date = Carbon::parse($request->effectiveDate)->format('d M Y');
                    $entryDate = Carbon::parse($request->effectiveDate);

                    $dateOfJoining = Carbon::parse($userData->date_of_joining);
                    $diff = $dateOfJoining->diff($entryDate);
                    $userData->date_diff = $diff->format('%y years, %m months, %d days');
                } else {
                    
                    $userData->entry_date = null;
                    $userData->date_diff = null;
                }
            }

            return $userData ?: response()->json(['message' => 'No data found']);
        }
    }

    public function IncrementPOST($request){

        $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('increments_promotions', 'users.id', '=', 'increments_promotions.employee_id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('salary_slab', 'users.id', '=', 'salary_slab.user_id')
        ->select(
            'users.id',
            'users.first_name as employee_name',
            'profile.employee_code',
            'profile.date_of_joining',
            'designations.name as designation_name',
            'departments.name as department_name',
            'increments_promotions.effective_date',
            'increments_promotions.amount',
            'increments_promotions.status',
            'increments_promotions.designation',
            'branchs.name as branch_name',
            'salary_slab.gross as old_amount'
        )
        ->where('users.id', '=', $request->employeeId)
        ->where('increments_promotions.increment', '=', 1)
        ->latest('increments_promotions.id')
        ->latest('salary_slab.id')
        ->first();
        return $userData;
    }

    public function IncrementPromotionPOST($request){
        $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('increments_promotions', 'users.id', '=', 'increments_promotions.employee_id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('salary_slab', 'users.id', '=', 'salary_slab.user_id')
        ->select(
            'users.id',
            'users.first_name as employee_name',
            'profile.employee_code',
            'profile.date_of_joining',
            'designations.name as designation_name',
            'departments.name as department_name',
            'sections.name as section_name.',
            'increments_promotions.effective_date',
            'increments_promotions.amount as increment_amount',
            'increments_promotions.designation as new_designation',
            'branchs.name as branch_name',
            'salary_slab.gross as slary_slab_gross'
        )
        ->where('users.id', '=', $request->employeeId)
        ->where('increments_promotions.increment', '=', 1)
        ->where('increments_promotions.promotion', '=', 1)
        ->where('increments_promotions.status', '=', 'approved')
        ->latest('increments_promotions.id')
        ->latest('salary_slab.id')
        ->first();
        return $userData;
    }


    public function GetLetterUser($request) {
        $userData = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('employee_separations', 'users.id', '=', 'employee_separations.employee_id')
        ->select(
            'users.id',
            'users.first_name as employee_name',
            'designations.name as designation_name',
            'departments.name as department_name',
            'branchs.name as branch_name',
            'sections.name as section_name'
        )
        ->where('users.id', '=', $request->employeeId)
        ->latest('employee_separations.id')
        ->first();
        return $userData;
    }
}