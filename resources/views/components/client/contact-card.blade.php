{{-- 
    Contact Info Card Component
    Sử dụng: <x-client.contact-card 
                icon="fa-solid fa-location-dot"
                title="Địa chỉ cửa hàng">
                <p>280 An Dương Vương, TP. HCM</p>
            </x-client.contact-card>
--}}

@props([
    'icon' => 'fa-solid fa-info-circle',
    'title' => ''
])

<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-50 flex gap-5 group hover:shadow-lg transition-all">
    <div class="w-14 h-14 shrink-0 bg-purple-50 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl group-hover:bg-[#7d3cff] group-hover:text-white transition-colors">
        <i class="{{ $icon }}"></i>
    </div>
    <div>
        <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $title }}</h4>
        <div class="text-gray-500 text-base leading-relaxed">
            {{ $slot }}
        </div>
    </div>
</div>
