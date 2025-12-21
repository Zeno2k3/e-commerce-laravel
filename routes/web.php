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




Route::get('/voucher', function () {
    return view('client.layouts.voucher');
})->name('client.voucher');;


Route::get('/gio-hang', function () {

    return view('client.carts.index');
})->name('client.carts.index');

Route::get('/success', function () {
    return view('client.carts.success');
})->name('client.carts.success');

Route::get('/san-pham', function () {
    return view('client.products.index');
})->name('client.products.index');

Route::get('/men', function () {
    return view('client.products.men');
})->name('client.men');


Route::get('/women', function () {
    return view('client.products.women');
})->name('client.women');


Route::get('/phu-kien', function () {
    return view('client.products.phu-kien');
})->name('client.accessories');

Route::get('/khuyen-mai', function () {
    return view('client.sale');
})->name('client.sale');
