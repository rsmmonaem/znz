<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdCardChecklistController extends Controller
{
    public function index()
    {
        $id_card_checklist = DB::table('id_card')
        ->leftJoin('users', 'id_card.user_id', '=', 'users.id')
        ->leftJoin('profile', 'id_card.user_id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->select('id_card.*', 'profile.employee_code','sections.name as section_name','branchs.name as branch_name','users.first_name', 'designations.name', 'departments.name as department_name')
       ->orderby('id_card.id', 'desc')
        ->paginate(20);
        // return $id_card_checklist;
        return view('IDCardCheck.id_card_checklist', compact('id_card_checklist'));
    }
    public function ChnageStatus(Request $request)
    {
        // return $request->all();
        $data = $request->input('data');
        foreach ($data as $d) {
            DB::table('id_card')
            ->where('id', $d['id']) 
            ->update(['status' => $d['status'],
            'remarks' => 'ID Card Provided',
            'updated_at' => date('Y-m-d H:i:s')]);
        }
        return response()->json(['status' => 'success', 'message' => 'Status change successfully.']);
    }
}