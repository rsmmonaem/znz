<?php
namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeProfileRequest;
use App\Classes\Helper;
use App\Department;
use App\Designation;
use App\User;
use App\Template;
use Entrust;
use Auth;
use App\LeaveType;
use App\SalaryType;
use App\Salary;
use App\DocumentType;
use App\EmployeeEducation;
use App\EmployeeTransfer;
use App\Grade;
use App\Profile;
use App\ReportType;
use App\Section;
use App\WorkExperience;
use Image;
use File;
use Mail;
use DB;
use Exception;
use Validator;

class EmployeeController extends Controller{
    use BasicController;
    
    protected $form = 'employee-form';

    public function index(User $employee){

        if(!Entrust::can('list_employee'))
            return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

        if(Entrust::can('manage_all_employee'))
            $designations = \App\Designation::all()->pluck('full_designation','id')->all();
        else{
            $childs = Helper::childDesignation(Auth::user()->designation_id);
            $designations = \App\Designation::whereIn('id',$childs)->get()->pluck('full_designation','id')->all();
        }

        $roles = \App\Role::whereIsHidden(0)->get()->pluck('name','id')->all();

        $col_heads = array(
            'Option',
            'ID',
            'Name',
            'Designation',
            'Department',
            'Category',
            'DOJ',
            'DOB',
            'Blood Group',
            'Job Nature',
            'Phone Number',
            'Gender',
            'Branch',
        );
        $table_info = array(
            'source' => 'employee',
            'title' => 'Employee List',
            'id' => 'employee_table'
        );

        $designation_users = User::select('designation_id', DB::raw('count(*) as total'))
             ->groupBy('designation_id')
             ->get();
        $designation_user_stat[] = array('Designation','Count');
        foreach($designation_users as $designation_user){
            $designation_user_stat[] = array($designation_user->Designation->name, $designation_user->total);
        }

        $status_users = User::select('status', DB::raw('count(*) as total'))
             ->groupBy('status')
             ->get();
        $status_user_stat[] = array('User Status','Count');
        foreach($status_users as $status_user){
            $status_user_stat[] = array(Helper::toWord($status_user->status),$status_user->total);
        }

        $departments = \App\Department::all();
        $department_user_stat[] = array('Department','Count');
        foreach($departments as $department){
            foreach($department->Designation as $designation)
            $department_user_stat[] = array($department->name,$designation->hasMany('\App\User')->count());
        }

        $role_users = DB::table('role_user')->join('roles','roles.id','=','role_user.role_id')->select('name', DB::raw('count(*) as total'))
             ->groupBy('role_id')
             ->get();
        $role_user_stat[] = array('Role','Count');
        foreach($role_users as $role_user)
            $role_user_stat[] = array(Helper::toWord($role_user->name),$role_user->total);

        $employee_graph_data = array('designation_wise_user_graph' => $designation_user_stat,'status_wise_user_graph' => $status_user_stat,'department_wise_user_graph' => $department_user_stat, 'role_wise_user_graph' => $role_user_stat);

        $assets = ['graph'];
       
        return view('employee.index',compact('col_heads','table_info','designations','roles','assets','employee_graph_data'));
    }

