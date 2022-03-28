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

//Auth::routes();
// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('registration', 'Auth\RegisterController@showRegistrationForm')->name('registration');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes();

Route::any('/home', 'HomeController@index')->name('home');
//see dashboard after profile submission
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard'])->middleware('auth');
Route::any('/error', 'HomeController@error')->name('error');

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

	Route::put('profile', ['as' => 'profile.updateSection1', 'uses' => 'ProfileController@updateSectionData']);
	Route::put('profileupdate', ['as' => 'profileupdate', 'uses' => 'ProfileController@updateSectionData']);
	Route::put('updateexp', ['as' => 'updateexp', 'uses' => 'ProfileController@updateSection4']);
	Route::put('updateproj', ['as' => 'updateproj', 'uses' => 'ProfileController@updateproj']);
	Route::put('updatecomp', ['as' => 'updatecomp', 'uses' => 'ProfileController@updateSectionData']);






	// Change Password
	Route::get('changepassword', ['as' => 'changepassword', 'uses' => 'ProfileController@changepassword']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('projectpreference', ['as' => 'projectpreference', 'uses' => 'HomeController@projectpreference']);
	Route::put('project', ['as' => 'project.preferenceupdate', 'uses' => 'HomeController@preferenceupdate']);
	Route::any('/projectdetail/{projectid}','HomeController@getprojectdetail');

	Route::get('project', ['as' => 'project.addproject', 'uses' => 'HomeController@addproject']);
	Route::post('insertproject', ['as' => 'insertproject', 'uses' => 'HomeController@insertproject']);
	
	Route::post('project', ['as' => 'project.savementorproject', 'uses' => 'HomeController@savementorproject']);
	
	Route::any('/viewpreferences', ['as'=>'viewpreferences','uses'=>'HomeController@viewpreferences'
	]);
	Route::any('/viewtimeslot', ['as'=>'viewtimeslot','uses'=>'HomeController@viewtimeslot'
	]);
	

	Route::get('timeslotbooking', ['as' => 'timeslotbooking', 'uses' => 'HomeController@timeslotbooking']);
	Route::any('gettimeslot', ['as' => 'gettimeslot', 'uses' => 'HomeController@gettimeslot']);
	Route::put('booktimeslot', ['as' => 'booktimeslot', 'uses' => 'HomeController@booktimeslot']);


	Route::get('Evaluation', ['as' => 'Evaluation', 'uses' => 'InterviewController@Evaluation']);
	Route::get('EvaluationResult', ['as' => 'EvaluationResult', 'uses' => 'InterviewController@EvaluationResult']);
	Route::put('EvaluationSubmit', ['as' => 'EvaluationSubmit', 'uses' => 'InterviewController@EvaluationSubmit']);
	// Route::get('UserEvaluation/{user}', ['as' => 'EvaluationResult', 'uses' => 'InterviewController@EvaluationResult']);
	
});

Route::get('wizard', function () {
    return view('multistepform');
});



Route::any('/SipRegistration', [
	'as'			=>	'SipRegistration',
	'uses'			=>	'SipRegistration@registerload'
	])->middleware('auth');
Route::any('/OldSipRegistration', [
	'as'			=>	'OldSipRegistration',
	'uses'			=>	'SipRegistration@OldSipRegistration'
	])->middleware('auth');

Route::any('/submitSection1', [
	'as'			=>	'submitSection1',
	'uses'			=>	'SipRegistration@submitSection1'
	])->middleware('auth');

Route::any('/submitSection2', [
	'as'			=>	'submitSection2',
	'uses'			=>	'SipRegistration@submitSection2'
	])->middleware('auth');
Route::any('/submitSection3', [
	'as'			=>	'submitSection3',
	'uses'			=>	'SipRegistration@submitSection3'
	])->middleware('auth');
Route::any('/submitSection4', [
	'as'			=>	'submitSection4',
	'uses'			=>	'SipRegistration@submitSection4'
	])->middleware('auth');
Route::any('/submitSection5', [
	'as'			=>	'submitSection5',
	'uses'			=>	'SipRegistration@submitSection5'
	])->middleware('auth');
Route::any('/submitSection6', [
	'as'			=>	'submitSection6',
	'uses'			=>	'SipRegistration@submitSection6'
	])->middleware('auth');





Route::any('/submitprofile', [
	'as'			=>	'submitprofile',
	'uses'			=>	'SipRegistration@submitprofile'
	])->middleware('auth');


Route::any('/attachmentUpload', ['as'=>	'attachmentUpload','uses'=>	'SipRegistration@attachment_upload'
	])->middleware('auth');

Route::any('/SipView', ['as'=>	'SipView','uses'=>	'SipRegistration@sip_view'])->middleware('auth');
Route::any('/SipStudent/{user}', 'SipRegistration@sip_student')->middleware('auth');
Route::any('/ViewMyRegistration/{user}', 'SipRegistration@ViewMyRegistration')->middleware('auth');
Route::any('/back', 'SipRegistration@back')->middleware('auth');
Route::any('/downloadCertificate/{studentid}','SipRegistration@download_certificate')->middleware('auth');

Route::any('/upload', ['as'=>'upload','uses'=>'HomeController@Upload'])->middleware('auth');

Route::any('/survey', ['as'=>'survey','uses'=>'HomeController@preintershipsurvey'])->middleware('auth');
Route::any('/submitsurvey', ['as'=>'submitsurvey','uses'=>'HomeController@submitsurvey'])->middleware('auth');
Route::any('/faq', ['as'=>'faq','uses'=>'HomeController@faq'])->middleware('auth');
Route::any('/nda', ['as'=>'nda','uses'=>'HomeController@nda'])->middleware('auth');
Route::any('/submitnda', ['as'=>'submitnda','uses'=>'HomeController@submitnda'])->middleware('auth');

Route::get('/all-nda', [
	'middleware'	=>	'auth',
	'as'			=>	'nda_all',
	'uses'			=>	'HomeController@listAllnda'
	]);
Route::any('/download-nda/{id}', ['as'=>'download_nda_all','uses'=>'HomeController@downloadNDA'])->middleware('auth');

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
Route::any('/verifydetails', ['as'=>'verifydetails','uses'=>'HomeController@verifydetails'])->middleware('auth');
Route::any('/AcceptVerify', ['as'=>'AcceptVerify','uses'=>'HomeController@AcceptVerify'])->middleware('auth');


Route::any('/mentorclearence', ['as'=>'mentorclearence','uses'=>'HomeController@mentorclearence'])->middleware('auth');
Route::any('/approveclearence/{userid}', ['as'=>'approveclearence','uses'=>'HomeController@approveclearence'])->middleware('auth');





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

	/**************** certificate for students ****************/
		Route::get('/generate/run', [
		'as' 			=> 'GenerateCertificate',
		'uses' 			=> 'Generate@run'
		]);

		Route::get('validate', 'ValidateController@index')->name('validate');
		Route::post('validate', 'ValidateController@verify');
		Route::get('validate/{id}', 'ValidateController@authenticate');





		Route::get('profiledtl', ['as' => 'profiledtl', 'uses' => 'SipRegistration@registerload']); 
		Route::any('submit-profile', ['as' => 'SubmitProfile', 'uses' => 'ProfileControllerNew@SubmitProfile']);

		Route::any('/View_profiles', ['as'=>'View_profiles','uses'=>'HomeController@View_studentprofiles'
	])->middleware('auth');

