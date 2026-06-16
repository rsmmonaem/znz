<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\Helpers;

class IdCardChecklistController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve branches for filter dropdown
        $branches = DB::table('branchs')->select('id', 'name')->get();

        // If no branch selected, show empty list initially
        if (!$request->has('branch_id')) {
            $id_card_checklist = collect();
        } else {
            // Base query with joins
            $query = DB::table('id_card')
                ->leftJoin('users', 'id_card.user_id', '=', 'users.id')
                ->leftJoin('profile', 'id_card.user_id', '=', 'profile.user_id')
                ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
                ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
                ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
                ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
                ->select('id_card.*', 'profile.employee_code','sections.name as section_name','branchs.name as branch_name','users.first_name', 'designations.name as designation_name', 'departments.name as department_name');

            // Apply branch filter
            $query->where('profile.branch_id', $request->input('branch_id'));

            // Apply optional employee filter
            if ($request->filled('employee_id')) {
                $query->where('users.id', $request->input('employee_id'));
            }

            $id_card_checklist = $query->orderBy('id_card.id', 'desc')->paginate(20);
        }
    }

    public function getBranchEmployees($branchId)
    {
        $employees = Helpers::GetBranchEmployeesIndependent($branchId);
        return response()->json($employees);
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