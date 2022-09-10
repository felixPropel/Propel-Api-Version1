<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRM\Transaction\HrmResourceController;

Route::post('findResourceWithCredentials', 'Hrm\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
Route::post('findDesignationByDepartmentId', 'Hrm\Transaction\HrmResourceController@findDesignationByDepartmentId')->name('findDesignationByDepartmentId');
