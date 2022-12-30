<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRM\Transaction\HrmResourceController;

Route::post('findResourceWithCredentials/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
Route::post('findDesignationByDepartmentId/{orgId}', 'App\Http\Controllers\version1\Controller\Hrm\Transaction\HrmResourceController@findDesignationByDepartmentId')->name('findDesignationByDepartmentId');
// Route::post('findResourceWithCredentials', 'Hrm\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
// Route::post('findDesignationByDepartmentId', 'Hrm\Transaction\HrmResourceController@findDesignationByDepartmentId')->name('findDesignationByDepartmentId');
// Route::post('freshPersonOrganizationDetails', 'Hrm\Transaction\HrmResourceController@store')->name('freshPersonOrganizationDetails');

Route::get('getResourceMasterData/{orgId}', 'App\Http\Controllers\version1\Controller\HRM\Transaction\\HrmResourceController@getResourceMasterData')->name('getPersonMasterData');
