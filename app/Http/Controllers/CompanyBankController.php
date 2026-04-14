<?php
namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Validator;
use DB;

class CompanyBankController extends Controller
{
    use BasicController;

    public function showPage()
    {
        return view('company_bank.index');
    }

    public function index(Request $request)
    {
        $banks = Bank::all();
        if ($request->ajax()) {
            return response()->json($banks);
        }
        return view('company_bank.index', compact('banks'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->messages()->first()]);
        }

        $bank = new Bank();
        $bank->fill($request->all());
        $bank->status = 1;
        $bank->save();

        $this->logActivity(['module' => 'company_bank', 'unique_id' => $bank->id, 'activity' => 'activity_added']);

        return response()->json(['status' => 'success', 'message' => 'Bank account added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json(['status' => 'error', 'message' => 'Bank not found.']);
        }

        $validation = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->messages()->first()]);
        }

        $bank->fill($request->all());
        $bank->save();

        $this->logActivity(['module' => 'company_bank', 'unique_id' => $bank->id, 'activity' => 'activity_updated']);

        return response()->json(['status' => 'success', 'message' => 'Bank account updated successfully.']);
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json(['status' => 'error', 'message' => 'Bank not found.']);
        }

        $this->logActivity(['module' => 'company_bank', 'unique_id' => $bank->id, 'activity' => 'activity_deleted']);
        $bank->delete();

        return response()->json(['status' => 'success', 'message' => 'Bank deleted successfully.']);
    }

    public function updateStatus(Request $request)
    {
        $bank = Bank::find($request->id);
        if ($bank) {
            $bank->status = $request->status;
            $bank->save();
            return response()->json(['status' => 'success', 'message' => 'Status updated successfully.']);
        }
        return response()->json(['status' => 'error', 'message' => 'Bank not found.']);
    }
}
