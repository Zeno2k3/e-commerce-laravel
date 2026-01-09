@extends('client.layouts.app')

@section('content')
<div class="bg-white font-sans pb-20" x-data="productDetailApp({{ $product['id'] }}, {{ json_encode($product['variants']->toArray()) }}, {{ json_encode($product['gallery']) }})" x-init="init()">
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- 1. BREADCRUMB --}}
        @php
            $breadcrumbs = [
                ['label' => 'Sản phẩm', 'url' => route('client.products.index')],
                ['label' => $product['name'], 'url' => route('client.products.show', $product['id'])]
            ];
        @endphp

        <x-breadcrumb :links="$breadcrumbs" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-6">

           {{-- 2. CỘT TRÁI: ẢNH SẢN PHẨM --}}
            <div class="space-y-4">
                {{-- ẢNH LỚN --}}
                <div class="rounded-2xl overflow-hidden border border-gray-100 relative group aspect-square bg-gray-50 flex items-center justify-center">
                    <img :src="activeImage"
                         alt="{{ $product['name'] }}"
                         class="w-full h-full object-contain transition-opacity duration-300 ease-in-out">

                    {{-- Nhãn giảm giá --}}
                    @if(!empty($product['discount']))
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                            {{ $product['discount'] }}
                        </span>
                    @endif
                </div>

                {{-- ẢNH NHỎ (THUMBNAILS) --}}
                <div class="grid grid-cols-4 gap-4">
                    <template x-for="(imgUrl, index) in gallery" :key="index">
                        <div @click="activeImage = imgUrl"
                             :class="activeImage === imgUrl ? 'border-[#7d3cff] ring-1 ring-[#7d3cff]/30' : 'border-gray-200 hover:border-gray-400 opacity-70 hover:opacity-100'"
                             class="rounded-xl overflow-hidden border-2 cursor-pointer transition-all aspect-square h-24 bg-gray-50">
                             <img :src="imgUrl" class="w-full h-full object-cover">
                        </div>
                    </template>
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
                            @if($i <= floor($product['rating']))
                                <i class="fa-solid fa-star"></i>
                            @elseif($i == ceil($product['rating']) && ($product['rating'] - floor($product['rating'])) >= 0.1)
                                <i class="fa-solid fa-star-half-stroke"></i>
                            @else
                                <i class="fa-regular fa-star text-gray-300"></i>
                            @endif
                        @endfor
                        <span class="text-gray-500 ml-2 font-medium">({{ $product['reviews_count'] }} đánh giá)</span>
                    </div>
                    <div class="h-4 w-px bg-gray-300"></div>
                    <span>Mã SP: <span class="font-mono text-gray-900 font-bold">{{ $product['sku'] }}</span></span>
                </div>

                {{-- Giá tiền - DYNAMIC --}}
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 p-6 rounded-2xl mb-8 border border-purple-100">
                    <div class="flex items-end gap-4">
                        <span class="text-4xl font-black text-[#7d3cff]" x-text="formatPrice(currentPrice)">
                        </span>
                        <template x-if="currentOldPrice && currentOldPrice > currentPrice">
                            <span class="text-xl text-gray-400 line-through mb-1" x-text="formatPrice(currentOldPrice)">
                            </span>
                        </template>
                        <template x-if="currentDiscount">
                            <span class="text-red-600 font-bold bg-red-100 px-3 py-1 rounded-md text-sm mb-2">
                                Tiết kiệm <span x-text="currentDiscount"></span>
                            </span>
                        </template>
                    </div>
                    <template x-if="selectedVariant">
                        <p class="text-sm text-gray-600 mt-2">
                            <i class="fa-solid fa-box-open mr-1"></i>
                            Còn lại: <span class="font-bold text-green-600" x-text="selectedVariant.stock"></span> sản phẩm
                        </p>
                    </template>
                </div>

                {{-- Mô tả ngắn --}}
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    {{ Str::limit($product['description'], 150) }}
                </p>

                {{-- ========== SMART VARIANT SELECTOR ========== --}}
                
                {{-- Chọn SIZE --}}
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-900 text-lg">
                            Kích thước: 
                            <span class="text-[#7d3cff]" x-text="selectedSize || 'Chưa chọn'"></span>
                        </span>
                        <a href="#" class="text-[#7d3cff] text-sm font-medium hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-ruler"></i> Bảng size
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <template x-for="size in availableSizes" :key="size">
                            <button 
                                @click="selectSize(size)"
                                :class="{
                                    'border-2 border-[#7d3cff] text-[#7d3cff] bg-purple-50 ring-2 ring-purple-200': selectedSize === size,
                                    'border border-gray-300 text-gray-700 hover:border-[#7d3cff] hover:bg-purple-50': selectedSize !== size
                                }"
                                class="min-w-[56px] h-12 px-4 rounded-xl font-bold transition-all transform hover:scale-105"
                                x-text="size">
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Chọn COLOR --}}
                <div class="mb-8" x-show="selectedSize">
                    <div class="mb-3">
                        <span class="font-bold text-gray-900 text-lg">
                            Màu sắc: 
                            <span class="text-[#7d3cff]" x-text="selectedColor || 'Chưa chọn'"></span>
                        </span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <template x-for="colorOption in availableColors" :key="colorOption.color">
                            <button 
                                @click="selectColor(colorOption.color)"
                                :disabled="!colorOption.available"
                                :class="{
                                    'border-2 border-[#7d3cff] bg-purple-50': selectedColor === colorOption.color,
                                    'border border-gray-300 hover:border-[#7d3cff]': selectedColor !== colorOption.color && colorOption.available,
                                    'opacity-40 cursor-not-allowed border-gray-200': !colorOption.available
                                }"
                                class="p-3 rounded-xl transition-all text-left relative">
                                <div class="font-bold text-gray-900" x-text="colorOption.color || 'Không màu'"></div>
                                <div class="text-sm text-[#7d3cff] font-semibold" x-text="formatPrice(colorOption.price)"></div>
                                <div 
                                    :class="colorOption.stock > 0 ? 'text-green-600' : 'text-red-500'"
                                    class="text-xs font-medium"
                                    x-text="colorOption.stock > 0 ? 'Còn ' + colorOption.stock : 'Hết hàng'">
                                </div>
                                <template x-if="!colorOption.available">
                                    <div class="absolute inset-0 flex items-center justify-center bg-white/80 rounded-xl">
                                        <i class="fa-solid fa-lock text-gray-400"></i>
                                    </div>
                                </template>
                            </button> 
                        </template>
                    </div>
                </div>

                {{-- Chọn Số lượng & Buttons Action --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10 pb-10 border-b border-gray-100" x-data="{ qty: 1 }">
                    <div class="flex items-center border-2 border-gray-300 rounded-xl w-fit bg-white">
                        <button @click="qty > 1 ? qty-- : qty = 1" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff] transition">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="text" x-model="qty" class="w-16 text-center border-none focus:ring-0 font-bold text-gray-900 p-0">
                        <button 
                            @click="qty++" 
                            :disabled="!selectedVariant || qty >= selectedVariant.stock"
                            class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff] transition disabled:opacity-40">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <button 
                        @click="addToCart()"
                        :disabled="!selectedVariant || selectedVariant.stock === 0 || isLoading"
                        :class="selectedVariant && selectedVariant.stock > 0 && !isLoading ? 'bg-[#7d3cff] hover:bg-[#6c2bd9] shadow-lg shadow-purple-200' : 'bg-gray-300 cursor-not-allowed'"
                        class="flex-1 text-white font-bold text-lg py-3 px-6 rounded-xl transition-all transform active:scale-95 flex items-center justify-center gap-3">
                        
                        <template x-if="isLoading">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                        </template>
                        <template x-if="!isLoading">
                            <i class="fa-solid fa-cart-plus"></i>
                        </template>
                        
                        <span x-text="isLoading ? 'Đang xử lý...' : (selectedVariant && selectedVariant.stock > 0 ? 'Thêm vào giỏ hàng' : 'Vui lòng chọn biến thể')"></span>
                    </button>

                    <button 
                        @click="toggleFavorite"
                        :class="{'bg-red-50 text-red-500 border-red-200': isFavorited, 'text-gray-400 hover:text-red-500 hover:bg-red-50 hover:border-red-200': !isFavorited}"
                        class="w-14 h-14 flex-shrink-0 border-2 border-gray-200 rounded-xl flex items-center justify-center transition-all group">
                        <i :class="isFavorited ? 'fa-solid fa-heart' : 'fa-regular fa-heart'" class="text-2xl transition-transform group-hover:scale-110"></i>
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
{{-- Nội dung Tab 1: Mô tả (Đã sửa theo mẫu ảnh yêu cầu) --}}
            <div x-show="activeTab === 'description'" class="bg-gray-50 rounded-2xl p-8 text-gray-700 leading-relaxed">

                {{-- 1. Đoạn giới thiệu chung --}}
                <div class="mb-6">
                    <p class="text-400">
                        {{--
                           Nếu data của bạn chưa có HTML, bạn có thể hardcode text mẫu giống ảnh
                           hoặc dùng {!! $product['description'] !!} nếu trong DB đã lưu dạng HTML.
                           Dưới đây là text demo giống hệt ảnh bạn gửi:
                        --}}
                        Áo khoác jean 100% có nón, form regular fit, phù hợp mặc hàng ngày.
                    </p>
                </div>

                {{-- 2. Phần Đặc điểm nổi bật --}}
                <div class="space-y-3">
                    <h4 class="font-bold text-gray-900 text-lg">Đặc điểm nổi bật:</h4>

                    <ul class="list-disc pl-5 space-y-2 marker:text-gray-400">
                        <li>Chất liệu cao cấp, bền đẹp theo thời gian</li>
                        <li>Thiết kế hiện đại, phù hợp nhiều dịp</li>
                        <li>Form dáng chuẩn, tôn dáng người mặc</li>
                        <li>Dễ dàng phối đồ với nhiều trang phục khác</li>
                        <li>Chăm sóc đơn giản, giặt máy được</li>
                    </ul>
                </div>

                {{--
                   LƯU Ý:
                   Sau này để nội dung này động theo từng sản phẩm,
                   bạn nên cài CKEditor hoặc Summernote cho trang Admin để nhập liệu dạng văn bản phong phú (Rich Text).
                   Khi đó ngoài view chỉ cần gọi: {!! $product['description'] !!} là nó tự hiện danh sách đẹp như trên.
                --}}
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
                                @if($i <= floor($product['rating']))
                                    <i class="fa-solid fa-star"></i>
                                @elseif($i == ceil($product['rating']) && ($product['rating'] - floor($product['rating'])) >= 0.1)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @else
                                    <i class="fa-regular fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-gray-500 font-medium mb-8">({{ count($product['reviews']) }} đánh giá)</p>
                        <button @click="showReviewModal = true" class="w-full bg-white border-2 border-[#7d3cff] text-[#7d3cff] font-bold py-3 px-6 rounded-xl hover:bg-[#7d3cff] hover:text-white transition-all shadow-sm">
                            Viết đánh giá
                        </button>
                    </div>
                </div>

                {{-- Cột phải: Danh sách bình luận --}}
                <div class="lg:col-span-8 space-y-6">
                    @forelse($product['reviews'] as $review)
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-[#7d3cff] font-bold text-lg">
                                        {{ substr($review['user'], 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">{{ $review['user'] }}</h4>
                                        <div class="flex items-center gap-2 text-sm">
                                            <div class="flex text-yellow-400 text-xs">
                                                @for($r=1; $r<=5; $r++)
                                                    @if($r <= floor($review['rating']))
                                                        <i class="fa-solid fa-star"></i>
                                                    @elseif($r == ceil($review['rating']) && ($review['rating'] - floor($review['rating'])) >= 0.1)
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-gray-300"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-gray-400">• {{ $review['time'] }}</span>
                                        </div>
                                    </div>
                                    </div>
                                    @auth
                                        @if($review['user_id'] === auth()->id())
                                            <div class="ml-auto flex gap-2">
                                                <button @click="editReview({{ Js::from($review) }})" class="text-gray-400 hover:text-[#7d3cff] transition-colors" title="Sửa đánh giá">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="deleteReview({{ $review['id'] }})" class="text-gray-400 hover:text-red-500 transition-colors" title="Xóa đánh giá">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            <p class="text-gray-600 leading-relaxed">{{ $review['content'] }}</p>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-2xl p-12 text-center">
                            <i class="fa-regular fa-comment-dots text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 font-medium text-lg">Chưa có đánh giá nào</p>
                            <p class="text-gray-400 text-sm mt-2">Hãy là người đầu tiên đánh giá sản phẩm này!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- 5. SẢN PHẨM LIÊN QUAN --}}
        @if(!empty($product['related_products']) && count($product['related_products']) > 0)
        <div class="mt-24">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($product['related_products'] as $related)
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <a href="{{ route('client.products.show', $related['id']) }}" class="block w-full h-full">
                            <img src="{{ asset($related['image']) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if($related['discount'])
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">{{ $related['discount'] }}</span>
                            @endif
                        </a>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('client.products.show', $related['id']) }}" class="block group-hover:text-[#7d3cff] transition-colors">
                            <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $related['name'] }}</h3>
                        </a>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">{{ number_format($related['price'], 0, ',', '.') }}₫</span>
                            <button @click="quickAddToCart({{ $related['id'] }}, {{ $related['variant_id'] ?? 'null' }})" 
                               class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors"
                               title="Thêm nhanh vào giỏ hàng">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    {{-- REVIEW MODAL --}}
    <div x-cloak x-show="showReviewModal" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        x-transition.opacity>
        <div class="bg-white rounded-2xl w-full max-w-lg p-8 mx-4 shadow-2xl transform transition-all"
            @click.outside="showReviewModal = false"
            x-transition.scale>
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Đánh giá sản phẩm</h3>
                <button type="button" @click="showReviewModal = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>

            @auth
            <form @submit.prevent="submitReview">
                <div class="mb-6 text-center">
                    <p class="text-gray-600 mb-2">Bạn cảm thấy sản phẩm này thế nào?</p>
                    <div class="flex justify-center gap-2">
                        <template x-for="star in 5">
                            <button type="button" 
                                    @click="reviewRating = star"
                                    @mouseenter="hoverRating = star"
                                    @mouseleave="hoverRating = 0"
                                    class="text-3xl transition-transform hover:scale-110 focus:outline-none">
                                <i class="fa-star" 
                                   :class="(hoverRating || reviewRating) >= star ? 'fa-solid text-yellow-400' : 'fa-regular text-gray-300'">
                                </i>
                            </button>
                        </template>
                    </div>
                    <div class="mt-2 font-bold text-yellow-500 h-6" x-text="getRatingLabel(hoverRating || reviewRating)"></div>
                </div>

                <div class="mb-6">
                    <label class="block font-bold text-gray-700 mb-2">Nhận xét của bạn</label>
                    <textarea x-model="reviewContent" 
                              rows="4" 
                              class="w-full border-gray-200 rounded-xl focus:ring-[#7d3cff] focus:border-[#7d3cff]"
                              placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..."></textarea>
                </div>

                <button type="submit" 
                        :disabled="isSubmitting || reviewRating === 0"
                        class="w-full bg-[#7d3cff] text-white font-bold py-3 rounded-xl hover:bg-[#6c2bd9] disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-lg shadow-purple-200">
                    <span x-show="!isSubmitting">Gửi đánh giá</span>
                    <span x-show="isSubmitting"><i class="fa-solid fa-spinner fa-spin mr-2"></i>Đang gửi...</span>
                </button>
            </form>
            @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#7d3cff] text-2xl">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-xl mb-2">Vui lòng đăng nhập</h4>
                <p class="text-gray-500 mb-6">Bạn cần đăng nhập để viết đánh giá cho sản phẩm này.</p>
                <a href="{{ route('login') }}" class="inline-block bg-[#7d3cff] text-white font-bold py-3 px-8 rounded-xl hover:bg-[#6c2bd9] transition">
                    Đăng nhập ngay
                </a>
            </div>
            @endauth
        </div>
    </div>
