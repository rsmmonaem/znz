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

class EmpoloyeeCreate extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        $departments = Department::all();
        $branches = Branch::all();
        $sections = Section::all();
        $grades = Grade::all();
        $category = DB::table('category')->get();
        return view('employee.create-employee',compact('category','designations','departments','branches','sections','grades'));
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
            DB::commit();
            // Return a success response (you could also return the created user, profile, and bank)
            return response()->json([
                'message' => 'success',
                'user' => $user,
                'profile' => $userProfile,
                'bank_account' => $userBank,
                'shift' => $userShift,
                'contract' => $userContract
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    private function MakeProfile($request , $user_id){

    }
}