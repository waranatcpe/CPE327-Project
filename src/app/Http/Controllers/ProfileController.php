<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\UserProfile;
use App\User;
use Auth;
use Validator;
use App\Apply;
use App;

class ProfileController extends Controller
{
    function checkAllowEdit(){
        $stmt = UserProfile::where("user_id", Auth::user()->id)->select("id")->first();
        $count = Apply::where("profile_id",$stmt->id)->where('status',0)->count();
        if($count > 0){
            return 0;
        }else{
            return 1;
        }
    }

    function checkProfile($profile){
        $status =  ($profile->citizen_id != null) &&
                    ($profile->telephone != null) &&
                    ($profile->email != null) &&
                    ($profile->firstname != null) &&
                    ($profile->lastname != null) &&
                    ($profile->address != null);
                return $status;
    }

    function checkEducation($profile){
        if($profile->edu_type == "มัธยมศึกษาปีที่ 6" || $profile->edu_type == "Grade 12"){
                $status = ($profile->school != null) &&
                ($profile->GPA_MTH != null) &&
                ($profile->GPA_SCI != null) &&
                ($profile->GPA_ENG != null) &&
                ($profile->GPAX != null) &&
                ($profile->CRE_MTH != null) && 
                ($profile->CRE_SCI != null) && 
                ($profile->CRE_ENG != null);
        }else if($profile->edu_type == "ประกาศนียบัตรวิชาชีพ (ปวช.3)" || $profile->edu_type == "ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)" || $profile->edu_type == "Vocational Certificate (Voc. Cert.)") {
            $status = ($profile->school != null) &&
                    ($profile->GPAX != null);
        }else if($profile->edu_type == null){
            $status = false;
        }else{
            $status = true;
        }
        
        return $status;
    }

    function checkTranscript($profile){
         $status = $profile->transcript != null;
         return $status;
    }

public function home(Request $r){
    App::setLocale($r['lang']);
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

    	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
        $id = Auth::user()->id;
            $profile = UserProfile::where('user_id', $id)->first();
            $status = [ 
                'profile' => $this->checkProfile($profile),
                'education' => $this->checkEducation($profile),
                'transcript' => $this->checkTranscript($profile),
            ];
        
            $allow = $this->checkAllowEdit();
    	return view('profile/home',[
            'profileData' => $profileData,
            'status' => $status,
            'edit' => $allow 
        ]);
    }

    public function myprofile(Request $r){
    App::setLocale($r['lang']);
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
        $allow = $this->checkAllowEdit();
    	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
    	return view('profile/myprofile',[
            'profileData' => $profileData,
            'edit' => $allow,
            'province' => array("กระบี่","กรุงเทพมหานคร","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา" ,"ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา" ,"นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี" ,"พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน" ,"ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา" ,"สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี" ,"สุรินทร์","หนองคาย","หนองบัวลำภู","อยุธยา","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี"),
            'i' => 0
        ]);
    }

    public function myprofileSave(Request $request){
        App::setLocale($request['lang']);
        $allow = $this->checkAllowEdit();
    	$v = $request->validate([
            'prefix'    => ['required', Rule::In(['นาย', 'นางสาว','Mr.','Ms.'])],
            'firstname' => 'required|max:50',
            'lastname'  => 'required|max:50',
            'facebook'  => 'nullable|max:50',
            'line'      => 'nullable|max:50',
            'telephone' => 'required|min:9',
            'email'     => 'required|email',
            'telephone2' => 'nullable|max:11',
            'address'   => 'required|max:500',
        ],[
            'required'  => 'โปรดกรอก :attribute',
            'firstname.required' => 'โปรดกรอกชื่อจริง',
            'lastname.required' => 'โปรดกรอกนามสกุล',
            'telephone.required' => 'โปรดกรอกหมายเลขโทรศัพท์ที่ติดต่อได้',
            'address.required' => 'โปรดกรอกที่อยู่',
        ]);

        if($v){
            $update = UserProfile::where('user_id', Auth::user()->id)
            	->update([
            		'prefix' => $request['prefix'],
        			'firstname' => $request['firstname'],
        			'lastname' => $request['lastname'],
        			'facebook' => $request['facebook'],
        			'lineID' => $request['line'],
        			'telephone' => $request['telephone'],
        			'email' => $request['email'],
                    'telephone2' => $request['telephone2'],
                    'address' => $request['address'],
            	]);

            $updateUser = User::where('id', Auth::user()->id)
                ->update([
                    'prefix' => $request['prefix'],
                    'name' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                ]);
        	 
        	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
	    	return view('profile/myprofile',[
	            'profileData' => $profileData,
	            'status' => 200,
                'edit' => $allow,
                //'lang' => Config::get('app.locale'),
                'province' => array("กระบี่","กรุงเทพมหานคร","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา" ,"ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา" ,"นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี" ,"พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน" ,"ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา" ,"สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี" ,"สุรินทร์","หนองคาย","หนองบัวลำภู","อยุธยา","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี"),
            'i' => 0
	        ]);
        }

    	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
    	return view('profile/myprofile',[
            'profileData' => $profileData,
            'edit' => $allow
        ]);
    }

