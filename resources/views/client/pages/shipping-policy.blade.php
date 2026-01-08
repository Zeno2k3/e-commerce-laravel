@extends('client.layouts.app')

@section('content')
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <x-client.page-header 
            icon="fa-solid fa-truck-fast"
            tag="Chính Sách Giao Hàng"
            title="Giao Hàng"
            highlight="Toàn Quốc"
            color="purple">
            <p class="text-gray-500 text-xl max-w-2xl mx-auto leading-relaxed mt-6">
                FlexStyle cam kết mang đến dịch vụ giao hàng nhanh chóng, an toàn và tiện lợi nhất.
                Chúng tôi hợp tác với các đơn vị vận chuyển uy tín để đảm bảo sản phẩm đến tay bạn trong tình trạng hoàn hảo.
            </p>
        </x-client.page-header>

        {{-- KHỐI 1: PHƯƠNG THỨC GIAO HÀNG --}}
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <i class="fa-solid fa-list-check text-[#7d3cff]"></i> Phương Thức Giao Hàng
            </h2>
            @php
                $shippingMethods = [
                    ['price' => '30.000₫', 'title' => 'Giao hàng tiêu chuẩn', 'description' => 'Phù hợp cho các đơn hàng thông thường, thời gian giao hàng an toàn và đáng tin cậy.', 'time' => '1-5 ngày làm việc', 'popular' => false],
                    ['price' => '50.000₫', 'title' => 'Giao hàng nhanh', 'description' => 'Dành cho khách hàng cần nhận hàng gấp, ưu tiên xử lý và vận chuyển nhanh nhất.', 'time' => '2-3 ngày làm việc', 'popular' => true],
                    ['price' => '100.000₫', 'title' => 'Giao hàng trong ngày', 'description' => 'Chỉ áp dụng tại Hà Nội và TP.HCM cho các đơn hàng đặt trước 14h hàng ngày.', 'time' => 'Trong vòng 24h', 'popular' => false],
                ];
            @endphp
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($shippingMethods as $method)
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 border {{ $method['popular'] ? 'border-2 border-[#7d3cff]/10' : 'border-white hover:border-[#7d3cff]/20' }} transition-all relative overflow-hidden">
                    @if($method['popular'])
                        <div class="absolute top-0 right-0 bg-[#7d3cff] text-white text-[10px] px-4 py-1 font-bold uppercase tracking-widest">Phổ biến</div>
                    @endif
                    <div class="text-[#7d3cff] text-4xl font-black mb-2">{{ $method['price'] }}</div>
                    <h4 class="font-bold text-xl text-gray-900 mb-4">{{ $method['title'] }}</h4>
                    <p class="text-gray-500 text-base leading-relaxed mb-4">{{ $method['description'] }}</p>
                    <span class="inline-block px-3 py-1 {{ $method['popular'] ? 'bg-purple-50 text-[#7d3cff]' : 'bg-gray-100 text-gray-600' }} rounded-lg text-sm font-bold">{{ $method['time'] }}</span>
                </div>
                @endforeach
            </div>

            {{-- Miễn phí giao hàng banner --}}
            <div class="mt-10 bg-gradient-to-r from-[#7d3cff] to-[#9d66ff] rounded-3xl p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-lg shadow-purple-200">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold">Miễn Phí Giao Hàng</h4>
                        <p class="text-purple-100 text-lg">Áp dụng cho đơn hàng từ 500.000₫ trở lên trên toàn quốc.</p>
                    </div>
                </div>
                <div class="text-4xl font-black opacity-30 hidden lg:block">FREE SHIPPING</div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            {{-- KHỐI 2: THỜI GIAN THEO KHU VỰC --}}
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-50">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-map-location-dot text-[#7d3cff]"></i> Thời Gian Theo Khu Vực
                </h2>
                @php
                    $regions = [
                        ['name' => 'Hà Nội & TP.HCM', 'fee' => '30.000₫', 'time' => '1-2 ngày'],
                        ['name' => 'Các tỉnh thành lớn', 'fee' => '35.000₫', 'time' => '2-3 ngày'],
                        ['name' => 'Các tỉnh miền núi', 'fee' => '45.000₫', 'time' => '3-5 ngày'],
                        ['name' => 'Các đảo xa', 'fee' => '60.000₫', 'time' => '5-7 ngày'],
                    ];
                @endphp
                <div class="space-y-6">
                    @foreach($regions as $region)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div>
                            <p class="font-bold text-gray-800 text-lg">{{ $region['name'] }}</p>
                            <p class="text-sm text-gray-500">Phí: {{ $region['fee'] }}</p>
                        </div>
                        <span class="font-black text-[#7d3cff] text-lg">{{ $region['time'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- KHỐI 3: THANH TOÁN KHI NHẬN HÀNG (COD) --}}
            <div class="bg-purple-50 p-10 rounded-[2.5rem] border-2 border-purple-100 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-hand-holding-dollar text-[#7d3cff]"></i> Thanh Toán COD
                </h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 shrink-0 bg-white text-[#7d3cff] rounded-xl flex items-center justify-center font-bold shadow-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p class="text-gray-700 text-lg leading-relaxed">Khách hàng được quyền kiểm tra sản phẩm trước khi thanh toán cho nhân viên giao hàng.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 shrink-0 bg-white text-[#7d3cff] rounded-xl flex items-center justify-center font-bold shadow-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p class="text-gray-700 text-lg leading-relaxed">Phí thu hộ (COD): 20.000₫ cho đơn hàng dưới 300.000₫. <span class="font-bold text-[#7d3cff]">Miễn phí</span> cho đơn hàng từ 300.000₫.</p>
                    </div>
                    <div class="bg-white p-6 rounded-2xl mt-4">
                        <h5 class="font-bold text-gray-900 mb-2 text-lg">Đóng Gói & Bảo Vệ:</h5>
                        <ul class="text-base text-gray-500 space-y-2">
                            <li>• Sử dụng hộp carton chuyên dụng</li>
                            <li>• Bọc nilon chống thấm nước</li>
                            <li>• Giấy gói và túi zip bảo vệ sản phẩm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- KHỐI 4: QUY TRÌNH GIAO HÀNG --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Quy Trình Giao Hàng</h2>
                <div class="w-24 h-1.5 bg-[#7d3cff] mx-auto rounded-full"></div>
            </div>
            @php
                $steps = [
                    ['number' => '1', 'title' => 'Xác nhận', 'description' => 'Xác nhận đơn hàng và thông tin giao hàng trong vòng 2h.'],
                    ['number' => '2', 'title' => 'Đóng gói', 'description' => 'Sản phẩm được đóng gói cẩn thận với vật liệu chất lượng cao.'],
                    ['number' => '3', 'title' => 'Vận chuyển', 'description' => 'Đơn hàng được bàn giao cho đối tác vận chuyển chuyên nghiệp.'],
                    ['number' => '4', 'title' => 'Giao hàng', 'description' => 'Nhận hàng tại địa chỉ yêu cầu và kiểm tra trước khi thanh toán.'],
                ];
            @endphp
            <div class="grid md:grid-cols-4 gap-8">
                @foreach($steps as $step)
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl font-black mx-auto mb-5">{{ $step['number'] }}</div>
                    <h5 class="font-bold text-gray-900 mb-2 text-lg">{{ $step['title'] }}</h5>
                    <p class="text-gray-500 text-base">{{ $step['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CẦN HỖ TRỢ THÊM --}}
        <div class="mt-20 text-center">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">Cần hỗ trợ thêm về vận chuyển?</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="tel:19006789" class="bg-[#7d3cff] text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-[#6c2bd9] transition transform hover:scale-105 shadow-lg shadow-purple-200 inline-block">
                    <i class="fa-solid fa-phone mr-2"></i> Hotline: 1900 6789
                </a>
                <a href="{{ route('client.contact') }}" class="bg-white text-gray-900 border border-gray-200 px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition transform hover:scale-105 inline-block">
                    Gửi tin nhắn ngay
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
