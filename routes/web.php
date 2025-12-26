<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\VoucherController;
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


//Admin Routes - Voucher Management

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Voucher statistics (đặt trước resource để tránh conflict với show)
    Route::get('vouchers/statistics', [VoucherController::class, 'statistics'])
        ->name('admin.vouchers.statistics');

    // Resource routes cho Voucher (index, store, show, update, destroy)
    // Route Model Binding: {voucher} sẽ được bind với Voucher model
    Route::apiResource('vouchers', VoucherController::class)
        ->names([
            'index' => 'admin.vouchers.index',
            'store' => 'admin.vouchers.store',
            'show' => 'admin.vouchers.show',
            'update' => 'admin.vouchers.update',
            'destroy' => 'admin.vouchers.destroy',
        ]);

    // Toggle status route
    Route::patch('vouchers/{voucher}/toggle-status', [VoucherController::class, 'toggleStatus'])
        ->name('admin.vouchers.toggle-status');
});

