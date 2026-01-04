<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('client.home');
});

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

Route::get('/chinhsach-baomat', function () {
    return view('client.chinhsach-baomat');
})->name('client.chinhsach-baomat');

Route::get('/chinhsach-giaohang', function () {
    return view('client.chinhsach-giaohang');
})->name('client.chinhsach-giaohang');

Route::get('/doitrahang', function () {
    return view('client.doitrahang');
})->name('client.doitrahang');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('client.account.profile');
    })->name('client.profile');

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});

Route::get('/payment', function () {
    return view('client.carts.payment');
})->name('client.carts.payment');


