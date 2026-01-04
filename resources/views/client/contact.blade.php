@extends('client.layouts.app')

@section('content')
{{-- Nền xám rất nhạt để làm nổi bật các khối trắng --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <div class="text-center mb-16 max-w-3xl mx-auto">
            {{-- Giữ nguyên kích cỡ text-2xl và bo góc rounded-lg như mẫu trước --}}
            <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-2xl mb-5 tracking-widest uppercase">
                <i class="fa-solid fa-headset mr-2"></i> Liên Hệ
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                Chúng Tôi Luôn <span class="text-[#7d3cff]">Lắng Nghe</span>
            </h1>
            <p class="text-gray-500 text-lg">
                Có câu hỏi, góp ý hay cần hỗ trợ? Đừng ngần ngại liên hệ với chúng tôi.
                Đội ngũ LaravelShop luôn sẵn sàng hỗ trợ bạn 24/7.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-10 items-start">

            {{-- KHỐI FORM GỬI TIN NHẮN (Trắng nổi bật) --}}
            <div class="lg:col-span-2 bg-white rounded-[2rem] p-10 shadow-xl shadow-purple-100/50 border border-white">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-paper-plane text-[#7d3cff]"></i>
                    Gửi tin nhắn cho chúng tôi
                </h2>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Họ và tên*</label>
                            <input type="text" placeholder="Nguyễn Văn A" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Số điện thoại</label>
                            <input type="text" placeholder="0123 456 789" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Email*</label>
                            <input type="email" placeholder="your@email.com" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Chủ đề*</label>
                            <input type="text" placeholder="Cần hỗ trợ về đơn hàng" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nội dung*</label>
                        <textarea rows="5" placeholder="Nhập nội dung tin nhắn của bạn..." class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all"></textarea>
                    </div>

                    <button type="submit" class="w-full md:w-auto bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-12 py-4 rounded-xl font-bold text-lg shadow-lg shadow-purple-200 transition transform hover:scale-105">
                        Gửi tin nhắn ngay
                    </button>
                </form>
            </div>

            {{-- CỘT THÔNG TIN LIÊN HỆ --}}
            <div class="space-y-6">
                {{-- Địa chỉ --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-50 flex gap-5 group hover:shadow-lg transition-all">
                    <div class="w-14 h-14 shrink-0 bg-purple-50 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl group-hover:bg-[#7d3cff] group-hover:text-white transition-colors">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Địa chỉ cửa hàng</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">280 An Dương Vương, Phường Chợ Quán, TP. HCM</p>
                    </div>
                </div>

                {{-- Hotline --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-50 flex gap-5 group hover:shadow-lg transition-all">
                    <div class="w-14 h-14 shrink-0 bg-purple-50 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl group-hover:bg-[#7d3cff] group-hover:text-white transition-colors">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Số điện thoại</h4>
                        <p class="text-gray-500 text-sm">Hotline: 1900 6789</p>
                        <p class="text-gray-500 text-sm">Zalo: 0123 456 789</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-50 flex gap-5 group hover:shadow-lg transition-all">
                    <div class="w-14 h-14 shrink-0 bg-purple-50 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl group-hover:bg-[#7d3cff] group-hover:text-white transition-colors">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Email liên hệ</h4>
                        <p class="text-gray-500 text-sm">info@laravelshop.com</p>
                        <p class="text-[#7d3cff] text-sm font-semibold">support@laravelshop.com</p>
                    </div>
                </div>

                {{-- Giờ làm việc --}}
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-50 flex gap-5 group hover:shadow-lg transition-all">
                    <div class="w-14 h-14 shrink-0 bg-purple-50 text-[#7d3cff] rounded-2xl flex items-center justify-center text-2xl group-hover:bg-[#7d3cff] group-hover:text-white transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Giờ làm việc</h4>
                        <p class="text-gray-500 text-sm">T2 - T6: 8:00 - 22:00</p>
                        <p class="text-gray-500 text-sm">T7 - CN: 9:00 - 21:00</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- KHỐI FAQ (CÂU HỎI THƯỜNG GẶP) --}}
        <div class="mt-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-gray-900 mb-4 uppercase tracking-tight">Câu Hỏi Thường Gặp</h2>
                <div class="w-24 h-1.5 bg-[#7d3cff] mx-auto rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:border-[#7d3cff] transition-all">
                    <h4 class="font-bold text-gray-900 text-lg mb-2 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#7d3cff] flex items-center justify-center text-xs font-black">Q</span>
                        Làm thế nào để theo dõi đơn hàng ?
                    </h4>
                    <p class="text-gray-600 pl-11">Bạn có thể theo dõi đơn hàng bằng cách đăng nhập vào tài khoản và vào mục 'Đơn hàng của tôi'.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:border-[#7d3cff] transition-all">
                    <h4 class="font-bold text-gray-900 text-lg mb-2 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#7d3cff] flex items-center justify-center text-xs font-black">Q</span>
                        Chính sách đổi trả như thế nào ?
                    </h4>
                    <p class="text-gray-600 pl-11">Chúng tôi hỗ trợ đổi trả trong vòng 30 ngày kể từ ngày mua hàng với điều kiện sản phẩm còn nguyên tem mác.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:border-[#7d3cff] transition-all">
                    <h4 class="font-bold text-gray-900 text-lg mb-2 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#7d3cff] flex items-center justify-center text-xs font-black">Q</span>
                        Có hỗ trợ giao hàng toàn quốc không?
                    </h4>
                    <p class="text-gray-600 pl-11">Có, chúng tôi giao hàng toàn quốc với phí ship từ 30.000đ. Miễn phí ship cho đơn hàng trên 500.000đ.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
