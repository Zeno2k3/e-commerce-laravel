@extends('client.layouts.app')

@section('content')

@php
    // Dữ liệu giả lập sản phẩm cho Trang 8
    $featured_products = [
        [
            'id' => 1,
            'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương',
            'image' => 'images/shirt.png',
            'price' => 1000000,
            'old_price' => 1250000,
            'discount' => '-20%',
            'rating' => 5,
            'reviews' => 69
        ],
        [
            'id' => 2,
            'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương',
            'image' => 'images/bag.png',
            'price' => 1000000,
            'old_price' => 1250000,
            'discount' => '-20%',
            'rating' => 5,
            'reviews' => 69
        ],
        [
            'id' => 3,
            'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương',
            'image' => 'https://pos.nvncdn.com/be3159/ps/20240417_A2k3y8k651.jpeg',
            'price' => 1000000,
            'old_price' => 1250000,
            'discount' => '-20%',
            'rating' => 5,
            'reviews' => 69
        ],
        [
            'id' => 4,
            'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương',
            'image' => 'https://pos.nvncdn.com/be3159/ps/20240417_A2k3y8k651.jpeg',
            'price' => 1000000,
            'old_price' => 1250000,
            'discount' => '-20%',
            'rating' => 5,
            'reviews' => 69
        ]
    ];
@endphp

