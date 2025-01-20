<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxbankbranchController extends Controller
{
    public function showPage()
    {
        $bank = DB::table('tax_bank')->get();
        return view('Tax.Taxbankbranch', compact('bank')); 
    }
    public function index()
    {
        $TaxBank = DB::table('tax_bank_branch')
        ->leftJoin('tax_bank', 'tax_bank_branch.tax_bank_id', '=', 'tax_bank.id')
        ->select('tax_bank.*', 'tax_bank_branch.name as branchname', 'tax_bank_branch.description as bdescription','tax_bank_branch.id as bid')
        ->get();
        return response()->json($TaxBank);
    }

    public function store(Request $request)
    {
        $taxbranch = DB::table('tax_bank_branch')->insert([
            'name' => $request->name,
            'tax_bank_id' => $request->tax_bank_id,
            'description' => $request->description
        ]);
        return response()->json($taxbranch);
    }
    public function update(Request $request)
    {
        try{
            $taxbranch = DB::table('tax_bank_branch')->where('id', $request->id)->update([
                'name' => $request->name,
                'tax_bank_id' => $request->tax_bank_id,
                'description' => $request->description
            ]);
            return response()->json($taxbranch);
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        // return $id;
        DB::table('tax_bank_branch')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

}