<?php
use Illuminate\Support\Facades\Route;


Route::get('getHrmDepartmentData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@index')->name('getHrmDepartmentData');
Route::get('createHrmDepartmentData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@create')->name('createHrmDepartmentData');
Route::post('storeHrmDepartment/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@store')->name('storeHrmDepartment');
Route::get('findHrmDepartmentDataById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@edit')->name('findHrmDepartmentDataById');
Route::get('deleteHrmDepartmentDataById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@destroy')->name('deleteHrmDepartmentDataById');
Route::post('storeHrmDesignation/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDesignationController@store')->name('storeHrmDesignation');
Route::get('getHrmDesignation/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDesignationController@index')->name('getHrmDesignation');
Route::get('findHrmDesignationDataById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDesignationController@edit')->name('findHrmDesignationDataById');
Route::get('destroyHrmDesignationById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDesignationController@destroy')->name('destroyHrmDesignationById');
Route::get('createHrmDesignationData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDesignationController@create')->name('createHrmDesignationData');
Route::get('getHrmResourceTypeData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmHumanResourceTypeController@index')->name('getHrmResourceTypeData');
Route::post('storeHrmResourceTypeData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmHumanResourceTypeController@store')->name('storeHrmResourceTypeData');
Route::get('findHrmResourceType/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmHumanResourceTypeController@edit')->name('findHrmResourceType');
Route::get('deleteHrmResourceTypeData/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmHumanResourceTypeController@destroy')->name('deleteHrmResourceTypeData');


