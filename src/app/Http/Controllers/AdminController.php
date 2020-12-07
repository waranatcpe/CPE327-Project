<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\UserProfile;
use App\Recruitment;
use App\Faculty;
use App\Department;
use App\Apply;
use Auth;
use Validator;

class AdminController extends Controller
{
    public function create(){
    	$faculty = Faculty::get();
    	return view('admin/create',['faculty' => $faculty]);
    }

    public function createSave(Request $request){
    	$v = $request->validate([
            'faculty' => 'required|integer',
            'department' => ['required',Rule::NotIn(['โปรดเลือกสาขา',""])],
            'name_round' => 'string',
            'TCAS_ROUND' => ['required',Rule::In(['รอบที่ 1','รอบที่ 2','รอบที่ 3','รอบที่ 4','รอบที่ 5','-'])],
            'openDate' => 'required|date',
            'closeDate' => 'required|date',
            'GPA_MTH' => 'min:0|max:4.00',
            'GPA_SCI' => 'min:0|max:4.00',
            'GPA_ENG' => 'min:0|max:4.00',
            'CRE_MTH' => 'min:0|max:30',
            'CRE_SCI' => 'min:0|max:30',
            'CRE_ENG' => 'min:0|max:30',
            'GPAX' => 'min:0|max:4.00',
            'ENG_TEST' => 'integer',
            'publish' => 'integer',
            'link' => 'nullable|string',
            'amount' => 'required|integer',
            'announcement' => 'nullable|string',
        ]);

    	if($v){
            $fac = Faculty::where("id",$request['faculty'])->first();
    		$recruit = Recruitment::Create(
	            [
	            //	'faculty' => $fac->name,
                    'faculty' => $request['faculty'],
		            'department' => $request['department'],
		            'name_round' => $request['name_round'],
		            'TCAS_ROUND' => $request['TCAS_ROUND'],
		            'openDate' => $request['openDate'],
		            'closeDate' => $request['closeDate'],
		            'GPA_MTH' => $request['GPA_MTH'],
        			'GPA_SCI' => $request['GPA_SCI'],
        			'GPA_ENG' => $request['GPA_ENG'],
        			'CRE_MTH' => $request['CRE_MTH'],
        			'CRE_SCI' => $request['CRE_SCI'],
        			'CRE_ENG' => $request['CRE_ENG'],
        			'GPAX'	=> $request['GPAX'],
		            'ENG_TEST' => $request['ENG_TEST'],
		            'publish' => $request['publish'],
                    'link' => $request['link'],
                    'amount' => $request['amount'],
                    'announcement' => $request['announcement'],
	            ]);
            $faculty = Faculty::get();
    		return view('admin/create',[
	            'status' => 200,
                'faculty' => $faculty
	        ]);
    	}
    }

    public function view(){
        $recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish','!=',2)
                ->get();
        
        return view('admin.view',[
            'recruitData' => $recruitData
        ]);
    }


    public function deptview(){
        $depts = Department::where('user',Auth::user()->id)->select('id')->get();
        $recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish','!=',2)
                ->whereIn('recruitment.department', $depts)
                ->get();
        
        return view('admin.deptview',[
            'recruitData' => $recruitData
        ]);
    }


