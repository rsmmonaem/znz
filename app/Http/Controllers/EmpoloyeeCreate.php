<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Employee;
use App\Designation;
use App\Department;
use App\Branch;
use App\Contract;
use App\Section;
use App\Grade;
use App\Profile;
use App\User;
use App\UserShift;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Image;
use App\WHD;

class EmpoloyeeCreate extends Controller
{
    public function index()
    {
        $designations = Designation::LeftJoin('departments', 'designations.department_id', '=', 'departments.id') ->select('designations.*', 'departments.name as department_name') ->get();

        $departments = Department::orderBy('name', 'asc')->get();   
        $branches    = Branch::orderBy('name', 'asc')->get();       
        $sections    = Section::orderBy('name', 'asc')->get();      
        $grades      = Grade::orderBy('name', 'asc')->get();        
        $category    = DB::table('category')->orderBy('name', 'asc')->get(); 
        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
        $division = DB::table('divisions')->orderBy('name', 'asc')->get();

        return view('employee.create-employee',compact('category','designations','departments','branches','sections','grades','countries','division'));
    }

    public function store(Request $request)
    {
        // return $request->mothers_name;
        DB::beginTransaction();
        try{
            // Create the User record
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'designation_id' => $request->designation_id,
                'email' => $request->email,
                'status' => 'active',  // Set status to active by default
            ]);

            // Create the Profile record for the user
            $userProfile = DB::table('profile')->insert([
                'user_id' => $user->id,
                'joining_period' => $request->joining_period,
                'employee_code' => $request->employee_id,
                // Personal Information
                'branch_id' => $request->branch_id,
                'section_id' => $request->section_id,
                'grade_id' => $request->grade_id,
                'category' => $request->category,
                'job_nature' => $request->job_nature,
                'fathers_name' => $request->fathers_name,
                'mothers_name' => $request->mothers_name,
                'religion' => $request->religion,
                'height' => $request->height,
                'weight' => $request->weight,
                'nationality' => $request->nationality,
                'blood_group' => $request->blood_group,
                'nid' => $request->nid,
                'birth' => $request->brith,
                'passport' => $request->passport,
                'tin' => $request->tin,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'date_of_birth' => $request->date_of_birth,
                'date_of_joining' => $request->date_of_joining,
                'date_of_leaving' => $request->date_of_leaving,
                'date_of_retirement' => $request->date_of_retirement,
                'contact_number' => $request->contact_number,
                'photo' => $request->photo,
                'confirm_date' => Carbon::parse($request->confirm_date)->format('Y-m-d'),
                // Persent address
                'pres_house' => $request->pres_house,
                'pres_road' => $request->pres_road,
                'pres_division' => $request->pres_division,
                'pres_post' => $request->pres_post,
                'pres_district' => $request->pres_district,
                'pres_thana' => $request->pres_thana,
                'pres_upazila' => $request->pres_upazila,
                'pres_post_code' => $request->pres_post_code,
                // permanent address
                'perm_house' => $request->per_house,
                'perm_road' => $request->per_road,
                'perm_division' => $request->per_division,
                'perm_post' => $request->per_post,
                'perm_district' => $request->per_district,
                'perm_thana' => $request->per_thana,
                'perm_upazila' => $request->per_upazila,
                'perm_post_code' => $request->per_post_code,
            ]);

            // Check if a photo is uploaded and if the user has not requested to remove it
            if ($request->hasFile('photo')) {
                $extension = $request->file('photo')->getClientOriginalExtension();
                $filename = uniqid(); // Generate a unique filename
                $filePath = $request->file('photo')->move(config('constants.upload_path.profile_image'), $filename . "." . $extension);

                // Resize the image and save it
                $img = Image::make($filePath);
                $img->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(config('constants.upload_path.profile_image') . $filename . "." . $extension);

                // Update the user's profile with the photo filename
                $userProfile->photo = $filename . "." . $extension;
                $userProfile->save(); // Save the updated profile with the photo
            }

            // Create the BankAccount record for the user
            $userBank = $user->bankAccount()->create([
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'bank_code' => $request->bank_code,
            ]);
            
            $userShift = UserShift::create([
                'user_id' => $user->id,
                'office_shift_id' => 1,
                'from_date' => Carbon::now(),
                'to_date' => Carbon::now()->addYear(3)
            ]);

            $userContract = Contract::create([
                'user_id' => $user->id,
                'title' => rand(1,100),
                'designation_id' => $request->designation_id,
                'from_date' => Carbon::now(),
                'to_date' => Carbon::now()->addYear(3),
                'contract_type_id' => 1
            ]);

