@extends('client.layouts.app')

@section('content')

{{-- DỮ LIỆU GIẢ CHO NỮ --}}
@php
    $products = [
        [
            'id' => 11, 'name' => 'Đầm Dự Tiệc Dáng Dài Sang Trọng',
            'image' => 'images/shirt.png',
            'price' => 1200000, 'old_price' => 1500000, 'discount' => '-20%', 'rating' => 5, 'reviews' => 88
        ],
        [
            'id' => 12, 'name' => 'Chân Váy Xếp Ly Tennis Hàn Quốc',
            'image' => 'images/shirt.png',
            'price' => 350000, 'old_price' => 450000, 'discount' => '-22%', 'rating' => 4, 'reviews' => 210
        ],
        [
            'id' => 13, 'name' => 'Áo Croptop Nữ Cá Tính Tay Dài',
            'image' => 'images/shirt.png',
            'price' => 180000, 'old_price' => null, 'discount' => null, 'rating' => 5, 'reviews' => 56
        ],
        [
            'id' => 14, 'name' => 'Set Blazer Nữ Công Sở Thanh Lịch',
            'image' => 'images/shirt.png',
            'price' => 950000, 'old_price' => 1200000, 'discount' => '-20%', 'rating' => 4, 'reviews' => 34
        ],
        [
            'id' => 15, 'name' => 'Túi Xách Nữ Da Mềm Thời Trang',
            'image' => 'images/shirt.png',
            'price' => 450000, 'old_price' => null, 'discount' => null, 'rating' => 5, 'reviews' => 120
        ]
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        <div class="text-center mb-12 max-w-3xl mx-auto">
            <span class="inline-block py-2 px-5 rounded-lg bg-pink-100 text-[#ec4899] font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-person-dress mr-2"></i> Thời trang Nữ
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                Vẻ Đẹp <span class="text-[#ec4899]">Quyến Rũ</span>
            </h1>

            <p class="text-gray-500 text-1xl">
                Khám phá bộ sưu tập thời trang nữ thanh lịch, hiện đại và đầy cá tính.
            </p>
        </div>

        <div class="mb-12">
            <h3 class="font-bold text-gray-800 text-2xl mb-6">Danh mục</h3>
            <div class="flex flex-wrap gap-4">
                <button class="flex items-center gap-3 bg-[#ec4899] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-pink-200 hover:bg-[#db2777] transition transform hover:scale-105">
                    Tất cả
                    <span class="bg-white/20 text-white px-2.5 py-0.5 rounded-md text-sm font-extrabold">5</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Váy đầm
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-pink-50 group-hover:text-[#ec4899] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Áo kiểu
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-pink-50 group-hover:text-[#ec4899] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Chân váy
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-pink-50 group-hover:text-[#ec4899] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Túi xách
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-pink-50 group-hover:text-[#ec4899] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 pb-6 border-b border-gray-100">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sản phẩm thời trang nữ</h2>
                <p class="text-gray-500 text-base font-medium">5 sản phẩm được tìm thấy</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-3 rounded-lg bg-[#ec4899] text-white font-bold text-base shadow-lg shadow-pink-200 transition">
                    Nổi bật
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Giá thấp
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Giá cao
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#ec4899] hover:text-[#ec4899] transition">
                    Tên A-Z
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-16 flex justify-center items-center gap-4">
            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-[#ec4899] bg-white hover:bg-pink-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-left text-lg group-hover:-translate-x-1 transition-transform"></i>
            </button>

            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-[#ec4899] text-[#ec4899] font-black text-lg shadow-md">
                1
            </button>

            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-[#ec4899] bg-white hover:bg-pink-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

    </div>
</div>
@endsection
