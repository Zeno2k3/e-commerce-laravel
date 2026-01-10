@extends('client.layouts.app')

@section('content')
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <x-client.page-header 
            icon="fa-solid fa-rotate-left"
            tag="CHÍNH SÁCH ĐỔI TRẢ"
            title="Đổi Trả"
            highlight="Dễ Dàng"
            color="purple">
            <p class="text-gray-500 text-xl max-w-3xl mx-auto leading-relaxed font-medium mt-6">
                FlexStyle cam kết mang đến trải nghiệm mua sắm tuyệt vời. Nếu bạn không hoàn toàn hài lòng với sản phẩm, chúng tôi hỗ trợ đổi trả một cách nhanh chóng và thuận tiện.
            </p>
        </x-client.page-header>

        {{-- KHỐI 1: HIGHLIGHTS (3 ĐIỂM NỔI BẬT) --}}
        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white p-10 rounded-[2rem] shadow-lg shadow-gray-100 border border-purple-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-20 h-20 mx-auto bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-regular fa-calendar-check text-[#7d3cff] text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-3">30 Ngày</h3>
                <p class="text-gray-500 text-lg">Thời gian đổi trả kể từ ngày nhận hàng</p>
            </div>
            <div class="bg-white p-10 rounded-[2rem] shadow-lg shadow-gray-100 border border-purple-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-check text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-3">Miễn Phí</h3>
                <p class="text-gray-500 text-lg">Không tính phí đổi trả nếu lỗi từ Shop</p>
            </div>
            <div class="bg-white p-10 rounded-[2rem] shadow-lg shadow-gray-100 border border-purple-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-shield-heart text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-3">100%</h3>
                <p class="text-gray-500 text-lg">Hài lòng với quy trình xử lý nhanh chóng</p>
            </div>
        </div>

        {{-- KHỐI 2: ĐIỀU KIỆN ĐỔI TRẢ (YES/NO) --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50 border border-gray-50 mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 flex items-center gap-4">
                <i class="fa-solid fa-clipboard-check text-[#7d3cff]"></i> Điều Kiện Đổi Trả
            </h2>
            <div class="grid md:grid-cols-2 gap-12">
                {{-- Cột ĐƯỢC chấp nhận --}}
                <div class="bg-green-50/50 p-8 rounded-[2rem] border border-green-100">
                    <h5 class="text-2xl font-bold text-green-700 mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-circle-check"></i> Được chấp nhận
                    </h5>
                    <ul class="space-y-4 text-lg text-gray-700 font-medium">
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Sản phẩm còn nguyên tem mác, nhãn hiệu</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Sản phẩm chưa qua sử dụng, giặt ủi</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Không có mùi lạ (nước hoa, thuốc lá...)</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Còn đầy đủ phụ kiện đi kèm</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Có hóa đơn mua hàng hoặc mã đơn hàng</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i> Trong thời hạn 30 ngày kể từ khi nhận</li>
                    </ul>
                </div>

                {{-- Cột KHÔNG được chấp nhận --}}
                <div class="bg-red-50/50 p-8 rounded-[2rem] border border-red-100">
                    <h5 class="text-2xl font-bold text-red-600 mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-circle-xmark"></i> Không chấp nhận
                    </h5>
                    <ul class="space-y-4 text-lg text-gray-700 font-medium">
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Sản phẩm đã qua sử dụng, giặt ủi</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Sản phẩm bị rách, bẩn do lỗi người dùng</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Sản phẩm có mùi lạ do người dùng</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Sản phẩm Sale trên 50% (trừ lỗi Shop)</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Thiếu phụ kiện, tem mác</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Quá thời hạn 30 ngày</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- KHỐI 3: QUY TRÌNH ĐỔI TRẢ (4 BƯỚC) --}}
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Quy Trình Đổi Trả</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="relative bg-white p-8 rounded-[2.5rem] shadow-lg border border-gray-100 flex flex-col items-center text-center group hover:border-[#7d3cff] transition-colors">
                    <span class="absolute top-6 left-6 text-6xl font-black text-gray-100 group-hover:text-purple-100 transition-colors select-none">1</span>
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-6 relative z-10">
                        <i class="fa-solid fa-headset text-[#7d3cff] text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">Liên hệ yêu cầu</h4>
                    <p class="text-gray-500 relative z-10">Gọi Hotline hoặc gửi email thông tin đơn hàng và lý do.</p>
                </div>

                <div class="relative bg-white p-8 rounded-[2.5rem] shadow-lg border border-gray-100 flex flex-col items-center text-center group hover:border-[#7d3cff] transition-colors">
                    <span class="absolute top-6 left-6 text-6xl font-black text-gray-100 group-hover:text-purple-100 transition-colors select-none">2</span>
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-6 relative z-10">
                        <i class="fa-solid fa-file-circle-check text-[#7d3cff] text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">Xác nhận yêu cầu</h4>
                    <p class="text-gray-500 relative z-10">Chúng tôi xác nhận và cung cấp mã đổi trả trong vòng 2h.</p>
                </div>

                <div class="relative bg-white p-8 rounded-[2.5rem] shadow-lg border border-gray-100 flex flex-col items-center text-center group hover:border-[#7d3cff] transition-colors">
                    <span class="absolute top-6 left-6 text-6xl font-black text-gray-100 group-hover:text-purple-100 transition-colors select-none">3</span>
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-6 relative z-10">
                        <i class="fa-solid fa-box-open text-[#7d3cff] text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">Đóng gói sản phẩm</h4>
                    <p class="text-gray-500 relative z-10">Đóng gói theo hướng dẫn và gửi về địa chỉ được cung cấp.</p>
                </div>

                <div class="relative bg-white p-8 rounded-[2.5rem] shadow-lg border border-gray-100 flex flex-col items-center text-center group hover:border-[#7d3cff] transition-colors">
                    <span class="absolute top-6 left-6 text-6xl font-black text-gray-100 group-hover:text-purple-100 transition-colors select-none">4</span>
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-6 relative z-10">
                        <i class="fa-solid fa-money-bill-transfer text-[#7d3cff] text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">Xử lý hoàn tiền</h4>
                    <p class="text-gray-500 relative z-10">Hoàn tiền hoặc gửi sản phẩm thay thế trong 3-5 ngày.</p>
                </div>
            </div>
        </div>

        {{-- KHỐI 4: THỜI GIAN HOÀN TIỀN & PHÍ --}}
        <div class="bg-[#f1f5f9] p-12 rounded-[3rem] border border-gray-200 mb-20 shadow-inner">
            <div class="grid md:grid-cols-2 gap-16">
                {{-- Thời gian hoàn tiền --}}
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <i class="fa-regular fa-clock text-[#7d3cff]"></i> Thời Gian Hoàn Tiền
                    </h3>
                    <ul class="space-y-6 text-xl text-gray-600 font-medium">
                        <li class="flex justify-between border-b border-gray-300 pb-3">
                            <span>Thanh toán Online:</span>
                            <span class="text-gray-900 font-bold">3 - 7 ngày làm việc</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-300 pb-3">
                            <span>Thanh toán COD:</span>
                            <span class="text-gray-900 font-bold">1 - 3 ngày làm việc</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-300 pb-3">
                            <span>Ví điện tử:</span>
                            <span class="text-gray-900 font-bold">1 - 2 ngày làm việc</span>
                        </li>
                        <li class="text-sm italic text-gray-500 mt-4">*Thời gian thực tế có thể tùy thuộc vào ngân hàng thụ hưởng.</li>
                    </ul>
                </div>

                {{-- Phí đổi trả --}}
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-coins text-[#7d3cff]"></i> Phí Đổi Trả
                    </h3>
                    <ul class="space-y-6 text-xl text-gray-600 font-medium">
                        <li class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm">
                            <span>Lỗi từ Shop:</span>
                            <span class="text-green-600 font-bold bg-green-50 px-3 py-1 rounded-lg">Miễn phí 100%</span>
                        </li>
                        <li class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm">
                            <span>Đổi size/màu:</span>
                            <span class="text-gray-900 font-bold">30.000₫</span>
                        </li>
                        <li class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm">
                            <span>Thay đổi ý định:</span>
                            <span class="text-gray-900 font-bold">50.000₫</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- KHỐI 5: LƯU Ý QUAN TRỌNG --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50 border border-gray-50 mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-4">
                <i class="fa-solid fa-circle-exclamation text-[#7d3cff] text-4xl"></i> Lưu Ý Quan Trọng
            </h2>
            <div class="grid md:grid-cols-2 gap-12 text-gray-600 text-xl leading-relaxed font-medium">
                <ul class="space-y-6">
                    <li class="flex gap-3"><span class="text-[#7d3cff]">•</span> Vui lòng quay video unboxing khi nhận hàng để làm bằng chứng nếu có vấn đề.</li>
                    <li class="flex gap-3"><span class="text-[#7d3cff]">•</span> Sản phẩm Sale trên 50% chỉ được đổi trả nếu có lỗi từ nhà sản xuất.</li>
                </ul>
                <ul class="space-y-6">
                    <li class="flex gap-3"><span class="text-[#7d3cff]">•</span> Đối với sản phẩm đặc biệt (đồ lót, trang sức), vui lòng liên hệ trước khi đổi trả.</li>
                    <li class="flex gap-3"><span class="text-[#7d3cff]">•</span> Khách hàng chịu phí ship khi gửi hàng về (trừ trường hợp lỗi từ shop).</li>
                </ul>
            </div>
        </div>

        {{-- LIÊN HỆ HỖ TRỢ --}}
        <x-client.cta-section 
            title="Cần Hỗ Trợ Đổi Trả?"
            description="Liên hệ ngay với đội ngũ chăm sóc khách hàng để được hỗ trợ nhanh chóng">
            <div class="flex flex-wrap justify-center gap-16 text-2xl font-bold mt-8">
                <a href="tel:19006789" class="flex items-center gap-4 hover:text-[#7d3cff] transition-colors">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-phone text-[#7d3cff] text-2xl"></i>
                    </div>
                    1900 6789
                </a>
                <a href="mailto:support@flexstyle.com" class="flex items-center gap-4 hover:text-[#7d3cff] transition-colors">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-envelope text-[#7d3cff] text-2xl"></i>
                    </div>
                    support@flexstyle.com
                </a>
            </div>
        </x-client.cta-section>

    </div>
</div>
@endsection