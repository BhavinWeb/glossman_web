<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

// Frontend Auth
Auth::routes();

Route::controller(UserLoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('users.login');
    Route::post('/login', 'login')->name('login');
});

// Social Authentication
Route::controller(SocialLoginController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')
        ->where('provider', 'google|facebook|twitter|linkedin|github')
        ->name('social-login');
    Route::get('/auth/{provider}/callback', 'callback')
        ->where('provider', 'google|facebook|twitter|linkedin|github');
});


// Admin Auth
Route::controller(AdminLoginController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.admin');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('admin.logout');
});
