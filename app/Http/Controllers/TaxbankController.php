<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxbankController extends Controller
{
    public function showPage()
    {
        return view('Tax.Taxbank');
    }
    public function index()
    {
        $TaxBank = DB::table('tax_bank')->get();
        return response()->json($TaxBank);
    }

    public function store(Request $request)
    {
        $jobNature = DB::table('tax_bank')->insert([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json($jobNature);
    }
    public function update(Request $request, $id)
    {
        $jobNature = DB::table('tax_bank')->where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json($jobNature);
    }

    public function destroy($id)
    {
        $jobNature = DB::table('tax_bank')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

}