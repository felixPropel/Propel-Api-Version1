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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    //Person//
    // Route::post('/get_stage', 'App\Http\Controllers\Person\PersonController@get_stage')->name('get_stage.api');

    // Route::post('/check_for_email', 'App\Http\Controllers\Person\PersonController@check_for_email')->name('check_for_email.api');
    // Route::post('check_person', 'App\Http\Controllers\Person\PersonController@check_person')->name('check_person');

    // Route::post('/temp_update', 'App\Http\Controllers\Person\PersonController@temp_update')->name('temp_update.api');
    // Route::post('/update_person_details', 'App\Http\Controllers\Person\PersonController@update_person_details')->name('update_person_details.api');
    // Route::post('/person_details_stage1', 'App\Http\Controllers\Person\PersonController@person_details_stage1')->name('person_details_stage1.api');
    // Route::post('/person_details_stage2', 'App\Http\Controllers\Person\PersonController@person_details_stage2')->name('person_details_stage2.api');
    // Route::post('/create_user', 'App\Http\Controllers\Person\PersonController@create_user')->name('create_user.api');
    // Route::post('/upload_pic', 'App\Http\Controllers\Person\PersonController@upload_pic')->name('upload_pic.api');
    // Route::post('/person_details_by_uid', 'App\Http\Controllers\Person\PersonController@person_details_by_uid')->name('person_details_by_uid.api');
    // Route::post('/complete_profile', 'App\Http\Controllers\Person\PersonController@complete_profile')->name('complete_profile.api');
    // Route::get('/get_gender_and_blood_group', 'App\Http\Controllers\Person\PersonController@get_gender_and_blood_group')->name('get_gender_and_blood_group.api');
    // Route::get('/get_mobile', 'App\Http\Controllers\Person\PersonController@get_mobile')->name('get_mobile.api');
    // Route::post('/get_cities_by_state', 'App\Http\Controllers\Person\PersonController@get_cities_by_state')->name('get_cities_by_state.api');
    // Route::get('/get_profile_details', 'App\Http\Controllers\Person\PersonController@get_profile_details')->name('get_profile_details.api');
    // Route::post('/person_details_update', 'App\Http\Controllers\Person\PersonController@person_details_update')->name('person_details_update.api');
    // Route::post('/person_details_update_extra', 'App\Http\Controllers\Person\PersonController@person_details_update_extra')->name('person_details_update_extra.api');
    // Route::post('/store_mobile', 'App\Http\Controllers\Person\PersonController@store_mobile')->name('store_mobile.api');
    // Route::post('/make_primary', 'App\Http\Controllers\Person\PersonController@make_primary')->name('make_primary.api');
    // Route::post('/make_email_primary', 'App\Http\Controllers\Person\PersonController@make_email_primary')->name('make_email_primary.api');
    // Route::post('/make_email_secondary', 'App\Http\Controllers\Person\PersonController@make_email_secondary')->name('make_email_secondary.api');
    // Route::post('/make_email_primary_secondary', 'App\Http\Controllers\Person\PersonController@make_email_primary_secondary')->name('make_email_primary_secondary.api');
    // Route::post('/delete_other', 'App\Http\Controllers\Person\PersonController@delete_other')->name('delete_other.api');
    // Route::post('/delete_other_email', 'App\Http\Controllers\Person\PersonController@delete_other_email')->name('delete_other_email.api');
    // //Person//

    // Route::post('/login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('login.api');
    // Route::post('/register', 'App\Http\Controllers\Auth\ApiAuthController@register')->name('register.api');
    // Route::get('/get_states', 'App\Http\Controllers\Auth\ApiAuthController@get_states')->name('get_states.api');
    // Route::get('/get_email', 'App\Http\Controllers\Auth\ApiAuthController@get_email')->name('get_email.api');
    // Route::post('/update_otp', 'App\Http\Controllers\Auth\ApiAuthController@update_otp')->name('update_otp.api');
    // Route::post('/get_account_details', 'App\Http\Controllers\Auth\ApiAuthController@get_account_details')->name('get_account_details.api');
    // Route::get('/check_person', 'App\Http\Controllers\Auth\ApiAuthController@check_person')->name('check_person.api');
    // Route::get('/check_person_email', 'App\Http\Controllers\Auth\ApiAuthController@check_person_email')->name('check_person_email.api');
    // Route::get('/get_temp_status', 'App\Http\Controllers\Auth\ApiAuthController@get_temp_status')->name('get_temp_status.api');
    // Route::get('/check_user', 'App\Http\Controllers\Auth\ApiAuthController@check_user')->name('check_user.api');
    // Route::post('/temp_user_mobile', 'App\Http\Controllers\Auth\ApiAuthController@temp_user_mobile')->name('temp_user_mobile.api');
    // Route::post('/update_temp_user_email', 'App\Http\Controllers\Auth\ApiAuthController@update_temp_user_email')->name('update_temp_user_email.api');
    // Route::post('/check_confirmation', 'App\Http\Controllers\Auth\ApiAuthController@check_confirmation')->name('check_confirmation.api');



    // Route::post('/person_registration_otp', 'App\Http\Controllers\Auth\ApiAuthController@person_registration_otp')->name('person_registration_otp.api');
    // Route::post('/update_password', 'App\Http\Controllers\Auth\ApiAuthController@update_password')->name('update_password.api');
    // Route::post('/forgot_password', 'App\Http\Controllers\Auth\ApiAuthController@forgot_password')->name('forgot_password.api');
    // Route::post('/submit_organisation', 'App\Http\Controllers\Auth\ApiAuthController@submit_organisation')->name('submit_organisation.api');
    // Route::post('/temp_organisation_stage_one', 'App\Http\Controllers\Auth\ApiAuthController@temp_organisation_stage_one')->name('temp_organisation_stage_one.api');
    // Route::post('/temp_organisation_stage_two', 'App\Http\Controllers\Auth\ApiAuthController@temp_organisation_stage_two')->name('temp_organisation_stage_two.api');
    // Route::post('/temp_organisation_stage_three', 'App\Http\Controllers\Auth\ApiAuthController@temp_organisation_stage_three')->name('temp_organisation_stage_three.api');
    // Route::post('/temp_organisation_stage_four', 'App\Http\Controllers\Auth\ApiAuthController@temp_organisation_stage_four')->name('temp_organisation_stage_four.api');
    // Route::post('/temp_organisation_stage_five', 'App\Http\Controllers\Auth\ApiAuthController@temp_organisation_stage_five')->name('temp_organisation_stage_five.api');
    // Route::get('/GenerateDB', 'App\Http\Controllers\Auth\ApiAuthController@GenerateDB')->name('GenerateDB.api');
    // Route::get('/GetGSTDetails', 'App\Http\Controllers\Auth\ApiAuthController@GetGSTDetails')->name('GetGSTDetails.api');
    //Repository Calls
    // Route::get('show', [HomeController::class, 'index'])->name('show.api');
    //Repository Calls Ends//

    // include_once('Person/personApi.php');
    include_once('v1/person.php');
    include_once('v1/user.php');
    include_once('v1/common.php');
 
});

Route::middleware('auth:api')

    ->group(function () {

        Route::post('/get_user_data', 'App\Http\Controllers\version1\Controller\User\UserController@get_user_data')->name('get_user_data');
        Route::post('/logout', 'App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
        // Route::post('changePassword', 'App\Http\Controllers\version1\Controller\User\UserController@changePassword')->name('changePassword');

        include_once('v1/organization.php');        
        include_once('v1/HRM/Masters/hrmMasterApi.php');
        include_once('v1/HRM/Transaction/hrmTransactionApi.php');
    });
