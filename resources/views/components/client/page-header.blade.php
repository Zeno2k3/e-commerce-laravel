{{-- 
    Page Header Component
    Sử dụng: <x-client.page-header 
                icon="fa-solid fa-star" 
                tag="VỀ CHÚNG TÔI" 
                title="Câu Chuyện Của" 
                highlight="LaravelShop"
                description="Mô tả ngắn về trang" 
                :color="'purple'" />
    
    Props:
    - icon: Font Awesome icon class
    - tag: Text hiển thị trong badge
    - title: Phần tiêu đề chính
    - highlight: Phần tiêu đề được highlight màu
    - description: Mô tả bên dưới tiêu đề
    - color: Màu chủ đạo (purple, red, pink, blue) - mặc định là purple
--}}

@props([
    'icon' => 'fa-solid fa-star',
    'tag' => '',
    'title' => '',
    'highlight' => '',
    'description' => '',
    'color' => 'purple'
])

@php
    $colorClasses = [
        'purple' => [
            'bg' => 'bg-purple-100',
            'text' => 'text-[#7d3cff]',
        ],
        'red' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-500',
        ],
        'pink' => [
            'bg' => 'bg-pink-100',
            'text' => 'text-[#ec4899]',
        ],
        'blue' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-600',
        ],
        'amber' => [
            'bg' => 'bg-amber-100',
            'text' => 'text-amber-600',
        ],
    ];
    
    $colors = $colorClasses[$color] ?? $colorClasses['purple'];
@endphp

<div class="text-center mb-16 max-w-4xl mx-auto">
    {{-- Tag Badge --}}
    @if($tag)
    <span class="inline-block py-2 px-5 rounded-lg {{ $colors['bg'] }} {{ $colors['text'] }} font-bold text-2xl mb-5 tracking-widest uppercase">
        <i class="{{ $icon }} mr-2"></i> {{ $tag }}
    </span>
    @endif

    {{-- Main Title --}}
    @if($title || $highlight)
    <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
        {{ $title }} 
        @if($highlight)
        <span class="{{ $colors['text'] }}">{{ $highlight }}</span>
        @endif
    </h1>
    @endif

    {{-- Description --}}
    @if($description)
    <p class="text-gray-500 text-xl leading-relaxed font-medium">
        {{ $description }}
    </p>
    @endif

    {{-- Slot for additional content --}}
    {{ $slot }}
</div>
