<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\UserProfile;
use App\User;

class UserProfileController extends Controller
{
    public function index(){
    	$profiles = UserProfile::leftjoin('users as u', 'user_profiles.user_id', '=', 'u.id')
    				->where('u.type',0)
    				->select('user_profiles.prefix','user_profiles.citizen_id','user_profiles.firstname','user_profiles.lastname','user_profiles.telephone','user_profiles.school','user_profiles.id','user_profiles.edu_type')
    				->get();
    	return view('profilemanage.index',[
    		'profiles' => $profiles
    	]);
    }

    public function search(Request $request){
    	$count = UserProfile::where('id',$request['id'])->count();
    	if($count){
    		$profile = UserProfile::where('id', $request['id'])->get();
    		return response()->json($profile);
    	}else{
    		return response()->json(['status' => 404]);
    	}
    }

    public function update(Request $request){
    	$v = $request->validate([
    		'_id' => 'required|integer',
    		'_uid' => 'required|integer',
            'prefix'    => ['required', Rule::In(['นาย', 'นางสาว','Mr.','Ms.'])],
            'firstname' => 'required',
            'lastname'  => 'required',
            'facebook'  => 'nullable',
            'lineID'    => 'nullable',
            'telephone' => 'nullable|min:9',
            'email'     => 'nullable|email',
            'telephone2' => 'nullable',
            'address'   => 'nullable',
        	'edu_type' => 'nullable',
            'school' => 'nullable',
            'province' => 'nullable',
            'GPA_MTH' => 'nullable|min:0|max:4.00',
            'GPA_SCI' => 'nullable|min:0|max:4.00',
            'GPA_ENG' => 'nullable|min:0|max:4.00',
            'CRE_MTH' => 'nullable|min:0|max:30',
            'CRE_SCI' => 'nullable|min:0|max:30',
            'CRE_ENG' => 'nullable|min:0|max:30',
            'GPAX' => 'nullable|min:0|max:4.00',
            'IELTS' => 'nullable|max:50',
            'TOEFL' => 'nullable|max:50',
            'TOEIC' => 'nullable|max:50',
            'CUTEP' => 'nullable|max:50',
            'feedback' => 'nullable|string',
        ]);

        if($v){
        	$update = UserProfile::where('id', $request['_id'])
            	->update([
            		'prefix' => $request['prefix'],
        			'firstname' => $request['firstname'],
        			'lastname' => $request['lastname'],
        			'facebook' => $request['facebook'],
        			'lineID' => $request['lineID'],
        			'telephone' => $request['telephone'],
        			'email' => $request['email'],
                    'telephone2' => $request['telephone2'],
                    'address' => $request['address'],
                    'feedback' => $request['feedback'],
            	]);

            $updateUser = User::where('id', $request['_uid'])
                ->update([
                    'prefix' => $request['prefix'],
                    'name' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                ]);

            $updateEdu = UserProfile::where('id', $request['_id'])
            	->update([
                    'edu_type' => $request['edu_type'],
            		'school' => $request['school'],
        			'province' => $request['province'],
        			'GPA_MTH' => $request['GPA_MTH'],
        			'GPA_SCI' => $request['GPA_SCI'],
        			'GPA_ENG' => $request['GPA_ENG'],
        			'CRE_MTH' => $request['CRE_MTH'],
        			'CRE_SCI' => $request['CRE_SCI'],
        			'CRE_ENG' => $request['CRE_ENG'],
        			'GPAX'	=> $request['GPAX'],
        			'IELTS' => $request['IELTS'],
        			'TOEFL' => $request['TOEFL'],
        			'TOEIC' => $request['TOEIC'],
        			'CUTEP' => $request['CUTEP'],
            	]);

        }else{
        	return response()->json(['status'=> 500]);
        }
    	return response()->json(['status' => 200]);
    }

}
