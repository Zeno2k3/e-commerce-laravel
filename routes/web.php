<?php

use Illuminate\Support\Facades\Route;

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
| 2. TRANG QUẢN TRỊ (ADMIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Quản lý Sản phẩm
    Route::prefix('products')->group(function () {
        Route::get('/', function () { 
            return view('admin.products.index'); 
        })->name('admin.products.index');
        
        Route::get('/create', function () { 
            return view('admin.products.form'); 
        })->name('admin.products.create');
        
        Route::get('/show', function () { 
            return view('admin.products.show'); 
        })->name('admin.products.show');
    });

    // Quản lý Đơn hàng
    Route::prefix('orders')->group(function () {
        Route::get('/', function () { 
            return view('admin.orders.index'); 
        })->name('admin.orders.index');
        
        Route::get('/show', function () { 
            return view('admin.orders.show'); 
        })->name('admin.orders.show');
    });

    Route::get('/settings', function () {
        return view('admin.settings'); 
    })->name('admin.settings');

    Route::get('/customers', function () {
        return view('admin.customers.index'); 
    })->name('admin.customers.index');
});