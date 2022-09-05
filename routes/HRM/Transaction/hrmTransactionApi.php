<?php
use Illuminate\Support\Facades\Route;

Route::post('findResourceWithCredentials', 'Hrm\Transaction\HrmResourceController@findResourceWithCredentials')->name('findResourceWithCredentials');
