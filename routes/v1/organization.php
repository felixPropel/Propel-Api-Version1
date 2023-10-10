<?php
use Illuminate\Support\Facades\Route;
Route::post('tempOrganizationStore', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@tempOrganizationStore')->name('tempOrganizationStore');
// Route::post('organizationStore', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@store')->name('organizationStore');
Route::get('organizationMasterDatas', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@organizationMasterDatas')->name('organizationMasterDatas');
Route::post('getCityByStateId', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getCityByStateId')->name('getCityByStateId');
Route::post('getOrganizationAccountByUid', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getOrganizationAccountByUid')->name('getOrganizationAccountByUid');
Route::post('getDataBaseNameByid', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@getDataBaseNameByid')->name('getDataBaseNameByid');
Route::post('setDefaultOrganization', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@setDefaultOrganization')->name('setDefaultOrganization');
Route::get('organizationIndex', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@organizationIndex')->name('organizationIndex');
