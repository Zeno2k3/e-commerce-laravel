@extends('client.layouts.app')

@section('content')

{{-- DỮ LIỆU GIẢ --}}
@php
    $products = [
        [
            'id' => 1, 'name' => 'Áo Khoác Denim Nam Classic',
            'image' => 'images/jacket.png',
            'price' => 850000, 'old_price' => 1200000, 'discount' => '-36%', 'rating' => 5, 'reviews' => 42
        ],
        [
            'id' => 3, 'name' => 'Quần Tây Nam Slimfit Hàn Quốc',
            'image' => 'images/jacket.png',
            'price' => 450000, 'old_price' => 550000, 'discount' => '-36%', 'rating' => 5, 'reviews' => 30
        ],
        [
            'id' => 5, 'name' => 'Giày Sneaker Nam Cổ Thấp',
            'image' => 'images/jacket.png',
            'price' => 650000, 'old_price' => 800000, 'discount' => '-36%', 'rating' => 4, 'reviews' => 25
        ],
        [
            'id' => 6, 'name' => 'Áo Thun Basic Cotton 100%',
            'image' => 'images/jacket.png',
            'price' => 150000, 'old_price' => 300000, 'discount' => '-36%', 'rating' => 5, 'reviews' => 88
        ],
        [
            'id' => 7, 'name' => 'Balo Laptop Chống Nước',
            'image' => 'images/jacket.png',
            'price' => 420000, 'old_price' => 600000, 'discount' => '-36%', 'rating' => 4, 'reviews' => 12
        ]
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- PHẦN HEADER: SALE BANNER --}}
        <div class="text-center mb-16 max-w-4xl mx-auto">
            {{-- Tag Khuyến Mãi: Đồng bộ font-bold text-2xl tracking-widest từ trang gốc --}}
            <span class="inline-block py-2 px-6 rounded-lg bg-red-100 text-red-500 font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-percent mr-2"></i> Khuyến mãi lớn
            </span>

            {{-- Tiêu đề lớn: Đồng bộ text-4xl md:text-5xl lg:text-5xl font-black --}}
            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-800 mb-4 tracking-tight leading-tight uppercase">
                SALE UP TO <span class="text-[#ff424e]">36%</span>
            </h1>

            {{-- Mô tả: Đồng bộ text-1xl --}}
            <p class="text-gray-600 text-1xl mb-2 font-medium">
                Cơ hội vàng sở hữu những món đồ thời trang yêu thích với giá ưu đãi
            </p>

            {{-- Timer / Note: Giữ text-base (chuẩn cho văn bản phụ) --}}
            <p class="text-gray-500 text-base flex items-center justify-center gap-2">
                <i class="fa-regular fa-clock"></i> Thời gian có hạn - Nhanh tay kẻo lỡ!
            </p>
        </div>

        {{-- PHẦN BỘ LỌC (FILTER BAR) --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 pb-6 border-b border-gray-100">
            {{-- Tiêu đề section: Đồng bộ text-3xl font-bold --}}
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sản phẩm khuyến mãi</h2>
                <p class="text-gray-500 text-base font-medium">{{ count($products) }} sản phẩm đang được giảm giá</p>
            </div>

            {{-- Các nút lọc: Đồng bộ text-base font-bold --}}
            <div class="flex flex-wrap gap-3">
                <button class="px-6 py-2.5 rounded-lg bg-[#7d3cff] text-white font-bold text-base shadow-lg shadow-purple-200 transition hover:bg-[#6c2bd9]">
                    Giảm nhiều nhất
                </button>

                <button class="px-6 py-2.5 rounded-lg bg-white border border-gray-200 text-gray-800 font-bold text-base hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
                    Giá thấp nhất
                </button>

                <button class="px-6 py-2.5 rounded-lg bg-white border border-gray-200 text-gray-800 font-bold text-base hover:border-[#7d3cff] hover:text-[#7d3cff] transition">
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

        {{-- PHÂN TRANG: Đồng bộ text-lg cho nút active --}}
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
