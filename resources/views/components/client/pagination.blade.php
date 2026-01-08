{{-- 
    Pagination Component
    Sử dụng: <x-client.pagination 
                :currentPage="1" 
                :totalPages="5"
                :color="'purple'" />
    
    Props:
    - currentPage: Trang hiện tại
    - totalPages: Tổng số trang
    - color: Màu chủ đạo (purple, pink) - mặc định là purple
--}}

@props([
    'currentPage' => 1,
    'totalPages' => 1,
    'color' => 'purple'
])

@php
    $colorClasses = [
        'purple' => [
            'active' => 'border-2 border-[#7d3cff] text-[#7d3cff]',
            'hover' => 'hover:text-[#7d3cff] hover:bg-purple-50',
        ],
        'pink' => [
            'active' => 'border-2 border-[#ec4899] text-[#ec4899]',
            'hover' => 'hover:text-[#ec4899] hover:bg-pink-50',
        ],
        'amber' => [
            'active' => 'border-2 border-amber-500 text-amber-500',
            'hover' => 'hover:text-amber-500 hover:bg-amber-50',
        ],
    ];
    
    $colors = $colorClasses[$color] ?? $colorClasses['purple'];
@endphp

<div class="mt-16 flex justify-center items-center gap-4">
    {{-- Previous Button --}}
    <button class="group w-12 h-12 flex items-center justify-center text-gray-400 {{ $colors['hover'] }} bg-white rounded-xl transition-all border border-gray-200">
        <i class="fa-solid fa-angles-left text-lg group-hover:-translate-x-1 transition-transform"></i>
    </button>

    {{-- Page Numbers --}}
    @for($i = 1; $i <= $totalPages; $i++)
        @if($i === $currentPage)
            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white {{ $colors['active'] }} font-black text-lg shadow-md">
                {{ $i }}
            </button>
        @else
            <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 {{ $colors['hover'] }} font-bold text-lg transition">
                {{ $i }}
            </button>
        @endif
    @endfor

    {{-- Next Button --}}
    <button class="group w-12 h-12 flex items-center justify-center text-gray-400 {{ $colors['hover'] }} bg-white rounded-xl transition-all border border-gray-200">
        <i class="fa-solid fa-angles-right text-lg group-hover:translate-x-1 transition-transform"></i>
    </button>
</div>
