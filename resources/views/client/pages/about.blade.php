@extends('client.layouts.app')

@section('content')

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- PHẦN GIỚI THIỆU ĐẦU TRANG --}}
        <x-client.page-header 
            icon="fa-solid fa-star"
            tag="VỀ CHÚNG TÔI"
            title="Câu Chuyện Của"
            highlight="LaravelShop"
            color="purple">
            <p class="text-gray-500 text-xl leading-relaxed mb-6 font-medium mt-6">
                Từ năm 2025, LaravelShop đã trở thành điểm đến tin cậy cho những ai yêu thích thời trang.
                Chúng tôi tự hào mang đến những sản phẩm chất lượng cao với phong cách hiện đại, phù hợp với mọi cá tính và hoàn cảnh.
            </p>
        </x-client.page-header>

        {{-- CHỈ SỐ THỐNG KÊ (STATS) --}}
        @php
            $stats = [
                ['value' => '10M+', 'label' => 'Khách hàng hài lòng'],
                ['value' => '15+', 'label' => 'Quốc gia phục vụ'],
                ['value' => '7+', 'label' => 'Năm kinh nghiệm'],
                ['value' => '1K+', 'label' => 'Sản phẩm yêu thích'],
            ];
        @endphp
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-20">
            @foreach($stats as $stat)
            <div class="text-center p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition shadow-purple-100">
                <div class="text-[#7d3cff] text-4xl font-black mb-2">{{ $stat['value'] }}</div>
                <div class="text-gray-600 font-bold text-lg">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>

        {{-- HÀNH TRÌNH VÀ GIÁ TRỊ CỐT LÕI --}}
        <div class="grid md:grid-cols-2 gap-12 mb-20 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Hành trình của chúng tôi</h2>
                <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                    <p>LaravelShop được thành lập với một tầm nhìn đơn giản nhưng mạnh mẽ: làm cho thời trang chất lượng cao trở nên dễ tiếp cận với mọi người. </p>
                    <p>Bắt đầu từ một cửa hàng nhỏ tại TP. Hồ Chí Minh, chúng tôi đã phát triển thành một thương hiệu được yêu thích trên toàn quốc. </p>
                    <p>Hôm nay, LaravelShop tự hào phục vụ hàng chục nghìn khách hàng mỗi tháng với hệ thống cửa hàng trải dài khắp cả nước. </p>
                </div>
            </div>
            <div class="bg-purple-50 p-10 rounded-3xl border-2 border-purple-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Giá Trị Cốt Lõi</h2>
                @php
                    $coreValues = [
                        ['number' => '01', 'title' => 'Chất lượng hàng đầu', 'description' => 'Chúng tôi cam kết mang đến những sản phẩm chất lượng cao nhất với giá cả hợp lý.'],
                        ['number' => '02', 'title' => 'Khách hàng là trung tâm', 'description' => 'Sự hài lòng của khách hàng là ưu tiên số một trong mọi hoạt động của chúng tôi.'],
                        ['number' => '03', 'title' => 'Đổi mới không ngừng', 'description' => 'Luôn cập nhật xu hướng mới nhất và áp dụng công nghệ tiên tiến để phục vụ tốt hơn.'],
                    ];
                @endphp
                <div class="space-y-6">
                    @foreach($coreValues as $value)
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 bg-[#7d3cff] text-white rounded-lg flex items-center justify-center font-bold text-lg">{{ $value['number'] }}</div>
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">{{ $value['title'] }}</h4>
                            <p class="text-gray-500 text-base">{{ $value['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- KÊU GỌI HÀNH ĐỘNG (CTA) --}}
        <x-client.cta-section 
            title="Hãy Cùng Chúng Tôi Tạo Nên Phong Cách Riêng"
            description="Khám phá bộ sưu tập mới nhất và tìm kiếm những món đồ hoàn hảo cho phong cách của bạn."
            :buttons="[
                ['text' => 'Khám Phá Sản Phẩm', 'url' => route('client.products.index'), 'primary' => true],
                ['text' => 'Liên Hệ Với Chúng Tôi', 'url' => route('client.contact'), 'primary' => false]
            ]" />

    </div>
</div>
@endsection
