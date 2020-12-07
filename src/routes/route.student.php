<?php 

/* Route for student*/
Route::group(['middleware' => ['student']], function () {
   // Route::get('/home', 'HomeController@index');
    Route::group(['prefix' => '{lang}/profile'], function($lang){
        
        Route::get('/home', 'ProfileController@home');
        /* ข้อมูลส่วนตัว */
        Route::get('/myprofile', 'ProfileController@myprofile');
        Route::post('/myprofile', 'ProfileController@myprofileSave');

        /* ข้อมูลการศึกษา */
        Route::get('/education', 'ProfileController@education');
        Route::post('/education', 'ProfileController@educationSave');

        /* ผลงาน */
        Route::get('/transcript', 'ProfileController@transcript');
        Route::post('/transcript', 'ProfileController@transcriptSave');
    });

    Route::group(['prefix' => '{lang}'], function($lang){
        /* Apply Route */
        Route::get('/apply', 'ApplyController@index'); //landing and all
        Route::post('/apply', 'ApplyController@search'); //search

        /* Create Application to Apply */
        Route::get('/apply/{id}', 'ApplyController@application');
        Route::post('/apply/{id}', 'ApplyController@apply');

        /* Application List*/
        Route::get('/application', 'ApplicationController@index');
        /* view own application */
        Route::get('/application/{id}','ApplicationController@view');
    });


    Route::group(['prefix' => 'userapi'], function(){
        Route::get('/department', 'DepartmentController@listAll');
        Route::post('/department', 'DepartmentController@list');
        Route::get('/cancel/app/{id}', function($id){
            return response()->json(['id'=>$id,'command'=>"DELETE",'status'=> 'Fail']);
        });
        Route::delete('/cancel/app/{id}', 'ApplicationController@cancel');
    });

});

?>