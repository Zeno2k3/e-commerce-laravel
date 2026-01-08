@extends('client.layouts.app')

@section('content')
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <x-client.page-header 
            icon="fa-solid fa-headset"
            tag="Liên Hệ"
            title="Chúng Tôi Luôn"
            highlight="Lắng Nghe"
            color="purple">
            <p class="text-gray-500 text-xl leading-relaxed mt-4">
                Có câu hỏi, góp ý hay cần hỗ trợ? Đừng ngần ngại liên hệ với chúng tôi.
                Đội ngũ LaravelShop luôn sẵn sàng hỗ trợ bạn 24/7.
            </p>
        </x-client.page-header>

        <div class="grid lg:grid-cols-3 gap-10 items-start">

            {{-- KHỐI FORM GỬI TIN NHẮN --}}
            <div class="lg:col-span-2 bg-white rounded-[2rem] p-10 shadow-xl shadow-purple-100/50 border border-white">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-paper-plane text-[#7d3cff]"></i>
                    Gửi tin nhắn cho chúng tôi
                </h2>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-base">Họ và tên*</label>
                            <input type="text" placeholder="Nguyễn Văn A" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all text-base">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-base">Số điện thoại</label>
                            <input type="text" placeholder="0123 456 789" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all text-base">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-base">Email*</label>
                            <input type="email" placeholder="your@email.com" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all text-base">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-base">Chủ đề*</label>
                            <input type="text" placeholder="Cần hỗ trợ về đơn hàng" class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all text-base">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-base">Nội dung*</label>
                        <textarea rows="5" placeholder="Nhập nội dung tin nhắn của bạn..." class="w-full px-6 py-4 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-[#7d3cff] focus:ring-4 focus:ring-purple-100 outline-none transition-all text-base"></textarea>
                    </div>

                    <button type="submit" class="w-full md:w-auto bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-12 py-4 rounded-xl font-bold text-lg shadow-lg shadow-purple-200 transition transform hover:scale-105">
                        Gửi tin nhắn ngay
                    </button>
                </form>
            </div>

            {{-- CỘT THÔNG TIN LIÊN HỆ --}}
            <div class="space-y-6">
                <x-client.contact-card icon="fa-solid fa-location-dot" title="Địa chỉ cửa hàng">
                    280 An Dương Vương, Phường Chợ Quán, TP. HCM
                </x-client.contact-card>

                <x-client.contact-card icon="fa-solid fa-phone" title="Số điện thoại">
                    <p>Hotline: 1900 6789</p>
                    <p>Zalo: 0123 456 789</p>
                </x-client.contact-card>

                <x-client.contact-card icon="fa-solid fa-envelope" title="Email liên hệ">
                    <p>info@laravelshop.com</p>
                    <p class="text-[#7d3cff] font-semibold">support@laravelshop.com</p>
                </x-client.contact-card>

                <x-client.contact-card icon="fa-solid fa-clock" title="Giờ làm việc">
                    <p>T2 - T6: 8:00 - 22:00</p>
                    <p>T7 - CN: 9:00 - 21:00</p>
                </x-client.contact-card>
            </div>
        </div>

        {{-- KHỐI FAQ --}}
        <div class="mt-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-gray-900 mb-4 uppercase tracking-tight">Câu Hỏi Thường Gặp</h2>
                <div class="w-24 h-1.5 bg-[#7d3cff] mx-auto rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                <x-client.faq-item question="Làm thế nào để theo dõi đơn hàng?">
                    Bạn có thể theo dõi đơn hàng bằng cách đăng nhập vào tài khoản và vào mục 'Đơn hàng của tôi'.
                </x-client.faq-item>

                <x-client.faq-item question="Chính sách đổi trả như thế nào?">
                    Chúng tôi hỗ trợ đổi trả trong vòng 30 ngày kể từ ngày mua hàng với điều kiện sản phẩm còn nguyên tem mác.
                </x-client.faq-item>

                <x-client.faq-item question="Có hỗ trợ giao hàng toàn quốc không?">
                    Có, chúng tôi giao hàng toàn quốc với phí ship từ 30.000đ. Miễn phí ship cho đơn hàng trên 500.000đ.
                </x-client.faq-item>
            </div>
        </div>

    </div>
</div>
@endsection
