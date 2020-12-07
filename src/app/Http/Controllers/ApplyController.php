<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\Recruitment;
use App\Faculty;
use App\Department;
use App\Apply;
use Auth;
use App;
use Config;


class ApplyController extends Controller
{
    public function index(Request $r){
        App::setLocale($r['lang']);
    	$faculty = Faculty::get();
    	$id = Auth::user()->id;
            $profile = UserProfile::where('user_id', $id)->first();
            $profileClass = new ProfileController();
            $status = [ 
                'profile' => $profileClass->checkProfile($profile),
                'education' => $profileClass->checkEducation($profile),
                'transcript' => $profileClass->checkTranscript($profile),
            ];

    	$recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish',1)->get();

    	return view('apply.index',[
    		'recruitData' => $recruitData,
    		'status' => $status,
    		'faculty' => $faculty,
            'lang' => $r['lang']
    	]);
    }

    public function search(Request $request){
        App::setLocale($request['lang']);
    	$faculty = Faculty::get();
    	$id = Auth::user()->id;
            $profile = UserProfile::where('user_id', $id)->first();
            $profileClass = new ProfileController();
            $status = [ 
                'profile' => $profileClass->checkProfile($profile),
                'education' => $profileClass->checkEducation($profile),
                'transcript' => $profileClass->checkTranscript($profile),
            ];

            if($request['department'] == "โปรดเลือกสาขา" || $request['department'] == "Choose department"){
				$recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName','faculty.name_en as f_name_en', 'departments.name_en as d_name_en')
                ->where('recruitment.faculty',$request['faculty'])
                //->orWhere('recruitment.department',$request['department'])
                ->where('publish',1)->get();

                $count = $recruitData->count();

                $data = Faculty::where('id',$request['faculty'])->select('name','name_en')->first();
                if(Config::get('app.locale') == 'th'){
                    $result = $data->name;
                }else{
                    $result = $data->name_en;
                }
            }else if($request['department']){
            	$recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName','faculty.name_en as f_name_en', 'departments.name_en as d_name_en')
                ->where('recruitment.faculty',$request['faculty'])
                ->where('recruitment.department',$request['department'])
                ->where('publish',1)->get();

                $count = $recruitData->count();

                $data = Faculty::where('id',$request['faculty'])->select('name','name_en')->first();
                $data2 = Department::where('id',$request['department'])->select('name','name_en')->first();

                if(Config::get('app.locale') == 'th'){
                    $result = $data->name." / ".$data2->name;
                }else{
                    $result = $data->name_en." / ".$data2->name_en;
                }
                

            }else{
            	$recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName','faculty.name_en as f_name_en', 'departments.name_en as d_name_en')
                ->where('publish',1)->get();

                $count = $recruitData->count();

                if(Config::get('app.locale') == 'th'){
                    $result = "ทั้งหมด";    
                }else{
                    $result = "All Recruitment";    
                }
                
            }   	
        
    	return view('apply.search',[
    		'recruitData' => $recruitData,
    		'status' => $status,
    		'faculty' => $faculty,
    		'result' => $result,
    		'count' => $count,
            'lang' => $request['lang'],
    	]);
    }

    public function application($lang,$id){
        App::setLocale($lang);
    	$s = Recruitment::where('id',$id)->count();
    	if(!$s){
    		return redirect(Config::get('app.locale').'/apply');
            exit();
    	}

        $c = Recruitment::where('id',$id)->select('publish')->first();
        if($c->publish == 0){
            return redirect(Config::get('app.locale').'/apply');
            exit();
        }
    	/* Get profile_id */
    	$stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
    	$profile_id = $stmt->id;

    	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();

    	/* Check Apply Status */
    	$count = Apply::where('profile_id' , $profile_id)->where('recruitment_id',$id)->where('status',0)->count();

    	/* GET recruitment Data */
    	$recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName','faculty.name_en as f_name_en', 'departments.department as department', 'departments.name as deptName','departments.name_en as d_name_en')
                ->where('recruitment.id',$id)->first();

    	if($count){
    		// Get ID application
    		$app = Apply::where('profile_id' , $profile_id)->where('recruitment_id',$id)->where('status',0)->select('id')->first();
    		return view('apply.application',[
    			'allow' => 0,
    			'id' => $id,
    			'recruit' => $recruitData,
    			'profile' => $profileData,
    			'id_app' => $app->id,
    		]);
    	}else{
    		return view('apply.application', [
    			'allow' => 1,
    			'id' => $id,
    			'recruit' => $recruitData,
    			'profile' => $profileData
    		]);
    	}
    }

