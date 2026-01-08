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
    
    $categories = [
        ['name' => 'Tất cả', 'slug' => 'all', 'count' => 5],
        ['name' => 'Túi xách', 'slug' => 'tui-xach', 'count' => 0],
        ['name' => 'Đồng hồ', 'slug' => 'dong-ho', 'count' => 0],
        ['name' => 'Trang sức', 'slug' => 'trang-suc', 'count' => 0],
        ['name' => 'Kính mát', 'slug' => 'kinh-mat', 'count' => 0],
    ];
@endphp

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER --}}
        <x-client.page-header 
            icon="fa-solid fa-gem"
            tag="Phụ kiện"
            title="Hoàn Thiện"
            highlight="Phong Cách"
            description="Bộ sưu tập phụ kiện cao cấp để tôn lên vẻ đẹp và cá tính riêng của bạn."
            color="amber" />

        {{-- CATEGORY FILTER --}}
        <x-client.category-filter 
            :categories="$categories" 
            activeCategory="all"
            color="amber" />

        {{-- SORT BAR --}}
        <x-client.sort-bar 
            title="Phụ kiện thời trang"
            :count="count($products)"
            :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z']"
            :activeSort="0"
            color="amber" />

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- PHÂN TRANG --}}
        <x-client.pagination :currentPage="1" :totalPages="1" color="amber" />

    </div>
</div>
@endsection
