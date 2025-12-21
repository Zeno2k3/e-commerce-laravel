@extends('client.layouts.app')

@section('content')

{{-- DỮ LIỆU GIẢ --}}
@php
    $products = [
        [
            'id' => 1, 'name' => 'Áo Khoác Denim Nam Classic Form Rộng',
            'image' => 'images/jacket.png',
            'price' => 850000, 'old_price' => 1200000, 'discount' => '-29%', 'rating' => 5, 'reviews' => 42
        ],
        [
            'id' => 2, 'name' => 'Áo Polo Nam Vải Cá Sấu Cao Cấp',
            'image' => 'images/jacket.png',
            'price' => 350000, 'old_price' => null, 'discount' => null, 'rating' => 4, 'reviews' => 150
        ],
        [
            'id' => 3, 'name' => 'Quần Tây Nam Slimfit Hàn Quốc',
            'image' => 'images/jacket.png',
            'price' => 450000, 'old_price' => 550000, 'discount' => '-18%', 'rating' => 5, 'reviews' => 30
        ],
        [
            'id' => 4, 'name' => 'Áo Vest Nam Blazer Lịch Lãm',
            'image' => 'images/jacket.png',
            'price' => 1500000, 'old_price' => null, 'discount' => null, 'rating' => 5, 'reviews' => 12
        ],
        [
            'id' => 5, 'name' => 'Giày Sneaker Nam Cổ Thấp Trắng',
            'image' => 'images/jacket.png',
            'price' => 650000, 'old_price' => 800000, 'discount' => '-15%', 'rating' => 4, 'reviews' => 25
        ]
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        <div class="text-center mb-12 max-w-3xl mx-auto">
            <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-user-tie mr-2"></i> Thời trang Nam
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                Phong Cách <span class="text-[#7d3cff]">Nam Tính</span>
            </h1>

            <p class="text-gray-500 text-1xl">
                Khám phá bộ sưu tập thời trang nam hiện đại, lịch lãm và năng động.
            </p>
        </div>

        <div class="mb-12">
            <h3 class="font-bold text-gray-800 text-2xl mb-6">Danh mục</h3>
            <div class="flex flex-wrap gap-4">
                <button class="flex items-center gap-3 bg-[#7d3cff] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-purple-200 hover:bg-[#6c2bd9] transition transform hover:scale-105">
                    Tất cả
                    <span class="bg-white/20 text-white px-2.5 py-0.5 rounded-md text-sm font-extrabold">5</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Áo sơ mi
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-purple-50 group-hover:text-[#7d3cff] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Quần dài
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-purple-50 group-hover:text-[#7d3cff] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Áo khoác
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-purple-50 group-hover:text-[#7d3cff] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>

                <button class="group flex items-center gap-3 bg-white border-2 border-gray-100 text-gray-600 px-8 py-4 rounded-xl font-bold text-lg hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Giày dép
                    <span class="bg-gray-100 text-gray-500 group-hover:bg-purple-50 group-hover:text-[#7d3cff] px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">0</span>
                </button>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 pb-6 border-b border-gray-100">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sản phẩm thời trang nam</h2>
                <p class="text-gray-500 text-base font-medium">5 sản phẩm được tìm thấy</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-3 rounded-lg bg-[#7d3cff] text-white font-bold text-base shadow-lg shadow-purple-200 transition">
                    Nổi bật
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Giá thấp
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Giá cao
                </button>
                <button class="px-6 py-3 rounded-lg bg-white border border-gray-200 text-gray-600 font-bold text-base hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
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
            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-[#7d3cff] bg-white hover:bg-purple-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-left text-lg group-hover:-translate-x-1 transition-transform"></i>
            </button>

            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border-2 border-[#7d3cff] text-[#7d3cff] font-black text-lg shadow-md">
                1
            </button>

            <button class="group w-12 h-12 flex items-center justify-center text-gray-400 hover:text-[#7d3cff] bg-white hover:bg-purple-50 rounded-xl transition-all border border-gray-200">
                <i class="fa-solid fa-angles-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

    </div>
</div>
@endsection
