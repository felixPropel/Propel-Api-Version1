<?php
use Illuminate\Support\Facades\Route;

Route::post('organizationStore', 'App\Http\Controllers\version1\Controller\Organization\OrganizationController@store')->name('organizationStore');