            $user_id_card = DB::table('id_card')->insert([
                'user_id' => $user->id,
                'status' => '0',
                'remarks' => 'ID Card Pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);


            // whd insert part start form here
            $startDate = Carbon::today();
            $endDate = Carbon::today()->addYears(3);

            // Loop start from next Friday (or today if today is Friday)
            $nextFriday = $startDate->copy()->next(Carbon::FRIDAY);
            if ($startDate->isFriday()) {
                $nextFriday = $startDate;
            }

            while ($nextFriday <= $endDate) {
                WHD::insert([
                    'user_id' => $user->id,
                    'date'    => $nextFriday->format('Y-m-d'), 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // Next Friday
                $nextFriday->addWeek();
            }
            // whd insert part End form here

            DB::commit();
            // Return a success response (you could also return the created user, profile, and bank)
            return response()->json([
                'message' => 'success',
                'user' => $user,
                'profile' => $userProfile,
                'bank_account' => $userBank,
                'shift' => $userShift,
                'contract' => $userContract,
                'id_card' => $user_id_card
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    private function MakeProfile($request , $user_id){

    }

    public function bloodGroup(Request $request) {
        $group = DB::table('com_group')->get();
        $brach = Branch::all();
        $departments = Department::all();
        $section = Section::all();
        $designation = Designation::all();
        $category = DB::table('category')->get();
        $grade = Grade::all();
       return view('employee.blood_employee_report', compact('group', 'brach', 'departments', 'section', 'designation', 'category', 'grade'));
    }

    public function bloodReport(Request $request) {
        if ($request->ajax()) {
            $query = Profile::leftJoin('users', 'profile.user_id', '=', 'users.id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('grades', 'profile.grade_id', '=', 'grades.id')
            ->select(
                'users.id',
                'profile.employee_code',
                'users.first_name',
                'designations.name as designation_name',
                'departments.name as department_name',
                'profile.category',
                'profile.date_of_joining',
                'profile.date_of_birth',
                'profile.blood_group',
                'profile.job_nature',
                'profile.contact_number',
                'profile.gender',
                'branchs.name as branch_name',
                'sections.name as section_name',
                'grades.name as grade_name'
            );
            if ($request->branch != '') {
                $query->where('profile.branch_id', $request->branch);
            }
            if ($request->section != '') {
                $query->where('profile.section_id', $request->section);
            }
            if ($request->grade != '') {
                $query->where('profile.grade_id', $request->grade);
            }
            if ($request->gender != '') {
                $query->where('profile.gender', $request->gender);
            }

            if ($request->category != '') {
                $query->where('profile.category', $request->category);
            }

            if ($request->employee_id != '') {
                $query->where('profile.employee_code', '=', $request->employee_id);
            }

            if (
                $request->designation != ''
            ) {
                $query->where('users.designation_id', $request->designation);
            }

            if ($request->department != '') {
                $query->where('designations.department_id', $request->department);
            }

            if ($request->blood_group != '') {
                $query->where('profile.blood_group', $request->blood_group);
            }
            $profile = $query->get();

            return response()->json($profile);
        }
    }



    public function migrate(Request $request)
    {
        try {
            $oldUsers = DB::table('tbluser')->where("BranchName","Hotel Kollol, Cox's Bazar")->get();
            

            $migrated = 0;
            foreach ($oldUsers as $old) {
                // Check if already migrated by email
                if (Profile::where('employee_code', $old->UserID)->exists()) {
                    continue;
                }

                // Insert into users table
                $user = new User();
                $user->first_name = $old->FullName;
                // $user->username = $old->UserName;
                $user->email = $old->Email;
                $user->password = null;
                $user->save();

                // Insert into profiles table

                $gender = strtolower(trim($old->Gender));

                
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->employee_code = $old->UserID;
                if ($gender == 'male') {
                    $profile->gender = 'male';
                } elseif ($gender == 'female') {
                    $profile->gender = 'female';
                } else {
                    $profile->gender = null; 
                }
                $profile->contact_number = $old->PhoneNo;
                $profile->fathers_name = $old->FathersName;
                $profile->mothers_name = $old->MothersName;
                $profile->blood_group = $old->BloodGroup;
                $profile->nid = $old->NID;
                $profile->branch_id = 24;
                $profile->save();

                
                $userContract = Contract::create([
                    'user_id' => $user->id,
                    'title' => rand(1,100),
                    'designation_id' => null,
                    'from_date' => Carbon::now(),
                    'to_date' => Carbon::now()->addYear(10),
                    'contract_type_id' => 1
                ]);

                $user_id_card = DB::table('id_card')->insert([
                    'user_id' => $user->id,
                    'status' => '0',
                    'remarks' => 'ID Card Pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);


            

                $migrated++;
            }

            return response()->json([
                'status' => 'success',
                'message' => $migrated . ' user(s) migrated successfully to Hotel Kollol by J&Z Group!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    


}