<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPage\LandingPageController;
use App\Http\Controllers\Superadmin\SuperadminEventController;
use App\Http\Controllers\Vendor\EventController;
use App\Http\Controllers\Vendor\UpdateProfileController;
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

// Landing page
Route::get('/', [LandingPageController::class, 'showEvent']);

// Register Routes
Route::prefix('register')->group(function() {
    Route::view('/', 'auth.register')->name('register.form');
    Route::view('/super-admin', 'auth.register')->name('register.super-admin.form');
    Route::view('/vendor', 'auth.register')->name('register.vendor.form');

    Route::controller(RegisterController::class)->group(function() {
        Route::post('/', 'register')->name('register.user');
        Route::post('/super-admin', 'register')->name('register.super-admin');
        Route::post('/vendor', 'register')->name('register.vendor');
    });
});


// Login and Logout Routes
Route::controller(LoginController::class)->group(function() {
    Route::view('/login', 'auth.login')->name('login.form');
    Route::post('/login', 'login')->name('login');

    Route::get('/logout', 'logout')->name('logout');
    Route::post('/logout', 'logout')->name('logout');

});



// Vendor Routes
Route::middleware(['checkVendor'])->group(function() {
    Route::prefix('vendor')->group(function() {
        Route::view('/events', 'vendor.events');
        Route::view('/add/events', 'vendor.addEvents');
        Route::view('/events/detail', 'vendor.eventDetail');
        Route::view('/dashboard', 'vendor.dashboard');

        Route::controller(EventController::class)->group(function() {
            Route::post('/add/events', 'store')->name('add.event');
            Route::get('/events', 'show')->name('vendor.events');
            Route::get('/events/edit/{id}', 'edit')->name('events.edit');
            Route::put('/events/edit/{id}', 'update')->name('events.update');
            Route::delete('/events/delete/{id}', 'destroy')->name('events.delete');

            Route::get('/events/detail/{id}', 'showEventDetail')->name('event.detail');


            //search
            Route::get('/event/search', 'search')->name('event.search');
        });

        // Profile Update Routes
        Route::controller(controller: UpdateProfileController::class)->group(function() {
            Route::get('/profile', 'getUser')->name('profile.show');
            Route::post('/profile/update', 'updateProfile')->name('profile.update');
        });

        //transaction
        Route::view('/transaction','vendor.transaction');
    });
});


// Super admin
Route::middleware(['checkAdmin'])->group(function(){
    Route::prefix('superadmin')->group(function(){
        Route::controller(SuperadminEventController::class)->group(function() {
            Route::get('/events', 'getEvents');
            Route::delete('/events/delete/{id}','destroy')->name('superadmin.event.delete');
            Route::get('/users','getUsers');
            Route::get('/dashboard','index');

            Route::get('/events/detail/{id}', 'showEventDetail')->name('superadmin.event.detail');
        });
    });
});


