<?php
namespace App\Http\Controllers;

use App\BankAccount;
use App\Branch;
use App\Contact;
use App\Contract;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;
use App\Http\Requests\SalaryRequest;
use App\SalaryType;
use App\Salary;
use App\Section;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;

Class SalaryController extends Controller{
    use BasicController;

    public function lists(Request $request){
        $data = '';

        $employee = \App\User::find($request->input('employee_id'));

        if(!$employee)
            return $data;

        $contracts = \App\Contract::whereUserId($employee->id)->pluck('id')->all();
        $contract_salaries = \App\Salary::whereIn('contract_id',$contracts)->groupBy('contract_id')->get();
        $salaries = \App\Salary::whereIn('contract_id',$contracts)->get();
        $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
        $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();

		foreach($contract_salaries as $contract_salary){
			$data .= '<tr>
				<td>'.$contract_salary->Contract->full_contract_detail.'</td>';
				foreach($earning_salary_types as $earning_salary_type){
				$data .= '<td>'.
					(($salaries->whereLoose('contract_id',$contract_salary->contract_id)->whereLoose('salary_type_id',$earning_salary_type->id)->first()) ? currency($salaries->whereLoose('contract_id',$contract_salary->contract_id)->whereLoose('salary_type_id',$earning_salary_type->id)->first()->amount) : 0).'</td>';
				}
				foreach($deduction_salary_types as $deduction_salary_type){
				$data .= '<td>'.
					(($salaries->whereLoose('contract_id',$contract_salary->contract_id)->whereLoose('salary_type_id',$deduction_salary_type->id)->first()) ? currency($salaries->whereLoose('contract_id',$contract_salary->contract_id)->whereLoose('salary_type_id',$deduction_salary_type->id)->first()->amount) : 0).'</td>';
				}
				$data .= '<td>
						<div class="btn-group btn-group-xs">
							<a href="#" data-href="/salary/'.$contract_salary->contract_id.'/edit" class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit" data-toggle="tooltip" title="'.trans('messages.edit').'"></i></a>'.
							delete_form(['salary.destroy',$contract_salary->contract_id]).
						'</div>
					</td>
				</tr>';
		}

		return $data;

    }

	public function store(Request $request,$id){
        return $request->all();
        $employee = \App\User::find($id);

        if(!$employee){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/employee')->withErrors(trans('messages.invalid_link'));
        }

		if(!$this->employeeAccessible($employee)){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

        $validation = Validator::make($request->all(),[
            'salary_contract_id' => 'required|unique:salary,contract_id'
        ]);

        if($validation->fails()){
            if($request->has('ajax_submit')){
                $response = ['message' => $validation->messages()->first(), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect()->back()->withInput()->withErrors($validation->messages()->first());
        }

		$salary_types = SalaryType::all();

		foreach($salary_types as $salary_type){
			$salary = new Salary;
			$salary->contract_id = $request->input('salary_contract_id');
			$salary->salary_type_id = $salary_type->id;
			$salary->amount = ($request->input($salary_type->id)) ? : 0;
			$salary->save();
		}
        $this->logActivity(['module' => 'salary','activity' => 'activity_added','secondary_id' => $employee->id]);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.employee').' '.trans('messages.salary').' '.trans('messages.added'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/employee/'.$id.'/#salary')->withSuccess(trans('messages.employee').' '.trans('messages.salary').' '.trans('messages.added'));
	}

	public function edit($id){
		$contract = \App\Contract::find($id);

        if(!$contract)
            return view('common.error',['message' => trans('messages.invalid_link')]);

		$employee = $contract->User;

		if(!$this->employeeAccessible($employee))
            return view('common.error',['message' => trans('messages.permission_denied')]);

		$salaries = Salary::whereContractId($id)->get()->pluck('amount','salary_type_id')->all();

        $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
        $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();
		return view('employee.edit_salary',compact('salaries','contract','earning_salary_types','deduction_salary_types'));
	}

	public function update(Request $request, $id){
		$contract = \App\Contract::find($id);

        if(!$contract){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/employee')->withErrors(trans('messages.invalid_link'));
        }

		$employee = $contract->User;

		if(!$this->employeeAccessible($employee)){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		$salary_types = SalaryType::all();

		foreach($salary_types as $salary_type){
			$salary = Salary::firstOrNew(array('contract_id' => $id, 'salary_type_id' => $salary_type->id));
			$salary->contract_id = $id;
			$salary->amount = ($request->input($salary_type->id)) ? : 0;
			$salary->save();
		}

        $this->logActivity(['module' => 'salary','activity' => 'activity_updated','secondary_id' => $employee->id]);

        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.employee').' '.trans('messages.salary').' '.trans('messages.updated'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/employee/'.$employee->id.'/#salary')->withSuccess(trans('messages.employee').' '.trans('messages.salary').' '.trans('messages.updated'));
	}

	public function destroy($id,Request $request){
		$contract = \App\Contract::find($id);

        if(!$contract){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.invalid_link'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            return redirect('/employee')->withErrors(trans('messages.invalid_link'));
        }

		$employee = $contract->User;

		if(!$this->employeeAccessible($employee)){
            if($request->has('ajax_submit')){
                $response = ['message' => trans('messages.permission_denied'), 'status' => 'error']; 
                return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
            }
			return redirect('/dashboard')->withErrors(trans('messages.permission_denied'));
		}

		\App\Salary::whereContractId($id)->delete();
        $this->logActivity(['module' => 'salary','activity' => 'activity_deleted','secondary_id' => $employee->id]);
        
        if($request->has('ajax_submit')){
            $response = ['message' => trans('messages.employee').' '.trans('messages.employee').' '.trans('messages.deleted'), 'status' => 'success']; 
            return response()->json($response, 200, array('Access-Controll-Allow-Origin' => '*'));
        }
		return redirect('/employee/'.$employee->id.'/#salary')->withSuccess(trans('messages.employee').' '.trans('messages.salary').' '.trans('messages.deleted'));
	}
    
    public function salary(){
       $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
       ->select('users.id', 'profile.employee_code','users.first_name')
       ->get();
       $group = DB::table('com_group')->get();
       $branch = Branch::all();

       return view('salary.salary-slab',compact('employee','group','branch'));
    }

    public function SalarySlabList(Request $request)
    {
        
        $users = \App\User::with('profile')->where(['users.id' => $request->query('id')])->get();

        
        $earning_salary_types = \App\SalaryType::where('salary_type', '=', 'earning')->get();

        $data = []; 

        foreach ($users as $user) {
            
            $latest_contract = \App\Contract::whereUserId($user->id)
                ->latest('id') 
                ->first();

            
            if ($latest_contract) {
                
                $contract_salaries = \App\Salary::where('contract_id', $latest_contract->id)
                ->latest('id') 
                ->get();

                
                $slab_data = DB::table('salary_slab')
                    ->where('user_id', $user->id)
                    ->latest('id') 
                    ->first();

                $contractData = [
                        'user_info' => [
                            'first_name' => $user->first_name,
                            'employee_code' => $user->profile->employee_code,
                            'entry_date' => isset($slab_data->entrydate) ? date('Y-m-d', strtotime($slab_data->entrydate)) : null,
                            'effective_date' => isset($slab_data->effactive_date) ? date('Y-m-d', strtotime($slab_data->effactive_date)) : null,
                            'gross' => isset($slab_data->gross) ? $slab_data->gross : null,
                            'slab_id' => isset($slab_data->id) ? $slab_data->id : null
                        ],
                        'contract_details' => [
                            'from_date' => $latest_contract->from_date,
                        ],
                        'salaries' => [],
                    ];

                foreach ($earning_salary_types as $earning_salary_type) {
                    
                    $salary = $contract_salaries->filter(function ($salary) use ($earning_salary_type) {
                        return $salary->salary_type_id == $earning_salary_type->id;
                    })->first();

                    $amount = $salary ? floor($salary->amount) : 0;

                    $contractData['salaries'][] = [
                        'salary_type' => $earning_salary_type->head,
                        'amount' => $amount,
                    ];
                }

                $data[] = $contractData; 
            }
        }

        return response()->json($data);
    }

    public function CreateSlab(Request $request){
        DB::beginTransaction();
        try{
            $employee_id  = $request->employeeId;
            // return $employee_id;
            $contact = Contract::where('user_id', $employee_id)->latest()->first();

            if (!$contact) {
                $contact = Contract::create([
                    'user_id' => $employee_id,
                    'contract_type_id' => 1,
                    'from_date' => date('Y-m-d'),
                    'to_date' => date('Y-m-d', strtotime('+10 year')),
                ]);
            }
            $gross = $request->gross;

            $basic = $request->basic;
            $house_rent = $request->house_rent;
            $medical = $request->medical;
            $conveyance = $request->conveyance;
            $others = $request->others;

            $totalBasic = $gross * $basic / 100;
            $totalHouseRent = $gross * $house_rent / 100;
            $totalMedical = $gross * $conveyance / 100;
            $totalConveyance = $gross * $medical / 100;
            $totalOthers = $gross * $others / 100;

            $salary_type_ids = ['1', '2', '12', '8', '13'];
            $salaryAmount = [
                'basic' => $totalBasic,
                'house_rent' => $totalHouseRent,
                'medical' => $totalMedical,
                'conveyance' => $totalConveyance,
                'others' => $totalOthers
            ];

            // return $salaryAmount;
            // Map salary types to their respective amounts
            $salary_mapping = array_combine($salary_type_ids, array_values($salaryAmount));

            // Iterate over the mapping to save data type-wise
            foreach ($salary_type_ids as $index => $type_id) {
                $amount = isset($salary_mapping[$type_id]) ? $salary_mapping[$type_id] : 0;
                $salary = new Salary();
                $salary->contract_id = $contact->id;
                $salary->salary_type_id = $type_id;
                $salary->amount = $amount ?: 0;
                $salary->user_id = $employee_id;
                $salary->save();
            }
            DB::table('salary_slab')->insert([
                'gross' => $gross,
                'user_id' => $request->employeeId,
                'entrydate' => $request->entryDate,
                'effactive_date' => $request->effectiveDate,
                'status' => $request->management ? $request->management : 0
            ]);
            $this->logActivity(['module' => 'salary', 'activity' => 'activity_added', 'secondary_id' => $employee_id]);
            DB::commit();
            return response()->json(['success', 'data' => $employee_id]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'status' => 'error', 'data' => $employee_id], 200, array('Access-Controll-Allow-Origin' => '*'));
        }
    }

    public function salaryslabdestroy($id)
    {
        try {
            $slab = DB::table('salary_slab')->where('id', $id)->first();
            if (!$slab) {
                return response()->json(['message' => 'Salary slab not found.'], 404);
            }
    
            DB::table('salary_slab')->where('id', $id)->delete();
            return response()->json(['message' => 'Salary slab deleted successfully.'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while deleting.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function salarySlabEdit($id)
    {
        $slab = DB::table('salary_slab')->where('id', $id)->first();
        
        if (!$slab) {
            return redirect('/salary-slab')->withErrors('Salary slab not found.');
        }

        $user = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('branchs', 'profile.branch_id', '=', 'branchs.id')
            ->select(
                'users.id',
                'users.first_name',
                'profile.employee_code',
                'profile.date_of_joining',
                'profile.branch_id',
                'designations.name as designation',
                'profile.category',
                'branchs.name as branch_name'
            )
            ->where('users.id', $slab->user_id)
            ->first();

        if (!$user) {
            return redirect('/salary-slab')->withErrors('Employee not found.');
        }

        // Get latest contract salaries for the employee
        $latest_contract = Contract::where('user_id', $user->id)->latest('id')->first();
        $salaries = [];
        
        if ($latest_contract) {
            $contract_salaries = Salary::where('contract_id', $latest_contract->id)->get();
            $earning_salary_types = SalaryType::where('salary_type', '=', 'earning')->get();
            
            foreach ($earning_salary_types as $type) {
                $salary = $contract_salaries->where('salary_type_id', $type->id)->first();
                $salaries[$type->head] = $salary ? floor($salary->amount) : 0;
            }
        }

        $group = DB::table('com_group')->get();
        $branch = Branch::all();

        return view('salary.edit-salary-slab', compact('slab', 'user', 'salaries', 'group', 'branch'));
    }

    public function salarySlabUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $slab_id = $request->slab_id;
            $slab = DB::table('salary_slab')->where('id', $slab_id)->first();

            if (!$slab) {
                return response()->json(['message' => 'Salary slab not found.', 'status' => 'error'], 404);
            }

            // Get employee_id from employee_code if provided, otherwise use existing
            $employee_id = $slab->user_id;
            if ($request->employeeId) {
                $employee_id = $request->employeeId;
            } elseif ($request->employeeCode) {
                $profile = DB::table('profile')->where('employee_code', $request->employeeCode)->first();
                if ($profile) {
                    $employee_id = $profile->user_id;
                }
            }

            $gross = $request->gross;

            // Get percentage values (same as create)
            $basic = 50;
            $house_rent = 28;
            $medical = 9;
            $conveyance = 8;
            $others = 5;

            // Calculate amounts (matching CreateSlab method - note: medical and conveyance are swapped in calculation)
            $totalBasic = $gross * $basic / 100;
            $totalHouseRent = $gross * $house_rent / 100;
            $totalMedical = $gross * $conveyance / 100;
            $totalConveyance = $gross * $medical / 100;
            $totalOthers = $gross * $others / 100;

            // Get latest contract
            $contact = Contract::where('user_id', $employee_id)->latest()->first();

            if (!$contact) {
                return response()->json(['message' => 'Contract not found for this employee.', 'status' => 'error'], 404);
            }

            // Update salary amounts
            $salary_type_ids = ['1', '2', '12', '8', '13'];
            $salaryAmount = [
                'basic' => $totalBasic,
                'house_rent' => $totalHouseRent,
                'medical' => $totalMedical,
                'conveyance' => $totalConveyance,
                'others' => $totalOthers
            ];

            $salary_mapping = array_combine($salary_type_ids, array_values($salaryAmount));

            // Update salary records
            foreach ($salary_type_ids as $type_id) {
                $amount = isset($salary_mapping[$type_id]) ? $salary_mapping[$type_id] : 0;
                $salary = Salary::where('contract_id', $contact->id)
                    ->where('salary_type_id', $type_id)
                    ->first();
                
                if ($salary) {
                    $salary->amount = $amount ?: 0;
                    $salary->save();
                } else {
                    $salary = new Salary();
                    $salary->contract_id = $contact->id;
                    $salary->salary_type_id = $type_id;
                    $salary->amount = $amount ?: 0;
                    $salary->user_id = $employee_id;
                    $salary->save();
                }
            }

            // Update salary slab
            $updateData = [
                'gross' => $gross,
                'effactive_date' => $request->effectiveDate,
            ];
            
            // Update user_id if employee changed
            if ($employee_id != $slab->user_id) {
                $updateData['user_id'] = $employee_id;
            }
            
            DB::table('salary_slab')->where('id', $slab_id)->update($updateData);

            $this->logActivity(['module' => 'salary', 'activity' => 'activity_updated', 'secondary_id' => $employee_id]);
            DB::commit();
            
            return response()->json(['message' => 'Salary slab updated successfully.', 'status' => 'success', 'data' => $employee_id]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'status' => 'error'], 500);
        }
    } 

    // public function getSalaryData(){
    //     Salary::LeftJoin('contacts', 'salary.contract_id' ,'=', 'contacts.id')
    //     ->LeftJoin('users', 'contacts.user_id' ,'=', 'users.id')
    //     ->LeftJoin('profile', 'users.id' ,'=', 'profile.user_id')
    //     ->LeftJoin('salary_type', 'salary.salary_type_id' ,'=', 'salary_type.id')
    //     ->select('users.first_name', 'profile.employee_code', 'salary.salary_type_id', 'salary.amount')
    //     ->get();
    // }

    public function Salary_BankPart() {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $section = Section::all();
        $companyBanks = DB::table('company_banks')->where('status', 1)->get();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'users.id', 
            'profile.employee_code', 
            'users.first_name'
        )
        ->get();
        return view('salary.salary', compact('group', 'branch', 'department', 'section', 'employee', 'companyBanks'));
    }

    public function Salary_BankPartPost(Request $request) {
        $gross = $request->gross;
        $distributions = $request->distributions; // Array of {bank_id, amount}
        $effectiveDate = $request->effectiveDate;
        $employeeId = $request->employeeId;
        $entryDate = $request->entryDate;
        $remarks = $request->remarks;

        if (!$gross) {
            return response()->json(['message' => 'Gross Amount does not exist for this employee.', 'status' => 'error']);
        }

        if (empty($distributions)) {
            return response()->json(['message' => 'Please provide at least one bank distribution.', 'status' => 'error']);
        }

        $totalBankAmount = 0;
        foreach ($distributions as $dist) {
            $totalBankAmount += (float)$dist['amount'];
        }

        if ($totalBankAmount > $gross) {
            return response()->json(['message' => 'Total bank amount exceeds gross salary.', 'status' => 'error']);
        }

        $cashAmount = $gross - $totalBankAmount;

        DB::beginTransaction();
        try {
            // Option: Clear existing distributions for the same effective date if needed? 
            // Or just append. Usually in this ERP, it's append or replace based on effective_date.
            // Let's replace for the same effective date to avoid duplicates.
            DB::table('salary_bank')->where('user_id', $employeeId)->where('effective_date', $effectiveDate)->delete();

            foreach ($distributions as $dist) {
                DB::table('salary_bank')->insert([
                    'user_id' => $employeeId,
                    'effective_date' => $effectiveDate,
                    'company_bank_id' => $dist['bank_id'],
                    'bank_amount' => $dist['amount'],
                    'cash_amount' => $cashAmount,
                    'status' => false,
                    'remarks' => $remarks,
                    'entry_date' => $entryDate,
                    'gross' => $gross,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            DB::commit();
            $this->logActivity(['module' => 'salary', 'activity' => 'activity_added', 'secondary_id' => $employeeId]);
            return response()->json(['status' => 'success', 'message' => 'Data saved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function GetBankPart(Request $request)
    {
        $query = DB::table('salary_bank')
            ->join('users', 'salary_bank.user_id', '=', 'users.id')
            ->join('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('company_banks', 'salary_bank.company_bank_id', '=', 'company_banks.id')
            ->select(
                'salary_bank.*',
                'users.first_name',
                'profile.employee_code',
                'company_banks.bank_name as company_bank_name'
            );

        // If an employeeId is provided, filter
        if($request->has('employeeId') && $request->employeeId != '') {
            $query->where('salary_bank.user_id', $request->employeeId);
        }

        $data = $query->get();

        return response()->json($data);
    }


    public function bankedit($id) {
        $bankPart = DB::table('salary_bank')->where('id', $id)->first();
        return view('salary.edit-bank-part', compact('bankPart'));
    }



    public function UpdateBankPart(Request $request)
{
    DB::table('salary_bank')->where('id', $request->id)->update([
        'bank_amount'     => $request->bank_amount,
        'cash_amount'     => $request->cash_amount,
        'remarks'         => $request->remarks,
        'effective_date'  => $request->effective_date
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Updated successfully'
    ]);
}


    public function DeleteBankPart($id) {
        DB::table('salary_bank')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted Successfully']);
    }

    
    
    
    public function updateStatus(Request $request) {
        $oldData = DB::table('salary_bank')->where('id', $request->id)->first();
        $data = [
            'status' => $request->status,
        ];
        // Check the condition for status 0
        if ($request->status == 0) {
            $data['cash_amount'] = $oldData->cash_amount - $oldData->old_bank;
            $data['bank_amount'] = $oldData->old_bank;
        }else if($request->status == 1){
            $data['cash_amount'] = $oldData->cash_amount + $oldData->bank_amount;
            $data['old_bank'] = $oldData->bank_amount;
            $data['bank_amount'] = 0;
        }
        // Update the salary_bank table with the prepared data array
        DB::table('salary_bank')->where('id', $request->id)->update($data);

        return response()->json(['message' => 'Status Update Successfully']);
    }
     public function salaryReport() {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $designation = Designation::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'users.id', 
            'profile.employee_code', 
            'users.first_name'
        )
        ->get();
        $category = DB::table('category')->get();
        return view('salary.salaryReport',compact('group','branch','department','section','employee','designation', 'category'));
    }

    // Get User Infor with Gross Salary
    public function getGrossSalary(Request $request) {
        $employee = User::leftjoin('profile', 'users.id', '=', 'profile.user_id')
        ->leftjoin('salary_slab', 'users.id', '=', 'salary_slab.user_id')
        ->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
        ->select(
            'users.id',
            'profile.employee_code',
            'users.first_name',
            'salary_slab.gross',
            'salary_slab.entrydate',
            'salary_slab.effactive_date',
            'profile.category',
            'designations.name as designation'
        )
        ->where('users.id', $request->employeeId)
        ->orderby('salary_slab.id','desc')
        ->first();
        // return $employee;
        return response()->json($employee);
    }


    public function SalaryReportPOST(Request $request)
    {
        $userIds = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->leftJoin('sections', 'profile.section_id', '=', 'sections.id')
            ->leftJoin('grades', 'profile.grade_id', '=', 'grades.id')
            ->where('users.status', 'active')
            ->when($request->employeeId, function($q) use ($request) {
                return $q->where('users.id', $request->employeeId);
            })
            ->when($request->branch, function($q) use ($request) {
                return $q->where('profile.branch_id', $request->branch);
            })
            ->when($request->section, function($q) use ($request) {
                return $q->where('profile.section_id', $request->section);
            })
            ->when($request->department, function($q) use ($request) {
                return $q->where('departments.id', $request->department);
            })
            ->when($request->designation, function($q) use ($request) {
                return $q->where('designations.id', $request->designation);
            })
            ->when($request->category, function($q) use ($request) {
                return $q->where('profile.category', $request->category);
            })
            ->select(
                'users.id',
                'profile.employee_code',
                'users.first_name',
                'profile.category',
                'profile.date_of_joining',
                'sections.name as section',
                'grades.name as grade',
                'departments.name as departments',
                'designations.name as designation'
            )
            ->orderByRaw('CAST(profile.employee_code AS UNSIGNED)')
            ->get();
    
        $earning_salary_types = \App\SalaryType::where('salary_type', 'earning')->get();
        $data = [];
    
        foreach ($userIds as $user) {
            // default values
            $gross = 0;
            $bank_amount = 0;
            $cash_amount = 0;
            $remarks = null;
            $account_number = null;
            $entry_date = null;
            $effective_date = null;
            $salary_group = [];
    
            // last contract
            $latest_contract = \App\Contract::where('user_id', $user->id)
                ->orderBy('id', 'DESC')
                ->first();
    
            if ($latest_contract) {
                $contract_salaries = \App\Salary::where('contract_id', $latest_contract->id)->get();
    
                $slab = DB::table('salary_slab')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'DESC')
                    ->first();
    
                if ($slab) {
                    $gross = isset($slab->gross) ? $slab->gross : 0;
                    $entry_date = isset($slab->entrydate) ? date('Y-m-d', strtotime($slab->entrydate)) : null;
                    $effective_date = isset($slab->effactive_date) ? date('Y-m-d', strtotime($slab->effactive_date)) : null;
                }
    
                $salary_bank = DB::table('salary_bank')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'DESC')
                    ->first();
    
                if ($salary_bank) {
                    $bank_amount = isset($salary_bank->bank_amount) ? $salary_bank->bank_amount : 0;
                    $cash_amount = isset($salary_bank->cash_amount) ? $salary_bank->cash_amount : 0;
                    $remarks = isset($salary_bank->remarks) ? $salary_bank->remarks : null;
                }
    
                $acc = DB::table('bank_accounts')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'DESC')
                    ->first();
    
                if ($acc) {
                    $account_number = isset($acc->account_number) ? $acc->account_number : null;
                }
    
                foreach ($earning_salary_types as $type) {
                    $row = $contract_salaries->first(function($s) use ($type) {
                        return isset($s->salary_type_id) && $s->salary_type_id == $type->id;
                    });
    
                    $amount = ($row && isset($row->amount)) ? floatval($row->amount) : 0;
    
                    $salary_group[] = [
                        'salary_type' => isset($type->head) ? $type->head : 'Unknown',
                        'amount' => floor($amount)
                    ];
                }
            } else {
                // no contract → all 0
                foreach ($earning_salary_types as $type) {
                    $salary_group[] = [
                        'salary_type' => isset($type->head) ? $type->head : 'Unknown',
                        'amount' => 0
                    ];
                }
            }
    
            $data[] = [
                'user_info' => [
                    'first_name' => isset($user->first_name) ? $user->first_name : '',
                    'employee_code' => isset($user->employee_code) ? $user->employee_code : '',
                    'departments' => isset($user->departments) ? $user->departments : '',
                    'designation' => isset($user->designation) ? $user->designation : '',
                    'section' => isset($user->section) ? $user->section : '',
                    'date_of_joining' => isset($user->date_of_joining) ? $user->date_of_joining : null,
                    'grade' => isset($user->grade) ? $user->grade : '',
                    'gross' => $gross,
                    'account_number' => $account_number,
                    'bank_amount' => $bank_amount,
                    'cash_amount' => $cash_amount,
                    'entry_date' => $entry_date,
                    'effective_date' => $effective_date,
                    'remarks' => $remarks
                ],
                'salaries' => $salary_group
            ];
        }
    
        return response()->json($data);
    }


    public function SalaryCertificate(Request $request)
    {
        $group = DB::table('com_group')->get();
        $branch = Branch::all();
        $department = Department::all();
        $designation = Designation::all();
        $section = Section::all();
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->select('users.id', 'profile.employee_code', 'users.first_name')
            ->get();
        $category = DB::table('category')->get();

        return view('salary.salarycertificate', compact(
            'group',
            'branch',
            'department',
            'section',
            'employee',
            'designation',
            'category'
        ));
    }

    public function SalaryCertificateGenerate(Request $request)
    {
        // Employee info
        $employee = User::leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'designations.department_id', '=', 'departments.id')
            ->where('users.id', $request->employeeId)
            ->select(
                'users.first_name',
                'profile.employee_code',
                'designations.name as designation',
                'departments.name as department',
                'profile.date_of_joining'
            )
            ->first();

        $salary = DB::table('employee_salary_details')
            ->where('employee_id', $request->employeeId)
            ->orderBy('id', 'desc')
            ->first();

        if (!$employee || !$salary) {
            return response()->json(['error' => 'No salary record found!']);
        }

        // ----- breakdown from gross -----
        $gross      = (float) $salary->gross_salary;
        $basic      = $gross * 0.50;
        $house      = $gross * 0.28;
        $medical    = $gross * 0.09;
        $conveyance = $gross * 0.08;
        $others     = $gross * 0.05;

        $data = [
            'employee'   => $employee,
            'basic'      => number_format($basic, 2),
            'house'      => number_format($house, 2),
            'medical'    => number_format($medical, 2),
            'conveyance' => number_format($conveyance, 2),
            'others'     => number_format($others, 2),
            'gross'      => number_format($gross, 2),
            'tax'        => number_format((float) $salary->tax_amount, 2),
            'net'        => number_format((float) $salary->net_salary, 2),
        ];

        return response()->json($data);
    }




}
?>