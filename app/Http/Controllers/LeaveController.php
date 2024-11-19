<?php
namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\LeaveStatusRequest;
use DB;
use Entrust;
use App\Leave;
use App\LeaveType;
use App\User;
use Auth;
use App\Classes\Helper;
use App\Department;
use App\Designation;
use App\Section;

Class LeaveController extends Controller{
    use BasicController;

	protected $form = 'leave-form';

	public function index(Leave $leave){

        $col_heads = array(
        		trans('messages.option'),
        		trans('messages.employee'),
        		trans('messages.leave_type'),
        		trans('messages.request').' '.trans('messages.duration'),
        		trans('messages.approved').' '.trans('messages.duration'),
        		trans('messages.status')
        		);

		if(Entrust::can('manage_all_employee'))
			$users = User::all();
		elseif(Entrust::can('manage_subordinate_employee')){
			$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
			$child_users = User::whereIn('designation_id',$child_designations)->pluck('id')->all();
			array_push($child_users, Auth::user()->id);
			$users = User::whereIn('id',$child_users)->get();
		} else 
			$users = User::whereId(Auth::user()->id)->get();

		$l_types = \App\LeaveType::all();
		$leave_graph = array();
		foreach($users as $user){
			$contract = Helper::getContract($user->id);

			if($contract){
				foreach($l_types as $leave_type){
					$leave_graph[$leave_type->name][] = array(
							$user->full_name_with_designation,
							($contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->count()) ? $contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->first()->leave_used : 0,
							($contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->count()) ? $contract->UserLeave->whereLoose('leave_type_id',$leave_type->id)->first()->leave_count : 0
						);
				}
			}
		}

		// return $leave_graph;

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $leave_types = LeaveType::pluck('name','id')->all();
        $menu = ['leave'];
        $assets = ['graph'];
        $table_info = array(
			'source' => 'leave',
			'title' => 'Leave List',
			'id' => 'leave_table'
		);
 
		return view('leave.index',compact('col_heads','menu','leave_types','table_info','leave_graph','assets'));
	}

	public function lists(Request $request){

		if(Entrust::can('manage_all_leave'))
        	$leaves = Leave::orderBy('status','desc')->get();
        elseif(Entrust::can('manage_subordinate_leave')){
			$child_designations = Helper::childDesignation(Auth::user()->designation_id,1);
			$child_users = User::whereIn('designation_id',$child_designations)->pluck('id')->all();
			array_push($child_users, Auth::user()->id);
    		$leaves = Leave::whereIn('user_id',$child_users)->get();
        }
    	else
    		$leaves = Leave::where('user_id','=',Auth::user()->id)->get();
        
        $rows=array();
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($leaves as $leave){

        	if($leave->from_date == $leave->to_date)
        		$leave_duration = showDate($leave->from_date);
        	else
        		$leave_duration = showDate($leave->from_date).' '.trans('messages.to').' '.showDate($leave->to_date);

        	$days_count = dateDiff($leave->from_date,$leave->to_date);
        	if($leave->approved_date && count(explode(',', $leave->approved_date)) != $days_count){
        		$approved_dates = explode(',',$leave->approved_date);
        		$leave_approved = '<ol>';
        		foreach($approved_dates as $approved_date)
        			$leave_approved .= '<li>'.showDate($approved_date).'</li>';
        		$leave_approved .= '</ol>';
        	} elseif($leave->approved_date && count(explode(',', $leave->approved_date)) == $days_count)
        		$leave_approved = $leave_duration;
        	else
        		$leave_approved = '';

			$row = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/leave/'.$leave->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="'.trans('messages.view').'"> <i class="fa fa-arrow-circle-right"></i></a> '.
					((Entrust::can('edit_leave') && $this->leaveAccessible($leave)) ? '<a href="#" data-href="/leave/'.$leave->id.'/edit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit" data-toggle="tooltip" title="'.trans('messages.edit').'"></i></a> ' : '').
					((Entrust::can('delete_leave') && $this->leaveAccessible($leave)) ? delete_form(['leave.destroy',$leave->id]) : '').'</div>',
					$leave->User->full_name_with_designation,
					$leave->LeaveType->name,
					$leave_duration,
					$leave_approved,
					trans('messages.'.$leave->status)
					);	
			$id = $leave->id;

			foreach($col_ids as $col_id)
				array_push($row,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$rows[] = $row;
        }

        $list['aaData'] = $rows;
        return json_encode($list);
	}

	public function show(Leave $leave){

		if(!$this->leaveAccessible($leave))
          	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

    	$other_leaves = Leave::where('id','!=',$leave->id)
    		->where('user_id','=',$leave->user_id)
    		->get();

    	$status = Helper::translateList(config('lists.leave_status'));
    	$f_date = $leave->from_date;
        $t_date = $leave->to_date;
        while ($f_date <= $t_date) {
            $available_date[] = $f_date;
            $f_date = date ("Y-m-d", strtotime("+1 days", strtotime($f_date)));
        }

        $menu = ['leave'];


		return view('leave.show',compact('leave','other_leaves','status','menu','available_date'));
	}

	public function create(){

		if(!Entrust::can('request_leave'))
            return view('common.error',['message' => trans('messages.permission_denied')]);

        $leave_types = LeaveType::pluck('name','id')->all();
        $menu = ['leave'];
        
		return view('leave.create',compact('leave_types','leave'));
	}

	public function edit(Leave $leave){

		if(!Entrust::can('edit_leave') || !$this->leaveAccessible($leave))
            return view('common.error',['message' => trans('messages.permission_denied')]);

		if($leave->status != 'pending')
            return view('common.error',['message' => trans('messages.leave_cannot_edit')]);

        $leave_types = LeaveType::pluck('name','id')->all();
        $custom_field_values = Helper::getCustomFieldValues($this->form,$leave->id);
        $menu = ['leave'];
		
		return view('leave.edit',compact('leave','leave_types','custom_field_values','menu'));
	}

	public function store(LeaveRequest $request, Leave $leave){	

        $validation = Helper::validateCustomField($this->form,$request);
        
        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }

		if(!Entrust::can('request_leave')){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$user_id = Auth::user()->id;
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$contract = \App\Contract::whereUserId($user_id)
			->where('from_date','<=',$from_date)
			->where('to_date','>=',$to_date)
			->first();

		if(!$contract){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.contract_period_not_found'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.contract_period_not_found'));
		}

		$user_leave = \App\UserLeave::whereContractId($contract->id)
			->whereLeaveTypeId($request->input('leave_type_id'))
			->first();

		if(!$user_leave){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.leave_not_defined'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.leave_not_defined'));
		}

		$leave_request_count = (strtotime($to_date) - strtotime($from_date)) / (60*60*24) + 1;
		$leave_type = LeaveType::find($request->input('leave_type_id'));

		$leave_balance = $user_leave->leave_count - $user_leave->leave_used;
		if($leave_balance <  $leave_request_count){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'));
		}

		$leaves = Leave::where('user_id','=',$user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date){
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query)  use($from_date,$to_date) {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.leave_requested_for_this_period'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withInput()->withErrors(trans('messages.leave_requested_for_this_period'));
		}

		$data = $request->all();
		$data['user_id'] = $user_id;
	    $leave->fill($data);
	    $leave->status = 'pending';
		$leave->save();
		$this->logActivity(['module' => 'leave','unique_id' => $leave->id,'activity' => 'activity_added']);

		Helper::storeCustomField($this->form,$leave->id, $data);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.leave').' '.trans('messages.requested'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect()->back()->withSuccess(trans('messages.leave').' '.trans('messages.requested'));		
	}

	public function update(LeaveRequest $request, Leave $leave){

        $validation = Helper::validateCustomField($this->form,$request);
        
        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        
		if(!Entrust::can('edit_leave') || !$this->leaveAccessible($leave)){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
          	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		if($leave->status != 'pending'){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.leave_cannot_edit'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('leave')->withErrors(trans('messages.leave_cannot_edit'));
		}
		
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$contract = \App\Contract::whereUserId($leave->user_id)
			->where('from_date','<=',$from_date)
			->where('to_date','>=',$to_date)
			->first();

		if(!$contract){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.contract_period_not_found'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.contract_period_not_found'));
		}

		$user_leave = \App\UserLeave::whereContractId($contract->id)
			->whereLeaveTypeId($request->input('leave_type_id'))
			->first();

		if(!$user_leave){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.leave_not_defined'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.leave_not_defined'));
		}

		$leave_request_count = (strtotime($to_date) - strtotime($from_date)) / (60*60*24) + 1;
		$leave_type = LeaveType::find($request->input('leave_type_id'));

		$leave_balance = $user_leave->leave_count - $user_leave->leave_used;
		if($leave_balance <  $leave_request_count){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'));
		}

		$leaves = Leave::where('id','!=',$leave->id)
			->where('user_id','=',$leave->user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date)  {
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query) use($from_date,$to_date)  {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves)
			return redirect()->back()->withErrors(trans('messages.leave_requested_for_this_period'));
		
		$data = $request->all();
		$leave->fill($data);
		$leave->save();
		Helper::updateCustomField($this->form,$leave->id, $data);
		$this->logActivity(['module' => 'leave','unique_id' => $leave->id,'activity' => 'activity_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.leave').' '.trans('messages.request').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/leave')->withSuccess(trans('messages.leave').' '.trans('messages.request').' '.trans('messages.updated'));
	}

	public function updateStatus(LeaveStatusRequest $request,$id){

		$leave = Leave::find($id);

		if(!$leave){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('/leave')->withErrors(trans('messages.invalid_link'));
		}

		if(!$this->leaveAccessible($leave) || !Entrust::can('update_leave_status')){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
          	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$contract = \App\Contract::whereUserId($leave->user_id)
			->where('from_date','<=',$leave->from_date)
			->where('to_date','>=',$leave->to_date)
			->first();

		$user_leave = \App\UserLeave::whereContractId($contract->id)
			->whereLeaveTypeId($leave->leave_type_id)
			->first();


    	$f_date = $leave->from_date;
        $t_date = $leave->to_date;
        $request_date = [];
        while ($f_date <= $t_date) {
            $request_date[] = $f_date;
            $f_date = date ("Y-m-d", strtotime("+1 days", strtotime($f_date)));
        }

		$approved_date = $request->has('approved_date') ? explode(',',$request->input('approved_date')) : $request_date;

		if($request->input('status') == 'pending' || $request->input('status') == 'rejected' || $request->input('status') == 'lwp')
			$approved_date = [];

		$leave_type = LeaveType::find($leave->leave_type_id);
		$previously_approved_date = ($leave->approved_date) ? explode(',',$leave->approved_date) : [];

		$adjustable_date = count($approved_date) - count($previously_approved_date);

		$leave_balance = $user_leave->leave_count - $user_leave->leave_used;
		if($adjustable_date > 0 && $leave_balance < $adjustable_date && $request->input('status') == 'approved'){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect()->back()->withErrors(trans('messages.only').' '.$leave_balance.' '.$leave_type->name.' '.trans('messages.remaining'));
		}

		if($request->input('status') == 'approved')
			$user_leave->increment('leave_used',$adjustable_date);
		else
			$user_leave->decrement('leave_used',count($previously_approved_date));

		$leave->status = ($request->input('status')) ? : 'pending';
		$leave->admin_remarks = $request->input('admin_remarks');
		$leave->approved_date = count($approved_date) ? implode(',',$approved_date) : null;
		$leave->save();
		$this->logActivity(['module' => 'leave','unique_id' => $leave->id,'activity' => 'activity_status_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.leave').' '.trans('messages.request').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect()->back()->withSuccess(trans('messages.leave').' '.trans('messages.request').' '.trans('messages.updated'));
	}

	public function destroy(Leave $leave,Request $request){
		if(!Entrust::can('delete_leave') || !$this->leaveAccessible($leave)){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
          	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		if($leave->status != 'pending'){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.leave_cannot_edit'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('leave')->withErrors(trans('messages.leave_cannot_edit'));
		}
		
		Helper::deleteCustomField($this->form, $leave->id);
        $leave->delete();
        $this->logActivity(['module' => 'leave','unique_id' => $leave->id,'activity' => 'activity_deleted']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.leave').' '.trans('messages.request').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/leave')->withSuccess(trans('messages.leave').' '.trans('messages.request').' '.trans('messages.deleted'));
	}

/**
 * Shows a form to select an employee and branch to check the leave balance of the employee.
 * 
 * @param  Request $request 
 * @return string        HTML form with a select box for employee and branch
 */
	public function Leavecheck(Request $request){
		$branch = Branch::all();
        $employee = User::select('users.id','users.first_name as name','profile.employee_code as employee_id','designations.name as designation')
		->LeftJoin('profile', 'users.id', '=', 'profile.user_id')
		->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
		->get();
		// return $employee;
		return view('leave.check', compact('branch', 'employee'));
	}

	/**
	 * Shows the leave balance for a given employee.
	 * 
	 * @param  Request $request 
	 * @return string        HTML table with leave balance
	 */
	public function Leavecheckvalue(Request $request){
		// $contract = Helper::getContract(2);
		$branch = $request->branch;
		$financialYear = $request->financialYear;
		$date = date('Y-m-d');
		// return $request->employee_id;
		$user = \App\User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
		->where('users.id', $request->employee_id) 
		->where('profile.branch_id', $branch)
		->first();
        // return $user;
		$contract = \App\Contract::whereUserId($user->id)
			->where('from_date', '<=', $date)
			->where('to_date', '>=', $date)
			->first();
		$leave_types = \App\LeaveType::all();
		$raw_data = array();
		$data = '';

		if (!$contract)
		return '<div class="alert alert-danger"><i class="fa fa-times icon"></i> ' . trans('messages.no_data_found') . '</div>';

		$data .= '<p style="margin-left:20px">' . trans('messages.contract_period') . ': <strong>' . showDate($contract->from_date) . ' ' . trans('messages.to') . ' ' . showDate($contract->to_date) . '</strong></p>';
		foreach ($leave_types as $leave_type) {
			$name = $leave_type->name;
			$used = ($contract->UserLeave->whereLoose('leave_type_id', $leave_type->id)->count()) ? $contract->UserLeave->whereLoose('leave_type_id', $leave_type->id)->first()->leave_used : 0;
			$allotted = ($contract->UserLeave->whereLoose('leave_type_id', $leave_type->id)->count()) ? $contract->UserLeave->whereLoose('leave_type_id', $leave_type->id)->first()->leave_count : 0;

			if ($allotted) {
				$used_percentage = ($allotted) ? ($used / $allotted) * 100 : 0;
				$data .= '<tr>
                <td>' . $name . '</td>
                <td>' . $allotted . '</td>
                <td>
                    ' . $used . '
                </td>
                <td>' . ($allotted - $used) . '</td>
              </tr>';
			}
		}
		return $data;
	}
 
/**
 * Returns the employee name and designation for a given employee code.
 *
 * @param  Request $request
 * @return \Illuminate\Http\JsonResponse The employee name and designation in JSON format.
 */
	public function getuserData(Request $request){
		$id = $request->id;
		$employee = User::select('users.id', 'users.first_name as name', 'profile.employee_code as employee_id', 'designations.name as designation', 'designations.id as designation_id')
		->LeftJoin('profile', 'users.id', '=', 'profile.user_id')
		->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
		->where('users.id','=',$id)
		->first();
		// return $employee;
		if ($employee) {
			return response()->json([
				'name' => $employee->name,
				'designation' => $employee->designation,
				'designation_id' => $employee->designation_id
			]);
		} else {
			return response()->json(['error' => 'Employee not found'], 404);
		}
	}

/**
 * Displays the leave application form view.
 *
 * @param  Request $request
 * @return \Illuminate\View\View The view for applying leave
 */
	public function Leaveapply(Request $request){
		$branch = Branch::all();
		$employee = User::select('users.id', 'users.first_name as name', 'profile.employee_code as employee_id', 'designations.name as designation')
		->LeftJoin('profile', 'users.id', '=', 'profile.user_id')
		->LeftJoin('designations', 'users.designation_id', '=', 'designations.id')
		->get();
		$leaveType = LeaveType::all();
		return view('leave.apply',compact('branch','employee', 'leaveType'));
	}

	public function LeaveRemaining(Request $request){
		// return $request->leaveType;
		$user = \App\User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
		->where('users.id', $request->user_id)
		// ->where('profile.branch_id', $branch)
		->first();

		$date = date('Y-m-d'); 
		$contract = \App\Contract::whereUserId($user->id)
			->where('from_date', '<=', $date)
			->where('to_date', '>=', $date)
			->first();
        // return $contract;
		if (!$contract) {
			return response()->json(['error' => 'Contract not found Selected Employee, Please Change Employee'], 404);
		}
		$leave_types = \App\LeaveType::where('id', '=', $request->leaveType) 
		->get();
		$leave_data = [];
		foreach ($leave_types as $leave_type) {
			$userLeave = $contract->UserLeave->where('leave_type_id', $leave_type->id)->first();
			$used = $userLeave ? $userLeave->leave_used : 0;
			$allotted = $userLeave ? $userLeave->leave_count : 0;
			$remaining = $allotted - $used;

			if ($allotted > 0) {
				$leave_data[] = [
					// 'leave_type' => $leave_type->name, // Optional: You can include leave type name if needed
					// 'allotted' => $allotted,
					// 'used' => $used,
					'remaining' => $remaining,
				];
			}
		}
		return response()->json($leave_data);
	}

	public function leaveStore(Request $request, Leave $leave){
		// return $request->all();
		$user_id = $request->input('user_id');
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');
        $user = \App\User::find($user_id);
		// return $user;
		$contract = \App\Contract::whereUserId($user->id)
		->where('from_date', '<=', $from_date)
		->where('to_date', '>=', $to_date)
		->first();
    //    return $contract;
	// 	if (!$contract) {
	// 		if ($request->has('ajax_submit')) {
	// 			$response = ['message' => trans('messages.contract_period_not_found'), 'status' => 'error'];
	// 			return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	// 		}
	// 		return redirect()->back()->withErrors(trans('messages.contract_period_not_found'));
	// 	}

		$user_leave = \App\UserLeave::whereContractId($contract->id)
		->whereLeaveTypeId($request->input('leave_type_id'))
		->first();

		// return $user_leave;
		// if (!$user_leave) {
		// 	if ($request->has('ajax_submit')) {
		// 		$response = ['message' => trans('messages.leave_not_defined'), 'status' => 'error'];
		// 		return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
		// 	}
		// 	return redirect()->back()->withErrors(trans('messages.leave_not_defined'));
		// }

		$leave_request_count = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24) + 1;
		$leave_type = LeaveType::find($request->input('leave_type_id'));
		$leave_balance = $user_leave->leave_count - $user_leave->leave_used;
		// return $leave_balance;
		if ($leave_balance <  $leave_request_count) {
			if ($request->has('ajax_submit')) {
				$response = ['message' => trans('messages.only') . ' ' . $leave_balance . ' ' . $leave_type->name . ' ' . trans('messages.remaining'), 'status' => 'error'];
				return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
			}
			return redirect()->back()->withErrors(trans('messages.only') . ' ' . $leave_balance . ' ' . $leave_type->name . ' ' . trans('messages.remaining'));
		}

		$leaves = Leave::where('user_id', '=', $user_id)
		->where(function ($query) use ($from_date, $to_date) {
			$query->where(function ($query) use ($from_date, $to_date) {
				$query->where('from_date', '>=', $from_date)
				->where('from_date', '<=', $to_date);
			})->orWhere(function ($query)  use ($from_date, $to_date) {
				$query->where('to_date', '>=', $from_date)
				->where('to_date', '<=', $to_date);
			});
		})->count();

		// return $leaves;

		if ($leaves) {
			if ($request->has('ajax_submit')) {
				$response = ['message' => trans('messages.leave_requested_for_this_period'), 'status' => 'error'];
				return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
			}
			// return redirect()->back()->withInput()->withErrors(trans('messages.leave_requested_for_this_period'));
			return $response = ['message' => 'Already' . ' ' . trans('messages.requested'), 'status' => 'error'];
		}

		$data = $request->all();
		// return $data;
		$data['user_id'] = $user_id;
		$leave->fill($data);
		$leave->status = 'pending';
		$leave->balance = $request->input('balance');
		$leave->appliedDays = $request->input('appliedDays');
		$leave->branch = $request->input('branch');
		$leave->recommendID = $request->input('recommendID');
		$leave->remarks = $request->input('reason');
		$leave->save();
		$this->logActivity(['module' => 'leave', 'unique_id' => $leave->id, 'activity' => 'activity_added']);
		 return $response = ['message' => trans('messages.leave') . ' ' . trans('messages.requested'), 'status' => 'success'];
		// Helper::storeCustomField($this->form, $leave->id, $data);

		if ($request->has('ajax_submit')) {
			$response = ['message' => trans('messages.leave') . ' ' . trans('messages.requested'), 'status' => 'success'];
			return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
		}
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function LeaveReport(Request $request){
		$branch = Branch::all();
		$leaveType = LeaveType::all();
		$department = Department::all();
        $designation = Designation::all();
		$section = Section::all();
		$status = ['pending','approved','rejectd'];
		return view('leave.report', compact('branch','leaveType','department','designation','section','status'));
	}

	public function LeaveReportPOST(Request $request){
		$user = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
		->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
		->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
		->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
		->when($request->employeeID, function ($query) use ($request) {
			return $query->where('profile.employee_code', '=', $request->employeeID);
		})
		->when($request->branch, function ($query) use ($request) {
			return $query->where('profile.branch_id', '=', $request->branch);
		})
		->when($request->section, function ($query) use ($request) {
			return $query->where('profile.section_id', '=', $request->section);
		})
		->when($request->department, function ($query) use ($request) {
			return $query->where('departments.id', '=', $request->department);
		})
		->when($request->designation, function ($query) use ($request) {
			return $query->where('designations.id', '=', $request->designation);
		})
		->select('users.id', 'profile.employee_code as employee_id' ,'designations.name as designation_name', 'departments.name as department_name', 'users.first_name', 'sections.name as section_name')
		->get();
       
		if (!$user) {
			return response()->json(['error' => 'User not found'], 500);
		}
		$data = Leave::whereIn('user_id', $user->pluck('id'))
			->leftJoin('leave_types', 'leaves.leave_type_id', '=', 'leave_types.id')
			->when($request->status, function ($query) use ($request) {
				return $query->where('leaves.status', '=', $request->status);
			})
			->where('from_date', '>=', $request->fromDate)
			->where('to_date', '<=', $request->toDate)
			->select('leaves.*', 'leave_types.name as leave_type_name')
			->get();

		$mergedLeaveRecords = $data->map(function ($leave) use ($user) {
			$user = $user->where('id', $leave->user_id)->first(); 
			return array_merge($user->toArray(), $leave->toArray());
		});

		$finalData = [
			'data' => $mergedLeaveRecords,
			'fromDate' => $request->fromDate,
			'toDate' => $request->toDate,
			'reportType' => $request->reportType,
		];

		return response()->json($finalData);

	}


}
?>