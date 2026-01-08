{{-- 
    CTA Section Component - Call to Action
    Sử dụng: <x-client.cta-section 
                title="Tiêu đề CTA"
                description="Mô tả ngắn"
                :buttons="[
                    ['text' => 'Khám Phá', 'url' => '/products', 'primary' => true],
                    ['text' => 'Liên Hệ', 'url' => '/contact', 'primary' => false]
                ]" />
--}}

@props([
    'title' => 'Hãy Cùng Chúng Tôi Tạo Nên Phong Cách Riêng',
    'description' => 'Khám phá bộ sưu tập mới nhất và tìm kiếm những món đồ hoàn hảo cho phong cách của bạn.',
    'buttons' => []
])

<div class="bg-gray-900 rounded-[3rem] p-12 text-center text-white relative overflow-hidden shadow-2xl shadow-purple-200">
    <div class="relative z-10">
        <h2 class="text-3xl md:text-4xl font-black mb-6">{{ $title }}</h2>
        <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">
            {{ $description }}
        </p>
        
        @if(count($buttons) > 0)
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($buttons as $button)
                @if($button['primary'] ?? false)
                    <a href="{{ $button['url'] }}"
                       class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-10 py-4 rounded-xl font-bold text-lg transition transform hover:scale-105 inline-block">
                        {{ $button['text'] }}
                    </a>
                @else
                    <a href="{{ $button['url'] }}"
                       class="bg-white text-gray-900 border border-gray-200 hover:bg-gray-100 px-10 py-4 rounded-xl font-bold text-lg transition transform hover:scale-105 inline-block">
                        {{ $button['text'] }}
                    </a>
                @endif
            @endforeach
        </div>
        @endif

        {{-- Slot for custom content --}}
        {{ $slot }}
    </div>
</div>
