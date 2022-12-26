<?php
use Illuminate\Support\Facades\Route;
Route::post('organizationStore', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@store')->name('organizationStore');
Route::get('getAllState', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getAllState')->name('getAllState');
Route::post('getDistrict', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getDistrict')->name('getDistrict');
Route::post('getOrganizationAccountByUid', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getOrganizationAccountByUid')->name('getOrganizationAccountByUid');