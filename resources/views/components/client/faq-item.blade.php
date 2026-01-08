{{-- 
    FAQ Item Component
    Sử dụng: <x-client.faq-item question="Câu hỏi?">
                Câu trả lời ở đây
            </x-client.faq-item>
--}}

@props([
    'question' => ''
])

<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:border-[#7d3cff] transition-all">
    <h4 class="font-bold text-gray-900 text-lg mb-2 flex items-center gap-3">
        <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#7d3cff] flex items-center justify-center text-xs font-black">Q</span>
        {{ $question }}
    </h4>
    <p class="text-gray-600 pl-11 text-base">{{ $slot }}</p>
</div>
