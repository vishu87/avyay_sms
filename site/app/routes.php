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
		Route::get('/','AdminController@addStudent');
		Route::post('/store','AdminController@storeStudent');
		Route::post('/getCenter','AdminController@getCenter');
		Route::post('/getGroup','AdminController@getGroup');
		Route::post('/getFee','AdminController@getFee');
		Route::post('/calDate','AdminController@calDate');
	});
	Route::group(array("prefix"=>'manage',"before"=>'auth'),function(){
		Route::get('/','AdminManageController@index');
		Route::group(array("prefix"=>'cities',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexCity');
			Route::get('/add','AdminManageController@addCity');
			Route::post('/insert','AdminManageController@insertCity');
			Route::delete('/deleteCity/{id}','AdminManageController@deleteCity');
			Route::get('/editCity/{id}','AdminManageController@editCity');
			Route::put('/update/{id}','AdminManageController@updateCity');
		});

		Route::group(array("prefix"=>'centers',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexCenters');
		});
		Route::group(array("prefix"=>'members',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexMembers');
		});
		Route::group(array("prefix"=>'groups',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexGroups');
		});
	});
});