    public function lists(Request $request){

        //     if (Entrust::can('manage_all_employee')){
        //     $employees = DB::select(DB::raw('
        //     SELECT
        //         u.id AS user_id,
        //         u.id AS user_id,
        //         u.first_name AS user_name,
        //         u.last_name as last_name,
        //         u.email as email,
        //         COALESCE(MAX(CASE WHEN cf.name = "bangla-name" THEN cfv.value END), "N/A") AS bangla_name,
        //         COALESCE(MAX(CASE WHEN cf.name = "category" THEN cfv.value END), "N/A") AS category,
        //         COALESCE(MAX(CASE WHEN cf.name = "job-nature" THEN cfv.value END), "N/A") AS job_nature,
        //         COALESCE(MAX(CASE WHEN cf.name = "father-name" THEN cfv.value END), "N/A") AS father_name,
        //         COALESCE(MAX(CASE WHEN cf.name = "mother-name" THEN cfv.value END), "N/A") AS mother_name,
        //         COALESCE(MAX(CASE WHEN cf.name = "confirm-date" THEN cfv.value END), "N/A") AS confirm_date,
        //         COALESCE(MAX(CASE WHEN cf.name = "religion-" THEN cfv.value END), "N/A") AS religion,
        //         COALESCE(MAX(CASE WHEN cf.name = "height" THEN cfv.value END), "N/A") AS height,
        //         COALESCE(MAX(CASE WHEN cf.name = "weight" THEN cfv.value END), "N/A") AS weight,
        //         COALESCE(MAX(CASE WHEN cf.name = "employ-phone-" THEN cfv.value END), "N/A") AS employ_phone,
        //         COALESCE(MAX(CASE WHEN cf.name = "nationality-" THEN cfv.value END), "N/A") AS nationality,
        //         COALESCE(MAX(CASE WHEN cf.name = "blood-group" THEN cfv.value END), "N/A") AS blood_group,
        //         COALESCE(MAX(CASE WHEN cf.name = "birth-" THEN cfv.value END), "N/A") AS birth,
        //         COALESCE(MAX(CASE WHEN cf.name = "passport-" THEN cfv.value END), "N/A") AS passport,
        //         COALESCE(MAX(CASE WHEN cf.name = "tin" THEN cfv.value END), "N/A") AS tin,
        //         COALESCE(d.name, "N/A") AS designation_name,
        //         COALESCE(dp.name, "N/A") AS department_name
        //     FROM
        //         users u
        //     LEFT JOIN
        //         custom_field_values cfv ON cfv.unique_id = u.id
        //     LEFT JOIN
        //         custom_fields cf ON cfv.field_id = cf.id
        //     LEFT JOIN 
        //         designations d ON u.designation_id = d.id
        //     LEFT JOIN
        //         departments dp ON d.department_id = dp.id
        //     GROUP BY
        //         u.id, u.first_name, d.name
        //     ORDER BY
        //         u.id desc
        // '));
        //     } else {
        //         $employees =[];
        //     }
        //     // Prepare rows to match column headers
        //     $rows = [];
        //     foreach ($employees as $employee) {
        //         $rows[] = [
        //             '<div class="btn-group btn-group-xs">' .
        //             '<a href="/employee/' . $employee->user_id . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="' . trans('messages.view') . '"> <i class="fa fa-arrow-circle-right"></i></a> ' .
        //             (Entrust::can('delete_employee') ? delete_form(['employee.destroy', $employee->user_id], 'employee', 1) : '') .
        //             '</div>',
        //             $employee->user_id,
        //             $employee->user_name,
        //             $employee->last_name,
        //             // $employee->email,
        //             $employee->bangla_name,
        //             $employee->designation_name,
        //             $employee->department_name,
        //             $employee->category,
        //             $employee->job_nature,
        //             $employee->father_name,
        //             $employee->mother_name,
        //             $employee->confirm_date,
        //             $employee->religion,
        //             $employee->height,
        //             $employee->weight,
        //             $employee->employ_phone,
        //             $employee->nationality,
        //             $employee->blood_group,
        //             $employee->birth,
        //             $employee->passport,
        //             $employee->tin,
        //         ];
        //     }
        if (Entrust::can('manage_all_employee'))
            // $employees = User::with('profile', 'designation', 'designation.department')->get();
         $employees = DB::table('users')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftjoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('designations', 'users.designation_id', '=','designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
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
                'branchs.name as branch_name'
            )
            ->get();
        elseif (Entrust::can('manage_subordinate_employee')) {
            $childs = Helper::childDesignation(Auth::user()->designation_id, 1);
            $employees = User::with('roles')->whereIn('designation_id', $childs)->get();
        } else
            $employees = [];

        $data = json_encode($employees);
        // return $data;
        // die;
        $rows = array();

        foreach ($employees as $employee) {
            // foreach ($employee->roles as $role)
            //     $role_name = Helper::toWord($role->name);

            $rows[] = array(
                '<div class="btn-group btn-group-xs">' .
                    '<a href="/employee/' . $employee->id . '" class="btn btn-default btn-xs" data-toggle="tooltip" title="' . trans('messages.view') . '"> <i class="fa fa-arrow-circle-right"></i></a> ' .
                    (Entrust::can('delete_employee') ? delete_form(['employee.destroy', $employee->id], 'employee', 1) : '') .
                    '</div>',
                ($employee->employee_code != '') ? $employee->employee_code : trans('messages.na'),
                $employee->first_name,
                $employee->designation_name,
                $employee->designation_name,
                $employee->category,
                $employee->date_of_joining,
                $employee->date_of_birth,
                $employee->blood_group,
                $employee->job_nature,
                $employee->contact_number,
                $employee->gender,
                $employee->branch_name
            );
        }
        $list['aaData'] = $rows;
        // Return the result as JSON for DataTable
        return response()->json($list);
    }

