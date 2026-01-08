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
        <x-client.page-header 
            icon="fa-solid fa-percent"
            tag="Khuyến mãi lớn"
            color="red">
            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-800 mb-4 tracking-tight leading-tight uppercase">
                SALE UP TO <span class="text-[#ff424e]">36%</span>
            </h1>
            <p class="text-gray-600 text-xl mb-2 font-medium">
                Cơ hội vàng sở hữu những món đồ thời trang yêu thích với giá ưu đãi
            </p>
            <p class="text-gray-500 text-base flex items-center justify-center gap-2">
                <i class="fa-regular fa-clock"></i> Thời gian có hạn - Nhanh tay kẻo lỡ!
            </p>
        </x-client.page-header>

        {{-- PHẦN BỘ LỌC (FILTER BAR) --}}
        <x-client.sort-bar 
            title="Sản phẩm khuyến mãi"
            :count="count($products)"
            :sortOptions="['Giảm nhiều nhất', 'Giá thấp nhất', 'Tên A-Z']"
            :activeSort="0"
            color="purple" />

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- PHÂN TRANG --}}
        <x-client.pagination :currentPage="1" :totalPages="1" color="purple" />

    </div>
</div>
@endsection
