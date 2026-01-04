<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;


Route::view('/auth/register', 'auth.register')->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register.post');

Route::view('/auth/login', 'auth.login')->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('gg.redirect');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
