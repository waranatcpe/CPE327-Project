<?php
/* API controller */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function list(Request $request){
    	if(isset($request['faculty_id'])){
    		$faculty_id = $request['faculty_id'];
			$data = Department::where('faculty_id', $faculty_id)->get();
			return response()->json($data);
    	}else{
    		$data = "";
    		return response()->json($data);
    	}
    }

    public function listAll(){
    	$data = Department::get();
			return response()->json($data);
    }
}
