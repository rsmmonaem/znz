<?php
namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use Entrust;
use App\Classes\Helper;
use App\Designation;
use App\Grade;
use App\Section;
use Auth;
use PhpParser\Node\Stmt\Return_;

Class GradeController extends Controller{
    use BasicController;

	protected $form = 'designation-form';

	public function index(Designation $designation){

		if(!Entrust::can('list_designation'))
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
        $branch = Grade::all();
		// return $branch;

		$col_heads = array(
			trans('messages.option'),
			trans('messages.department_name'),
			trans('messages.description'),
			trans('messages.designation'),
			trans('messages.total_employee')
		);

		return view('Grade.index',compact('branch', 'col_heads'));
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
				(Entrust::can('delete_designation') ? delete_form(['sections.destroy',$designation->id],'designation',1) : '').
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
		$top_designations = [];

		$b = Grade::where('id',$id)->first();

		return view('Grade.edit',compact('id', 'b'));
	}

	public function store(Request $request, Grade $section){	

		if(!Entrust::can('create_designation')){
	        if($request->has('ajax_submit')){
	            $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
	            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
	        }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$data = $request->all();

		$section->fill($data)->save();

		$this->logActivity(['module' => 'designation','unique_id' => $section->id,'activity' => 'activity_added']);
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.section').' '.trans('messages.added'), 'status' => 'success','new_data' => $data]; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect()->back()->withSuccess(trans('messages.designation').' '.trans('messages.added'));		
	}

	public function update(Request $request,$id){

        $data = $request->all();
        // return $data;
		$section = Grade::find($id);
		$section->fill($data)->save();

		$this->logActivity(['module' => 'designation','unique_id' => $section->id,'activity' => 'activity_updated']);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.section').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/sectios')->withSuccess(trans('messages.section').' '.trans('messages.updated'));
	}

	public function destroy(Request $request,$id){
        // return $id;
		Grade::find($id)->delete();
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.section').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
        return redirect('/sectios')->withSuccess(trans('messages.section').' '.trans('messages.deleted'));
	}
}
?>