<?php
use Illuminate\Support\Facades\Route;
// searching Part Start
//@Developer Dhana
Route::post('findMobileNumber', 'App\Http\Controllers\version1\Controller\Person\PersonController@findMobileNumber')->name('findMobileNumber');
Route::post('findCredential', 'App\Http\Controllers\version1\Controller\Person\PersonController@findCredential')->name('findCredential');
Route::post('storePerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storePerson')->name('storePerson');
Route::get('getSalutation', 'App\Http\Controllers\version1\Controller\Person\PersonController@getSalutation')->name('getSalutation');
Route::get('getCommonData', 'App\Http\Controllers\version1\Controller\Person\PersonController@getCommonData')->name('getCommonData');
Route::post('storeTempPerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storeTempPerson')->name('storeTempPerson');
Route::post('personOtpValidation', 'App\Http\Controllers\version1\Controller\Person\PersonController@personOtpValidation')->name('personOtpValidation');
//Searching Part Ended
Route::post('generateEmailOtp', 'App\Http\Controllers\version1\Controller\Person\PersonController@generateEmailOtp')->name('generateEmailOtp');
Route::post('checkPersonEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@checkPersonEmail')->name('checkPersonEmail');
Route::post('personMobileOtp', 'App\Http\Controllers\version1\Controller\Person\PersonController@personMobileOtp')->name('personMobileOtp');
Route::post('personDatas', 'App\Http\Controllers\version1\Controller\Person\PersonController@personDatas')->name('personDatas');
Route::post('personUpdate', 'App\Http\Controllers\version1\Controller\Person\PersonController@personUpdate')->name('personUpdate');
Route::post('personToUser', 'App\Http\Controllers\version1\Controller\Person\PersonController@personToUser')->name('personToUser');
Route::post('userCreation', 'App\Http\Controllers\version1\Controller\Person\PersonController@userCreation')->name('userCreation');
Route::post('emailOtpValidation', 'App\Http\Controllers\version1\Controller\Person\PersonController@emailOtpValidation')->name('emailOtpValidation');
Route::post('personProfiles', 'App\Http\Controllers\version1\Controller\Person\PersonController@personProfiles')->name('personProfiles');
Route::post('profileUpdate', 'App\Http\Controllers\version1\Controller\Person\PersonController@profileUpdate')->name('profileUpdate');
Route::post('getDetailedAllPerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@getDetailedAllPerson')->name('getDetailedAllPerson');
Route::post('changePassword', 'App\Http\Controllers\version1\Controller\User\UserController@changePassword')->name('changePassword');
//User Profile
Route::post('userProfileDatas', 'App\Http\Controllers\version1\Controller\Person\PersonController@userProfileDatas')->name('userProfileDatas');
Route::post('addOtherMobile', 'App\Http\Controllers\version1\Controller\Person\PersonController@addOtherMobileNumber')->name('addOtherMobile');
Route::post('resendOtpForMobile', 'App\Http\Controllers\version1\Controller\Person\PersonController@resendOtpForMobile')->name('resendOtpForMobile');
Route::post('otpValidationForMobile', 'App\Http\Controllers\version1\Controller\Person\PersonController@otpValidationForMobile')->name('otpValidationForMobile');
Route::post('deleteForMobileNumberByUid', 'App\Http\Controllers\version1\Controller\Person\PersonController@deleteForMobileNumberByUid')->name('deleteForMobileNumberByUid');
Route::post('mobileNumberChangeAsPrimary', 'App\Http\Controllers\version1\Controller\Person\PersonController@mobileNumberChangeAsPrimary')->name('mobileNumberChangeAsPrimary');
Route::post('addOtherEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@addOtherEmail')->name('addOtherEmail');
Route::post('resendOtpForEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@resendOtpForEmail')->name('resendOtpForEmail');
Route::post('deleteForEmailByUid', 'App\Http\Controllers\version1\Controller\Person\PersonController@deleteForEmailByUid')->name('deleteForEmailByUid');
Route::post('emailChangeAsPrimary', 'App\Http\Controllers\version1\Controller\Person\PersonController@emailChangeAsPrimary')->name('emailChangeAsPrimary');
Route::post('resendOtpForTempMobileNo', 'App\Http\Controllers\version1\Controller\Person\PersonController@resendOtpForTempMobileNo')->name('resendOtpForTempMobileNo');
Route::post('OtpValidationForTempMobile', 'App\Http\Controllers\version1\Controller\Person\PersonController@OtpValidationForTempMobile')->name('OtpValidationForTempMobile');
Route::post('resendOtpForTempEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@resendOtpForTempEmail')->name('resendOtpForTempEmail');
Route::post('OtpValidationForTempEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@OtpValidationForTempEmail')->name('OtpValidationForTempEmail');

//user Profile End 