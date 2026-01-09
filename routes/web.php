<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ImportReceiptController;
use App\Http\Controllers\Admin\PromotionEventController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductClientController;

/*
|--------------------------------------------------------------------------
| 1. TRANG DÀNH CHO KHÁCH HÀNG (CLIENT)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('client.pages.home'); })->name('home');
Route::get('/voucher', function () { return view('client.layouts.voucher'); })->name('client.voucher');
Route::get('/success', function () { return view('client.carts.success'); })->name('client.carts.success');
Route::get('/profile', function () { return view('client.account.profile'); })->name('client.profile');
Route::get('/about', function() { return view('client.pages.about'); })->name('client.about');
Route::get('/contact', function() { return view('client.pages.contact'); })->name('client.contact');
Route::get('/chinhsach-giaohang',  function() { return view('client.pages.shipping-policy'); })->name('client.chinhsach-giaohang');
Route::get('/doitrahang', function () {return view('client.pages.return-policy'); })->name('client.doitrahang');
Route::get('/chinhsach-baomat', function () {return view('client.pages.privacy-policy'); })->name('client.chinhsach-baomat');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); 
})->name('logout');

// ----------------------------- San Pham -----------------------------

Route::get('/san-pham', [ProductClientController::class, 'index'])->name('client.products.index');
Route::get('/san-pham/{id}', [ProductClientController::class, 'show'])->name('client.products.show');
Route::get('/san-pham/{category_id}', [ProductClientController::class, 'get_product_by_category_id'])->name('client.products.get_product_by_category_id');

Route::get('/men', [ProductClientController::class, 'men'])->name('client.men');
Route::get('/women', [ProductClientController::class, 'women'])->name('client.women');
Route::get('/phu-kien', [ProductClientController::class, 'accessories'])->name('client.accessories');
Route::get('/khuyen-mai', [ProductClientController::class, 'sale'])->name('client.sale');



//---------------------------- Thanh Toan ------------------------------

Route::get('/payment', function () {
    return view('client.cart.payment');
})->name('client.cart.payment');

Route::get('/success', function () {
    return view('client.cart.success');
})->name('client.cart.success');

Route::post('/payment', [CartController::class, 'payment'])->name('client.cart.payment');


Route::get('/lichsu-donhang', function () {
    return view('client.account.orders');
})->name('client.account.orders');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// --------------------------- Gio hang User ---------------------------
Route::middleware('auth')->group(function () {
    Route::get('/gio-hang', [CartController::class, 'index'])->name('client.cart.index');
    Route::post('/gio-hang', [CartController::class, 'addToCart'])->name('client.cart.add');
    Route::post('/gio-hang/update-quantity', [CartController::class, 'updateQuantity'])->name('client.cart.updateQuantity');
    Route::post('/gio-hang/remove-item', [CartController::class, 'removeItem'])->name('client.cart.removeItem');
    Route::post('/gio-hang/clear', [CartController::class, 'clearCart'])->name('client.cart.clear');
});

// ============================================
// ADMIN ROUTES (role: admin, employee)
// ============================================
Route::prefix('admin')->middleware(['auth', 'role:admin,employee'])->group(function () {
    
    // Dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Quản lý roles
    Route::get('/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/{role}/users', [EmployeeController::class, 'byRole'])->name('admin.roles.users');
    
    // Quản lý nhân viên
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('admin.employees.index');
        Route::post('/', [EmployeeController::class, 'store'])->name('admin.employees.store');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    });
    
    // Quản lý sản phẩm
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
    
    // Danh mục sản phẩm
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
    
    // Quản lý khách hàng
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::post('/', [CustomerController::class, 'store'])->name('admin.customers.store');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    });
    
    // Quản lý nhà cung cấp
    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('admin.suppliers.index');
        Route::post('/', [SupplierController::class, 'store'])->name('admin.suppliers.store');
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('admin.suppliers.update');
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('admin.suppliers.destroy');
    });
    
    // Phiếu nhập hàng
    Route::prefix('imports')->group(function () {
        Route::get('/', [ImportReceiptController::class, 'index'])->name('admin.imports.index');
        Route::post('/', [ImportReceiptController::class, 'store'])->name('admin.imports.store');
        Route::patch('/{receipt}/confirm', [ImportReceiptController::class, 'confirm'])->name('admin.imports.confirm');
    });
    
    // Quản lý voucher
    Route::prefix('vouchers')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('admin.vouchers.index');
        Route::post('/', [VoucherController::class, 'store'])->name('admin.vouchers.store');
        Route::put('/{voucher}', [VoucherController::class, 'update'])->name('admin.vouchers.update');
        Route::delete('/{voucher}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
    });
    
    // Sự kiện ưu đãi
    Route::prefix('events')->group(function () {
        Route::get('/', [PromotionEventController::class, 'index'])->name('admin.events.index');
        Route::post('/', [PromotionEventController::class, 'store'])->name('admin.events.store');
        Route::put('/{event}', [PromotionEventController::class, 'update'])->name('admin.events.update');
        Route::delete('/{event}', [PromotionEventController::class, 'destroy'])->name('admin.events.destroy');
    });
    
    // Thông báo
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('admin.notifications.index');
        Route::post('/', [NotificationController::class, 'store'])->name('admin.notifications.store');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    });
    
    // Quản lý đơn hàng
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/issues', [OrderController::class, 'issues'])->name('admin.orders.issues');
        Route::get('/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
    
    // Thống kê
    Route::prefix('statistics')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('admin.statistics.index');
        Route::get('/data', [App\Http\Controllers\Admin\StatisticsController::class, 'getData'])->name('admin.statistics.data');
    });
    
    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('/info', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
        Route::put('/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.profile.password');
    });
});