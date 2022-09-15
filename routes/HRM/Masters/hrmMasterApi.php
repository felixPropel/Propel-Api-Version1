<?php
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\HRM\Master\HrmDepartmentController;
 use App\Http\Controllers\HRM\Master\HrmDesignationController;
 use App\Http\Controllers\HRM\Master\HrmHumanResourceTypeController;

 

Route::resource('hrmDepartment', 'App\Http\Controllers\HRM\Master\HrmDepartmentController');
Route::resource('hrmHumanResourceType', 'App\Http\Controllers\HRM\Master\HrmHumanResourceTypeController');
Route::resource('hrmDesignation', 'App\Http\Controllers\HRM\Master\HrmDesignationController');
