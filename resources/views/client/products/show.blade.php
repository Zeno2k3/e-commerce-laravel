@extends('client.layouts.app')

@section('content')
<div class="bg-white font-sans pb-20">
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- 1. BREADCRUMB --}}
        @php
            $breadcrumbs = [
                ['label' => 'Sản phẩm', 'url' => '#'],
                ['label' => $product['name'], 'url' => '']
            ];
        @endphp

        <x-breadcrumb :links="$breadcrumbs" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-6">

            {{-- 2. CỘT TRÁI: ẢNH SẢN PHẨM --}}
            <div class="space-y-4">
                {{-- Ảnh lớn --}}
                <div class="rounded-2xl overflow-hidden border border-gray-100 relative group">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-auto object-cover">

                    {{-- Nhãn giảm giá --}}
                    @if(isset($product['discount']) && $product['discount'])
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            {{ $product['discount'] }}
                        </span>
                    @endif
                </div>

                {{-- Ảnh nhỏ (Thumbnails) --}}
                <div class="grid grid-cols-4 gap-4">
                    @for($i = 0; $i < 4; $i++)
                        <div class="rounded-xl overflow-hidden border {{ $i == 0 ? 'border-[#7d3cff] border-2' : 'border-gray-200' }} cursor-pointer hover:border-gray-400">
                             <img src="{{ asset($product['image']) }}" class="w-full h-full object-cover">
                        </div>
                    @endfor
                </div>
            </div>

            {{-- 3. CỘT PHẢI: THÔNG TIN CHI TIẾT --}}
            <div>
                {{-- Tên sản phẩm --}}
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-4">
                    {{ $product['name'] }}
                </h1>

                {{-- Đánh giá & Mã SP --}}
                <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
                    <div class="flex items-center text-yellow-400 gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($product['rating']))
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star text-gray-300"></i>
                            @endif
                        @endfor
                        <span class="text-gray-500 ml-2 font-medium">({{ $product['reviews_count'] }} đánh giá)</span>
                    </div>
                    <div class="h-4 w-px bg-gray-300"></div>
                    <span>Mã SP: <span class="font-mono text-gray-900 font-bold">{{ $product['sku'] }}</span></span>
                </div>

                {{-- Giá tiền --}}
                <div class="bg-gray-50 p-6 rounded-2xl mb-8">
                    <div class="flex items-end gap-4">
                        <span class="text-4xl font-black text-[#7d3cff]">
                            {{ number_format($product['price'], 0, ',', '.') }}₫
                        </span>
                        @if($product['old_price'])
                            <span class="text-xl text-gray-400 line-through mb-1">
                                {{ number_format($product['old_price'], 0, ',', '.') }}₫
                            </span>
                        @endif
                        @if(isset($product['discount']) && $product['discount'])
                            <span class="text-red-600 font-bold bg-red-100 px-2 py-1 rounded-md text-sm mb-2">
                                Tiết kiệm {{ $product['discount'] }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Mô tả ngắn --}}
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    {{ Str::limit($product['description'], 150) }}
                </p>

                {{-- Chọn Size --}}
                <div class="mb-8" x-data="{ selectedSize: 'M' }">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-900 text-lg">Kích thước: <span x-text="selectedSize" class="text-[#7d3cff]"></span></span>
                        <a href="#" class="text-[#7d3cff] text-sm font-medium hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-ruler"></i> Bảng size
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button @click="selectedSize = '{{ $size }}'"
                                    :class="selectedSize === '{{ $size }}' ? 'border-2 border-[#7d3cff] text-[#7d3cff] bg-purple-50' : 'border border-gray-200 text-gray-600 hover:border-[#7d3cff]'"
                                    class="w-14 h-12 rounded-xl font-bold transition-all">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Chọn Số lượng & Buttons Action --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10 pb-10 border-b border-gray-100" x-data="{ qty: 1 }">
                    <div class="flex items-center border border-gray-300 rounded-xl w-fit bg-white">
                        <button @click="qty > 1 ? qty-- : qty = 1" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff]"><i class="fa-solid fa-minus"></i></button>
                        <input type="text" x-model="qty" class="w-10 text-center border-none focus:ring-0 font-bold text-gray-900 p-0">
                        <button @click="qty++" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff]"><i class="fa-solid fa-plus"></i></button>
                    </div>

                    <button class="flex-1 bg-[#7d3cff] hover:bg-[#6c2bd9] text-white font-bold text-lg py-3 px-6 rounded-xl shadow-lg shadow-purple-200 transition-all transform active:scale-95 flex items-center justify-center gap-3">
                        <i class="fa-solid fa-cart-plus"></i>
                        Thêm vào giỏ hàng
                    </button>

                    <button class="w-14 h-14 flex-shrink-0 border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 hover:border-red-200 transition-all">
                        <i class="fa-regular fa-heart text-2xl"></i>
                    </button>
                </div>

                {{-- Chính sách --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xl flex-shrink-0">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Giao hàng miễn phí</p>
                            <p class="text-sm text-gray-500">Cho đơn hàng trên 500k</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600 text-xl flex-shrink-0">
                            <i class="fa-solid fa-rotate-left"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Đổi trả dễ dàng</p>
                            <p class="text-sm text-gray-500">Trong vòng 15 ngày</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- 4. PHẦN TAB THÔNG TIN & ĐÁNH GIÁ --}}
                {{-- 4. PHẦN TAB THÔNG TIN & ĐÁNH GIÁ --}}
        <div class="mt-20" x-data="{ activeTab: 'description' }">

            {{-- Tab Headers (Menu chọn tab) --}}
            <div class="flex gap-8 border-b border-gray-200 mb-8 overflow-x-auto">
                <button @click="activeTab = 'description'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'description', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'description' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Mô tả chi tiết
                </button>
                <button @click="activeTab = 'specs'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'specs', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'specs' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Thông số kỹ thuật
                </button>
                <button @click="activeTab = 'reviews'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'reviews', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'reviews' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Đánh giá ({{ count($product['reviews']) }})
                </button>
            </div>

            {{-- Nội dung Tab 1: Mô tả --}}
            <div x-show="activeTab === 'description'" class="bg-gray-50 rounded-2xl p-8 text-gray-700 leading-relaxed">
                <p class="text-lg">{{ $product['description'] }}</p>
            </div>

            {{-- Nội dung Tab 2: Thông số kỹ thuật (Đã chỉnh sửa để hiện dữ liệu thật) --}}
            <div x-show="activeTab === 'specs'" class="bg-gray-50 rounded-2xl p-8 text-gray-700 leading-relaxed" style="display: none;">
                <div class="grid md:grid-cols-2 gap-10">
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl mb-4 border-b border-gray-200 pb-2">Thông tin sản phẩm</h4>
                        <ul class="space-y-4">
                            {{-- Kiểm tra và hiển thị từng thông số --}}
                            @if(isset($product['specs']))
                                @foreach($product['specs'] as $key => $value)
                                    <li class="flex justify-between items-center border-b border-gray-100 pb-2 last:border-0">
                                        <span class="text-gray-500 font-medium capitalize">
                                            {{-- Dịch key sang tiếng Việt cho đẹp --}}
                                            @switch($key)
                                                @case('material') Chất liệu @break
                                                @case('origin') Xuất xứ @break
                                                @case('brand') Thương hiệu @break
                                                @case('style') Kiểu dáng @break
                                                @default {{ $key }}
                                            @endswitch
                                        </span>
                                        <span class="font-bold text-gray-900">{{ $value }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-gray-400 italic">Chưa có thông số kỹ thuật</li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl mb-4 border-b border-gray-200 pb-2">Hướng dẫn bảo quản</h4>
                        <ul class="list-disc pl-6 space-y-3">
                            <li>Giặt máy ở nhiệt độ dưới 30°C</li>
                            <li>Không sử dụng chất tẩy rửa mạnh</li>
                            <li>Phơi nơi thoáng mát, tránh ánh nắng trực tiếp</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Nội dung Tab 3: Đánh giá (Đã chỉnh sửa vòng lặp) --}}
            <div x-show="activeTab === 'reviews'" class="grid grid-cols-1 lg:grid-cols-12 gap-10" style="display: none;">
                {{-- Cột trái: Điểm số --}}
                <div class="lg:col-span-4">
                    <div class="bg-purple-50 rounded-2xl p-8 text-center border border-purple-100 h-full sticky top-24">
                        <div class="text-6xl font-black text-[#7d3cff] mb-2">{{ $product['rating'] }}</div>
                        <div class="flex justify-center gap-1 text-yellow-400 text-xl mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= round($product['rating']) ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-gray-500 font-medium mb-8">({{ count($product['reviews']) }} đánh giá)</p>
                        <button class="w-full bg-white border-2 border-[#7d3cff] text-[#7d3cff] font-bold py-3 px-6 rounded-xl hover:bg-[#7d3cff] hover:text-white transition-all shadow-sm">
                            Viết đánh giá
                        </button>
                    </div>
                </div>

                {{-- Cột phải: Danh sách bình luận --}}
                <div class="lg:col-span-8 space-y-6">
                    @if(count($product['reviews']) > 0)
                        @foreach($product['reviews'] as $review)
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        {{-- Avatar chữ cái --}}
                                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-[#7d3cff] font-bold text-lg">
                                            {{ substr($review['user'], 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg">{{ $review['user'] }}</h4>
                                            <div class="flex items-center gap-2 text-sm">
                                                <div class="flex text-yellow-400 text-xs">
                                                    @for($r=1; $r<=5; $r++)
                                                        <i class="{{ $r <= $review['rating'] ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-gray-400">• {{ $review['time'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 leading-relaxed">{{ $review['content'] }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-gray-500 py-10">
                            Chưa có đánh giá nào. Hãy là người đầu tiên!
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- 5. SẢN PHẨM LIÊN QUAN --}}
        <div class="mt-24">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($product['related_products'] as $related)
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <img src="{{ asset($related['image']) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @if($related['discount'])
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $related['discount'] }}</span>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $related['name'] }}</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">{{ number_format($related['price'], 0, ',', '.') }}₫</span>
                            <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
