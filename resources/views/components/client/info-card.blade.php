{{-- 
    Info Card Component - Dùng cho các thẻ thông tin trong policy pages
    Sử dụng: <x-client.info-card title="Tiêu đề" :items="['Item 1', 'Item 2']" />
--}}

@props([
    'title' => '',
    'items' => []
])

<div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-white">
    <h4 class="font-bold text-2xl text-gray-900 mb-6 underline decoration-[#7d3cff] decoration-4 underline-offset-8">{{ $title }}</h4>
    <ul class="text-gray-600 text-lg space-y-4 pt-2 leading-relaxed">
        @foreach($items as $item)
            <li>• {{ $item }}</li>
        @endforeach
    </ul>
    {{ $slot }}
</div>
