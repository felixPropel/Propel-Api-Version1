<?php

use Illuminate\Support\Facades\Route;


// searching Part Start
//@Developer Dhana

Route::post('findMobileNumber', 'App\Http\Controllers\version1\Controller\Person\PersonController@findMobileNumber')->name('findMobileNumber');
Route::post('findEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@findEmail')->name('findEmail');
Route::post('storePerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storePerson')->name('storePerson');
Route::get('getSalutation', 'App\Http\Controllers\version1\Controller\Person\PersonController@getSalutation')->name('getSalutation');
Route::get('getCommonData', 'App\Http\Controllers\version1\Controller\Person\PersonController@getCommonData')->name('getCommonData');

Route::post('storeTempPerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storeTempPerson')->name('storeTempPerson');
Route::post('personOtpValidation', 'App\Http\Controllers\version1\Controller\Person\PersonController@personOtpValidation')->name('personOtpValidation');
Route::post('emailOtpValidation', 'App\Http\Controllers\version1\Controller\Person\PersonController@emailOtpValidation')->name('emailOtpValidation');
Route::post('updatePassword', 'App\Http\Controllers\version1\Controller\Person\PersonController@updatePassword')->name('updatePassword');

Route::post('forgot_password', 'App\Http\Controllers\Auth\ApiAuthController@forgot_password')->name('forgot_password.api');

//Searching Part Ended
