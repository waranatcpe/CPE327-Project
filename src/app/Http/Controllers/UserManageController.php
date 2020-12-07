<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class UserManageController extends Controller
{
    public function list(){
    	$users = User::get();
    	return view('usermanage.userlist', [
    		'users' => $users
    	]);
    }

    public function listdept(){
    	$users = User::orderby('id','desc')->get();
    	return view('usermanage.userdept', [
    		'users' => $users
    	]);
    }

    public function userdetail(Request $req){
        if(isset($req['id']) && !empty($req['id'])){
            $user = User::where('id',$req['id'])->get();
            return response()->json($user);
        }  
    }

    public function updateUser(Request $req){
        $v = $req->validate([
            'id' => 'required|integer',
            'prefix' => 'required|string',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string',
            'ps' => 'required|integer',
            'password' => 'nullable|min:6',
            'role' => 'required|integer',
        ]);

        if($v){
            if($req['ps']){
                $user = User::where('id', $req['id'])
                ->update([
                    'prefix' => $req['prefix'],
                    'name' => $req['name'],
                    'lastname' => $req['lastname'],
                    'email' => $req['email'],
                    'type' => $req['role'],
                    'username' => $req['username'],
                    'password' => Hash::make($req['password']) 
                ]);
            }else{
                $user = User::where('id', $req['id'])
                ->update([
                    'prefix' => $req['prefix'],
                    'name' => $req['name'],
                    'lastname' => $req['lastname'],
                    'type' => $req['role'],
                    'email' => $req['email'],
                    'username' => $req['username'],
                ]);
            }
            return response()->json(['status' => 200]);            
        }
    }
}
