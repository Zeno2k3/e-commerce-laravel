@extends('client.layouts.app')

@section('content')
{{-- Nền xám rất nhạt để làm nổi bật các khối trắng và xám xanh --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG (Đã tăng kích thước) --}}
        <div class="text-center mb-20 max-w-4xl mx-auto">
            {{-- Badge tiêu đề phụ - Giữ nguyên 2xl nhưng tăng padding --}}
            <span class="inline-block py-3 px-6 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-xl mb-6 tracking-widest uppercase shadow-sm">
                <i class="fa-solid fa-shield-halved mr-2"></i> CHÍNH SÁCH BẢO MẬT
            </span>
            <h1 class="text-3xl md:text-6xl font-black text-gray-900 mb-8 tracking-tight leading-tight">
                Bảo Vệ <span class="text-[#7d3cff]">Quyền Riêng Tư</span>
            </h1>
            <p class="text-gray-500 text-2xl max-w-3xl mx-auto leading-relaxed">
                FlexStyle cam kết bảo vệ thông tin cá nhân của khách hàng. Chúng tôi tuân thủ nghiêm ngặt các quy định về bảo mật dữ liệu và quyền riêng tư của người dùng.
            </p>
        </div>

        {{-- KHỐI 1: THÔNG TIN CHÚNG TÔI THU THẬP --}}
        <div class="mb-20">
            <h2 class="text-4xl font-black text-gray-900 mb-10 flex items-center gap-4">
                <i class="fa-solid fa-database text-[#7d3cff]"></i> Thông Tin Chúng Tôi Thu Thập
            </h2>
            <div class="grid md:grid-cols-3 gap-10">
                {{-- Thông tin cá nhân --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-white">
                    <h4 class="font-bold text-2xl text-gray-900 mb-6 underline decoration-[#7d3cff] decoration-4 underline-offset-8">Thông tin cá nhân</h4>
                    <ul class="text-gray-600 text-lg space-y-4 pt-2 leading-relaxed">
                        <li>• Họ tên, email, số điện thoại</li>
                        <li>• Địa chỉ giao hàng</li>
                        <li>• Ngày sinh, giới tính</li>
                    </ul>
                </div>
                {{-- Thông tin giao dịch --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-white">
                    <h4 class="font-bold text-2xl text-gray-900 mb-6 underline decoration-[#7d3cff] decoration-4 underline-offset-8">Thông tin giao dịch</h4>
                    <ul class="text-gray-600 text-lg space-y-4 pt-2 leading-relaxed">
                        <li>• Lịch sử mua hàng</li>
                        <li>• Phương thức thanh toán</li>
                        <li>• Địa chỉ thanh toán</li>
                    </ul>
                </div>
                {{-- Thông tin hành vi --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-white">
                    <h4 class="font-bold text-2xl text-gray-900 mb-6 underline decoration-[#7d3cff] decoration-4 underline-offset-8">Thông tin hành vi</h4>
                    <ul class="text-gray-600 text-lg space-y-4 pt-2 leading-relaxed">
                        <li>• Lịch sử duyệt website</li>
                        <li>• Sản phẩm yêu thích</li>
                        <li>• Tương tác với website</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- KHỐI 2: MỤC ĐÍCH SỬ DỤNG THÔNG TIN --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50 border border-gray-50 mb-20">
            <h2 class="text-4xl font-black text-gray-900 mb-12 flex items-center gap-4">
                <i class="fa-solid fa-bullseye text-[#7d3cff]"></i> Mục Đích Sử Dụng Thông Tin
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="space-y-4">
                    <h5 class="font-bold text-gray-800 text-2xl">Cung cấp dịch vụ</h5>
                    <p class="text-lg text-gray-500 leading-relaxed">• Xử lý đơn hàng và giao hàng<br>• Hỗ trợ khách hàng<br>• Xác thực tài khoản<br>• Quản lý thanh toán</p>
                </div>
                <div class="space-y-4">
                    <h5 class="font-bold text-gray-800 text-2xl">Cải thiện trải nghiệm</h5>
                    <p class="text-lg text-gray-500 leading-relaxed">• Cá nhân hóa nội dung<br>• Gợi ý sản phẩm phù hợp<br>• Phân tích hành vi người dùng<br>• Cải thiện website</p>
                </div>
                <div class="space-y-4">
                    <h5 class="font-bold text-gray-800 text-2xl">Marketing</h5>
                    <p class="text-lg text-gray-500 leading-relaxed">• Gửi email khuyến mãi<br>• Thông báo sản phẩm mới<br>• Chương trình ưu đãi<br>• Khảo sát ý kiến</p>
                </div>
                <div class="space-y-4">
                    <h5 class="font-bold text-gray-800 text-2xl">Tuân thủ pháp luật</h5>
                    <p class="text-lg text-gray-500 leading-relaxed">• Báo cáo thuế<br>• Tuân thủ quy định<br>• Phòng chống gian lận<br>• Bảo vệ quyền lợi</p>
                </div>
            </div>
        </div>

        {{-- KHỐI 3: QUYỀN CỦA KHÁCH HÀNG --}}
        <div class="mb-20">
            <h2 class="text-4xl font-black text-gray-900 mb-10">Quyền Của Khách Hàng</h2>
            <div class="grid md:grid-cols-2 gap-8">
                {{-- Các ô nội dung được tăng cỡ chữ lên text-xl --}}
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền truy cập</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Xem thông tin cá nhân chúng tôi đang lưu trữ</p>
                </div>
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền chỉnh sửa</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Cập nhật, sửa đổi thông tin cá nhân bất kỳ lúc nào</p>
                </div>
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền xóa</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Yêu cầu xóa tài khoản và dữ liệu cá nhân</p>
                </div>
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền từ chối</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Từ chối nhận email marketing và quảng cáo</p>
                </div>
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền khiếu nại</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Khiếu nại về việc xử lý dữ liệu cá nhân</p>
                </div>
                <div class="bg-[#f1f5f9] p-10 rounded-3xl border border-gray-200 shadow-sm transition hover:shadow-md">
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Quyền di chuyển</h4>
                    <p class="text-gray-600 text-xl leading-relaxed">Yêu cầu xuất dữ liệu cá nhân sang định dạng khác</p>
                </div>
            </div>
        </div>

        {{-- KHỐI 4: CHÍNH SÁCH COOKIE --}}
        <div class="bg-[#f1f5f9] p-12 rounded-[3rem] border border-gray-200 mb-20 shadow-inner">
            <h3 class="text-4xl font-black text-gray-900 mb-6">Chính Sách Cookie</h3>
            <p class="text-gray-700 mb-12 text-2xl leading-relaxed">Chúng tôi sử dụng cookie để cải thiện trải nghiệm người dùng và phân tích lưu lượng truy cập website.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h5 class="font-bold text-gray-900 mb-4 text-2xl">Cookie cần thiết</h5>
                    <p class="text-gray-500 text-xl italic leading-relaxed">Đảm bảo website hoạt động bình thường và bảo mật phiên đăng nhập.</p>
                </div>
                <div>
                    <h5 class="font-bold text-gray-900 mb-4 text-2xl">Cookie phân tích</h5>
                    <p class="text-gray-500 text-xl italic leading-relaxed">Giúp chúng tôi hiểu cách người dùng tương tác với website để cải thiện dịch vụ.</p>
                </div>
                <div>
                    <h5 class="font-bold text-gray-900 mb-4 text-2xl">Cookie marketing</h5>
                    <p class="text-gray-500 text-xl italic leading-relaxed">Sử dụng để cá nhân hóa quảng cáo và hiển thị nội dung phù hợp với sở thích.</p>
                </div>
            </div>
        </div>

        {{-- KHỐI 5: CHIA SẺ & BẢO MẬT --}}
        <div class="grid lg:grid-cols-2 gap-12 mb-20">
            {{-- Chia sẻ thông tin --}}
            <div class="bg-purple-50 p-12 rounded-[3rem] border-2 border-purple-100">
                <h4 class="font-bold text-3xl text-gray-900 mb-8">Chia Sẻ Thông Tin</h4>
                <div class="space-y-6 text-xl text-gray-700 leading-relaxed">
                    <p class="italic mb-6">Chúng tôi KHÔNG chia sẻ với bên thứ ba không liên quan hoặc các công ty marketing khác.</p>
                    <p class="font-bold text-[#7d3cff]">Chúng tôi chỉ chia sẻ với:</p>
                    <ul class="space-y-4">
                        <li>• Đối tác vận chuyển (chỉ thông tin giao hàng)</li>
                        <li>• Cổng thanh toán (thông tin cần thiết để giao dịch)</li>
                        <li>• Cơ quan pháp luật khi có yêu cầu chính thức</li>
                    </ul>
                </div>
            </div>
            {{-- Biện pháp bảo mật --}}
            <div class="bg-gray-900 p-12 rounded-[3rem] text-white shadow-2xl">
                <h4 class="font-bold text-3xl mb-8">Biện Pháp Bảo Mật</h4>
                <div class="space-y-8">
                    <div class="flex items-center gap-5">
                        <i class="fa-solid fa-lock text-[#7d3cff] text-3xl"></i>
                        <span class="text-xl">Dữ liệu khách hàng được mã hóa hoàn toàn (SSL/TLS)</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <i class="fa-solid fa-server text-[#7d3cff] text-3xl"></i>
                        <span class="text-xl">Hệ thống máy chủ bảo mật đa tầng, sao lưu định kỳ</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <i class="fa-solid fa-user-shield text-[#7d3cff] text-3xl"></i>
                        <span class="text-xl">Giám sát hệ thống và phòng chống gian lận 24/7</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KHỐI 6: LƯU Ý QUAN TRỌNG --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50 border border-gray-50 mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-4">
                <i class="fa-solid fa-circle-exclamation text-[#7d3cff] text-4xl"></i> Lưu Ý Quan Trọng
            </h2>
            <div class="grid md:grid-cols-2 gap-12 text-gray-600 text-xl leading-relaxed">
                <ul class="space-y-6">
                    <li>• Chính sách này có thể được cập nhật định kỳ để phù hợp với quy định pháp luật hiện hành.</li>
                    <li>• Khách hàng sẽ được thông báo qua email hoặc website trước khi có thay đổi quan trọng.</li>
                </ul>
                <ul class="space-y-6">
                    <li>• Việc tiếp tục sử dụng dịch vụ đồng nghĩa với việc bạn chấp nhận chính sách bảo mật mới.</li>
                    <li>• Đối với trẻ em dưới 16 tuổi, việc sử dụng cần có sự đồng ý và giám sát của phụ huynh.</li>
                </ul>
            </div>
        </div>

        {{-- LIÊN HỆ BẢO MẬT --}}
        <div class="text-center bg-gray-900 rounded-[4rem] p-16 text-white shadow-2xl shadow-purple-200 relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-4xl font-black mb-10 uppercase tracking-tight">Có Thắc Mắc Về Quyền Riêng Tư?</h3>
                <div class="flex flex-wrap justify-center gap-16 text-2xl font-bold">
                    <span class="flex items-center gap-4"><i class="fa-solid fa-phone text-[#7d3cff] text-4xl"></i> 1900 6789</span>
                    <span class="flex items-center gap-4"><i class="fa-solid fa-envelope text-[#7d3cff] text-4xl"></i> support@flexstyle.com</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
