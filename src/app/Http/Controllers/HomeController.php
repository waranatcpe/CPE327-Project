<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use Auth;
use App\UserProfile;
use App\Apply;
use App\Department;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $r)
    {
        App::setLocale($r['lang']);

        if(auth()->user()->isAdmin()) {
            
            $recruitData = 
            Recruitment::leftjoin('faculty', 'recruitment.faculty', '=', 'faculty.id')
                ->leftjoin('departments', 'recruitment.department', '=', 'departments.id')
                ->select('recruitment.*', 'faculty.name as facName', 'departments.department as department', 'departments.name as deptName')
                ->where('publish',1)
                ->get();
            //return response()->json($recruitData);

            return view('admin/home',[
                'recruitData' => $recruitData,
            ]);

        }elseif(auth()->user()->isDepartment()){
            $depts = Department::where('user',Auth::user()->id)->get();
            return view('department/home',[
                'depts' => $depts
            ]);
            
        }elseif(auth()->user()->isStudent()){

            $recruitData = Recruitment::where('publish',1)->get();
            $id = Auth::user()->id;
            $profile = UserProfile::where('user_id', $id)->first();

            $count = UserProfile::where('user_id', Auth::user()->id)->count();
            if($count == 0){
                $profile = UserProfile::Create(
                    [
                        'user_id' => Auth::user()->id,
                        'prefix' => Auth::user()->prefix,
                        'firstname' => Auth::user()->name,
                        'lastname' => Auth::user()->lastname,
                        'citizen_id' => Auth::user()->username,
                        'email' => Auth::user()->email,
                    ]);
            }

            $profileClass = new ProfileController();
            $status = [ 
                'profile' => $profileClass->checkProfile($profile),
                'education' => $profileClass->checkEducation($profile),
                'transcript' => $profileClass->checkTranscript($profile),
            ];

            /* Get profile_id */
            $stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
            /* check count apply*/
            $count = Apply::where("profile_id",$stmt->id)->where('status',0)->count();

           // echo $count;
            if($count > 0){
                $allow = false;
            }else{
                $allow = true;
            }

            return view('profile/home',[
                'recruitData' => $recruitData,
                'status' => $status,
                'edit' => $allow
            ]);
            // return response()->json($recruitData);
        }
    }
}
