<?php
use Illuminate\Support\Facades\Route;

Route::get('getHrmDepartmentData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@index')->name('getHrmDepartmentData');
Route::get('createHrmDepartmentData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@create')->name('createHrmDepartmentData');
Route::post('storeHrmDepartment/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@store')->name('storeHrmDepartment');
Route::get('findHrmDepartmentDataById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@edit')->name('findHrmDepartmentDataById');
Route::get('deleteHrmDepartmentDataById/{orgId}/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@destroy')->name('deleteHrmDepartmentDataById');