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
    
    $categories = [
        ['name' => 'Tất cả', 'slug' => 'all', 'count' => 5],
        ['name' => 'Váy đầm', 'slug' => 'vay-dam', 'count' => 0],
        ['name' => 'Áo kiểu', 'slug' => 'ao-kieu', 'count' => 0],
        ['name' => 'Chân váy', 'slug' => 'chan-vay', 'count' => 0],
        ['name' => 'Túi xách', 'slug' => 'tui-xach', 'count' => 0],
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER --}}
        <x-client.page-header 
            icon="fa-solid fa-person-dress"
            tag="Thời trang Nữ"
            title="Vẻ Đẹp"
            highlight="Quyến Rũ"
            description="Khám phá bộ sưu tập thời trang nữ thanh lịch, hiện đại và đầy cá tính."
            color="pink" />

        {{-- CATEGORY FILTER --}}
        <x-client.category-filter 
            :categories="$categories" 
            activeCategory="all"
            color="pink" />

        {{-- SORT BAR --}}
        <x-client.sort-bar 
            title="Sản phẩm thời trang nữ"
            :count="count($products)"
            :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z']"
            :activeSort="0"
            color="pink" />

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- PHÂN TRANG --}}
        <x-client.pagination :currentPage="1" :totalPages="1" color="pink" />

    </div>
</div>
@endsection