</div>


<script>
function productDetailApp(productId, variants, galleryArray) {
    return {
        // Core Data
        productId: productId,
        allVariants: variants,
        gallery: galleryArray.map(img => '{{ asset("") }}' + img),
        
        // State
        activeImage: '',
        selectedSize: null,
        selectedColor: null,
        selectedVariant: null,
        isLoading: false,
        qty: 1,
        
        // Review State
        showReviewModal: false,
        reviewRating: 0,
        hoverRating: 0,
        reviewContent: '',
        isSubmitting: false,

        // Favorite
        isFavorited: {{ \Illuminate\Support\Js::from($product['is_favorited'] ?? false) }},

        // Toggle Favorite
        toggleFavorite() {
            if (this.isLoading) return;
            this.isLoading = true;
            
            fetch('{{ route('client.favorite.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: this.productId })
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.status === 'success') {
                    this.isFavorited = !this.isFavorited;
                    // Optional: Show toast or feedback
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => this.isLoading = false);
        },
        
        // Computed Arrays
        availableSizes: [],
        availableColors: [],
        
        // Display Values
        currentPrice: 0,
        currentOldPrice: null,
        currentDiscount: null,
        
        // Initialize
        init() {
            // Set initial active image
            this.activeImage = this.gallery[0] || '{{ asset("images/no-image.png") }}';
            
            // Get unique sizes
            this.availableSizes = [...new Set(this.allVariants.map(v => v.size))].filter(Boolean);
            
            // Auto-select logic
            if (this.availableSizes.length === 1) {
                this.selectSize(this.availableSizes[0]);
            } else {
                this.updatePrice();
            }
        },
        
        getRatingLabel(star) {
            const labels = ['Chưa chọn', 'Tệ', 'Không hài lòng', 'Bình thường', 'Hài lòng', 'Tuyệt vời'];
            return labels[star] || '';
        },

        editReview(review) {
            this.reviewRating = review.rating;
            this.reviewContent = review.content;
            this.showReviewModal = true;
        },

        deleteReview(reviewId) {
            if (!confirm('Bạn có chắc chắn muốn xóa đánh giá này không?')) return;

            fetch(`/review/${reviewId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    alert('Đánh giá đã được xóa thành công!');
                    window.location.reload(); 
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Có lỗi xảy ra khi xóa đánh giá');
            });
        },

        async submitReview() {
            if (this.reviewRating === 0) {
                alert('Vui lòng chọn số sao đánh giá!');
                return;
            }
            if (!this.reviewContent.trim()) {
                alert('Vui lòng nhập nội dung đánh giá!');
                return;
            }

            this.isSubmitting = true;
            let timeoutId;

            try {
                // Get CSRF Token safely
                const csrfElement = document.querySelector('meta[name="csrf-token"]');
                if (!csrfElement) {
                    throw new Error('Lỗi bảo mật: Không tìm thấy CSRF Token. Vui lòng tải lại trang.');
                }
                const csrfToken = csrfElement.content;

                const controller = new AbortController();
                timeoutId = setTimeout(() => controller.abort(), 15000); // 15s timeout

                const response = await fetch('{{ route("client.review.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: this.productId,
                        rating: this.reviewRating,
                        content: this.reviewContent
                    }),
                    signal: controller.signal
                });

                clearTimeout(timeoutId);
                
                let data;
                try {
                    data = await response.json();
                } catch(e) {
                    throw new Error('Lỗi phản hồi từ máy chủ (Invalid JSON).');
                }

                if (response.ok && data.success) {
                    alert('Đánh giá của bạn đã được ghi nhận!');
                    this.showReviewModal = false;
                    window.location.reload(); 
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra khi lưu trữ.');
                }

            } catch (error) {
                if (timeoutId) clearTimeout(timeoutId);
                console.error('Submit Error:', error);
                
                if (error.name === 'AbortError') {
                     alert('Kết nối quá hạn (15s). Vui lòng kiểm tra mạng.');
                } else {
                     alert(error.message || 'Có lỗi xảy ra.');
                }
            } finally {
                this.isSubmitting = false;
            }
        },

        // Quick Add for Related Products
        quickAddToCart(productId, variantId) {
            if (!variantId) {
                alert('Sản phẩm này cần chọn biến thể. Vui lòng xem chi tiết.');
                window.location.href = `/san-pham/${productId}`;
                return;
            }

            // Using existing addToCart logic but simplified
            this.isLoading = true; // Use global loading state or individual? Global is safer to prevent double clicks.

            fetch('{{ route("client.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    variant_id: variantId,
                    quantity: 1
                })
            })
            .then(async response => {
                if (response.status === 401) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }
                const data = await response.json();
                if (response.ok && data.status === 'success') {
                    alert('Đã thêm 1 sản phẩm vào giỏ hàng!');
                    // Update cart count
                    const cartCountEl = document.getElementById('cart-count');
                    if (cartCountEl && data.total_items) {
                        cartCountEl.innerText = data.total_items;
                        cartCountEl.classList.add('animate-bounce');
                        setTimeout(() => cartCountEl.classList.remove('animate-bounce'), 1000);
                    }
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                console.error('Quick Add Error:', error);
                alert(error.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng');
            })
            .finally(() => {
                this.isLoading = false;
            });
        },
        
        // Select Size
        selectSize(size) {
            this.selectedSize = size;
            this.selectedColor = null; 
            this.updateAvailableColors();
            
            // Auto-select first available color
            const firstAvailable = this.availableColors.find(c => c.available);
            if (firstAvailable) {
                this.selectColor(firstAvailable.color);
            }
        },
        
        // Update Colors
        updateAvailableColors() {
            if (!this.selectedSize) {
                this.availableColors = [];
                return;
            }
            const matchingVariants = this.allVariants.filter(v => v.size === this.selectedSize);
            const colorMap = new Map();
            matchingVariants.forEach(variant => {
                const color = variant.color || 'Không màu';
                if (!colorMap.has(color)) {
                    colorMap.set(color, {
                        color: variant.color,
                        price: variant.price,
                        stock: variant.stock,
                        available: variant.stock > 0,
                        variant: variant
                    });
                }
            });
            this.availableColors = Array.from(colorMap.values());
        },
        
        // Select Color
        selectColor(color) {
            if (!this.selectedSize) return;
            this.selectedColor = color;
            this.updateSelectedVariant();
        },
        
        // Update Variant
        updateSelectedVariant() {
            if (!this.selectedSize || !this.selectedColor) {
                this.selectedVariant = null;
                this.updatePrice();
                return;
            }
            this.selectedVariant = this.allVariants.find(v => 
                v.size === this.selectedSize && 
                (v.color === this.selectedColor || (!v.color && this.selectedColor === 'Không màu'))
            );
            if (this.selectedVariant && this.selectedVariant.url_image) {
                this.activeImage = '{{ asset("") }}' + this.selectedVariant.url_image;
            }
            this.updatePrice();
            
            // Reset quantity if it exceeds new stock
            if (this.selectedVariant && this.qty > this.selectedVariant.stock) {
                this.qty = Math.max(1, this.selectedVariant.stock);
            }
        },
        
        // Update Price
        updatePrice() {
            if (this.selectedVariant) {
                this.currentPrice = this.selectedVariant.price;
            } else if (this.allVariants.length > 0) {
                const prices = this.allVariants.map(v => v.price);
                this.currentPrice = Math.min(...prices);
            }
        },
        
        formatPrice(price) {
            if (!price) return '0₫';
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
        },
        
        // AJAX Add to Cart
        addToCart() {
            if (!this.selectedVariant) {
                alert('Vui lòng chọn đầy đủ kích thước và màu sắc!');
                return;
            }
            
            if (this.qty > this.selectedVariant.stock) {
                alert(`Xin lỗi, chỉ còn ${this.selectedVariant.stock} sản phẩm trong kho!`);
                return;
            }

            this.isLoading = true;

            fetch('{{ route("client.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest', // Important for Laravel to detect AJAX
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: this.productId,
                    variant_id: this.selectedVariant.variant_id,
                    quantity: this.qty
                })
            })
            .then(async response => {
                if (response.status === 401) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }
                
                const data = await response.json();
                
                if (response.ok && data.status === 'success') {
                    // Success logic
                    alert(data.message);
                    
                    // Update cart count in header if element exists
                    const cartCountEl = document.getElementById('cart-count');
                    if (cartCountEl) {
                        cartCountEl.innerText = data.total_items;
                        // Optional: Add simple animation
                        cartCountEl.classList.add('animate-bounce');
                        setTimeout(() => cartCountEl.classList.remove('animate-bounce'), 1000);
                    }
                } else {
                    // Error from server
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng');
            })
            .finally(() => {
                this.isLoading = false;
            });
        }
    }
}
</script>

@endsection
