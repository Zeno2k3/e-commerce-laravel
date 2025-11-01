<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('client.home');
});

Route::view('/auth/login', 'auth.login')->name('login');
Route::view('/auth/register', 'auth.register')->name('register');

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('gg.redirect');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
