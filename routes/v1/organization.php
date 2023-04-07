<?php
use Illuminate\Support\Facades\Route;

Route::post('organizationStore', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@store')->name('organizationStore');
Route::get('getAllStates', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getAllStates')->name('getAllStates');
Route::post('getDistrict', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getDistrict')->name('getDistrict');
Route::post('getOrganizationAccountByUid', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getOrganizationAccountByUid')->name('getOrganizationAccountByUid');
Route::post('getDataBaseNameByid', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getDataBaseNameByid')->name('getDataBaseNameByid');
Route::post('setDefaultOrganization', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@setDefaultOrganization')->name('setDefaultOrganization');
