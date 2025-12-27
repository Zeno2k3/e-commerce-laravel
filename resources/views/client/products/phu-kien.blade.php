@extends('client.layouts.app')

@section('content')

{{-- DỮ LIỆU GIẢ CHO PHỤ KIỆN --}}
@php
    $products = [
        [
            'id' => 21, 'name' => 'Kính Mát Thời Trang UV400 Unisex',
            'image' => 'images/bag.png',
            'price' => 250000, 'old_price' => 350000, 'discount' => '-28%', 'rating' => 5, 'reviews' => 120
        ],
        [
            'id' => 22, 'name' => 'Đồng Hồ Nam Dây Da Cổ Điển',
            'image' => 'images/bag.png',
            'price' => 1500000, 'old_price' => 2000000, 'discount' => '-25%', 'rating' => 5, 'reviews' => 45
        ],
        [
            'id' => 23, 'name' => 'Túi Đeo Chéo Canvas Tiện Lợi',
            'image' => 'images/bag.png',
            'price' => 150000, 'old_price' => null, 'discount' => null, 'rating' => 4, 'reviews' => 89
        ],
        [
            'id' => 24, 'name' => 'Nón Kết NY Thêu Chữ Nổi 3D',
            'image' => 'images/bag.png',
            'price' => 120000, 'old_price' => 180000, 'discount' => '-33%', 'rating' => 5, 'reviews' => 210
        ],
        [
            'id' => 25, 'name' => 'Thắt Lưng Da Bò Cao Cấp',
            'image' => 'images/bag.png',
            'price' => 450000, 'old_price' => null, 'discount' => null, 'rating' => 4, 'reviews' => 34
        ]
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER TRANG (Thông số y hệt mẫu Nam) --}}
        <div class="text-center mb-12 max-w-3xl mx-auto">
            {{-- Badge: Đổi sang màu Amber (Vàng cam) --}}
            <span class="inline-block py-2 px-5 rounded-lg bg-amber-100 text-amber-600 font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-gem mr-2"></i> Phụ kiện
            </span>

            {{-- Title: Giữ nguyên text-5xl font-black --}}
            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                Hoàn Thiện <span class="text-amber-500">Phong Cách</span>
            </h1>

            <p class="text-gray-500 text-1xl">
                Bộ sưu tập phụ kiện cao cấp để tôn lên vẻ đẹp và cá tính riêng của bạn.
            </p>
        </div>

        {{-- DANH MỤC (Button to px-8 py-4) --}}
        <div class="mb-12">
            <h3 class="font-bold text-gray-800 text-2xl mb-6">Danh mục</h3>
            <div class="flex flex-wrap gap-4">
                {{-- Nút Active: Màu Amber --}}
                <button class="flex items-center gap-3 bg-amber-500 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-amber-200 hover:bg-amber-600 transition transform hover:scale-105">
                    Tất cả
                    <span class="bg-white/20 text-white px-2.5 py-0.5 rounded-md text-sm font-extrabold">5</span>
                </button>

                {{-- Nút Inactive --}}
                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-amber-500 hover:text-amber-500 transition">
                    Túi xách
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-amber-50 group-hover:text-amber-500 px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-amber-500 hover:text-amber-500 transition">
                    Đồng hồ
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-amber-50 group-hover:text-amber-500 px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-amber-500 hover:text-amber-500 transition">
                    Trang sức
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-amber-50 group-hover:text-amber-500 px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-amber-500 hover:text-amber-500 transition">
                    Kính mát
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-amber-50 group-hover:text-amber-500 px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>
            </div>
        </div>

        {{-- TOOLBAR SẮP XẾP --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 pb-6 border-b border-gray-100">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Phụ kiện thời trang</h2>
                <p class="text-gray-500 text-base font-medium">5 sản phẩm được tìm thấy</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-3 rounded-lg bg-amber-500 text-white font-bold text-base shadow-lg shadow-amber-200 transition">
                    Nổi bật
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-amber-500 hover:text-amber-500 transition">
                    Giá thấp
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-amber-500 hover:text-amber-500 transition">
                    Giá cao
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-amber-500 hover:text-amber-500 transition">
                    Tên A-Z
                </button>
            </div>
        </div>

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- PHÂN TRANG (Giữ nguyên size w-12 h-12) --}}
        <div class="mt-16 flex justify-center items-center gap-4">
            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-amber-500 bg-white hover:bg-amber-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-left text-lg group-hover:-translate-x-1 transition-transform"></i>
            </button>

            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-amber-500 text-amber-500 font-black text-lg shadow-md">
                1
            </button>

            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-amber-500 bg-white hover:bg-amber-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

    </div>
</div>
@endsection
