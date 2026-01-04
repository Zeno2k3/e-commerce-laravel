<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

// 1. Route trang chủ (Giữ nguyên 'home' để khớp với Breadcrumb)
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::view('/auth/login', 'auth.login')->name('login');
Route::view('/auth/register', 'auth.register')->name('register');

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('gg.redirect');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/voucher', function () {
    return view('client.layouts.voucher');
})->name('client.voucher');

Route::get('/gio-hang', function () {
    return view('client.carts.index');
})->name('client.carts.index');

Route::get('/success', function () {
    return view('client.carts.success');
})->name('client.carts.success');


Route::get('/san-pham', function () {
    return view('client.products.index');
})->name('products.index');

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

Route::get('/about', function () {
    return view('client.about');
})->name('client.about');

Route::get('/contact', function () {
    return view('client.contact');
})->name('client.contact');

Route::get('/shipping-policy', function () {
    return view('client.chinhsach-giaohang');
})->name('client.chinhsach-giaohang');

Route::get('/return-policy', function () {
    return view('client.doitrahang');
})->name('client.doitrahang');

Route::get('/privacy-policy', function () {
    return view('client.chinhsach-baomat');
})->name('client.chinhsach-baomat');

Route::get('/profile', function () {
    return view('client.account.profile');
})->name('client.account.profile');


Route::get('/show', function () {
    return view('client.products.show');
})->name('client.products.show');

Route::get('/payment', function () {
    return view('client.carts.payment');
})->name('client.carts.payment');
