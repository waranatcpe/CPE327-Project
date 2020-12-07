<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Apply;
use App\Recruitment;
use App\UserProfile;
use App;

class ApplicationController extends Controller
{
    public function index($lang){
        /* Get profile_id */
        App::setLocale($lang);
    	$stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
    	$profile_id = $stmt->id;

        $profile = UserProfile::where('user_id', Auth::user()->id)->first();

    	$myapp = Apply::leftjoin('user_profiles as p','apply.profile_id','=','p.id')
    			->leftjoin('recruitment as r','apply.recruitment_id','=','r.id')
    			->leftjoin('faculty as f', 'r.faculty', '=', 'f.id')
                ->leftjoin('departments as d', 'r.department', '=', 'd.id')
    			->where('profile_id', $profile_id)
    			->select('apply.*','f.name as faculty','d.department as department','d.name as branch','r.TCAS_ROUND as tcas', 'r.name_round as nameround','r.publish as published','apply.status as state', 'apply.sentdept as sentdept','f.name_en as f_name_en', 'd.name_en as d_name_en')
                ->orderBy('published','asc')->orderBy('apply.id','desc')
    			->get();
        $count = $myapp->count();

    	return view('application.index',[
    		'application' => $myapp,
            'count'=>$count,
            'lang'=>$lang,
            'profile' => $profile,
    	]);
    }

    public function view($lang,$id){
    	/* Get profile_id */
        App::setLocale($lang);
    	$stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
    	$profile_id = $stmt->id;
        
    	$check = Apply::where('profile_id',$profile_id)->where('id',$id)->count();
    	if($check){
    		$app = Apply::leftjoin('user_profiles as p','apply.profile_id','=','p.id')
    			->leftjoin('recruitment as r','apply.recruitment_id','=','r.id')
    			->leftjoin('faculty as f', 'r.faculty', '=', 'f.id')
                ->leftjoin('departments as d', 'r.department', '=', 'd.id')
    			->where('profile_id', $profile_id)
    			->select('apply.*','f.name as faculty','d.department as department','d.name as branch','r.TCAS_ROUND as tcas', 'r.name_round as nameround','r.id as rid','r.publish as published','apply.status as state','apply.sentdept as sentdept','r.announcement as announcement','r.interview_location as itv_location','r.interview_at as interview_at','r.interview_time as interview_time')
    			->where('apply.profile_id',$profile_id)->where('apply.id',$id)
    			->first();

    		$recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName','faculty.name_en as f_name_en', 'departments.department as department', 'departments.name as deptName' , 'departments.name_en as d_name_en')
                ->where('recruitment.id',$app->rid)->first();

            $profileData = UserProfile::where('user_id', Auth::user()->id)->first();

    		return view('application.view',[
    			'app' => $app,
    			'recruit' => $recruitData,
    			'profile' => $profileData,
    			'id' => $id,
    		]);
    	}else{
    		return redirect('/application');
    	}
    }

    public function viewAdmin($id){
        /* Get profile_id */
        $idx = Apply::where('id',$id)->select('profile_id')->count();
        if($idx){
            $idxx = Apply::where('id',$id)->select('profile_id')->first();
            $profile_id = $idxx->profile_id;
        }else{
            $profile_id = 0;
        }
        

        // $check = Apply::where('profile_id',$profile_id)->where('id',$id)->count();
       if($profile_id){
            $app = Apply::leftjoin('user_profiles as p','apply.profile_id','=','p.id')
                ->leftjoin('recruitment as r','apply.recruitment_id','=','r.id')
                ->leftjoin('faculty as f', 'r.faculty', '=', 'f.id')
                ->leftjoin('departments as d', 'r.department', '=', 'd.id')
                ->where('profile_id', $profile_id)
                ->select('apply.*','f.name as faculty','d.department as department','d.name as branch','r.TCAS_ROUND as tcas', 'r.name_round as nameround','r.id as rid','r.publish as published','apply.status as state')
                ->where('apply.profile_id',$profile_id)->where('apply.id',$id)
                ->first();


            $recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('recruitment.id',$app->rid)->first();

            $profileData = UserProfile::where('id', $profile_id)->first();

            return view('application.viewAdmin',[
                'app' => $app,
                'recruit' => $recruitData,
                'profile' => $profileData,
                'id' => $id,
            ]);
        }else{
            return redirect('/admin/result');
        }
    }

    public function cancel($id){
        $stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
        $profile_id = $stmt->id;

        $check = Apply::where('profile_id',$profile_id)->where('id',$id)->where('sentdept',0)->count();

        if($check){
            $delete = Apply::where('id',$id)->delete();
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
        
    }
}
