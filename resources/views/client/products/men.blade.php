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
    
    $categories = [
        ['name' => 'Tất cả', 'slug' => 'all', 'count' => 5],
        ['name' => 'Áo sơ mi', 'slug' => 'ao-so-mi', 'count' => 0],
        ['name' => 'Quần dài', 'slug' => 'quan-dai', 'count' => 0],
        ['name' => 'Áo khoác', 'slug' => 'ao-khoac', 'count' => 0],
        ['name' => 'Giày dép', 'slug' => 'giay-dep', 'count' => 0],
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER --}}
        <x-client.page-header 
            icon="fa-solid fa-user-tie"
            tag="Thời trang Nam"
            title="Phong Cách"
            highlight="Nam Tính"
            description="Khám phá bộ sưu tập thời trang nam hiện đại, lịch lãm và năng động."
            color="purple" />

        {{-- CATEGORY FILTER --}}
        <x-client.category-filter 
            :categories="$categories" 
            activeCategory="all"
            color="purple" />

        {{-- SORT BAR --}}
        <x-client.sort-bar 
            title="Sản phẩm thời trang nam"
            :count="count($products)"
            :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z']"
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