    public function deleteRecruitmet($id){
        $count = Recruitment::where('id',$id)->count();

        if($count){
            $deleteApp = Apply::where("recruitment_id",$id)->delete();
            $delete = Recruitment::where('id',$id)->delete();
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>404]);
        }
        
    }

    public function stopRecruitment(Request $request){
        $v = $request->validate([
            'id' => 'required|integer',
        ]);
        if($v){
            $stmt = Recruitment::where("id",$request['id'])->select('publish')->first();

            if($stmt->publish == 1){
                $update = Recruitment::where("id",$request['id'])
                            ->update([
                                'publish' => 0
                            ]);
                return response()->json(['status'=>200]);
            }else{
                $update = Recruitment::where("id",$request['id'])
                            ->update([
                                'publish' => 1
                            ]);
                return response()->json(['status'=>200]);
            }
        }
    }

    public function edit($id){
        $count = Recruitment::where('id',$id)->count();
        $depts = Department::where('user',Auth::user()->id)->select('id')->get();

        if($count){
            if(Auth::user()->type == 2){
                $data = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                    ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                    ->where('recruitment.id',$id)
                    ->select('recruitment.*', 'faculty.name as fac','departments.name as dept')
                    ->first();
                    
                    //ยังไม่ได้เช็ค

                return view('admin.edit',[
                    'data' => $data,
                ]);
            }else{
                $data = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                    ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                    ->where('recruitment.id',$id)
                    ->select('recruitment.*', 'faculty.name as fac','departments.name as dept')
                    ->first();
                return view('admin.edit',[
                    'data' => $data,
                ]);
            }
        }else{
            return redirect('/admin/view');
        }
    }

    public function editSave($idsave,Request $request){
        if(Auth::user()->type == 2){
            $v = $request->validate([
                'interview_at' => 'required|string',
                'interview_time' => 'required|string',
                'interview_location' => 'nullable|string',
            ]);

            if($v){
                $recruit = Recruitment::where('id',$idsave)
                ->update(
                    [
                        'interview_at' => $request['interview_at'],
                        'interview_time' => $request['interview_time'],
                        'interview_location' => $request['interview_location'],
                    ]);
                return redirect("/dept/view");
            }else{
                echo "errors";
            }

        }else{
                $v = $request->validate([
                'name_round' => 'string',
                'TCAS_ROUND' => ['required',Rule::In(['รอบที่ 1','รอบที่ 2','รอบที่ 3','รอบที่ 4','รอบที่ 5'])],
                'openDate' => 'required|date',
                'closeDate' => 'required|date',
                'GPA_MTH' => 'min:0|max:4.00',
                'GPA_SCI' => 'min:0|max:4.00',
                'GPA_ENG' => 'min:0|max:4.00',
                'CRE_MTH' => 'min:0|max:30',
                'CRE_SCI' => 'min:0|max:30',
                'CRE_ENG' => 'min:0|max:30',
                'GPAX' => 'min:0|max:4.00',
                'ENG_TEST' => 'integer',
                'publish' => 'integer',
                'link' => 'nullable|string',
                'amount' => 'required|integer',
                'announcement' => 'nullable|string',
            ]);

            if($v){
                $recruit = Recruitment::where('id',$idsave)
                ->update(
                    [
                        'name_round' => $request['name_round'],
                        'TCAS_ROUND' => $request['TCAS_ROUND'],
                        'openDate' => $request['openDate'],
                        'closeDate' => $request['closeDate'],
                        'GPA_MTH' => $request['GPA_MTH'],
                        'GPA_SCI' => $request['GPA_SCI'],
                        'GPA_ENG' => $request['GPA_ENG'],
                        'CRE_MTH' => $request['CRE_MTH'],
                        'CRE_SCI' => $request['CRE_SCI'],
                        'CRE_ENG' => $request['CRE_ENG'],
                        'GPAX'  => $request['GPAX'],
                        'ENG_TEST' => $request['ENG_TEST'],
                        'publish' => $request['publish'],
                        'link' => $request['link'],
                        'amount' => $request['amount'],
                        'announcement' => $request['announcement'],
                    ]);
                return redirect("/admin/view");
            }
        }
    }

    public function result(){
        if(Auth::user()->type == 2){
            $depts = Department::where('user',Auth::user()->id)->select('id')->get();
                $recruitData = 
                Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish','!=',2)
                ->whereIn('recruitment.department', $depts)
                ->get();
            }else{
                $recruitData = 
                Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish','!=',2)
                ->get();
            }
        
        
        return view('admin.result',[
            'recruitData' => $recruitData
        ]);
    }

    public function resultClose(){
        if(Auth::user()->type == 2){
            $depts = Department::where('user',Auth::user()->id)->select('id')->get();
            $recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish',2)
                ->whereIn('recruitment.department', $depts)
                ->get();
        }else{
            $recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish',2)
                ->get();
        }
        
        return view('admin.resultClose',[
            'recruitData' => $recruitData
        ]);
    }

    public function resultByID($id){
        $count = Recruitment::where('id',$id)->count();
        if($count > 0){
            $recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                        ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                        ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                        ->where('recruitment.id',$id)
                        ->first();

            if(Auth::user()->type == 2){
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->where('apply.sentdept',1)
                            ->select('apply.*','apply.id as aid', 'u.*')
                            ->get();
            }else{
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->select('apply.*','apply.id as aid', 'u.*')
                            ->get();
            }
            

            return view('admin.resultByID',[
                'recruit' => $recruitData,
                'applyData' => $applyData,
                'applyCount' => $applyData->count(),
            ]);
        }else{
            return redirect('/admin/result');
        }
    }

    public function final($id){
        $count = Recruitment::where('id',$id)->count();
        if($count > 0){
            $recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                        ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                        ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                        ->where('recruitment.id',$id)
                        ->first();

            if(Auth::user()->type == 2){
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->where('apply.sentdept',1)
                            ->where('apply.interview',1)
                            ->select('apply.*','apply.id as aid', 'u.*')
                            ->get();
            }else{
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->select('apply.*','apply.id as aid', 'u.*')
                            ->get();
            }
            

            return view('admin.final',[
                'recruit' => $recruitData,
                'applyData' => $applyData,
                'applyCount' => $applyData->count(),
            ]);
        }else{
            return redirect('/dept/result');
        }
    }


    public function exportByID($id){
        $count = Recruitment::where('id',$id)->count();
        if($count > 0){
            $recruitData = Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                        ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                        ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                        ->where('recruitment.id',$id)
                        ->first();

            if(Auth::user()->type == 2){
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->where('apply.sentdept',1)
                            ->get();
            }else{
                $applyData = Apply::leftjoin('user_profiles as u','apply.profile_id','=','u.id')
                            ->where('recruitment_id',$id)
                            ->get();
            }
            

            return view('admin.exportByID',[
                'recruit' => $recruitData,
                'applyData' => $applyData,
                'applyCount' => $applyData->count(),
            ]);
        }else{
            return redirect('/admin/result');
        }
    }

    public function closeRecruitment(Request $request){
        $v = $request->validate([
            'id' => 'required|integer',
        ]);
        if($v){
            $stmt = Recruitment::where("id",$request['id'])->select('publish')->first();
            $update = Recruitment::where("id",$request['id'])
                    ->update([
                       'publish' => 2
                    ]);
            $updateApply = Apply::where('recruitment_id',$request['id'])
                            ->update([
                                'status' => 1
                            ]);

            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>404]);
        }
    }
}