   // EDUCATION
   public function education(Request $r){
    App::setLocale($r['lang']);
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
        $allow = $this->checkAllowEdit();
   	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
   		return view('profile/education',[
            'profileData' => $profileData,
            'edit'=>$allow,
            'province' => array("กระบี่","กรุงเทพมหานคร","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา" ,"ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา" ,"นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี" ,"พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน" ,"ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา" ,"สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี" ,"สุรินทร์","หนองคาย","หนองบัวลำภู","อยุธยา","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี"),
            'i' => 0
        ]);
   }

    public function educationSave(Request $request){
        App::setLocale($request['lang']);
        if($request['edu_type'] == "มัธยมศึกษาปีที่ 6" || $request['edu_type'] == "Grade 12" ){
            /* Require All */
            $v = $request->validate([
                'edu_type' => 'required',
                'school' => 'required',
                'province' => 'required',
                'GPA_MTH' => 'required|min:0|max:4.00',
                'GPA_SCI' => 'required|min:0|max:4.00',
                'GPA_ENG' => 'required|min:0|max:4.00',
                'CRE_MTH' => 'required|min:0|max:50',
                'CRE_SCI' => 'required|min:0|max:50',
                'CRE_ENG' => 'required|min:0|max:50',
                'GPAX' => 'required|min:0|max:4.00',
                'IELTS' => 'nullable|max:50',
                'TOEFL' => 'nullable|max:50',
                'TOEIC' => 'nullable|max:50',
                'CUTEP' => 'nullable|max:50',
                'RMIT' => 'nullable|max:50',
            ],[
                'required'  => 'โปรดกรอก :attribute',
                'GPA_MTH.required' => 'โปรดกรอกผลการเรียน คณิตศาสตร์',
                'GPA_SCI.required' => 'โปรดกรอกผลการเรียน วิทยาศาสตร์',
                'GPA_ENG.required' => 'โปรดกรอกผลการเรียน ภาษาต่างประเทศ',
                'CRE_MTH.required' => 'โปรดกรอกหน่วยกิตรวม คณิตศาสตร์',
                'CRE_SCI.required' => 'โปรดกรอกหน่วยกิตรวม วิทยาศาสตร์',
                'CRE_ENG.required' => 'โปรดกรอกหน่วยกิตรวม ภาษาต่างประเทศ',
                'GPAX.required' => 'โปรดกรอกผลการเรียนเฉลี่ย',
            ]);

        }elseif($request['edu_type'] == "ประกาศนียบัตรวิชาชีพ (ปวช.3)" || $request['edu_type'] == 'Vocational Certificate (Voc. Cert.)' || $request['edu_type'] == "ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)"){

            $v = $request->validate([
                'edu_type' => 'required',
                'school' => 'required',
                'province' => 'required',
                'GPA_MTH' => 'nullable|min:0|max:4.00',
                'GPA_SCI' => 'nullable|min:0|max:4.00',
                'GPA_ENG' => 'nullable|min:0|max:4.00',
                'CRE_MTH' => 'nullable|min:0|max:50',
                'CRE_SCI' => 'nullable|min:0|max:50',
                'CRE_ENG' => 'nullable|min:0|max:50',
                'GPAX' => 'required|min:0|max:4.00',
                'IELTS' => 'nullable|max:50',
                'TOEFL' => 'nullable|max:50',
                'TOEIC' => 'nullable|max:50',
                'CUTEP' => 'nullable|max:50',
                'RMIT' => 'nullable|max:50',
            ]);

        }elseif($request['edu_type'] == "GED" || $request['edu_type'] == "IGCSE"){
            $v = $request->validate([
                'edu_type' => 'required',
                'school' => 'required',
                'province' => 'required',
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
                'RMIT' => 'nullable|max:50',
            ]);
            
        }else{
            $v = $request->validate([
                'edu_type' => 'required',
                'school' => 'required',
                'province' => 'required',
                'GPA_MTH' => 'required|min:0|max:4.00',
                'GPA_SCI' => 'required|min:0|max:4.00',
                'GPA_ENG' => 'required|min:0|max:4.00',
                'CRE_MTH' => 'required|min:0|max:50',
                'CRE_SCI' => 'required|min:0|max:50',
                'CRE_ENG' => 'required|min:0|max:50',
                'GPAX' => 'required|min:0|max:4.00',
                'IELTS' => 'nullable|max:50',
                'TOEFL' => 'nullable|max:50',
                'TOEIC' => 'nullable|max:50',
                'CUTEP' => 'nullable|max:50',
                'RMIT' => 'nullable|max:50',
            ]);
        }

        if($v){
            $update = UserProfile::where('user_id', Auth::user()->id)
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
                    'RMIT' => $request['RMIT'],
            	]);
        	 $allow = $this->checkAllowEdit();
        	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
	    	return view('profile/education',[
	            'profileData' => $profileData,
	            'status' => 200,
                'edit'=>$allow,
                'province' => array("กระบี่","กรุงเทพมหานคร","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา" ,"ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา" ,"นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี" ,"พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน" ,"ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา" ,"สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี" ,"สุรินทร์","หนองคาย","หนองบัวลำภู","อยุธยา","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี"),
                'i' => 0
	        ]);
        }

        $allow = $this->checkAllowEdit();
        $profileData = UserProfile::where('user_id', Auth::user()->id)->first();
    	return view('profile/education',[
            'profileData' => $profileData,
            'edit'=>$allow,
            'province' => array("กระบี่","กรุงเทพมหานคร","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา" ,"ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา" ,"นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี" ,"พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน" ,"ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา" ,"สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี" ,"สุรินทร์","หนองคาย","หนองบัวลำภู","อยุธยา","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี"),
            'i' => 0
        ]);
    }

    // Portfolio
   public function transcript(Request $r){
    App::setLocale($r['lang']);
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
        $allow = $this->checkAllowEdit();
   	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
   		return view('profile/transcript',[
            'profileData' => $profileData,
            'edit'=>$allow
        ]);
   }


	public function transcriptSave(Request $request){
        App::setLocale($request['lang']);
        
         $allow = $this->checkAllowEdit();
		$input = $request->all();
		$fileName = "";
	    if(isset($input['transcript'])){
	    	$v = $request->validate([
	            'transcript' => 'required|mimes:pdf,jpeg,png,jpg',
	        ]);	

        	if($v){
				$file = $request['transcript'];
	            $fileName = Auth::user()->name."_".Auth::user()->lastname."-transcript.".$file->extension();
	            $file = $file->move(storage_path('app/uploads/transcript'), $fileName);

	            $update = UserProfile::where('user_id', Auth::user()->id)
            	->update([
            		'transcript' => $fileName,
        			'link' => $request['link'],
            	]);

            	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
		    	return view('profile/transcript',[
		            'profileData' => $profileData,
		            'status' => 200,
                    'edit'=>$allow
		        ]);
        	}
	    }else{
	    	$update = UserProfile::where('user_id', Auth::user()->id)
            	->update([
        			'link' => $request['link'],
            	]);
        	
        	$profileData = UserProfile::where('user_id', Auth::user()->id)->first();
	    	return view('profile/transcript',[
	            'profileData' => $profileData,
	            'status' => 200,
                'edit' => $allow
	        ]);
	    }
    	

        $profileData = UserProfile::where('user_id', Auth::user()->id)->first();
    	return view('profile/transcript',[
            'profileData' => $profileData,
            'edit' => $allow
        ]);
    }

}
