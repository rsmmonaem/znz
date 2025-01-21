<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use Entrust;
use App\Classes\Helper;
use App\SpacialHoliday;
use App\User;
use Illuminate\Support\Facades\DB;

Class SpacialHolidayController extends Controller{
    use BasicController;

	protected $form = 'holiday-form';

	public function index(SpacialHoliday $holiday){

		if(!Entrust::can('list_holiday'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

		return view('spacial-holiday.index');
	}

	public function lists(){

        $holidays = SpacialHoliday::leftJoin('users', 'spacial_holidays.user_id','=', 'users.id')
		->leftJoin('profile', 'users.id', '=', 'profile.user_id')
		->select('profile.employee_code as employee_code','spacial_holidays.description as description', 'spacial_holidays.date', 'spacial_holidays.id', 'users.first_name as bname')
		->orderby('spacial_holidays.id','desc')
		->get();
		return $holidays;
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_holiday'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

        $menu = ['holiday'];
		return view('spacial-holiday.create',compact('menu'));
	}

	public function edit($id){

		$holiday = SpacialHoliday::find($id);
		// $branches = Branch::all(); // Fetch all branches
		if(!Entrust::can('edit_holiday'))
            return view('common.error',['message' => trans('messages.permission_denied')]);

		$custom_field_values = Helper::getCustomFieldValues($this->form,$holiday->id);
        $menu = ['holiday'];
		return view('spacial-holiday.edit',compact('holiday','custom_field_values','menu'));
	}

	public function store(HolidayRequest $request, SpacialHoliday $holiday){
		if (!Entrust::can('create_holiday'))
		return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

		$validation = Helper::validateCustomField($this->form, $request);

		if ($validation->fails()) {
			if ($request->has('ajax_submit')) {
				$response = ['message' => $validation->messages()->first(), 'status' => 'error'];
				return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
			}
			return redirect()->back()->withInput()->withErrors($validation->messages());
		}
		// Define the base query for user data
		$data = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
			->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
			->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
			->leftJoin('departments', 'designations.department_id', '=', 'departments.id');
		if ($request->branch) {
			$data->where('profile.branch_id', '=', $request->branch);
		}
		if ($request->department) {
			$data->where('designations.department_id', '=', $request->department);
		}
		if ($request->designation) {
			$data->where('designations.id', '=', $request->designation);
		}
		if ($request->employee_id) {
			$employeeIds = is_array($request->employee_id) ? $request->employee_id : explode(',', $request->employee_id);
			$data->whereIn('profile.employee_code', $employeeIds);
		}
		if ($request->section) {
			$data->where('profile.section_id', '=', $request->section);
		}
		// Get the employee IDs
		$user_ids = $data->pluck('users.id');
		$dates = $request->input('date') ? explode(',', $request->input('date')) : [];

		foreach ($user_ids as $user_id) {
			foreach ($dates as $date) {
				// Check if the holiday exists for the user on the given date
				$holiday_exists = DB::table('spacial_holidays')
				->where('date', $date)
					->where('user_id', $user_id)
					->exists();

				if (!$holiday_exists) {
					$holiday = new SpacialHoliday;
					$holiday->date = $date;
					$holiday->user_id = $user_id;
					$holiday->description = $request->input('description');

					// Save and handle errors
					if ($holiday->save()) {
						Helper::storeCustomField($this->form, $holiday->id, $request->all());
					} else {
						return response()->json(['error' => 'Failed to save holiday'], 500);
					}
				}
			}
		}
		$this->logActivity(['module' => 'holiday','activity' => 'activity_added']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.holiday').' '.trans('messages.added'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		$response = ['message' => trans('messages.holiday') . ' ' . trans('messages.added'), 'status' => 'success'];
		return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));	
	}

	public function update(Request $request, $id){

		$holiday = SpacialHoliday::find($id);

		if(!Entrust::can('edit_holiday'))
            return view('common.error',['message' => trans('messages.permission_denied')]);

        $validation = Helper::validateCustomField($this->form,$request);
        
        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        
		$dates = explode(',',$request->input('date'));
		if(count($dates) > 1){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.one_holiday_edit_one_time'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.one_holiday_edit_one_time'));
		}
		
	    $data = $request->all();
		$holiday->fill($data);
		$holiday->save();
		Helper::updateCustomField($this->form,$holiday->id, $data);
		$this->logActivity(['module' => 'holiday','activity' => 'activity_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.holiday').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/spacial-holiday')->withSuccess(trans('messages.holiday').' '.trans('messages.updated'));
	}

	public function destroy(Request $request, $id){
		if(!Entrust::can('delete_holiday')){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$this->logActivity(['module' => 'holiday','activity' => 'activity_deleted']);
		SpacialHoliday::find($id)->delete();
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.holiday').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/holiday')->withSuccess(trans('messages.holiday').' '.trans('messages.deleted'));
	}
}
?>