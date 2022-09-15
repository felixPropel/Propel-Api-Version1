<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRM\Transaction\HrmResourceController;

<<<<<<< HEAD
Route::post('findResourceWithCredentials', 'App\Http\Controllers\Hrm\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
Route::post('findDesignationByDepartmentId', 'App\Http\Controllers\Hrm\Transaction\HrmResourceController@findDesignationByDepartmentId')->name('findDesignationByDepartmentId');
=======
Route::post('findResourceWithCredentials', 'Hrm\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
Route::post('findDesignationByDepartmentId', 'Hrm\Transaction\HrmResourceController@findDesignationByDepartmentId')->name('findDesignationByDepartmentId');
Route::post('freshPersonOrganizationDetails', 'Hrm\Transaction\HrmResourceController@store')->name('freshPersonOrganizationDetails');

>>>>>>> e1e91057a927bc8d36bec9f0468f62e6134f1e0c
