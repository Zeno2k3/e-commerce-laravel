<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| 1. TRANG DÀNH CHO KHÁCH HÀNG (CLIENT)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('client.home'); })->name('home');
Route::get('/voucher', function () { return view('client.layouts.voucher'); })->name('client.voucher');
Route::get('/gio-hang', function () { return view('client.carts.index'); })->name('client.carts.index');
Route::get('/success', function () { return view('client.carts.success'); })->name('client.carts.success');
Route::get('/san-pham', function () { return view('client.products.index'); })->name('client.products.index');
Route::get('/men', function () { return view('client.products.men'); })->name('client.men');
Route::get('/women', function () { return view('client.products.women'); })->name('client.women');
Route::get('/phu-kien', function () { return view('client.products.phu-kien'); })->name('client.accessories');
Route::get('/khuyen-mai', function () { return view('client.sale'); })->name('client.sale');
Route::get('/profile', function () { return view('client.account.profile'); })->name('client.profile');

// Đưa Logout ra ngoài prefix hoặc để trong tùy mày, nhưng phải dùng POST
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');

/*
|--------------------------------------------------------------------------
| 2. TRANG QUẢN TRỊ (ADMIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.products.show');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    });

    Route::get('/customers', [UserController::class, 'index'])->name('admin.customers.index');

    // Gom nhóm Cài đặt lại cho gọn, bỏ cái khai báo lẻ ở trên đi
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('admin.settings.updateProfile');
        Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('admin.settings.updatePassword');
    });
});