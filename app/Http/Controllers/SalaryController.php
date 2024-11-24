<?php
namespace App\Http\Controllers;

use App\Branch;
use App\Contact;
use App\Contract;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\SalaryRequest;
use App\SalaryType;
use App\Salary;
use App\Section;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Validator;

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

    public function SalarySlabList()
    {
        // Get all users with their profiles
        $users = \App\User::with('profile')->get();

        // Fetch earning salary types only once
        $earning_salary_types = \App\SalaryType::where('salary_type', '=', 'earning')->get();

        $data = []; // Initialize an array for storing all users' data

        foreach ($users as $user) {
            // Get the latest contract for the current user
            $latest_contract = \App\Contract::whereUserId($user->id)
                ->latest('id') // Ensure it fetches the latest contract by ID
                ->first();

            // Check if a contract exists before proceeding
            if ($latest_contract) {
                // Fetch the salaries associated with the latest contract
                $contract_salaries = \App\Salary::where('contract_id', $latest_contract->id)
                ->latest('id') 
                ->get();

                // Fetch the latest salary slab for the current user
                $slab_data = DB::table('salary_slab')
                    ->where('user_id', $user->id)
                    ->latest('id') // Ensure it fetches the latest salary slab
                    ->first();

                $contractData = [
                        'user_info' => [
                            'first_name' => $user->first_name,
                            'employee_code' => $user->profile->employee_code,
                            'entry_date' => isset($slab_data->entrydate) ? date('Y-m-d', strtotime($slab_data->entrydate)) : null,
                            'effective_date' => isset($slab_data->effactive_date) ? date('Y-m-d', strtotime($slab_data->effactive_date)) : null,
                            'gross' => isset($slab_data->gross) ? $slab_data->gross : null,
                        ],
                        'contract_details' => [
                            'from_date' => $latest_contract->from_date,
                        ],
                        'salaries' => [],
                    ];

                // Assuming $earning_salary_types is already defined elsewhere in your code
                foreach ($earning_salary_types as $earning_salary_type) {
                    // Filter the salary group to get the correct salary type
                    $salary = $contract_salaries->filter(function ($salary) use ($earning_salary_type) {
                        return $salary->salary_type_id == $earning_salary_type->id;
                    })->first();

                    // Default amount to 0 if no matching salary is found
                    $amount = $salary ? floor($salary->amount) : 0;

                    $contractData['salaries'][] = [
                        'salary_type' => $earning_salary_type->head,
                        'amount' => $amount,
                    ];
                }

                $data[] = $contractData; // Add contract data to the main data array
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
                return response()->json(['message' => trans('contract Not Found'), 'status' => 'error'], 200, array('Access-Controll-Allow-Origin' => '*'));
            }
            $gross = $request->gross;

            $basic = $request->basic;
            $house_rent = $request->house_rent;
            $medical = $request->medical;
            $conveyance = $request->conveyance;
            $others = $request->others;

            $totalBasic = $gross * $basic / 100;
            $totalHouseRent = $gross * $house_rent / 100;
            $totalMedical = $gross * $medical / 100;
            $totalConveyance = $gross * $conveyance / 100;
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
            return response()->json(['success']);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'status' => 'error'], 200, array('Access-Controll-Allow-Origin' => '*'));
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
        $employee = User::LeftJoin('profile', 'users.id', '=', 'profile.user_id')->select('users.id', 'profile.employee_code', 'users.first_name')->get();
        return view('salary.salary', compact('group', 'branch', 'department', 'section', 'employee'));
    }

    public function  salaryReport() {
        return view('salary.salaryReport');
    }

}
?>