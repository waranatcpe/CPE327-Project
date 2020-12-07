<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Faculty;

class DepartmentManageController extends Controller
{

    public function index(){
        $dept = Department::leftjoin('faculty as f', 'departments.faculty_id', '=', 'f.id')
                ->select('f.name as f_name', 'departments.department as d_name','departments.name as d_major', 'f.id as f_id', 'departments.id as d_id', 'departments.user as user')
                ->orderby('departments.id','desc')
                ->get();

        $faculty = Faculty::select('id','name')->get();
        $users = User::where('type',2)->get();
        return view('deptmanage.index',[
            'dept' => $dept,
            'faculty' => $faculty,
            'users' => $users,
        ]);
    }

    public function adddept(Request $req){
        $v = $req->validate([
            'faculty' => 'required|integer',
            'department' => 'nullable|string',
            'major' => 'required|string',
            'admin' => 'required',
        ],[
            'major.required' => 'โปรดกรอกสาขาวิชา'
        ]);

        if($v){
            if($req['admin'] == 'null'){
                $profile = Department::Create(
                [
                    'faculty_id' => $req['faculty'],
                    'department' => $req['department'],
                    'name' => $req['major'],
                    'user' => NULL,
                ]);
            }else{
                $profile = Department::Create(
                [
                    'faculty_id' => $req['faculty'],
                    'department' => $req['department'],
                    'name' => $req['major'],
                    'user' => $req['admin'],
                ]);
            }
            return $this->index();
        }else{
            return $this->index();
        }
    }

    public function updateAdmin(Request $req){
        $v = $req->validate([
            'user' => 'required',
            'dept_id' => 'required|integer'
        ]);

        if($v){
            if($req['user'] == "null"){
                 $update = Department::where('id', $req['dept_id'])
                ->update([
                    'user' => NULL,
                ]);
            }else{
                $update = Department::where('id', $req['dept_id'])
                ->update([
                    'user' => $req['user'],
                ]);
            }
            
        }
        return response()->json($req->all());
    }
}
