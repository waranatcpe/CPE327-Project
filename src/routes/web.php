<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::auth();

/* login Route*/
Route::get('/{lang}/login',function($lang){
	App::setLocale($lang);
	return view('auth.login');
});

/* register Route */
Route::get('/{lang}/register',function($lang){
	App::setLocale($lang);
	return view('auth.register');
});

/* Redirect To TH login view*/
Route::get('/',function(){
	App::setLocale('th');
    return redirect('/th/login');
});

Route::get('/{lang}/home','HomeController@index')->name('main');

/* Public Route */
Route::get('/users/reset-password',function(){
	if(Auth::check()){
		return "Reset Password";
	}else{
		return "No Auth";
	}
});

// use App\	Auth;
/* Home Redirect to Roles*/
Route::get('/home', function(){
	if(auth()->user()->isAdmin()){
		return redirect('/admin/home');
	}else if(auth()->user()->isDepartment()){
		return redirect('/dept/home');
	}else if(auth()->user()->isStudent()){
		return redirect('/'.Config::get('app.locale').'/home');
	}
});

require_once 'route.student.php';
require_once 'route.department.php';
require_once 'route.admin.php';
require_once 'route.public.php';