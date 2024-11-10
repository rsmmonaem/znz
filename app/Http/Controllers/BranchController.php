<?php
namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\DesignationRequest;
use Entrust;
use App\Classes\Helper;
use App\Designation;
use Auth;
use PhpParser\Node\Stmt\Return_;

Class BranchController extends Controller{
    use BasicController;

	protected $form = 'designation-form';

	public function index(Designation $designation){

		if(!Entrust::can('list_designation'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
        $branch = \App\Branch::all();
		// return $branch;

		$col_heads = array(
			trans('messages.option'),
			trans('messages.department_name'),
			trans('messages.description'),
			trans('messages.designation'),
			trans('messages.total_employee')
		);

		return view('branch.index',compact('branch', 'col_heads'));
	}

	public function lists(Request $request){
		if(!Entrust::can('list_designation'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));

		if(Entrust::can('manage_all_designation'))
		  $branch = \App\Branch::all();
		
		else
		  $branch = [];

        $rows = array();

        foreach ($branch as $designation){
			$row = array(
				'<div class="btn-group btn-group-xs">'.
				(Entrust::can('edit_designation') ? '<a href="#" data-href="/branch/'.$designation->id.'/edit" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit" data-toggle="tooltip" title="'.trans('messages.edit').'"></i></a> ' : '').
				(Entrust::can('delete_designation') ? delete_form(['branch.destroy',$designation->id],'designation',1) : '').
				'</div>',
				$designation->name,
				$designation->description
			);
	    	$rows[] = $row;
    	}

        $list['aaData'] = $rows;
        return json_encode($list);
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(Request $request,$id){

        // if(!$this->designationAccessible($designation) || !Entrust::can('edit_designation'))
        //     return view('common.error',['message' => trans('messages.permission_denied')]);

		// $child_designations = Helper::childDesignation($designation->id);
		// array_push($child_designations, Auth::user()->designation_id);

		// // array_diff is used to remove child designations from the lists.

		// if(Entrust::can('manage_all_designation'))
		// 	$top_designations = array_diff(Designation::where('id','!=',$designation->id)->get()->pluck('full_designation','id')->all(), $child_designations);
		// elseif(Entrust::can('manage_subordinate_designation'))
		// 	$top_designations = array_diff(Designation::where('id','!=',$designation->id)->whereIn('id',$child_designations)->get()->pluck('full_designation','id')->all(), $child_designations);
		// else
		$top_designations = [];

		$b = \App\Branch::where('id',$id)->first();
        // return $branchall;
		// $custom_field_values = Helper::getCustomFieldValues($this->form,$designation->id);
      
		return view('branch.edit',compact('id', 'b'));
	}

	public function store(Request $request, Branch $branch){	

		if(!Entrust::can('create_designation')){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$data = $request->all();

		// $data['top_designation_id'] = ($request->input('top_designation_id')) ? : null;
		$branch->fill($data)->save();

		// Helper::storeCustomField($this->form,$designation->id, $data);

		$this->logActivity(['module' => 'designation','unique_id' => $branch->id,'activity' => 'activity_added']);

        // if(\App\Setup::whereModule('designation')->whereCompleted(0)->first())
        // 	\App\Setup::whereModule('designation')->whereCompleted(0)->update(['completed' => 1]);

        if($request->has('ajax_submit')){
        	// $new_data = array('value' => $designation->full_designation,'id' => $designation->id,'field' => 'top_designation_id');
            $response = ['message' => trans('messages.designation').' '.trans('messages.added'), 'status' => 'success','new_data' => $data]; 
	        // if(config('config.application_setup_info') && defaultRole()){
	        // 	$setup_data = Helper::setupInfo();
	        // 	$response['setup_data'] = $setup_data;
	        // }
          
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect()->back()->withSuccess(trans('messages.designation').' '.trans('messages.added'));		
	}

	public function update(Request $request, Branch $branch){

		// if(!Entrust::can('edit_designation') || !$this->designationAccessible($designation)){
	    //     if($request->has('ajax_submit')){
	    //         $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	    //         return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	    //     }
		// 	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		// }

        $data = $request->all();

		// $data['top_designation_id'] = ($request->input('top_designation_id')) ? : null;

		// $child_designations = Helper::childDesignation($designation->id,1);

		// if($data['top_designation_id'] != null && in_array($data['top_designation_id'],$child_designations)){
		//     if($request->has('ajax_submit')){
		//         $response = ['message' => trans('messages.top_designation_cannot_become_child'), 'status' => 'error']; 
		//         return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
		//     }
		// 	return redirect()->back()->withErrors(trans('messages.top_designation_cannot_become_child'));
		// }

		$branch->fill($data)->save();

		$this->logActivity(['module' => 'designation','unique_id' => $branch->id,'activity' => 'activity_updated']);

		// Helper::updateCustomField($this->form,$designation->id, $data);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.designation').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/branch')->withSuccess(trans('messages.designation').' '.trans('messages.updated'));
	}

	public function destroy(Branch $branch,Request $request){
		// if(!Entrust::can('delete_designation') || !$this->designationAccessible($designation) || $designation->is_hidden == 1){
		//     if($request->has('ajax_submit')){
		//         $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
		//         return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
		//     }
		// 	return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		// }

		// $this->logActivity(['module' => 'designation','unique_id' => $designation->id,'activity' => 'activity_deleted']);

		// Helper::deleteCustomField($this->form, $designation->id);

		$branch->delete();
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.designation').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/designation')->withSuccess(trans('messages.designation').' '.trans('messages.deleted'));
	}
}
?>