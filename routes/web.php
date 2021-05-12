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

// Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes();

Route::any('/home', 'HomeController@index')->name('home')->middleware('auth');
//see dashboard after profile submission
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard'])->middleware('auth');

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

Route::group(['middleware' => 'auth'], function () 
{
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

	// Change Password
	Route::get('changepassword', ['as' => 'changepassword', 'uses' => 'ProfileController@changepassword']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::put('submitform', ['as' => 'submitform', 'uses' => 'ProfileController@submitform']);
	Route::any('/studentprofile', ['as'=>'studentprofile','uses'=>'ProfileController@studentprofile'
	]);

	Route::get('project', ['as' => 'project.preference', 'uses' => 'HomeController@projectpreference']);
	Route::put('project', ['as' => 'project.preferenceupdate', 'uses' => 'HomeController@preferenceupdate']);
	Route::any('/projectdetail/{projectid}','HomeController@getprojectdetail');
	
	Route::any('/viewpreferences', ['as'=>'viewpreferences','uses'=>'HomeController@viewpreferences'
	]);
	Route::any('/viewtimeslot', ['as'=>'viewtimeslot','uses'=>'HomeController@viewtimeslot'
	]);
	

	Route::get('timeslotbooking', ['as' => 'timeslotbooking', 'uses' => 'HomeController@timeslotbooking']);
	Route::any('gettimeslot', ['as' => 'gettimeslot', 'uses' => 'HomeController@gettimeslot']);
	Route::put('booktimeslot', ['as' => 'booktimeslot', 'uses' => 'HomeController@booktimeslot']);
	
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
Route::any('/attachmentUpload', ['as'=>	'attachmentUpload','uses'=>	'SipRegistration@attachment_upload'
	])->middleware('auth');

Route::any('/SipView', ['as'=>	'SipView','uses'=>	'SipRegistration@sip_view']);
Route::any('/SipStudent/{user}', 'SipRegistration@sip_student');
Route::any('/ViewMyRegistration/{user}', 'SipRegistration@ViewMyRegistration');

Route::any('/downloadCertificate/{studentid}','SipRegistration@download_certificate');

Route::any('/upload', ['as'=>'upload','uses'=>'HomeController@Upload'])->middleware('auth');

Route::any('/survey', ['as'=>'survey','uses'=>'HomeController@preintershipsurvey'])->middleware('auth');
Route::any('/submitsurvey', ['as'=>'submitsurvey','uses'=>'HomeController@submitsurvey'])->middleware('auth');
Route::any('/faq', ['as'=>'faq','uses'=>'HomeController@faq'])->middleware('auth');
Route::any('/nda', ['as'=>'nda','uses'=>'HomeController@nda'])->middleware('auth');
Route::any('/submitnda', ['as'=>'submitnda','uses'=>'HomeController@submitnda'])->middleware('auth');
	Route::any('/getstatewiseColleges', [
	'as'			=>	'getstatewiseColleges',
	'uses'			=>	'HomeController@getstatewiseColleges'
	]);
	Route::any('/getCountrywiseStates', [
	'as'			=>	'getCountrywiseStates',
	'uses'			=>	'HomeController@getCountrywiseStates'
	]);
	// Route::any('/getcollegeinfo', [
	// 'as'			=>	'getcollegeinfo',
	// 'uses'			=>	'elsiRegistrationResponse@getcollegeinfo'
	// ]);





	//get log info
Route::prefix('admin')->group(function () {
Route::get('downloadLogFile', 'LogController@downloadLogFile');
Route::get('viewLogFile', 'LogController@viewLogFile');
Route::get('eraseLogFile', 'LogController@eraseLogFile');
});

Route::get('/log/downloadLogFile/{year}/{month}/{date}', 'LogController@downloadLogFile');
Route::get('/log/viewLogFile/{year}/{month}/{date}', 'LogController@viewLogFile');
Route::get('/log/eraseLogFile/{year}/{month}/{date}', 'LogController@eraseLogFile');





//Payment routes

	Route::get('/api/ir','PaymentController@paymentImmediateResponse');//immediateresponse
	Route::get('/api/recon','PaymentController@reconcile'); //reconcile 


	//authenticated
	Route::get('get-payment-info','PaymentController@getPaymentInfo')->name('paymentpage')->middleware('auth');
	Route::post('make-payment','PaymentController@makePayment')->middleware('auth');

	//for admin use
	Route::get('/fetchrecon/{user_id}','PaymentController@reconciliationForUser'); //request server for ir response
	Route::get('/fetchir/{user_id}','PaymentController@immediateResponseForUser'); //request server for recon response