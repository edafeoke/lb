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


/*============================== Home Route ==================================*/

    Route::get('/logout', ['uses' => '\App\Http\Controllers\AdminControllers\Auth\LoginController@logout']);

    Route::post('/verify-2fa',['as' => 'verify-2fa','uses' => 'Profile\ProfileController@verify']);

	Route::post('/activate-2fa',['uses' => 'Profile\ProfileController@activate','as' => 'activate-2fa']);

	Route::post('/enable-2fa',['uses' => 'Profile\ProfileController@enable','as' => 'enable-2fa']);

	Route::post('/disable-2fa',['uses' => 'Profile\ProfileController@disable','as' => 'disable-2fa']);

	Route::get('/2fa/instruction',['uses' => 'Profile\ProfileController@instruction',]);

  /*==============================Dashboard ==================================*/
	Route::get('/',['as'=> 'admin','uses'=> '\App\Http\Controllers\AdminControllers\Dashboard\DashboardController@index',]);
  /*==============================Dashboard ==================================*/

  /*=============================== Activitylog Route ======================= */
	Route::resource('/activity-log','Activitylog\ActivitylogController');
  /*=============================== Activitylog Route ======================= */


  /*================================= Profile Route ========================= */

    Route::resource('/profile','Profile\ProfileController');

	Route::get('/update-avatar/{id}',['as' => 'update-avatar','uses'=>'Profile\ProfileController@showAvatar']);

	Route::post('/update-avatar/{id}','Profile\ProfileController@updateAvatar');

	Route::post('/update-profile-login/{id}',['uses'=>'Profile\ProfileController@updateLogin','as' => 'update-login',]);

  /*================================= Profile Route ========================= */

// Users Route
    Route::post('send-pop/{user}', ['as' => 'send-pop', 'uses' => 'UserController@sendPopMessage']);
    Route::post('update-pop', ['as' => 'update-pop', 'uses' => 'Profile\ProfileController@updatePopStatus']);
	Route::resource('/user','UserController');
	Route::post('update-account/{user}',['as' => 'update-account','uses'=>'UserController@updateAccount']);
	Route::get('user/{id}/activity-log/',['as' => 'user-activitlog','uses'=>'UserController@userActivityLog']);
  // Users Route


// Roles Route
	Route::resource('/role','Role\RoleController');
	Route::post('/role-permission/{id}',['as' => 'roles_permit','uses' => 'Role\RoleController@assignPermission',]);
// Roles Route


    Route::get('/card', ['uses' => '\App\Http\Controllers\AdminControllers\AccountController@viewCards']);
    Route::get('/card/update/{card}', ['as' => '/card/update','uses' => '\App\Http\Controllers\AdminControllers\AccountController@editCards']);
    Route::post('/card/update/{card}', ['uses' => '\App\Http\Controllers\AdminControllers\AccountController@updateCards']);
    Route::get('/card-action/{action}/{card}', ['uses' => '\App\Http\Controllers\AdminControllers\AccountController@cardAction']);


    Route::get('/loan-action/{action}/{loan}', ['as' => 'loan-action', 'uses' => '\App\Http\Controllers\AdminControllers\AccountController@loanAction']);
    Route::get('/loan', ['as' => 'loan', 'uses' => '\App\Http\Controllers\AdminControllers\AccountController@viewLoans']);

    Route::get('check-action/{action}/{check}', ['as' => 'check-action', 'uses' => '\App\Http\Controllers\AdminControllers\CheckDepositController@checkAction']);
    Route::post('download-checks/{page}/{check}', ['as' => 'download-checks', 'uses' => '\App\Http\Controllers\AdminControllers\CheckDepositController@downloadChecks']);
    Route::get('download-checks/{page}/{check}', ['uses' => '\App\Http\Controllers\AdminControllers\CheckDepositController@redirectChecks']);
    Route::get('/check-deposit', '\App\Http\Controllers\AdminControllers\CheckDepositController@index');
    Route::resource('/accounts', '\App\Http\Controllers\AdminControllers\AccountController');
    Route::get('/credit/account', '\App\Http\Controllers\AdminControllers\AccountController@creditAccount');
    Route::get('/debit/account', '\App\Http\Controllers\AdminControllers\AccountController@debitAccount');
    Route::post('/credit-debit/account/{action}', '\App\Http\Controllers\AdminControllers\AccountController@creditOrDebit');
    Route::get('/history/account', '\App\Http\Controllers\AdminControllers\AccountController@creditAndDebitHistory');
    Route::get('/transfers', '\App\Http\Controllers\AdminControllers\AccountController@viewTransfer');
    Route::get('/transfer-action/{action}/{transaction}', '\App\Http\Controllers\AdminControllers\AccountController@transferAction');

   // Permission Route
	Route::resource('/permission','Permission\PermissionController');
   // Permission Route

    Route::resource('/settings','Settings\SettingsController');

    Route::post('/settings/app-name/update',[
        'as' => 'settings/app-name/update',
        'uses' => 'Settings\SettingsController@appNameUpdate',
    ]);

    Route::post('/settings/app-logo/update',[
        'as' => 'settings/app-logo/update',
        'uses' => 'Settings\SettingsController@appLogoUpdate',
    ]);

    Route::post('/settings/app-background-image/update',[
        'as' => 'settings/app-background-image/update',
        'uses' => 'Settings\SettingsController@appBackgroundImageUpdate',
    ]);

    Route::post('/settings/app-theme/update',[
        'as' => 'settings/app-theme/update',
        'uses' => 'Settings\SettingsController@appThemeUpdate',
    ]);

    Route::post('/settings/auth-settings/update',[
        'as' => 'settings/auth-settings/update',
        'uses' => 'Settings\SettingsController@authSettingsUpdate',
    ]);

Route::impersonate();

Auth::routes(['verify' => true,'register' => false]);
