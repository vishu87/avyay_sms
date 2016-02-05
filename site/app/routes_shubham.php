<?php

Route::group(array("prefix"=>'admin',"before"=>'auth'),function(){

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
			Route::get('/','AdminManageController@indexCenter');
			Route::get('/add','AdminManageController@addCenter');
			Route::post('/insert','AdminManageController@insertCenter');
			Route::delete('/delete/{id}','AdminManageController@deleteCenter');
			Route::get('/edit/{id}','AdminManageController@editCenter');
			Route::put('/update/{id}','AdminManageController@updateCenter');
		});
		
		Route::group(array("prefix"=>'groups',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexGroup');
			Route::get('/add','AdminManageController@addGroup');
			Route::post('/insert','AdminManageController@insertGroup');
			Route::delete('/deleteGroup/{id}','AdminManageController@deleteGroup');
			Route::get('/edit/{id}','AdminManageController@editGroup');
			Route::put('/update/{id}','AdminManageController@updateGroup');
		});

		Route::group(array("prefix"=>'members',"before"=>'auth'),function(){
			Route::get('/','AdminManageController@indexMember');
			Route::get('/add','AdminManageController@addMember');
			Route::post('/insert','AdminManageController@insertMember');
			Route::delete('/delete/{id}','AdminManageController@deleteMember');
			Route::get('/edit/{id}','AdminManageController@editMember');
			Route::put('/update/{id}','AdminManageController@updateMember');
		});
	});
});