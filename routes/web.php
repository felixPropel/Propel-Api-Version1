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
Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
    Route::view('/', 'wizard.mobile_page')->name('mobile');
    Route::view('/login', 'wizard.login')->name('/login');
    // Route::post('/logout', [WizardController::class, 'logout'])->name('logout');
    Route::post('/check', [WizardController::class, 'check'])->name('check');
    Route::view('/register', 'wizard.register')->name('register');
    Route::post('/create_user', [WizardController::class, 'create_user'])->name('create_user');
    //Temp registration
    Route::post('stage1', [WizardController::class, 'temp_stage1'])->name('stage1');
    Route::get('stage2/{mobile}', [WizardController::class, 'temp_stage2'])->name('stage2');
    Route::get('stage3', [WizardController::class, 'temp_stage3'])->name('stage3');
    Route::match(['get','post'],'stage_3', [WizardController::class, 'temp_stage_3'])->name('stage_3');
    //Registration
    Route::match(['get','post'],'registration', [WizardController::class, 'registration'])->name('registration');
    Route::match(['get','post'],'confirmation', [WizardController::class, 'confirmation'])->name('confirmation');
    Route::post('basic_details', [WizardController::class, 'basic_details'])->name('basic_details');
    Route::match(['get','post'],'basic_details1', [WizardController::class, 'basic_details1'])->name('basic_details1');
    Route::get('basic_details2', [WizardController::class, 'basic_details2'])->name('basic_details2');
    Route::post('form_submit', [WizardController::class, 'form_submit'])->name('form_submit');
    Route::post('upload_pic', [WizardController::class, 'upload_pic'])->name('upload_pic');
    Route::get('edit_profile/{uid}', [WizardController::class, 'edit_profile'])->name('edit_profile');
    Route::post('complete_profile',[WizardController::class,'complete_profile'])->name('complete_profile');
    Route::get('account/{uid}', [WizardController::class, 'account'])->name('account');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/forgot_password/{mobile}',[WizardController::class,'forgot_password'])->name('forgot_password');
    Route::post('validate_otp',[WizardController::class,'validate_otp'])->name('validate_otp');
    Route::get('resend_email_otp/{uid}',[WizardController::class,'resend_email_otp'])->name('resend_email_otp');
    Route::get('reset_password/{uid}',[WizardController::class,'reset_password'])->name('reset_password');
    Route::post('set_pasword',[WizardController::class,'set_pasword'])->name('set_pasword');
    //Person to User Registration
    Route::get('person_email/{uid}',[WizardController::class,'person_email'])->name('person_email');
    Route::get('person_confirmation/{uid}',[WizardController::class,'person_confirmation'])->name('person_confirmation');
    Route::post('update_email',[WizardController::class,'update_email'])->name('update_email');
    Route::post('person_otp',[WizardController::class,'person_otp'])->name('person_otp');
    Route::get('person_details_update',[WizardController::class,'person_details_update'])->name('person_details_update');
    Route::post('update_password',[WizardController::class,'update_password'])->name('update_password');
});

Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {

});

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('/dashboard');
});
// });


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'admin.login')->name('/login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/home', 'admin.dashboard')->name('home');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
