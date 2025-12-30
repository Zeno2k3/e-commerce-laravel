<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

/*

|--------------------------------------------------------------------------

| 1. TRANG DÀNH CHO KHÁCH HÀNG (CLIENT)

|--------------------------------------------------------------------------

*/



Route::get('/', function () {

    return view('client.home');

})->name('home');



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



// Tạm thời bỏ middleware('auth') để bạn check giao diện Profile

Route::get('/profile', function () {

    return view('client.account.profile');

})->name('client.profile');

/*
|--------------------------------------------------------------------------
| TRANG QUẢN TRỊ (ADMIN) - FIX LỖI 404
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    // Dashboard - URL: domain.com/admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý Sản phẩm - URL: domain.com/admin/products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.products.show');
    });

    // Quản lý Đơn hàng - URL: domain.com/admin/orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    });

    // Quản lý Khách hàng - URL: domain.com/admin/customers
    Route::get('/customers', [UserController::class, 'index'])->name('admin.customers.index');

    // Cài đặt hệ thống - URL: domain.com/admin/settings
    Route::get('/settings', function () {
        return view('admin.settings'); 
    })->name('admin.settings');
});