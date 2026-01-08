{{-- 
    Rights Card Component - Dùng cho thẻ quyền lợi
    Sử dụng: <x-client.rights-card title="Quyền truy cập">
                Mô tả quyền ở đây
            </x-client.rights-card>
--}}

@props([
    'title' => ''
])

<div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
    <h4 class="text-2xl font-bold text-gray-900 mb-3">{{ $title }}</h4>
    <p class="text-gray-600 text-xl leading-relaxed">{{ $slot }}</p>
</div>
