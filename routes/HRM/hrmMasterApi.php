<?php
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\HRM\HrmDepartmentController;
 use App\Http\Controllers\HRM\HrmDesignationController;
 use App\Http\Controllers\HRM\HrmHumanResourceTypeController;

 

Route::resource('hrmDepartment', 'HRM\HrmDepartmentController');
Route::resource('hrmHumanResourceType', 'HRM\HrmHumanResourceTypeController');
Route::resource('hrmDesignation', 'HRM\HrmDesignationController');