    public function profile($id = null){

        $id = ($id != null) ? $id : Auth::user()->id;
        $user = (User::find($id)) ? : Auth::user();

        if(Entrust::can('manage_all_employee')){}
        elseif(Entrust::can('manage_subordinate_employee')){
            $child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
            $child_users = User::whereIn('designation_id',$child_designations)->pluck('id')->all();
            array_push($child_users, Auth::user()->id);
            if(!in_array($user->id,$child_users))
                return redirect('/profile')->withErrors(trans('messages.permission_denied'));
        } elseif($user->id != Auth::user()->id)
                return redirect('/profile')->withErrors(trans('messages.permission_denied'));

        $contract = Helper::getContract($user->id);
        $menu = ['employee'];

        return view('employee.profile',compact('user','contract','menu'));
    }

    public function show(User $employee){

        if(!$this->employeeAccessible($employee) && $employee->id != Auth::user()->id)
            return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

        if(Entrust::can('manage_all_employee'))
            $designations = \App\Designation::all()->pluck('full_designation','id')->all();
        elseif(Entrust::can('manage_subordinate_employee')) {
            $childs = Helper::childDesignation(Auth::user()->designation_id);
            $designations = \App\Designation::whereIn('id',$childs)->get()->pluck('full_designation','id')->all();
        } else
            $designations = [];

        foreach($employee->roles as $role)
            $role_id = $role->id;

        $roles = \App\Role::whereIsHidden(0)->get()->pluck('name','id')->all();

        $gender = Helper::translateList(config('lists.gender'));
        $marital_status = Helper::translateList(config('lists.marital_status'));
        $employee_relation = Helper::translateList(config('lists.employee_relation'));
        $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);
        $social_custom_field_values = Helper::getCustomFieldValues('employee-social-form-form',$employee->id);
        $contract_types = \App\ContractType::pluck('name','id')->all();
        $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
        $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();
        $leave_types = LeaveType::all();
        $contract_lists = \App\Contract::whereUserId($employee->id)->get()->pluck('full_contract_detail','id')->all();
        $office_shifts = \App\OfficeShift::all()->pluck('name','id')->all();
        $document_types = DocumentType::pluck('name','id')->all();

        $templates = \App\Template::whereIsDefault(0)->pluck('name','id')->all();