    public function apply($lang, $id, Request $request){
        App::setLocale($lang);
    	$input = $request->all();
		$fileName = "";
		$id_user = Auth::user()->id;
        /* Get profile_id */
    	$stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
    	$profile_id = $stmt->id;

        /* Check double apply*/
        $check = Apply::where('recruitment_id',$id)->where('profile_id',$profile_id)->count();

	    if(1 && !$check){
	    	$v = $request->validate([
	            'portfolio' => 'required|mimes:pdf',
                'alumni_doc' => 'nullable|mimes:pdf',
                'sop' => 'nullable|mimes:pdf',
	            'link' => 'string|nullable',
	        ]);	

        	if($v){
				$file = $request['portfolio'];
	            $fileName = $id."_".Auth::user()->name."_".Auth::user()->lastname."-portfolio-".rand(10000001,99999999).".".$file->extension();
	            $file = $file->move(storage_path('app/uploads/portfolio'), $fileName);

                $alumniDocName = NULL;
                if(!empty($request['alumni_doc'])){
                    // alumni_doc session
                    $alumniDoc = $request['alumni_doc'];
                    $alumniDocName = $id."_".Auth::user()->name."_".Auth::user()->lastname."-alumni-doc-".rand(10000001,99999999).".".$alumniDoc->extension();
                    $alumniDoc = $alumniDoc->move(storage_path('app/uploads/alumni_doc'), $alumniDocName);
                }
                

	            $apply = Apply::Create(
	            [
	            	'profile_id' => $profile_id,
                    'recruitment_id' => $id,
                    'result' => 0,
                    'portfolio' => $fileName,
                    'alumni' => $alumniDocName,
	            	'link' => $request['link'],
	            	'status' => 0,
	            ]);

                if(!empty($request['sop'])){
                    $file2 = $request['sop'];
                    $fileNameSop = $id."_".Auth::user()->name."_".Auth::user()->lastname."-sop-".rand(10000001,99999999).".".$file2->extension();
                    $file2 = $file2->move(storage_path('app/uploads/sop'), $fileNameSop);

                    $apply_sop = Apply::where('portfolio',$fileName)->
                    update([
                        'sop' => $fileNameSop,
                    ]);
                }
	            return $this->application($lang,$id);
        	}
	    }else{
	    	return $this->application($lang,$id);
	    }
    }

    public function updateResult(Request $req){
        $v =  $req->validate([
            'id' => 'required|integer'
        ]);

        if($v){
            $app = Apply::where('id', $req['id'])->first();
                if($app->result == 1){
                $update = Apply::where('id',$req['id'])
                            ->update([
                                'result' => 0
                            ]);
                return response()->json(['status'=>200]);
                }else if($app->result == 0){
                    $update = Apply::where('id',$req['id'])
                                ->update([
                                    'result' => 1
                                ]);
                return response()->json(['status'=>200]);
                }
        }else{ 
            return response()->json(['status'=>500]);
        }
    }

    public function updateSentdept(Request $req){
        $v =  $req->validate([
            'id' => 'required|integer'
        ]);

        if($v){
            $app = Apply::where('id', $req['id'])->first();
                if($app->sentdept == 1){
                $update = Apply::where('id',$req['id'])
                            ->update([
                                'sentdept' => 0
                            ]);
                return response()->json(['status'=>200]);
                }else if($app->sentdept == 0){
                    $update = Apply::where('id',$req['id'])
                                ->update([
                                    'sentdept' => 1
                                ]);
                return response()->json(['status'=>200]);
                }
        }else{ 
            return response()->json(['status'=>500]);
        }
    }

    public function updateInterview(Request $req){
        $v =  $req->validate([
            'id' => 'required|integer'
        ]);

        if($v){
            $app = Apply::where('id', $req['id'])->first();
                if($app->interview == 1){
                $update = Apply::where('id',$req['id'])
                            ->update([
                                'interview' => 0
                            ]);
                return response()->json(['status'=>200]);
                }else if($app->interview == 0){
                    $update = Apply::where('id',$req['id'])
                                ->update([
                                    'interview' => 1
                                ]);
                return response()->json(['status'=>200]);
                }
        }else{ 
            return response()->json(['status'=>500]);
        }
    }

    public function updateEnd(Request $req){
        $v =  $req->validate([
            'id' => 'required|integer'
        ]);

        if($v){
            $app = Apply::where('id', $req['id'])->first();
                if($app->status == 1){
                $update = Apply::where('id',$req['id'])
                            ->update([
                                'status' => 0
                            ]);
                return response()->json(['status'=>200]);
                }else if($app->status == 0){
                    $update = Apply::where('id',$req['id'])
                                ->update([
                                    'status' => 1
                                ]);
                return response()->json(['status'=>200]);
                }
        }else{ 
            return response()->json(['status'=>500]);
        }
    }

    public function interviewConfirm(Request $req){
        $v =  $req->validate([
            'id' => 'required|integer'
        ]);

        if($v){
            $app = Recruitment::where('id', $req['id'])->first();
                if($app->interview_confirm == 1){
                $update = Recruitment::where('id',$req['id'])
                            ->update([
                                'interview_confirm' => 0
                            ]);
                return response()->json(['status'=>200]);
                }else if($app->interview_confirm == 0){
                    $update = Recruitment::where('id',$req['id'])
                                ->update([
                                    'interview_confirm' => 1
                                ]);
                return response()->json(['status'=>200]);
                }
            }else{ 
            return response()->json(['status'=>500]);
        }
    }
        
}
