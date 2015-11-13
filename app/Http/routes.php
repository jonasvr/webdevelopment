<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/',         ['as' => 'home',        'uses' => 'HomeController@index']);

//Route::get('/home', 'HomeController@index');
Route::get('/home', 		['as' => 'home', 		'uses' => 'HomeController@index']);


// Authentication routes...
Route::get('/login', 		['as' => 'login', 		'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 	[				 		'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', 		['as' => 'logout', 		'uses' => 'Auth\AuthController@getLogout']);


// Registration routes...
Route::get('/register', 	['as' => 'register', 	'uses' => 'Auth\AuthController@getRegister']);
Route::post('/register', 	[						'uses' => 'Auth\AuthController@postRegister']);


//quiz spelen
Route::get('/play',                     ['as' => 'play',                    'uses' => 'InquiryController@play']);
Route::post('/awnser',                  ['as' => 'awnser',                  'uses' => 'InquiryController@awnser']);

Route::get('/winner',     ['as' => 'winner',                  'uses' => 'testController@mail']);



//  restrictions

Route::group(['middleware' => 'admin'], function(){
	// participant
	Route::get('/participants',                 ['as' => 'participants',                'uses' => 'ParticipantsController@index']);
	Route::get('/participants/delete/{id}',     ['as' => 'participants/delete',         'uses' => 'ParticipantsController@delete']);

	// quize aanmaken
	Route::get('/createinquiry',                ['as' => 'createinquiry',               'uses' => 'InquiryController@index']);
	Route::post('/addInquiry',                  ['as' => 'addInquiry',                  'uses' => 'InquiryController@create']);

	//upcoming
	Route::get('/upcoming',                 ['as' => 'upcoming',                'uses' => 'UpcomingController@index']);
});