<?php

/* Not Authentication routes */
Route::get('/','UserController@login');
Route::get('/login','UserController@login');

Route::post('/loginUser','UserController@postLogin');

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

// App::missing(function($exception)
// {	
	
// 	return View::make('404');
// });
// App::error(function(Exception $exception, $code) 
// {
   
// 	return View::make('404');
// });

Route::group(array("prefix"=>'admin',"before"=>'auth'),function(){
	Route::get('/','AdminController@index');
	
	Route::group(array("prefix"=>'student',"before"=>'auth'),function(){
		Route::get('/','StudentController@addStudent');
		Route::post('/store','StudentController@storeStudent');
		Route::post('/getCenter','StudentController@getCenter');
		Route::post('/getGroup','StudentController@getGroup');
		Route::post('/getFee','StudentController@getFee');
		Route::post('/calDate','StudentController@calDate');
		Route::get('/viewAllStudent','StudentController@viewAllStudent');
	});

});

include('routes_shubham.php');