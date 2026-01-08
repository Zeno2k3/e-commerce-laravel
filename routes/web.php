<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CustomerController;
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

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');

/*
|--------------------------------------------------------------------------
| 2. TRANG QUẢN TRỊ (ADMIN) - 6 Modules
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    // Redirect /admin to /admin/employees
    Route::get('/', function () {
        return redirect()->route('admin.employees.index');
    });
    
    // 1. Quản lý nhân viên
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('admin.employees.index');
        Route::post('/', [EmployeeController::class, 'store'])->name('admin.employees.store');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    });
    
    // 2. Quản lý sản phẩm
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
    
    // 3. Quản lý đơn hàng
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
    
    // 4. Danh mục sản phẩm
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
    
    // 5. Quản lý voucher
    Route::prefix('vouchers')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('admin.vouchers.index');
        Route::post('/', [VoucherController::class, 'store'])->name('admin.vouchers.store');
        Route::put('/{voucher}', [VoucherController::class, 'update'])->name('admin.vouchers.update');
        Route::delete('/{voucher}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
    });
    
    // 6. Quản lý người dùng (khách hàng)
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::post('/', [CustomerController::class, 'store'])->name('admin.customers.store');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    });
});