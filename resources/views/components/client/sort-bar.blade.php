{{-- 
    Sort Bar Component
    Sử dụng: <x-client.sort-bar 
                title="Sản phẩm thời trang nam"
                :count="5"
                :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z']"
                :activeSort="0"
                :color="'purple'" />
    
    Props:
    - title: Tiêu đề section
    - count: Số lượng sản phẩm
    - sortOptions: Array các tùy chọn sắp xếp
    - activeSort: Index của option đang active
    - color: Màu chủ đạo (purple, pink) - mặc định là purple
--}}

@props([
    'title' => 'Sản phẩm',
    'count' => 0,
    'sortOptions' => ['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z'],
    'activeSort' => 0,
    'color' => 'purple'
])

@php
    $colorClasses = [
        'purple' => [
            'active' => 'bg-[#7d3cff] text-white shadow-lg shadow-purple-200',
            'inactive' => 'bg-white border border-gray-200 text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff]',
        ],
        'pink' => [
            'active' => 'bg-[#ec4899] text-white shadow-lg shadow-pink-200',
            'inactive' => 'bg-white border border-gray-200 text-gray-600 hover:border-[#ec4899] hover:text-[#ec4899]',
        ],
        'amber' => [
            'active' => 'bg-amber-500 text-white shadow-lg shadow-amber-200',
            'inactive' => 'bg-white border border-gray-200 text-gray-600 hover:border-amber-500 hover:text-amber-500',
        ],
    ];
    
    $colors = $colorClasses[$color] ?? $colorClasses['purple'];
@endphp

<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 pb-6 border-b border-gray-100">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $title }}</h2>
        <p class="text-gray-500 text-base font-medium">{{ $count }} sản phẩm được tìm thấy</p>
    </div>

    <div class="flex flex-wrap gap-3">
        @foreach($sortOptions as $index => $option)
            @php
                $isActive = $index === $activeSort;
                $buttonClass = $isActive ? $colors['active'] : $colors['inactive'];
            @endphp
            
            <button class="px-6 py-3 rounded-lg {{ $buttonClass }} font-bold text-base transition">
                {{ $option }}
            </button>
        @endforeach
    </div>
</div>
