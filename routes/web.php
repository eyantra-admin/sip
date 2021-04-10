<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

	//Route::get('studentprofile', ['as' => 'studentprofile', 'uses' => 'ProfileController@studentprofile']);
	Route::put('submitform', ['as' => 'submitform', 'uses' => 'ProfileController@submitform']);
	
	Route::any('/attachmentUpload', ['as'=>	'attachmentUpload','uses'=>	'SipRegistration@attachment_upload'
	]);

	Route::any('/studentprofile', ['as'=>	'studentprofile','uses'=>	'ProfileController@studentprofile'
	]);

	Route::get('project', ['as' => 'project.preference', 'uses' => 'HomeController@projectpreference']);
	Route::put('project', ['as' => 'project.preferenceupdate', 'uses' => 'HomeController@preferenceupdate']);
	
	Route::any('/projectdetail/{projectid}','HomeController@getprojectdetail');

	Route::get('changepassword', ['as' => 'changepassword', 'uses' => 'ProfileController@changepassword']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::get('wizard', function () {
    return view('multistepform');
});



Route::any('/SipRegistration', [
	'as'			=>	'SipRegistration',
	'uses'			=>	'SipRegistration@registerload'
	])->middleware('auth');
	Route::any('/submitprofile', [
	'as'			=>	'submitprofile',
	'uses'			=>	'SipRegistration@submitprofile'
	])->middleware('auth');


	Route::any('/getstatewiseColleges', [
	'as'			=>	'getstatewiseColleges',
	'uses'			=>	'HomeController@getstatewiseColleges'
	]);
	Route::any('/getCountrywiseStates', [
	'as'			=>	'getCountrywiseStates',
	'uses'			=>	'HomeController@getCountrywiseStates'
	]);
	Route::any('/getcollegeinfo', [
	'as'			=>	'getcollegeinfo',
	'uses'			=>	'elsiRegistrationResponse@getcollegeinfo'
	]);



