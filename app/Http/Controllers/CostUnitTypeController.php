<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CostUnitTypeController extends Controller
{
    public function showPage()
    {
        return view('Tax.tax_cost_unit_type');//D:\laragon\www\znz\resources\views\Tax\tax_cost_unit_type.blade.php
    }
    public function index()
    {
        $costUnitTypes = DB::table('tax_cost_unit_type')->get();
        return response()->json($costUnitTypes);
    }
    public function store(Request $request)
    {
        $jobNature = DB::table('tax_cost_unit_type')->insert([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json($jobNature);
    }
    public function update(Request $request, $id)
    {
        $jobNature = DB::table('tax_cost_unit_type')->where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json($jobNature);
    }

    public function destroy($id)
    {
        $jobNature = DB::table('tax_cost_unit_type')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}