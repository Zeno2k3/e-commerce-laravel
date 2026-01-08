@extends('client.layouts.app')

@section('content')

{{-- DỮ LIỆU GIẢ CHO TRANG CHỦ --}}
@php
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
            'id' => 2, 'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương', 'image' => 'images/jacket.png', 'price' => 1000000, 'old_price' => 1250000, 'discount' => '-20%', 'rating' => 5, 'reviews' => 69
        ],
        [
            'id' => 3, 'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương', 'image' => 'images/shirt.png', 'price' => 1000000, 'old_price' => 1250000, 'discount' => '-20%', 'rating' => 5, 'reviews' => 69
        ],
        [
            'id' => 4, 'name' => 'Áo Khoác Jean Phối Nón The Original 039 Xanh Dương', 'image' => 'images/jacket.png', 'price' => 1000000, 'old_price' => 1250000, 'discount' => '-20%', 'rating' => 5, 'reviews' => 69
        ]
    ];
@endphp

<div class="font-sans text-gray-800">

    {{-- 1. HERO SECTION (Banner chính) [cite: 117-124] --}}
    <section class="relative bg-gray-50 py-12 md:py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-10">
            <div class="md:w-1/2 z-10">
                <span class="text-gray-500 font-semibold text-sm md:text-base mb-2 block uppercase tracking-wider">
                    Bộ sưu tập mới 2025
                </span>

                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                    Thời trang hiện đại cho <br>
                    <span class="text-indigo-600">phong cách của bạn</span>
                </h1>

                <p class="text-gray-500 text-sm md:text-base mb-8 max-w-md leading-relaxed">
                    Khám phá những xu hướng thời trang mới nhất với chất lượng cao cấp và giá cả hợp lý. Tự tin thể hiện phong cách riêng.
                </p>

                <div class="flex gap-3">
                    <a href="/san-pham" class="bg-black text-white px-6 py-3 rounded text-sm font-bold hover:bg-gray-800 transition flex items-center gap-2">
                        Mua sắm ngay <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="/contact" class="bg-white text-gray-900 border border-gray-300 px-6 py-3 rounded text-sm font-bold hover:border-black transition">
                        Tìm hiểu thêm
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 relative">
                <div class="relative z-10 bg-gray-200 rounded-2xl overflow-hidden aspect-[4/3] shadow-xl">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=2070&auto=format&fit=crop" alt="Hero Image" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- 2. FEATURES (Cam kết dịch vụ) [cite: 125-133] --}}
    <section class="py-10 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center divide-x divide-gray-100 md:divide-none">
                {{-- Feature 1 --}}
                <div class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">Giao hàng miễn phí</h4>
                        <p class="text-xs text-gray-500">Đơn hàng trên 500k</p>
                    </div>
                </div>
                {{-- Feature 2 --}}
                <div class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">Thanh toán an toàn</h4>
                        <p class="text-xs text-gray-500">Bảo mật 100%</p>
                    </div>
                </div>
                {{-- Feature 3 --}}
                <div class="flex flex-col items-center gap-2">
                    <i class="fa-regular fa-star text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">Chất lượng đảm bảo</h4>
                        <p class="text-xs text-gray-500">Sản phẩm chính hãng</p>
                    </div>
                </div>
                {{-- Feature 4 --}}
                <div class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-arrow-rotate-left text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">Đổi trả dễ dàng</h4>
                        <p class="text-xs text-gray-500">Trong vòng 30 ngày</p>
                    </div>
                </div>
                {{-- Feature 5 --}}
                <div class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-headset text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">Hỗ trợ 24/7</h4>
                        <p class="text-xs text-gray-500">Tư vấn mọi lúc</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. SẢN PHẨM NỔI BẬT [cite: 134-152] --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Sản phẩm nổi bật</h2>
                <p class="text-gray-500 text-sm md:text-base max-w-xl mx-auto">
                    Khám phá những sản phẩm được yêu thích nhất với chất lượng cao cấp và thiết kế thời thượng
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @foreach($featured_products as $product)
                <div class="group bg-white rounded-lg overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-lg transition duration-300 relative">
                    {{-- Badge Sale --}}
                    <span class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded z-10 uppercase">
                        {{ $product['discount'] }}
                    </span>

                    {{-- Image --}}
                    <div class="aspect-[3/4] overflow-hidden bg-gray-100 relative group">
                        <img src="{{ $product['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                        {{-- Nút Thêm vào giỏ: Hiện khi hover --}}
                        <div class="absolute inset-x-0 bottom-0 p-3 translate-y-full group-hover:translate-y-0 transition duration-300">
                            <button class="w-full bg-black text-white py-2.5 rounded text-sm font-bold hover:bg-gray-800 flex items-center justify-center gap-2 shadow-lg">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-3">
                        <h3 class="font-medium text-gray-900 text-sm mb-1 line-clamp-2 min-h-[40px] leading-snug group-hover:text-indigo-600 transition">
                            {{ $product['name'] }}
                        </h3>

                        <div class="flex items-end justify-between mt-1">
                            <div class="flex flex-col">
                                <span class="text-red-600 font-bold text-base">{{ number_format($product['price']) }}đ</span>
                                <span class="text-gray-400 text-xs line-through">{{ number_format($product['old_price']) }}đ</span>
                            </div>
                            <div class="text-yellow-400 text-xs flex items-center gap-0.5">
                                <span>5</span> <i class="fa-solid fa-star text-[10px]"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="/san-pham" class="inline-block border border-gray-800 text-gray-800 px-8 py-2.5 rounded text-sm font-bold hover:bg-gray-800 hover:text-white transition uppercase tracking-wide">
                    Xem tất cả sản phẩm
                </a>
            </div>
        </div>
    </section>

    {{-- 4. BANNER DANH MỤC (Nam/Nữ) [cite: 153-154] --}}
    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category Nam --}}
                <div class="relative group h-[350px] rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-8">
                        <h3 class="text-2xl font-bold text-white mb-1">Thời trang Nam</h3>
                        <p class="text-gray-300 text-sm mb-4">Phong cách lịch lãm, hiện đại</p>

                        {{-- Nút Xem ngay đã được chuyển thành thẻ a --}}
                        <a href="/men" class="inline-block text-white text-sm font-bold underline decoration-2 underline-offset-4 group-hover:text-indigo-400 transition">
                            Xem ngay <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                {{-- Category Nữ --}}
                <div class="relative group h-[350px] rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-8">
                        <h3 class="text-2xl font-bold text-white mb-1">Thời trang Nữ</h3>
                        <p class="text-gray-300 text-sm mb-4">Trẻ trung, thanh lịch, quyến rũ</p>

                        {{-- Nút Xem ngay đã được chuyển thành thẻ a --}}
                        <a href="/women" class="inline-block text-white text-sm font-bold underline decoration-2 underline-offset-4 group-hover:text-pink-400 transition">
                            Xem ngay <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. NEWSLETTER [cite: 156-160] --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-xl mx-auto">
                <i class="fa-regular fa-envelope text-4xl mb-4 text-indigo-600"></i>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Đăng ký nhận tin tức</h2>
                <p class="text-gray-500 text-sm mb-6">
                    Nhận thông tin về sản phẩm mới, ưu đãi đặc biệt và xu hướng thời trang mới nhất.
                </p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Nhập email của bạn" class="flex-1 px-4 py-3 rounded border border-gray-300 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    <button type="button" class="bg-black text-white px-6 py-3 rounded font-bold text-sm hover:bg-gray-800 transition">
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection
