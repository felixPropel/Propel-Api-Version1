<?php

use Illuminate\Support\Facades\Route;

// searchin Part Start
//@Developer Dhana
 Route::post('userLogin', 'App\Http\Controllers\version1\Controller\User\UserController@login')->name('userLogin');
  
   Route::post('storeUser', 'App\Http\Controllers\version1\Controller\User\UserController@storeUser')->name('storeUser');
//Searching Part Ended
