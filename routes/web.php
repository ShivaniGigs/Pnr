<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\PNRStatusController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[UserController::class,'index']);
Route::post('user-store',[UserController::class,'user_create'])->name('user_Store');
Route::any('find-city-by-pincode', [OTPVerificationController::class,'getCityByPincode'])->name('find-city-by-pincode');
Route::post('veryfiemail',[UserController::class,'veryfiemail'])->name('veryfiemail');
Route::post('veryfiecontact',[UserController::class,'veryfiecontact'])->name('veryfiecontact');

Route::post('resend-otp', [OTPVerificationController::class, 'resendOTP'])->name('resend-otp');

Route::get('/loginpage',[UserController::class,'loginPage']);

Route::post('/userlogin',[UserController::class,'UserLogin'])->name('UserLogin');

Route::get('/password/forgot/form',[UserController::class,'showForgotForm'])->name('forgot.password.form');
Route::post('/password/forgot',[UserController::class,'sendResetLink'])->name('forgot.password.link');

Route::get('/password/reset/{id}',[UserController::class,'showResetForm'])->name('reset.password.form');

Route::post('send-otp', [OTPVerificationController::class,'resend_otp'])->name('send-otp');
Route::any('verify-otp', [OTPVerificationController::class,'verify_otp'])->name('verify-otp');



Route::group(['middleware'=>'pnr_auth'],function(){
Route::get('/pnr-status',[PNRStatusController::class,'index']);

});