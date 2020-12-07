<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use DB;

class ManagerController extends Controller
{
    public function index(){
    	$recruitmentData = DB::select("SELECT DISTINCT name_round FROM recruitment ");
    	return view('admin-manager.index',[
    		'recuitData' => $recruitmentData
    	]);
    }
}
