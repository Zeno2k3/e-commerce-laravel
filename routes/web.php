<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\Client\VoucherController as ClientVoucherController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('client.home');
});

// Voucher routes cho Client - lấy dữ liệu từ database
Route::get('/voucher', [ClientVoucherController::class, 'index'])->name('client.voucher');
Route::get('/voucher/all', [ClientVoucherController::class, 'all'])->name('client.voucher.all');
Route::get('/api/vouchers', [ClientVoucherController::class, 'getVouchersJson'])->name('api.vouchers');
Route::get('/api/vouchers/{code}', [ClientVoucherController::class, 'checkVoucherByCode'])->name('api.vouchers.check');
Route::post('/voucher/apply', [ClientVoucherController::class, 'applyVoucher'])->name('client.voucher.apply');


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

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Admin Routes - Voucher Management (CRUD)
|--------------------------------------------------------------------------
| 
| Các route này sử dụng Route Model Binding.
| Laravel tự động inject Voucher model dựa trên voucher_id trong URL.
|
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Voucher statistics
    Route::get('vouchers/statistics', [AdminVoucherController::class, 'statistics'])
        ->name('admin.vouchers.statistics');

    // Resource routes cho Voucher (index, store, show, update, destroy)
    Route::apiResource('vouchers', AdminVoucherController::class)
        ->names([
            'index' => 'admin.vouchers.index',
            'store' => 'admin.vouchers.store',
            'show' => 'admin.vouchers.show',
            'update' => 'admin.vouchers.update',
            'destroy' => 'admin.vouchers.destroy',
        ]);

    // Toggle status route
    Route::patch('vouchers/{voucher}/toggle-status', [AdminVoucherController::class, 'toggleStatus'])
        ->name('admin.vouchers.toggle-status');
});