        $assets = ['rte'];
        $menu = ['employee'];
        $type = ['Owner' => 'Owner', 'Staff' => 'Staff'];
        $riligion = ['Islam' => 'Islam', 'Hinduism' => 'Hinduism', 'Christianity' => 'Christianity', 'Buddhism' => 'Buddhism', 'Judaism' => 'Judaism', 'Sikhism' => 'Sikhism', 'Jainism' => 'Jainism'];
        $brach = Branch::all()->pluck('name','id')->all();
        $section = Section::all()->pluck('name','id')->all();
        $grade = Grade::all()->pluck('name','id')->all();
        // return $brach;
        $education = EmployeeEducation::where('user_id', '=', $employee->id)->get();
        $experience = WorkExperience::where('user_id','=', $employee->id)->get();
        // return $education;
        return view('employee.show',compact('experience','education','section','grade','brach','type', 'riligion','employee','designations','assets','menu','role','roles','gender','marital_status','custom_field_values','employee_relation','social_custom_field_values','contract_types','earning_salary_types','deduction_salary_types','leave_types','contract_lists','office_shifts','document_types','templates'));
    }

    public function edit(User $employee){
      $child_designations = Helper::childDesignation(Auth::user()->designation_id,1);

      if(!Entrust::can('edit_employee') || !$this->employeeAccessible($employee))
          return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

      foreach($employee->roles as $role)
        $role_id = $role->id;

      $query = \App\Designation::whereNotNull('id');

      if(!Entrust::can('manage_all_employee'))
        $query->whereIn('id',$child_designations);

      $designations = $query->get()->pluck('full_designation','id')->all();

        if(defaultRole())
            $roles = \App\Role::pluck('name','id')->all();
        else
            $roles = \App\Role::where('name','!=','admin')->pluck('name','id')->all();

      $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);
        $menu = ['employee'];

      return view('employee.edit',compact('employee','designations','roles','role_id','custom_field_values','menu'));
    }

    public function profileUpdate(EmployeeProfileRequest $request, $id){
        $employee = User::find($id);

        if(!$employee){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('employee')->withErrors(trans('messages.invalid_link'));
        }

        if(!$this->employeeAccessible($employee)){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
        }

        if($request->input('type') == 'social_networking'){
            $validation = Helper::validateCustomField('employee-social-form',$request);
            
            if($validation->fails()){
                if($request->has('ajax_submit')){
                    $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                    return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
                }
                return redirect()->back()->withInput()->withErrors($validation->messages());
            }
        }

        $profile = $employee->Profile ?: new Profile;
        $employee->profile()->save($profile);
        $photo = $profile->photo;
        $data = $request->all();
        $profile->fill($data);

        if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid();
            $file = $request->file('photo')->move(config('constants.upload_path.profile_image'), $filename.".".$extension);
            $img = Image::make(config('constants.upload_path.profile_image').$filename.".".$extension);
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(config('constants.upload_path.profile_image').$filename.".".$extension);
            $profile->photo = $filename.".".$extension;
        } elseif($request->input('remove_photo') == 1){
            File::delete(config('constants.upload_path.profile_image').$profile->photo);
            $profile->photo = null;
        }
        else
        $profile->photo = $photo;

        if($request->input('type') == 'social_networking')
            Helper::updateCustomField('employee-social-form',$employee->id, $data);

        $profile->save();

        $this->logActivity(['module' => 'employee','unique_id' => $employee->id,'activity' => 'activity_profile_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.profile').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }

        return redirect('/employee/'.$id.'/#'.$request->input('type'))->withSuccess(trans('messages.employee').' '.trans('messages.profile').' '.trans('messages.updated'));
    }

    public function update(EmployeeRequest $request, User $employee){
        // return $request->all();
        $validation = Helper::validateCustomField($this->form,$request);
        
        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

        if(!Entrust::can('edit_employee') || !$this->employeeAccessible($employee)){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
        }

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        if($request->has('designation_id'))
        $employee->designation_id = $request->input('designation_id');

        if(defaultRole() && $request->has('role_id')){
          $roles[] = $request->input('role_id');
          $employee->roles()->sync($roles);
        }
        $employee->save();

        $profile = $employee->Profile ?: new Profile;
        $profile->gender = $request->input('gender');
        $profile->marital_status = $request->input('marital_status');
        $profile->employee_code = $request->input('employee_code');
        $profile->date_of_birth = ($request->input('date_of_birth')) ? : null;
        $profile->date_of_joining = ($request->input('date_of_joining')) ? : null;
        $profile->date_of_leaving = ($request->input('date_of_leaving')) ? : null;
        // Extra Added Code
        $profile->category = $request->input('category');
        $profile->job_nature = $request->input('job_nature');
        $profile->fathers_name = $request->input('fathers_name');
        $profile->mothers_name = $request->input('mothers_name');
        $profile->gender = $request->input('gender');
        $profile->marital_status = $request->input('marital_status');
        $profile->confirm_date = $request->input('empoloyee_confirm') ?: null;
        $profile->religion = $request->input('reliagion');
        $profile->height = $request->input('height') ?: null;
        $profile->weight = $request->input('weight') ?: null;
        $profile->contact_number = $request->input('contact_number');
        $profile->nationality = $request->input('nationality');
        $profile->blood_group = $request->input('blood_group') ?: null;
        $profile->nid = $request->input('nid');
        $profile->birth = $request->input('brith');
        $profile->passport = $request->input('passport');
        $profile->tin = $request->input('tin');
        // Present address fields
        $profile->pres_house = $request->input('pres_house');
        $profile->pres_road = $request->input('pres_road');
        $profile->pres_division = $request->input('pres_division');
        $profile->pres_post = $request->input('pres_post');
        $profile->pres_district = $request->input('pres_district');
        $profile->pres_thana = $request->input('pres_thana');
        $profile->pres_upazila = $request->input('pres_upazila');
        $profile->pres_post_code = $request->input('pres_post_code');
        // Permanet Address
        $profile->perm_house = $request->input('house');
        $profile->perm_road = $request->input('road');
        $profile->perm_division = $request->input('division');
        $profile->perm_post = $request->input('post');
        $profile->perm_district = $request->input('district');
        $profile->perm_thana = $request->input('thana');
        $profile->perm_upazila = $request->input('upazila');
        $profile->perm_post_code = $request->input('post_code');
        // Added Branch
        $profile->branch_id = $request->input('branch_id');
        $profile->section_id = $request->input('section_id');
        $profile->grade_id = $request->input('grade_id');
        // return $profile->branch_id;
        // Upload Image
        if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid();
            $file = $request->file('photo')->move(config('constants.upload_path.profile_image'), $filename.".".$extension);
            $img = Image::make(config('constants.upload_path.profile_image').$filename.".".$extension);
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(config('constants.upload_path.profile_image').$filename.".".$extension);
            $profile->photo = $filename.".".$extension;
            // return $profile->photo;
        } 
        $employee->profile()->save($profile);

        if(isset($profile->date_of_leaving) && $profile->date_of_leaving < date('Y-m-d'))
            $employee->status = 'in-active';
        else
            $employee->status = 'active';
        $employee->save();

        Helper::updateCustomField($this->form,$employee->id, $request->all());

        $this->logActivity(['module' => 'employee','unique_id' => $employee->id,'activity' => 'activity_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.employee').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/employee/'.$employee->id.'#basic')->withSuccess(trans('messages.employee').' '.trans('messages.updated'));
    }

    public function accountInvalid(){

      if(Auth::user()->Profile->date_of_leaving > date('Y-m-d'))
        return redirect('/dashboard');

      return view('employee.account_invalid');
    }

    public function changePassword(){
      return view('auth.change_password');
    }


    public function doChangePassword(Request $request){
        if(!getMode()){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.disable_message'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withErrors(trans('messages.disable_message'));
        }

        $credentials = $request->only(
                'new_password', 'new_password_confirmation'
        );

        $validation = Validator::make($request->all(),[
            'old_password' => 'required|valid_password',
            'new_password' => 'required|confirmed|different:old_password|min:6',
            'new_password_confirmation' => 'required|different:old_password|same:new_password'
        ]);

        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withErrors($validation->messages()->first());
        }

        $user = Auth::user();
        
        $user->password = bcrypt($credentials['new_password']);
        $user->save();
        $this->logActivity(['module' => 'authentication','activity' => 'activity_password_changed']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.password_changed'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        
        return redirect()->back()->withErrors(trans('messages.password_changed'));
    }

    public function doChangeEmployeePassword(Request $request, $id){
        if(!getMode()){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.disable_message'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withErrors(trans('messages.disable_message'));
        }
        $employee = User::find($id);
        

        $validation = Validator::make($request->all(),[
            'new_password' => 'required|confirmed|min:6',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withErrors($validation->messages()->first());
        }

        $credentials = $request->only(
                'new_password', 'new_password_confirmation'
        );

        $employee->password = bcrypt($credentials['new_password']);
        $employee->save();
        $this->logActivity(['module' => 'authentication','activity' => 'activity_employee_password_changed']);

        $response = ['message' => trans('messages.password_changed'), 'status' => 'success']; 
        return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        
        return redirect()->back()->withSuccess(trans('messages.password_changed'));    
    }

    public function email(Request $request, $id){
        $validation = Validator::make($request->all(),[
            'subject' => 'required',
            'body' => 'required'
        ]);

        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withErrors($validation->messages()->first());
        }

        $user = User::find($id);
        $mail['email'] = $user->email;
        $mail['subject'] = $request->input('subject');
        $body = $request->input('body');

        \Mail::send('emails.email', compact('body'), function($message) use ($mail){
            $message->to($mail['email'])->subject($mail['subject']);
        });
        $this->logEmail(array('to' => $mail['email'],'subject' => $mail['subject'],'body' => $body));

        $this->logActivity(['module' => 'employee','unique_id' => $user->id,'activity' => 'mail_sent']);
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.mail').' '.trans('messages.sent'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect()->back()->withSuccess(trans('messages.mail').' '.trans('messages.sent'));
    }

    public function destroy(User $employee,Request $request){

        if(!Entrust::can('delete_employee') || !$this->employeeAccessible($employee) || $employee->is_hidden){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
          return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
        }

        if($employee->id == Auth::user()->id){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/employee')->withErrors(trans('message.unable_to_delete_yourself'));
        }

        Helper::deleteCustomField($this->form, $employee->id);
        $this->logActivity(['module' => 'employee','unique_id' => $employee->id,'activity' => 'activity_deleted']);

        $employee->delete();
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.employee').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/employee')->withSuccess(trans('messages.employee').' '.trans('messages.deleted'));
    }

    public function EmployeeReport(Request $request){
        $brach = Branch::select('name','id')->get();
        $departments = Department::select('name','id')->get();
        $designation = Designation::select('name','id')->get();
        $section = Section::select('name','id')->get();
        $grade = Grade::select('name','id')->get();
        $report_type = ReportType::select('name','id')->get();

        
        return view('employee.employee_report',compact('brach','departments','designation','section','grade','report_type'));
    }

    public function EmployeeReportPOST(Request $request){
        if ($request->ajax()) {
            $query = Profile::leftJoin('users', 'profile.user_id', '=', 'users.id')
            ->leftJoin('designations', 'users.designation_id','=', 'designations.id')
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
            if($request->multiple_id != '') {
                // return $request->multiple_id;
                $query->whereIn('profile.employee_code', $request->multiple_id);
            }
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

            if ($request->designation != ''
            ) {
                $query->where('users.designation_id', $request->designation);
            }

            if ($request->department != '') {
                $query->where('designations.department_id', $request->department);
            }

            $profile = $query->get();

            return response()->json($profile);
        }
    }

    /**
     * This function is used to generate view for transfer of employee
     * 
     * @param Request $request 
     * 
     * @return view
     */
    public function transferview(Request $request){
        $branch = Branch::select('name','id')->get();
        $department = Department::select('name','id')->get();
        $designation = Designation::select('name','id')->get();
        $section = Section::select('name','id')->get();
        $employee = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        return view('employee_transfer.transfer',compact('branch','department','designation','section','employee'));
    }
    /**
     * Handles the transfer of an employee.
     *
     * @param Request $request The HTTP request object containing transfer data.
     * 
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the status of the transfer.
     */
    public function transfer(Request $request){
      DB::beginTransaction();
      try{
            EmployeeTransfer::create($request->all());
            Profile::where('user_id', $request->femployee)->update(['branch_id' => $request->tbranch, 'section_id' => $request->tsection]);
            Designation::where('id', $request->fdesignation)->update(['department_id' => $request->tdepartment]);
            User::where('id', $request->femployee)->update(['designation_id' => $request->tdesignation]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => trans('Employee Transfered Successfully')]);
      }catch(Exception $e){
        DB::rollback();
        return response()->json(['status' => 'success', 'message' => $e->getMessage()]);
      }
    }

    /**
     * This function is used to generate the view for list of transferred employees
     * 
     * @return view
     */
    public function transferList(){
        $transferlist = EmployeeTransfer::select(
            'employeetransfer.id',
            'profile.employee_code',
            'users.first_name',
            'designations.name as designation_name',  // Alias for designation name
            'ftransfer_date',
            'tjoin_date',
            'remarks',
            'users.status'
        )
            ->leftJoin('users', 'employeetransfer.femployee', '=', 'users.id')
            ->leftJoin('designations', 'employeetransfer.fdesignation', '=', 'designations.id')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')  // Assuming 'profiles' is the table and relationship for employee_code
            ->orderBy('employeetransfer.id', 'desc')
            ->get();
        return $transferlist;
    }
    
    /**
     * This function is used to generate the view for edit of transferred employees
     * @param int $id The ID of the employee transfer record to edit
     * @return view
     */
    public function transferEdit($id){
        $transfer = EmployeeTransfer::find($id);
        $branch = Branch::select('name', 'id')->get();
        $department = Department::select('name', 'id')->get();
        $designation = Designation::select('name', 'id')->get();
        $section = Section::select('name', 'id')->get();
        $employee = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.first_name', 'users.id', 'profile.employee_code')
        ->get();
        return view('employee_transfer.transfer-edit',compact('branch','department','designation','section','employee','transfer'));
        // return $transfer;
    }


    /**
     * This function is used to update the employee transfer record
     * @param Request $request The request sent from the form
     * @param int $id The ID of the employee transfer record to update
     * @return \Illuminate\Http\JsonResponse
     */
    public function transferUpdate(Request $request, $id){
        DB::beginTransaction();
        try{
            EmployeeTransfer::where('id', $id)->update($request->all());
            Profile::where('user_id', $request->femployee)->update(['branch_id' => $request->tbranch, 'section_id' => $request->tsection]);
            Designation::where('id', $request->fdesignation)->update(['department_id' => $request->tdepartment]);
            User::where('id', $request->femployee)->update(['designation_id' => $request->tdesignation]);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => trans('Employee Transfered Successfully')]);
        }catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => 'success', 'message' => $e->getMessage()]);
        }
    }

    /**
     * This function is used to delete the employee transfer record
     * @param int $id The ID of the employee transfer record to delete
     * @return \Illuminate\Http\JsonResponse
     */
    public function transferCancel($id){
        DB::beginTransaction();
        try{
            $olddata = EmployeeTransfer::where('id', $id)->first();
            Profile::where('user_id', $olddata->femployee)->update(['branch_id' => $olddata->fbranch, 'section_id' => $olddata->fsection]);
            Designation::where('id', $olddata->fdesignation)->update(['department_id' => $olddata->fdepartment]);
            User::where('id', $olddata->femployee)->update(['designation_id' => $olddata->fdesignation]);
            EmployeeTransfer::where('id', $id)->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => trans('Employee Transfer Deleted Successfully')]);
         }catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => 'success', 'message' => $e->getMessage()]);
        }
    }
}