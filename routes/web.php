<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\WizardController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::prefix('user')->name('user.')->group(function () {
// Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
    Route::view('/', 'web.not_allowed')->name('not_allowed');
// });

