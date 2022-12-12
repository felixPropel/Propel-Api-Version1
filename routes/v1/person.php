<?php

use Illuminate\Support\Facades\Route;

// searchin Part Start
//@Developer Dhana

   Route::post('findMobileNumber', 'App\Http\Controllers\version1\Controller\Person\PersonController@findMobileNumber')->name('findMobileNumber');
   Route::post('findEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@findEmail')->name('findEmail');
   Route::post('storePerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storePerson')->name('storePerson');
//Searching Part Ended
