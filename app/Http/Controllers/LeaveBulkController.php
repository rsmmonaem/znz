<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LeaveType;
use Illuminate\Support\Facades\DB;

class LeaveBulkController extends Controller {
    public function index() {
        $levaeType = LeaveType::all();
        return view('LeaveBulk.index',compact('LeaveBulk', 'levaeType'));
    }
    public function store(Request $request)
    {
        // Check if the financial year already exists in the database
        $exists = DB::table('leave_manage')->where('financial_year', $request->financial_year)->exists();

        if ($exists) {
            // If the financial year already exists, return an error message
            return response()->json(['error' => 'Leave Bulk already exists.'], 400);
        } else {
            // If the financial year doesn't exist, insert new leave data
            foreach ($request->leave as $leaveTypeId => $leaveCount) {
                $leaveData = [
                    'leave_type_id' => $leaveTypeId,
                    'leave_count' => $leaveCount,
                    'leave_used' => 0,  // Default value for unused leave
                    'financial_year' => $request->financial_year,
                ];
                // Insert the leave data into the leave_manage table
                DB::table('leave_manage')->insert($leaveData);
            }
            // Return success message after inserting the data
            return response()->json(['success' => 'Leave Bulk added successfully.'], 200);
        }
    }

    public function show() {
        $leaveData = DB::table('leave_manage')
            ->select('financial_year', DB::raw('GROUP_CONCAT(leave_type_id) as leave_types'), DB::raw('GROUP_CONCAT(leave_count) as leave_counts'))
            ->groupBy('financial_year')
            ->orderBy('financial_year', 'desc')
            ->get();
        return response()->json(['data' => $leaveData]);
    }

    public function destroy(Request $request) {
        $financialYear = $request->input('financial_year');
        DB::table('leave_manage')->where('financial_year', $financialYear)->delete();
        return response()->json(['success' => 'Leave Bulk deleted successfully.']);
    }

    public function edit(Request $request, $id) {
        $financialYear = $id;
        $date = DB::table('leave_manage')
        ->where('financial_year', $financialYear)
        ->select(
            'financial_year',
            DB::raw('GROUP_CONCAT(leave_type_id) as leave_types'),
            DB::raw('GROUP_CONCAT(leave_count) as leave_counts')
        )
        ->groupBy('financial_year')
        ->orderBy('financial_year', 'desc')
        ->first(); 

        if (!$date) {
            return redirect()->back()->with('error', 'No leave data found for this financial year.');
        }
        // Decode the comma-separated values into arrays
        $leaveTypesArray = explode(',', $date->leave_types);
        $leaveCountsArray = explode(',', $date->leave_counts);

        // Fetch all available leave types
        $levaeType = LeaveType::all(); 
        return view('LeaveBulk.edit', compact('date', 'financialYear','levaeType', 'leaveTypesArray', 'leaveCountsArray'));
    }

    public function update(Request $request) {
        //    return $request->all();
       try {
            foreach ($request->leave as $leaveTypeId => $leaveCount) {
                $leaveData = [
                    'leave_count' => $leaveCount,
                    'leave_used' => 0,  // Default value for unused leave
                    'financial_year' => $request->financial_year,
                ];

                // Update the existing leave data in the leave_manage table
                DB::table('leave_manage')
                ->where('leave_type_id', $leaveTypeId)
                ->where('financial_year', $request->financial_year)
                ->update($leaveData);
            }
            // Return success message after inserting the data
            return response()->json(['success' => 'Leave Bulk updated successfully.'], 200);
       } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update leave bulk.']);
       }
    }
}