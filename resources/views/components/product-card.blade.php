@props(['product'])

<div class="group flex flex-col bg-white border border-gray-100 rounded-2xl p-3 hover:shadow-xl hover:shadow-purple-100 hover:border-purple-300 transition-all duration-300 h-full relative overflow-hidden">

    {{-- 1. ẢNH SẢN PHẨM --}}
    <div class="relative w-full aspect-[4/5] bg-purple-50 rounded-xl overflow-hidden mb-3 group-hover:bg-white transition-colors duration-300">

        @if(isset($product['discount']) && $product['discount'])
            <span class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-md shadow-sm z-10">
                {{ $product['discount'] }}
            </span>
        @endif

        {{-- Link ảnh --}}
        <a href="{{ route('client.product.detail',$product['id'])}} class="block w-full h-full">
            <img src="{{ asset($product['image']) }}"
                 alt="{{ $product['name'] }}"
                 class="w-full h-full object-contain mix-blend-multiply p-4 transition-transform duration-500 group-hover:scale-110">
        </a>

        {{-- Nút yêu thích (Heart) --}}
        <button class="absolute top-2 right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 shadow-sm opacity-0 group-hover:opacity-100 transition-all transform translate-x-4 group-hover:translate-x-0">
            <i class="fa-regular fa-heart"></i>
        </button>
    </div>

    {{-- 2. THÔNG TIN SẢN PHẨM --}}
    <div class="flex flex-col flex-1">

        {{-- Link tên sản phẩm --}}
        <a href="{{ route('client.product.detail', $product['id']) }}" class="block group/link">
            <h3 class="text-gray-800 font-bold text-[15px] leading-snug mb-2 line-clamp-2 min-h-[44px] group-hover/link:text-[#7d3cff] transition-colors">
                {{ $product['name'] }}
            </h3>
        </a>

        {{-- Đánh giá sao --}}
        <div class="flex items-center gap-1.5 mb-3">
            <div class="flex text-yellow-400 text-xs">
                @for($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= ($product['rating'] ?? 5) ? 'fa-solid' : 'fa-regular' }} fa-star{{ $i > ($product['rating'] ?? 5) ? ' text-gray-200' : '' }}"></i>
                @endfor
            </div>
            <span class="text-xs text-gray-400">({{ $product['reviews'] ?? 0 }})</span>
        </div>

        {{-- Giá tiền --}}
        <div class="flex items-baseline gap-2 mb-4 mt-auto">
            <span class="text-[#7d3cff] font-black text-xl">
                {{ number_format($product['price'], 0, ',', '.') }}₫
            </span>
            @if(isset($product['old_price']) && $product['old_price'])
                <span class="text-gray-400 text-xs line-through">
                    {{ number_format($product['old_price'], 0, ',', '.') }}₫
                </span>
            @endif
        </div>

        {{-- 3. NÚT THÊM GIỎ HÀNG (Quan trọng: Đã có onclick) --}}
        <button onclick="addToCartDemo(event)" class="w-full bg-gradient-to-r from-[#7d3cff] to-[#a76bf8] hover:to-[#7d3cff] text-white font-bold text-sm py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 shadow-md shadow-purple-200 hover:shadow-lg hover:shadow-purple-300 transform active:scale-95">
            <i class="fa-solid fa-cart-plus"></i>
            Thêm vào giỏ
        </button>
    </div>
</div>
