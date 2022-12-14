<?php

use Illuminate\Support\Facades\Route;

// searchin Part Start
//@Developer Dhana

   Route::post('findMobileNumber', 'App\Http\Controllers\version1\Controller\Person\PersonController@findMobileNumber')->name('findMobileNumber');
   Route::post('findEmail', 'App\Http\Controllers\version1\Controller\Person\PersonController@findEmail')->name('findEmail');
   Route::post('storePerson', 'App\Http\Controllers\version1\Controller\Person\PersonController@storePerson')->name('storePerson');
   Route::get('getSalutation','App\Http\Controllers\version1\Controller\Person\PersonController@getSalutation')->name('getSalutation');
   Route::get('getCommonData','App\Http\Controllers\version1\Controller\Person\PersonController@getCommonData')->name('getCommonData');

//Searching Part Ended
