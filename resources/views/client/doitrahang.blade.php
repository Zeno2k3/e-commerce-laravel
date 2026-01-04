@extends('client.layouts.app')

@section('content')
{{-- Nền xám nhạt đồng bộ để làm nổi bật các khối trắng --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <div class="text-center mb-16 max-w-4xl mx-auto">
            {{-- Badge: Đồng bộ text-2xl font-bold --}}
            <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-rotate-left mr-2"></i> Chính Sách Đổi Trả
            </span>
            {{-- H1: Đồng bộ text-4xl md:text-5xl --}}
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                Đổi Trả <span class="text-[#7d3cff]">Dễ Dàng</span>
            </h1>
            {{-- Intro: text-xl --}}
            <p class="text-gray-500 text-xl max-w-2xl mx-auto leading-relaxed">
                FlexStyle cam kết mang đến trải nghiệm mua sắm tuyệt vời. Nếu bạn không hoàn toàn hài lòng với sản phẩm, chúng tôi hỗ trợ đổi trả một cách nhanh chóng và thuận tiện.
            </p>
        </div>

        {{-- CHỈ SỐ NỔI BẬT --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white">
                <div class="text-[#7d3cff] text-5xl font-black mb-2">30 Ngày</div>
                {{-- Label: Tăng lên text-lg --}}
                <p class="text-gray-600 font-bold text-lg">Thời gian đổi trả kể từ ngày nhận hàng</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white">
                <div class="text-[#7d3cff] text-5xl font-black mb-2">Miễn phí</div>
                <p class="text-gray-600 font-bold text-lg">Không tính phí đổi trả cho lỗi từ nhà sản xuất</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 text-center border border-white">
                <div class="text-[#7d3cff] text-5xl font-black mb-2">100%</div>
                <p class="text-gray-600 font-bold text-lg">Cam kết hoàn tiền hoặc đổi sản phẩm mới</p>
            </div>
        </div>

        {{-- ĐIỀU KIỆN ĐỔI TRẢ --}}
        <div class="bg-white p-10 rounded-[3rem] shadow-xl shadow-gray-200/50 mb-16 border border-gray-50">
            {{-- H2: Đồng bộ text-3xl font-bold --}}
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Điều Kiện Đổi Trả</h2>
            <div class="grid md:grid-cols-2 gap-10">
                {{-- Được chấp nhận --}}
                <div class="space-y-4">
                    <h4 class="text-[#10b981] font-bold text-xl flex items-center gap-2 mb-6">
                        <i class="fa-solid fa-circle-check"></i> Được chấp nhận đổi trả
                    </h4>
                    {{-- List item: Tăng lên text-lg --}}
                    <ul class="space-y-4 text-lg">
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-check"></i></span>
                            Sản phẩm còn nguyên tem mác, nhãn hiệu
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-check"></i></span>
                            Sản phẩm chưa qua sử dụng, giặt ủi
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-check"></i></span>
                            Sản phẩm không có mùi lạ (nước hoa, thuốc lá...)
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-check"></i></span>
                            Còn đầy đủ phụ kiện và hóa đơn mua hàng
                        </li>
                    </ul>
                </div>

                {{-- Không được chấp nhận --}}
                <div class="space-y-4">
                    <h4 class="text-[#ef4444] font-bold text-xl flex items-center gap-2 mb-6">
                        <i class="fa-solid fa-circle-xmark"></i> Không được chấp nhận
                    </h4>
                    <ul class="space-y-4 text-lg">
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-xmark"></i></span>
                            Sản phẩm đã qua sử dụng, giặt ủi hoặc bị rách, bẩn
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-xmark"></i></span>
                            Sản phẩm sale trên 50% (trừ lỗi từ shop)
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-xmark"></i></span>
                            Quá thời hạn 30 ngày kể từ khi nhận hàng
                        </li>
                        <li class="flex items-start gap-3 text-gray-600">
                            <span class="w-5 h-5 mt-1 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-[10px]"><i class="fa-solid fa-xmark"></i></span>
                            Các sản phẩm đặc biệt (đồ lót, trang sức)
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- QUY TRÌNH ĐỔI TRẢ --}}
        <div class="mb-16">
            {{-- H2: Đồng bộ text-3xl font-bold --}}
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Quy Trình Đổi Trả</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center relative">
                    <div class="w-12 h-12 bg-[#7d3cff] text-white rounded-full flex items-center justify-center font-black mx-auto mb-4 shadow-lg shadow-purple-200">1</div>
                    {{-- Title: text-xl --}}
                    <h5 class="font-bold text-gray-900 mb-2 text-xl">Liên hệ yêu cầu</h5>
                    {{-- Desc: text-base (Giảm từ xl xuống base cho cân đối) --}}
                    <p class="text-gray-500 text-base">Gọi hotline hoặc gửi email với thông tin đơn hàng và lý do.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center relative">
                    <div class="w-12 h-12 bg-[#7d3cff] text-white rounded-full flex items-center justify-center font-black mx-auto mb-4 shadow-lg shadow-purple-200">2</div>
                    <h5 class="font-bold text-gray-900 mb-2 text-xl">Xác nhận yêu cầu</h5>
                    <p class="text-gray-500 text-base">Shop xác nhận và cung cấp mã đổi trả trong vòng 2 giờ làm việc.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center relative">
                    <div class="w-12 h-12 bg-[#7d3cff] text-white rounded-full flex items-center justify-center font-black mx-auto mb-4 shadow-lg shadow-purple-200">3</div>
                    <h5 class="font-bold text-gray-900 mb-2 text-xl">Đóng gói hàng</h5>
                    <p class="text-gray-500 text-base">Đóng gói sản phẩm theo hướng dẫn và gửi về địa chỉ shop.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center relative">
                    <div class="w-12 h-12 bg-[#7d3cff] text-white rounded-full flex items-center justify-center font-black mx-auto mb-4 shadow-lg shadow-purple-200">4</div>
                    <h5 class="font-bold text-gray-900 mb-2 text-xl">Xử lý hoàn tiền</h5>
                    <p class="text-gray-500 text-base">Hoàn tiền hoặc gửi sản phẩm thay thế trong vòng 3-5 ngày.</p>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            {{-- PHÍ ĐỔI TRẢ --}}
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-50">
                {{-- H2: text-3xl font-bold --}}
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-hand-holding-dollar text-[#7d3cff]"></i> Chi Phí Đổi Trả
                </h2>
                <div class="space-y-4">
                    {{-- Row text: Tăng lên text-lg --}}
                    <div class="flex justify-between p-4 bg-gray-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Lỗi từ nhà sản xuất / Shop</span>
                        <span class="font-black text-[#10b981]">Miễn phí 100%</span>
                    </div>
                    <div class="flex justify-between p-4 bg-gray-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Đổi size / màu sắc</span>
                        <span class="font-black text-gray-900">36.000₫</span>
                    </div>
                    <div class="flex justify-between p-4 bg-gray-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Thay đổi quyết định mua hàng</span>
                        <span class="font-black text-gray-900">50.000₫</span>
                    </div>
                    <p class="text-sm text-center text-gray-400 mt-4 italic">* Miễn phí đổi trả cho đơn hàng từ 1.000.000₫</p>
                </div>
            </div>

            {{-- THỜI GIAN HOÀN TIỀN --}}
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-50">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-clock-rotate-left text-[#7d3cff]"></i> Thời Gian Hoàn Tiền
                </h2>
                <div class="space-y-4">
                    {{-- Row text: Tăng lên text-lg --}}
                    <div class="flex justify-between p-4 bg-purple-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Thanh toán Online (Thẻ/Bank)</span>
                        <span class="font-black text-[#7d3cff]">3-6 ngày</span>
                    </div>
                    <div class="flex justify-between p-4 bg-purple-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Thanh toán khi nhận hàng (COD)</span>
                        <span class="font-black text-[#7d3cff]">1-3 ngày</span>
                    </div>
                    <div class="flex justify-between p-4 bg-purple-50 rounded-2xl text-lg">
                        <span class="text-gray-700">Ví điện tử (Momo/ZaloPay)</span>
                        <span class="font-black text-[#7d3cff]">1-2 ngày</span>
                    </div>
                    <p class="text-sm text-center text-gray-400 mt-4 italic">* Thời gian thực tế phụ thuộc vào ngân hàng của bạn</p>
                </div>
            </div>
        </div>

        {{-- LƯU Ý QUAN TRỌNG --}}
        <div class="bg-gray-900 rounded-[3rem] p-12 text-white shadow-2xl shadow-purple-200 relative overflow-hidden">
            <div class="relative z-10 grid md:grid-cols-2 gap-10 items-center">
                <div>
                    {{-- Footer H2: Giữ font-black cho nổi bật trên nền tối --}}
                    <h2 class="text-3xl font-black mb-6">Lưu Ý Quan Trọng</h2>
                    {{-- List item: text-lg --}}
                    <ul class="space-y-4 text-gray-300 text-lg">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-video mt-1 text-[#7d3cff]"></i>
                            Vui lòng quay video unboxing khi nhận hàng để làm bằng chứng nếu có vấn đề.
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-exclamation mt-1 text-[#7d3cff]"></i>
                            Khách hàng chịu phí ship khi gửi hàng về (trừ trường hợp lỗi từ shop).
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-tag mt-1 text-[#7d3cff]"></i>
                            Sản phẩm quà tặng kèm theo đơn hàng không hỗ trợ đổi trả.
                        </li>
                    </ul>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-xl mb-6">Cần hỗ trợ đổi trả ngay?</p>
                    <div class="flex flex-col md:flex-row justify-end gap-4">
                        <a href="tel:19006789" class="bg-[#7d3cff] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#6c2bd9] transition inline-block">
                            Hotline: 1900 6789
                        </a>
                        <a href="mailto:support@flexstyle.com" class="bg-white text-gray-900 px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition inline-block">
                            Gửi Email hỗ trợ
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
