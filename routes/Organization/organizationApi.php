<?php
use Illuminate\Support\Facades\Route;

Route::post('/checkGstNumber', 'App\Http\Controllers\Organization\OrganizationCommonController@checkGstNumber')->name('checkGstNumber');
Route::get('/organizationCommonData', 'App\Http\Controllers\Organization\OrganizationCommonController@organizationCommonData')->name('organizationCommonData');
Route::post('/createDB', 'App\Http\Controllers\Organization\OrganizationController@createDB')->name('createDB');