{{-- Nền xám nhạt đồng bộ --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20 overflow-x-hidden">

    {{-- 1. HERO SECTION (BANNER) --}}
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="flex flex-col md:flex-row items-center gap-12">
            {{-- Text Content --}}
            <div class="md:w-1/2 z-10">
                {{-- Badge: Đồng bộ style mẫu (text-2xl, tím) --}}
                <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-xl md:text-2xl mb-6 tracking-widest uppercase">
                    Bộ sưu tập mới 2025
                </span>

                {{-- H1: Đồng bộ text-5xl font-black --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 mb-6 tracking-tight leading-tight">
                    Thời trang hiện đại cho <br>
                    <span class="text-[#7d3cff]">phong cách của bạn</span>
                </h1>

                {{-- Intro: Đồng bộ text-xl text-gray-500 --}}
                <p class="text-gray-500 text-xl leading-relaxed mb-10 max-w-lg">
                    Khám phá những xu hướng thời trang mới nhất với chất lượng cao cấp và giá cả hợp lý. Tự tin thể hiện phong cách riêng.
                </p>

                {{-- Buttons: Form rounded-xl font-bold --}}
                <div class="flex flex-wrap gap-4">
                    <a href="#" class="bg-gray-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-[#7d3cff] transition text-lg shadow-xl shadow-gray-200">
                        Mua sắm ngay <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#" class="bg-white text-gray-900 border border-gray-200 px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition text-lg">
                        Tìm hiểu thêm
                    </a>
                </div>
            </div>

            {{-- Hero Image: Form rounded-[3rem] shadow-xl --}}
            <div class="md:w-1/2 relative">
                <div class="relative z-10 bg-white p-4 rounded-[3rem] shadow-2xl shadow-purple-200/50">
                    <div class="rounded-[2.5rem] overflow-hidden aspect-[4/3]">
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=2070&auto=format&fit=crop" alt="Hero Image" class="w-full h-full object-cover">
                    </div>
                </div>
                {{-- Decor --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-300 rounded-full blur-3xl opacity-30"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-pink-300 rounded-full blur-3xl opacity-30"></div>
            </div>
        </div>
    </div>

    {{-- 2. FEATURES (CAM KẾT) --}}
    <div class="container mx-auto px-4 mb-20">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            {{-- Feature 1 --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 bg-purple-50 text-[#7d3cff] rounded-full flex items-center justify-center text-3xl mx-auto mb-5">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                {{-- Tăng cỡ chữ tiêu đề lên text-xl --}}
                <h4 class="font-bold text-gray-900 text-xl mb-2">Giao hàng miễn phí</h4>
                {{-- Tăng cỡ chữ mô tả lên text-base --}}
                <p class="text-gray-500 text-base">Đơn hàng trên 500k</p>
            </div>

            {{-- Feature 2 --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 bg-purple-50 text-[#7d3cff] rounded-full flex items-center justify-center text-3xl mx-auto mb-5">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-xl mb-2">Thanh toán an toàn</h4>
                <p class="text-gray-500 text-base">Bảo mật 100%</p>
            </div>

            {{-- Feature 3 --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 bg-purple-50 text-[#7d3cff] rounded-full flex items-center justify-center text-3xl mx-auto mb-5">
                    <i class="fa-regular fa-star"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-xl mb-2">Chất lượng đảm bảo</h4>
                <p class="text-gray-500 text-base">Sản phẩm chính hãng</p>
            </div>

            {{-- Feature 4 --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 bg-purple-50 text-[#7d3cff] rounded-full flex items-center justify-center text-3xl mx-auto mb-5">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-xl mb-2">Đổi trả dễ dàng</h4>
                <p class="text-gray-500 text-base">Trong vòng 30 ngày</p>
            </div>

            {{-- Feature 5 --}}
            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white hover:-translate-y-1 transition duration-300">
                <div class="w-16 h-16 bg-purple-50 text-[#7d3cff] rounded-full flex items-center justify-center text-3xl mx-auto mb-5">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-xl mb-2">Hỗ trợ 24/7</h4>
                <p class="text-gray-500 text-base">Tư vấn mọi lúc</p>
            </div>
        </div>
    </div>
    {{-- 3. SẢN PHẨM NỔI BẬT --}}
    <div class="container mx-auto px-4 mb-20">
        {{-- Tiêu đề Section: text-3xl font-bold center --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">Sản Phẩm Nổi Bật</h2>
            <p class="text-gray-500 text-xl max-w-2xl mx-auto">
                Khám phá những sản phẩm được yêu thích nhất với chất lượng cao cấp và thiết kế thời thượng.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @foreach($featured_products as $product)
            {{-- Card sản phẩm: Form rounded-[2rem] --}}
            <div class="bg-white p-4 rounded-[2rem] shadow-xl shadow-gray-200/50 border border-white hover:border-purple-100 transition duration-300 group">
                {{-- Ảnh: Bo góc lớn --}}
                <div class="relative aspect-[3/4] rounded-[1.5rem] overflow-hidden mb-4">
                    {{-- Badge Sale --}}
                    <span class="absolute top-3 left-3 bg-[#ef4444] text-white font-bold px-3 py-1 rounded-lg text-sm z-10">
                        {{ $product['discount'] }}
                    </span>
                    <img src="{{ $product['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    {{-- Button Add to Cart --}}
                    <div class="absolute inset-x-4 bottom-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                        <button class="w-full bg-white/90 backdrop-blur text-gray-900 py-3 rounded-xl font-bold hover:bg-[#7d3cff] hover:text-white shadow-lg flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>

                {{-- Info --}}
                <div class="px-2 pb-2">
                    <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 min-h-[3.5rem] leading-snug">
                        {{ $product['name'] }}
                    </h3>
                    <div class="flex items-end justify-between">
                        <div class="flex flex-col">
                            {{-- Giá: text-[#7d3cff] font-black --}}
                            <span class="text-[#7d3cff] font-black text-xl">{{ number_format($product['price']) }}đ</span>
                            <span class="text-gray-400 text-sm line-through font-bold">{{ number_format($product['old_price']) }}đ</span>
                        </div>
                        <div class="flex text-yellow-400 text-sm gap-1 mb-1">
                            <i class="fa-solid fa-star"></i>
                            <span class="font-bold text-gray-600">5.0</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#" class="inline-block border-2 border-gray-900 text-gray-900 px-10 py-3 rounded-xl font-bold hover:bg-gray-900 hover:text-white transition text-lg tracking-wide">
                XEM TẤT CẢ SẢN PHẨM
            </a>
        </div>
    </div>

    {{-- 4. DANH MỤC (BANNER LỚN) --}}
    <div class="container mx-auto px-4 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Nam --}}
            <div class="relative group h-[450px] rounded-[3rem] overflow-hidden cursor-pointer shadow-2xl shadow-gray-200">
                <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-10">
                    <h3 class="text-4xl font-black text-white mb-2">Thời trang Nam</h3>
                    <p class="text-gray-300 text-xl mb-6">Phong cách lịch lãm, hiện đại</p>
                    <span class="inline-flex items-center gap-2 bg-white text-gray-900 px-6 py-3 rounded-xl font-bold self-start hover:bg-[#7d3cff] hover:text-white transition">
                        Mua ngay <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </div>
            </div>

            {{-- Nữ --}}
            <div class="relative group h-[450px] rounded-[3rem] overflow-hidden cursor-pointer shadow-2xl shadow-gray-200">
                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-10">
                    <h3 class="text-4xl font-black text-white mb-2">Thời trang Nữ</h3>
                    <p class="text-gray-300 text-xl mb-6">Trẻ trung, thanh lịch, quyến rũ</p>
                    <span class="inline-flex items-center gap-2 bg-white text-gray-900 px-6 py-3 rounded-xl font-bold self-start hover:bg-[#7d3cff] hover:text-white transition">
                        Mua ngay <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 5. NEWSLETTER (FORM ĐĂNG KÝ) --}}
    <div class="container mx-auto px-4">
        {{-- Sử dụng style background tối màu rounded-[3rem] như mẫu --}}
        <div class="bg-gray-900 rounded-[3rem] p-12 md:p-16 text-white shadow-2xl shadow-purple-200 relative overflow-hidden text-center">

            <div class="relative z-10 max-w-3xl mx-auto">
                <i class="fa-solid fa-paper-plane text-[#7d3cff] text-5xl mb-6"></i>
                <h2 class="text-3xl md:text-5xl font-black mb-6">Đăng Ký Nhận Tin Tức</h2>
                <p class="text-gray-300 text-xl mb-10 leading-relaxed">
                    Nhận thông tin về sản phẩm mới, ưu đãi đặc biệt và xu hướng thời trang mới nhất trực tiếp vào hộp thư của bạn.
                </p>

                <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                    <input type="email" placeholder="Nhập email của bạn" class="flex-1 px-6 py-4 rounded-xl text-gray-900 text-lg focus:outline-none focus:ring-4 focus:ring-purple-500/50 border-none">
                    <button type="button" class="bg-[#7d3cff] text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-[#6c2bd9] transition shadow-lg shadow-purple-900/50">
                        Đăng Ký
                    </button>
                </form>
            </div>

            {{-- Decor --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600 rounded-full blur-[100px] opacity-20"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>
        </div>
    </div>

</div>
@endsection
