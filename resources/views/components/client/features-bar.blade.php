{{-- 
    Features Bar Component - Thanh cam kết dịch vụ
    Sử dụng: <x-client.features-bar />
    
    Component này hiển thị các cam kết dịch vụ như:
    - Giao hàng miễn phí
    - Thanh toán an toàn
    - Chất lượng đảm bảo
    - Đổi trả dễ dàng
    - Hỗ trợ 24/7
--}}

@props([
    'features' => null
])

@php
    $defaultFeatures = [
        [
            'icon' => 'fa-solid fa-truck-fast',
            'title' => 'Giao hàng miễn phí',
            'description' => 'Đơn hàng trên 500k'
        ],
        [
            'icon' => 'fa-solid fa-shield-halved',
            'title' => 'Thanh toán an toàn',
            'description' => 'Bảo mật 100%'
        ],
        [
            'icon' => 'fa-regular fa-star',
            'title' => 'Chất lượng đảm bảo',
            'description' => 'Sản phẩm chính hãng'
        ],
        [
            'icon' => 'fa-solid fa-arrow-rotate-left',
            'title' => 'Đổi trả dễ dàng',
            'description' => 'Trong vòng 30 ngày'
        ],
        [
            'icon' => 'fa-solid fa-headset',
            'title' => 'Hỗ trợ 24/7',
            'description' => 'Tư vấn mọi lúc'
        ],
    ];
    
    $items = $features ?? $defaultFeatures;
@endphp

<section class="py-10 bg-white border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center divide-x divide-gray-100 md:divide-none">
            @foreach($items as $feature)
                <div class="flex flex-col items-center gap-2">
                    <i class="{{ $feature['icon'] }} text-2xl text-indigo-600 mb-1"></i>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900">{{ $feature['title'] }}</h4>
                        <p class="text-xs text-gray-500">{{ $feature['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
