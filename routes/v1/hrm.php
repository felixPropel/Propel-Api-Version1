<?php
use Illuminate\Support\Facades\Route;

Route::get('getHrmDataByOrgId/{id}', 'App\Http\Controllers\version1\Controller\HRM\Master\HrmDepartmentController@getHrmDataByOrgId')->name('getHrmDataByOrgId');