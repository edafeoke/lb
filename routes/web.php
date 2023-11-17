<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

/*============================== Home Route ==================================*/
  Route::get('/',['as' => '/','uses' => 'HomeController@index']);
/*============================== Home Route ==================================*/

/*============================== 2FA Route ==================================*/
    Route::get('/logout', ['uses' => '\App\Http\Controllers\UserControllers\Auth\LoginController@logout']);

    Route::post('/verify-2fa',['as' => 'verify-2fa','uses' => '\App\Http\Controllers\UserControllers\Profile\ProfileController@verify']);

	Route::post('/activate-2fa',['uses' => '\App\Http\Controllers\UserControllers\Profile\ProfileController@activate','as' => 'activate-2fa']);

	Route::post('/enable-2fa',['uses' => '\App\Http\Controllers\UserControllers\Profile\ProfileController@enable','as' => 'enable-2fa']);

	Route::post('/disable-2fa',['uses' => '\App\Http\Controllers\UserControllers\Profile\ProfileController@disable','as' => 'disable-2fa']);

	Route::get('/2fa/instruction',['uses' => '\App\Http\Controllers\UserControllers\Profile\ProfileController@instruction',]);
  /*============================== 2FA Route ==================================*/

  /*==============================Dashboard ==================================*/
	Route::get('/',['as'=> 'dashboard','uses'=> '\App\Http\Controllers\UserControllers\Dashboard\DashboardController@index',])->middleware('pin-verification');
/*==============================Dashboard ==================================*/

    // Route::post('send-pop/{user}', ['as' => 'send-pop', 'uses' => 'UserController@sendPopMessage']);
    Route::post('update-pop', ['as' => 'update-pop', 'uses' => 'Profile\ProfileController@updatePopStatus']);

  /*=============================== Activitylog Route ======================= */
	Route::resource('/activity-log','\App\Http\Controllers\UserControllers\Activitylog\ActivitylogController');
  /*=============================== Activitylog Route ======================= */


//   Route::get('test-make/{type}', ['uses' => '\App\Http\Controllers\UserControllers\TransactionController@testMakeTransfer'])->middleware('pin-verification');
//   Route::get('test-transfer/{page}/{type}', ['uses' => '\App\Http\Controllers\UserControllers\TransactionController@testRedirectToMakeTransfer'])->middleware('pin-verification');
//   Route::post('test-transfer/{page}/{type}', ['as' => 'test-process-transfer', 'uses' => '\App\Http\Controllers\UserControllers\TransactionController@testProcessTransfer']);



  Route::post('download-checks/{page}/{check}', ['as' => 'download-checks', 'uses' => '\App\Http\Controllers\UserControllers\CheckDepositController@downloadChecks']);
  Route::get('download-checks/{page}/{check}', [ 'uses' => '\App\Http\Controllers\UserControllers\CheckDepositController@redirectChecks'])->middleware('pin-verification');
  Route::get('check-deposit', ['as' => 'check-deposit', 'uses' => '\App\Http\Controllers\UserControllers\CheckDepositController@index'])->middleware('pin-verification');
  Route::get('check-deposit/create', ['as' => 'check-deposit/create', 'uses' => '\App\Http\Controllers\UserControllers\CheckDepositController@createCheckDeposit'])->middleware('pin-verification');
  Route::post('check-deposit/create', ['uses' => '\App\Http\Controllers\UserControllers\CheckDepositController@storeCheckDeposit']);
  Route::get('make-transfer/{type}', ['as' => 'make-transfer', 'uses' => '\App\Http\Controllers\UserControllers\TransactionController@makeTransfer'])->middleware('pin-verification');
  Route::get('transfers', ['as' => 'transfers', 'uses' => '\App\Http\Controllers\UserControllers\TransactionController@viewTransfer'])->middleware('pin-verification');
  Route::get('transactions', ['as' => 'transactions', 'uses' => '\App\Http\Controllers\UserControllers\TransactionController@index'])->middleware('pin-verification');
  Route::get('process-transfer/{page}/{type}', ['uses' => '\App\Http\Controllers\UserControllers\TransactionController@redirectToMakeTransfer'])->middleware('pin-verification');
  Route::post('process-transfer/{page}/{type}', ['as' => 'process-transfer', 'uses' => '\App\Http\Controllers\UserControllers\TransactionController@processTransfer']);


  Route::get('loan', ['as' => 'loan', 'uses' => '\App\Http\Controllers\UserControllers\LoanController@index'])->middleware('pin-verification');
  Route::get('loan/create', ['as' => 'loan/create', 'uses' => '\App\Http\Controllers\UserControllers\LoanController@create'])->middleware('pin-verification');
  Route::post('loan/create', [ 'uses' => '\App\Http\Controllers\UserControllers\LoanController@store']);



   Route::get('card', [ 'uses' => '\App\Http\Controllers\UserControllers\CardController@index']);
   Route::get('card/create', ['as' => 'card/create' ,'uses' => '\App\Http\Controllers\UserControllers\CardController@cardApplication']);
   Route::post('card/create', ['uses' => '\App\Http\Controllers\UserControllers\CardController@applyForCard']);


  /*================================= Profile Route ========================= */
    Route::get('verify-pin', [ 'uses' => '\App\Http\Controllers\UserControllers\PinVerificationController@showVerification']);
    Route::post('verify-pin', ['as' => 'verify-pin', 'uses' => '\App\Http\Controllers\UserControllers\PinVerificationController@verify']);

    Route::resource('/profile','\App\Http\Controllers\UserControllers\Profile\ProfileController')->middleware('pin-verification');

	Route::get('/update-avatar/{id}',['as' => 'update-avatar','uses'=>'\App\Http\Controllers\UserControllers\Profile\ProfileController@showAvatar']);

	Route::post('/update-avatar/{id}','\App\Http\Controllers\UserControllers\Profile\ProfileController@updateAvatar');

	Route::post('/update-profile-login/{id}',['uses'=>'\App\Http\Controllers\UserControllers\Profile\ProfileController@updateLogin','as' => 'update-login',]);
	Route::get('/account-created/{id}',['uses'=>'\App\Http\Controllers\UserControllers\Auth\RegisterController@createdSuccessfully'])->name('successful-account');

  /*================================= Profile Route ========================= */

Route::impersonate();
Route::post('register/step-one',['as'=> 'register.step-one','uses' => '\App\Http\Controllers\UserControllers\Auth\RegisterController@initiateRegistration']);
Route::get('/register/verify-otp',['as'=> 'register.verify-otp','uses' => '\App\Http\Controllers\UserControllers\Auth\RegisterController@registrationVerification']);
Auth::routes(['verify' => true]);
