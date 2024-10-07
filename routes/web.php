<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Register
Route::view('/register', 'auth.register')->name('register.form'); // Display the registration form
Route::view('/register/super-admin', 'auth.register')->name('register.super-admin.form'); // Super admin registration form
Route::view('/register/vendor', 'auth.register')->name('register.vendor.form'); // Vendor registration form

Route::post('/register', [RegisterController::class, 'register'])->name('register.user'); // Regular user registration
Route::post('/register/super-admin', [RegisterController::class, 'register'])->name('register.super-admin');
Route::post('/register/vendor', [RegisterController::class, 'register'])->name('register.vendor'); // Vendor registration


//Login
Route::view('/login','auth.login')->name('login.form');
Route::post('/login',[LoginController::class,'login'])->name('login');