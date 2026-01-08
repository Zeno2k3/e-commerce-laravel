{{-- 
    Category Filter Component
    Sử dụng: <x-client.category-filter 
                :categories="$categories" 
                :activeCategory="'all'"
                :color="'purple'" />
    
    Props:
    - categories: Array của categories [['name' => 'Tất cả', 'slug' => 'all', 'count' => 5], ...]
    - activeCategory: Slug của category đang active
    - color: Màu chủ đạo (purple, pink) - mặc định là purple
--}}

@props([
    'categories' => [],
    'activeCategory' => 'all',
    'color' => 'purple'
])

@php
    $colorClasses = [
        'purple' => [
            'active' => 'bg-[#7d3cff] text-white shadow-xl shadow-purple-200 hover:bg-[#6c2bd9]',
            'inactive' => 'bg-white border-2 border-gray-100 text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff]',
            'badge_active' => 'bg-white/20 text-white',
            'badge_inactive' => 'bg-gray-100 text-gray-500 group-hover:bg-purple-50 group-hover:text-[#7d3cff]',
        ],
        'pink' => [
            'active' => 'bg-[#ec4899] text-white shadow-xl shadow-pink-200 hover:bg-[#db2777]',
            'inactive' => 'bg-white border-2 border-gray-100 text-gray-600 hover:border-[#ec4899] hover:text-[#ec4899]',
            'badge_active' => 'bg-white/20 text-white',
            'badge_inactive' => 'bg-gray-100 text-gray-500 group-hover:bg-pink-50 group-hover:text-[#ec4899]',
        ],
        'amber' => [
            'active' => 'bg-amber-500 text-white shadow-xl shadow-amber-200 hover:bg-amber-600',
            'inactive' => 'bg-white border-2 border-gray-100 text-gray-600 hover:border-amber-500 hover:text-amber-500',
            'badge_active' => 'bg-white/20 text-white',
            'badge_inactive' => 'bg-gray-100 text-gray-500 group-hover:bg-amber-50 group-hover:text-amber-500',
        ],
    ];
    
    $colors = $colorClasses[$color] ?? $colorClasses['purple'];
@endphp

<div class="mb-12">
    <h3 class="font-bold text-gray-800 text-2xl mb-6">Danh mục</h3>
    <div class="flex flex-wrap gap-4">
        @foreach($categories as $category)
            @php
                $isActive = ($category['slug'] ?? '') === $activeCategory;
                $buttonClass = $isActive ? $colors['active'] : $colors['inactive'];
                $badgeClass = $isActive ? $colors['badge_active'] : $colors['badge_inactive'];
            @endphp
            
            <button class="group flex items-center gap-3 {{ $buttonClass }} px-8 py-4 rounded-xl font-bold text-lg transition transform hover:scale-105">
                {{ $category['name'] }}
                <span class="{{ $badgeClass }} px-2.5 py-0.5 rounded-md text-sm font-extrabold transition">
                    {{ $category['count'] ?? 0 }}
                </span>
            </button>
        @endforeach
    </div>
</div>
