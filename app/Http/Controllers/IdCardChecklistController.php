<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdCardChecklistController extends Controller
{
    public function index()
    {
        $branches = DB::table('branchs')->select('id', 'name')->get();
        $id_card_checklist = DB::table('id_card')
            ->leftJoin('users', 'id_card.user_id', '=', 'users.id')
            ->leftJoin('profile', 'id_card.user_id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->select('id_card.*', 'profile.employee_code','sections.name as section_name','branchs.name as branch_name','users.first_name', 'designations.name', 'departments.name as department_name')
            ->orderBy('id_card.id', 'desc')
            ->paginate(20);
        // return $id_card_checklist;
        return view('IDCardCheck.id_card_checklist', compact('id_card_checklist', 'branches'));
    }

    public function getBranchEmployees(Request $request)
    {
        $branchId = $request->input('branch_id');
        $employees = DB::table('profile')
            ->join('users', 'profile.user_id', '=', 'users.id')
            ->where('profile.branch_id', $branchId)
            ->select('users.first_name', 'users.last_name')
            ->get()
            ->map(function($item) {
                return ['name' => $item->first_name . ' ' . $item->last_name];
            });
        return response()->json($employees);
    }

    public function ChnageStatus(Request $request)
    {
        // return $request->all();
        $data = $request->input('data');
        foreach ($data as $d) {
            $status = $d['status'];
            $remarks = $status == 1 ? 'ID Card Provided' : 'ID Card Not Provided';
            DB::table('id_card')
                ->where('id', $d['id'])
                ->update([
                    'status' => $status,
                    'remarks' => $remarks,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
        return response()->json(['status' => 'success', 'message' => 'Status change successfully.']);
    }
}