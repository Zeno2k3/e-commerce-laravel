<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\CustomerController;
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
Route::get('/san-pham', function () { return view('client.products.index'); })->name('client.products.index');
Route::get('/men', function () { return view('client.products.men'); })->name('client.men');
Route::get('/women', function () { return view('client.products.women'); })->name('client.women');
Route::get('/phu-kien', function () { return view('client.products.phu-kien'); })->name('client.accessories');
Route::get('/khuyen-mai', function () { return view('client.pages.sale'); })->name('client.sale');
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

Route::get('/payment', function () {
    return view('client.carts.payment');
})->name('client.carts.payment');


Route::get('/lichsu-donhang', function () {
    return view('client.account.orders');
})->name('client.account.orders');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);



// --------------------------- Gio hang User ---------------------------

Route::get('/gio-hang', [CartController::class, 'index'])->name('client.carts.index');
Route::post('/gio-hang', [CartController::class, 'addToCart'])->name('client.cart.add');



//Giả dữ liệu Chi tiết sp

Route::get('/san-pham/{id}', function ($id) {
    // --- KHAI BÁO DỮ LIỆU GIẢ TẠI ĐÂY ---
    $product = [
        'id' => $id,
        'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương',
        'sku' => 'W9ED09E',
        'price' => 1000000,
        'old_price' => 10999000,
        'discount' => '-90%',
        'description' => 'Áo khoác jean 100% có nón, form regular fit, phù hợp mặc hàng ngày. Chất liệu bền đẹp...',
        'image' => 'images/jacket.png', // Đảm bảo ảnh này có trong thư mục public/images
        'rating' => 4.0,
        'reviews_count' => 69,
        'specs' => [
            'material' => 'Jean Cotton 100%',
            'origin' => 'Việt Nam',
            'brand' => 'FlexStyle',
            'style' => 'Regular'
        ],
        'reviews' => [
            ['user' => 'Nguyễn Văn A', 'avatar_text' => 'A', 'rating' => 5, 'time' => '2 ngày trước', 'content' => 'Sản phẩm tốt!'],
            ['user' => 'Trần Thị B', 'avatar_text' => 'B', 'rating' => 4, 'time' => '1 tuần trước', 'content' => 'Giao hàng nhanh.'],
        ],
        'related_products' => [
             ['id' => 101, 'name' => 'Sản phẩm gợi ý 1', 'price' => 500000, 'image' => 'images/jacket.png', 'discount' => '-50%'],
             ['id' => 102, 'name' => 'Sản phẩm gợi ý 2', 'price' => 250000, 'image' => 'images/shirt.png', 'discount' => null],
        ]
    ];

    // Truyền biến $product vào giao diện 'client.products.show'
    return view('client.products.show', compact('product'));

})->name('client.product.detail');

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
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
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