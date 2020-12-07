<?php
/* Route for admin */
Route::group(['middleware' => ['admin']], function(){
   	// Route::get('/dashboard', 'admin\AdminController@index');
   // Route::get('/home', 'HomeController@index');
    Route::group(['prefix' => 'manage'], function(){
        Route::get('/', 'ManagerController@index');
    });

   	Route::group(['prefix' => 'admin'], function(){
    	Route::get('/create', 'AdminController@create');
    	Route::post('/create', 'AdminController@createSave');

        Route::get('/view', 'AdminController@view');
        Route::get('/edit/{id}', 'AdminController@edit');
        Route::post('/edit/{id}', 'AdminController@editSave');

        Route::get('/result', 'AdminController@result');
        Route::get('/result/closed', 'AdminController@resultClose');

        Route::get('/active/{id}', 'AdminController@resultByID');
        Route::get('/app/{id}','ApplicationController@viewAdmin');

        Route::get('/users', 'UserManageController@list');
        Route::get('/user-profiles', 'UserProfileController@index');

        Route::get('/department-admin', 'UserManageController@listdept');

        Route::get('/department-manage', 'DepartmentManageController@index');
        Route::post('/department-manage', 'DepartmentManageController@adddept');
	});

   	Route::group(['prefix' => 'api'], function(){
        Route::get('/department', 'DepartmentController@listAll');
    	Route::post('/department', 'DepartmentController@list');

        Route::delete("/delete/recruitment/{id}", 'AdminController@deleteRecruitmet');
        Route::get('/stop/recruitment', function(){
            return response()->json(['status'=>403]);
        });
        Route::post('/stop/recruitment', 'AdminController@stopRecruitment');
        Route::get('/export/{id}', 'AdminController@exportByID');

        Route::get('/closed/recruitment', function(){
            return response()->json(['status'=>403]);
        });
        Route::post('/closed/recruitment', 'AdminController@closeRecruitment');

        Route::post('/profile', 'UserProfileController@search');
        Route::post('/updatestudentprofile', 'UserProfileController@update');
        Route::post('/update-admin-department', 'DepartmentManageController@updateAdmin');
        Route::post('/user-detail', 'UserManageController@userdetail');
        Route::post('/update-user', 'UserManageController@updateUser');
        Route::post('/result-update', 'ApplyController@updateResult');
        Route::post('/sentdept-update', 'ApplyController@updateSentdept');
        Route::post('/interview-update', 'ApplyController@updateInterview');
	});
});

?>