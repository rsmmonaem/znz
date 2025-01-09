<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobNeatureController extends Controller
{
    public function showPage()
    {
        // $jobNeature = DB::table('job-nature')->get();
        return view('job-neature.index');
    }
    public function index()
    {
        $jobNatures = DB::table('job-nature')->get();
        return response()->json($jobNatures);
    }

    public function store(Request $request)
    {
        $jobNature = DB::table('job-nature')->insert([
            'name' => $request->name
        ]);
        return response()->json($jobNature);
    }

    public function update(Request $request, $id)
    {
        $jobNature = DB::table('job-nature')->where('id',$id)->update([
            'name' => $request->name
        ]);
        return response()->json($jobNature);
    }

    public function destroy($id)
    {
        $jobNature = DB::table('job-nature')->where('id',$id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}