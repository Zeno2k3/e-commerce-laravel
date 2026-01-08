{{-- 
    Newsletter Component - Đăng ký nhận tin tức
    Sử dụng: <x-client.newsletter />
    
    Component này hiển thị form đăng ký nhận tin tức với:
    - Icon email
    - Tiêu đề và mô tả
    - Form nhập email và nút đăng ký
--}}

@props([
    'title' => 'Đăng ký nhận tin tức',
    'description' => 'Nhận thông tin về sản phẩm mới, ưu đãi đặc biệt và xu hướng thời trang mới nhất.',
    'buttonText' => 'Đăng ký',
    'placeholder' => 'Nhập email của bạn'
])

<section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-xl mx-auto">
            <i class="fa-regular fa-envelope text-4xl mb-4 text-indigo-600"></i>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $title }}</h2>
            <p class="text-gray-500 text-sm mb-6">
                {{ $description }}
            </p>
            <form class="flex gap-2">
                <input type="email" 
                       placeholder="{{ $placeholder }}" 
                       class="flex-1 px-4 py-3 rounded border border-gray-300 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                <button type="button" class="bg-black text-white px-6 py-3 rounded font-bold text-sm hover:bg-gray-800 transition">
                    {{ $buttonText }}
                </button>
            </form>
        </div>
    </div>
</section>
