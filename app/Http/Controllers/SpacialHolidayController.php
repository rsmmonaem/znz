<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use Entrust;
use App\Classes\Helper;
use App\SpacialHoliday;
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

        $holidays = SpacialHoliday::leftJoin('branchs', 'spacial_holidays.branch','=', 'branchs.id')
		->select('spacial_holidays.description as description', 'spacial_holidays.date', 'spacial_holidays.id', 'branchs.name as bname')
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

		if(!Entrust::can('create_holiday'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

        $validation = Helper::validateCustomField($this->form,$request);
        
        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

		$dates = explode(',',$request->input('date'));
		$data = $request->all();
		foreach($dates as $date){
			$holiday_exists = DB::table('spacial_holidays')->where('date','=',$date)->count();
			if(!$holiday_exists){
				$holiday = new SpacialHoliday;
				$holiday->date = $date;
				$holiday->branch = $request->input('branch');
				$holiday->description = $request->input('description');
				$holiday->save();
				Helper::storeCustomField($this->form,$holiday->id, $data);
			}
		}
		$this->logActivity(['module' => 'holiday','activity' => 'activity_added']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.holiday').' '.trans('messages.added'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect()->back()->withSuccess(trans('messages.holiday').' '.trans('messages.added'));		
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