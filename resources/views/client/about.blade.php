@extends('client.layouts.app')

@section('content')

<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- PHẦN GIỚI THIỆU ĐẦU TRANG --}}
        <div class="text-center mb-16 max-w-4xl mx-auto">
            <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-star mr-2"></i> VỀ CHÚNG TÔI
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-6 tracking-tight leading-tight">
                Câu Chuyện Của <span class="text-[#7d3cff]">LaravelShop</span>
            </h1>

            <p class="text-gray-500 text-xl leading-relaxed mb-6">
                Từ năm 2025, LaravelShop đã trở thành điểm đến tin cậy cho những ai yêu thích thời trang.
                Chúng tôi tự hào mang đến những sản phẩm chất lượng cao với phong cách hiện đại, phù hợp với mọi cá tính và hoàn cảnh.
            </p>
        </div>

        {{-- CHỈ SỐ THỐNG KÊ (STATS) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-20">
            <div class="text-center p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition shadow-purple-100">
                <div class="text-[#7d3cff] text-4xl font-black mb-2">10,000,000+</div>
                <div class="text-gray-600 font-bold text-lg">Khách hàng hài lòng</div>
            </div>
            <div class="text-center p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition shadow-purple-100">
                <div class="text-[#7d3cff] text-4xl font-black mb-2">15+</div>
                <div class="text-gray-600 font-bold text-lg">Quốc gia phục vụ</div>
            </div>
            <div class="text-center p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition shadow-purple-100">
                <div class="text-[#7d3cff] text-4xl font-black mb-2">7+</div>
                <div class="text-gray-600 font-bold text-lg">Năm kinh nghiệm</div>
            </div>
            <div class="text-center p-8 rounded-2xl bg-gray-50 hover:shadow-xl transition shadow-purple-100">
                <div class="text-[#7d3cff] text-4xl font-black mb-2">1,000+</div>
                <div class="text-gray-600 font-bold text-lg">Sản phẩm yêu thích</div>
            </div>
        </div>

        {{-- HÀNH TRÌNH VÀ GIÁ TRỊ CỐT LÕI --}}
        <div class="grid md:grid-cols-2 gap-12 mb-20 items-center">
            <div>
                <h2 class="text-3xl font-black text-gray-900 mb-6">Hành trình của chúng tôi</h2>
                <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                    <p>LaravelShop được thành lập với một tầm nhìn đơn giản nhưng mạnh mẽ: làm cho thời trang chất lượng cao trở nên dễ tiếp cận với mọi người. </p>
                    <p>Bắt đầu từ một cửa hàng nhỏ tại TP. Hồ Chí Minh, chúng tôi đã phát triển thành một thương hiệu được yêu thích trên toàn quốc. </p>
                    <p>Hôm nay, LaravelShop tự hào phục vụ hàng chục nghìn khách hàng mỗi tháng với hệ thống cửa hàng trải dài khắp cả nước. </p>
                </div>
            </div>
            <div class="bg-purple-50 p-10 rounded-3xl border-2 border-purple-100">
                <h2 class="text-3xl font-black text-gray-900 mb-6 text-center">Giá Trị Cốt Lõi</h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 bg-[#7d3cff] text-white rounded-lg flex items-center justify-center font-bold">01</div>
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">Chất lượng hàng đầu</h4>
                            <p class="text-gray-500">Chúng tôi cam kết mang đến những sản phẩm chất lượng cao nhất với giá cả hợp lý.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 bg-[#7d3cff] text-white rounded-lg flex items-center justify-center font-bold">02</div>
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">Khách hàng là trung tâm</h4>
                            <p class="text-gray-500">Sự hài lòng của khách hàng là ưu tiên số một trong mọi hoạt động của chúng tôi.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 bg-[#7d3cff] text-white rounded-lg flex items-center justify-center font-bold">03</div>
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">Đổi mới không ngừng</h4>
                            <p class="text-gray-500">Luôn cập nhật xu hướng mới nhất và áp dụng công nghệ tiên tiến để phục vụ tốt hơn. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KÊU GỌI HÀNH ĐỘNG (CTA) --}}
        <div class="bg-gray-900 rounded-[3rem] p-12 text-center text-white relative overflow-hidden shadow-2xl shadow-purple-200">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-black mb-6">Hãy Cùng Chúng Tôi Tạo Nên Phong Cách Riêng</h2>
                <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">
                    Khám phá bộ sưu tập mới nhất và tìm kiếm những món đồ hoàn hảo cho phong cách của bạn.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    {{-- Thay đổi ở phần CTA cuối trang --}}

                    <a href="{{ route('products.index') }}"
                    class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-10 py-4 rounded-xl font-bold text-lg transition transform hover:scale-105 inline-block">
                        Khám Phá Sản Phẩm
                    </a>

                    <a href="{{ route('client.contact') }}"
                    class="bg-white text-gray-900 border border-gray-200 hover:bg-gray-100 px-10 py-4 rounded-xl font-bold text-lg transition transform hover:scale-105 inline-block">
                        Liên Hệ Với Chúng Tôi
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
