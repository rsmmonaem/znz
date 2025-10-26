<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryPaidUnpaidController extends Controller
{
    private function getCommonData()
    {
        return [
            'groups' => DB::table('com_group')->get(),
            'branches' => DB::table('branchs')->get(),
            'departments' => DB::table('departments')->get(),
            'designation' => DB::table('designations')->get(),
            'section' => DB::table('sections')->get(),
        ];
    }
    public function index()
    {
        return view('salary-process.Salaey_paid_unpaid', $this->getCommonData());
    }

    public function indexPost(Request $request)
    {
        // return $request->branch;
        $data = DB::table('employee_salary_payment_details')
        ->leftJoin('users', 'users.id', '=', 'employee_salary_payment_details.EmployeeID')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
        ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
        ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
        ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id');
        if ($request->branch) {
            $data->where('profile.branch_id', '=', $request->branch);
        }
        if ($request->department) {
            $data->where('designations.department_id', '=', $request->department);
        } 
        if ($request->section) {
            $data->where('profile.section_id', '=', $request->section);
        }
        if ($request->designation) {
            $data->where('users.designation_id', '=', $request->designation);
        }
        if($request->employeeId){
            $data->where('users.id','=',$request->employeeId);
        }
        if ($request->year) {
            $data->whereRaw('YEAR(employee_salary_payment_details.ToDate) = ?', [$request->year]);
        }
        if ($request->month) {
            $data->whereRaw('MONTH(employee_salary_payment_details.ToDate) = ?', [$request->month]);
        }
        
        // Group payment filters for logical consistency
        $data->where(function ($query) use ($request) {
            if ($request->full_paid) {
                $query->whereRaw('employee_salary_payment_details.TotalPayable = employee_salary_payment_details.PaidAmount');
            }
            if ($request->partial_paid) {
                $query->orWhereRaw('employee_salary_payment_details.TotalPayable > employee_salary_payment_details.PaidAmount')
                ->orWhereRaw('employee_salary_payment_details.PaidAmount > 1');
            }
            if ($request->due) {
                $query->orWhereRaw('employee_salary_payment_details.PaidAmount = 0.00');
            }
        });

        $data = $data
        ->select('employee_salary_payment_details.*', 'designations.name', 'departments.name as department_name', 'users.first_name as employee_name', 'sections.name as section_name', 'branchs.name as branch_name','profile.employee_code')
        ->orderBy('employee_salary_payment_details.ToDate', 'desc')
        ->groupBy('employee_salary_payment_details.EmployeeID') 
        ->get();
        return $data;
    }

    public function SalaryPaidUnpaidUpdate(Request $request){
       $ids = $request->checkedrowsids;
       try{
            $data = DB::table('employee_salary_payment_details')->whereIn('id', $ids)->get();
            foreach ($data as $d) {
                
                if (!empty($d->PaidAmount) && $d->PaidAmount > 0) {
                    DB::table('employee_salary_payment_details')
                        ->where('id', $d->id)
                        ->update([
                            'PaidAmount'   => DB::raw("PaidAmount + $d->UnpaidAmount"),
                            'UnpaidAmount' => 0,
                        ]);
                } else {
                    
                    DB::table('employee_salary_payment_details')
                        ->where('id', $d->id)
                        ->update([
                            'PaidAmount'   => $d->UnpaidAmount,
                            'UnpaidAmount' => 0,
                        ]);
                }
            }
            return response()->json(['message' => 'Paid Amount Updated Successfully.']);
       }catch(\Exception $e){
           return $e->getMessage();
       }
    }

   public function SalaryPaidUnpaidPertialPaid(Request $request)
    {
        $idWithAmount = $request->input('idWithAmount'); // Retrieve the input array

        try {
            // Extract only the IDs from the input
            $ids = array_map(function ($item) {
                return $item['id'];
            }, $idWithAmount);

            // Fetch matching data from the database
            $data = DB::table('employee_salary_payment_details')->whereIn('id', $ids)->get();

            foreach ($data as $d) {
                // Find the corresponding amount for the current ID using array_filter
                $filtered = array_filter($idWithAmount, function ($item) use ($d) {
                    return $item['id'] == $d->id;
                });

                // Get the first match from the filtered array
                $amount = reset($filtered)['amount'];

                // Update PaidAmount and reduce UnpaidAmount
                DB::table('employee_salary_payment_details')
                    ->where('id', $d->id)
                    ->update([
                        'PaidAmount'   => $amount,
                        'UnpaidAmount' => DB::raw("UnpaidAmount - $amount")
                    ]);
            }

            return response()->json(['message' => 'Paid and Unpaid Amounts Updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}