<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response'], 'namespace' => 'App\Http\Controllers'], function () {

    //Person//
    Route::post('/get_stage', 'Person\PersonController@get_stage')->name('get_stage.api');
    Route::post('/check_for_email', 'Person\PersonController@check_for_email')->name('check_for_email.api');
    Route::post('/temp_update', 'Person\PersonController@temp_update')->name('temp_update.api');
    Route::post('/update_person_details', 'Person\PersonController@update_person_details')->name('update_person_details.api');
    Route::post('/person_details_stage1', 'Person\PersonController@person_details_stage1')->name('person_details_stage1.api');
    Route::post('/person_details_stage2', 'Person\PersonController@person_details_stage2')->name('person_details_stage2.api');
    Route::post('/create_user', 'Person\PersonController@create_user')->name('create_user.api');
    Route::post('/upload_pic', 'Person\PersonController@upload_pic')->name('upload_pic.api');
    Route::post('/person_details_by_uid', 'Person\PersonController@person_details_by_uid')->name('person_details_by_uid.api');
    Route::post('/complete_profile', 'Person\PersonController@complete_profile')->name('complete_profile.api');
    Route::get('/get_gender_and_blood_group', '@get_gender_and_blood_group')->name('get_gender_and_blood_group.api');
    Route::get('/get_mobile', 'Person\PersonController@get_mobile')->name('get_mobile.api');
    //Person//

    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register', 'Auth\ApiAuthController@register')->name('register.api');
   

    Route::get('/get_states', 'Auth\ApiAuthController@get_states')->name('get_states.api');

    Route::get('/get_email', 'Auth\ApiAuthController@get_email')->name('get_email.api');
    Route::post('/update_otp', 'Auth\ApiAuthController@update_otp')->name('update_otp.api');
    Route::get('/get_profile_details', 'Auth\ApiAuthController@get_profile_details')->name('get_profile_details.api');
    Route::post('/get_account_details', 'Auth\ApiAuthController@get_account_details')->name('get_account_details.api');

    Route::get('/check_person', 'Auth\ApiAuthController@check_person')->name('check_person.api');
    Route::get('/check_person_email', 'Auth\ApiAuthController@check_person_email')->name('check_person_email.api');
    Route::get('/get_temp_status', 'Auth\ApiAuthController@get_temp_status')->name('get_temp_status.api');
    Route::get('/check_user', 'Auth\ApiAuthController@check_user')->name('check_user.api');
    Route::post('/temp_user_mobile', 'Auth\ApiAuthController@temp_user_mobile')->name('temp_user_mobile.api');
    Route::post('/update_temp_user_email', 'Auth\ApiAuthController@update_temp_user_email')->name('update_temp_user_email.api');

    Route::post('/check_confirmation', 'Auth\ApiAuthController@check_confirmation')->name('check_confirmation.api');
  
    Route::post('/person_details_update', 'Auth\ApiAuthController@person_details_update')->name('person_details_update.api');
    Route::post('/person_details_update_extra', 'Auth\ApiAuthController@person_details_update_extra')->name('person_details_update_extra.api');
  

    
  
  
    Route::post('/person_registration_otp', 'Auth\ApiAuthController@person_registration_otp')->name('person_registration_otp.api');
    Route::post('/update_password', 'Auth\ApiAuthController@update_password')->name('update_password.api');
    Route::post('/forgot_password', 'Auth\ApiAuthController@forgot_password')->name('forgot_password.api');
    Route::post('/store_mobile', 'Auth\ApiAuthController@store_mobile')->name('store_mobile.api');
    Route::post('/make_primary', 'Auth\ApiAuthController@make_primary')->name('make_primary.api');
    Route::post('/make_email_primary', 'Auth\ApiAuthController@make_email_primary')->name('make_email_primary.api');
    Route::post('/make_email_secondary', 'Auth\ApiAuthController@make_email_secondary')->name('make_email_secondary.api');
    Route::post('/make_email_primary_secondary', 'Auth\ApiAuthController@make_email_primary_secondary')->name('make_email_primary_secondary.api');
    Route::post('/delete_other', 'Auth\ApiAuthController@delete_other')->name('delete_other.api');
    Route::post('/delete_other_email', 'Auth\ApiAuthController@delete_other_email')->name('delete_other_email.api');
    Route::post('/submit_organisation', 'Auth\ApiAuthController@submit_organisation')->name('submit_organisation.api');
    Route::post('/temp_organisation_stage_one', 'Auth\ApiAuthController@temp_organisation_stage_one')->name('temp_organisation_stage_one.api');
    Route::post('/temp_organisation_stage_two', 'Auth\ApiAuthController@temp_organisation_stage_two')->name('temp_organisation_stage_two.api');
    Route::post('/temp_organisation_stage_three', 'Auth\ApiAuthController@temp_organisation_stage_three')->name('temp_organisation_stage_three.api');
    Route::post('/temp_organisation_stage_four', 'Auth\ApiAuthController@temp_organisation_stage_four')->name('temp_organisation_stage_four.api');
    Route::post('/temp_organisation_stage_five', 'Auth\ApiAuthController@temp_organisation_stage_five')->name('temp_organisation_stage_five.api');

    //Repository Calls
    Route::get('show', [HomeController::class, 'index'])->name('show.api');
    //Repository Calls Ends//
    include_once('HRM/hrmMasterApi.php');
});

Route::middleware('auth:api')
    ->namespace('App\Http\Controllers')
    ->group(function () {

        Route::post('/get_user_data', 'Auth\ApiAuthController@get_user_data')->name('get_user_data.api');
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    });
