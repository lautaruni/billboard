<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'api'],function(){
	Route::get('billboard/getweek/{start}','ApibillboardController@getWeek');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
	Route::get('/','DashboardController@index');
	Route::get('events/showdates/{id}','EventController@showdates');
	Route::get('events/casting/{id}','EventController@casting');
	Route::resource('events','EventController');
	Route::resource('venues','VenueController');
	Route::resource('companies','CompanyController');
	Route::resource('categories','CategoryController');
	Route::resource('people','PersonController');
	Route::resource('rols','RolController');
	Route::resource('reviews','ReviewController');
	Route::resource('dispatches','DispatchController');
	Route::resource('users','UserController');
});
