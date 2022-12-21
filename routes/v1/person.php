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
//Searching Part Ended
Route::post('checkPersonEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@checkPersonEmail')->name('checkPersonEmail');
Route::post('personMobileOtp', 'App\Http\Controllers\version1\Controller\Person\PersonController@personMobileOtp')->name('personMobileOtp');
Route::post('mobileOtpValidated', 'App\Http\Controllers\version1\Controller\Person\PersonController@mobileOtpValidated')->name('mobileOtpValidated');
Route::post('personDatas', 'App\Http\Controllers\version1\Controller\Person\PersonController@personDatas')->name('personDatas');
Route::post('personUpdate', 'App\Http\Controllers\version1\Controller\Person\PersonController@personUpdate')->name('personUpdate');
Route::post('personToUser', 'App\Http\Controllers\version1\Controller\Person\PersonController@personToUser')->name('personToUser');
Route::post('userCreation', 'App\Http\Controllers\version1\Controller\Person\PersonController@userCreation')->name('userCreation');
Route::post('emailOtpValidation', 'App\Http\Controllers\version1\Controller\Person\PersonController@emailOtpValidation')->name('emailOtpValidation');
