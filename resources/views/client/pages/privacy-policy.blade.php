@extends('client.layouts.app')

@section('content')
<div class="bg-[#f9fafb] min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- TIÊU ĐỀ TRANG --}}
        <x-client.page-header 
            icon="fa-solid fa-shield-halved"
            tag="CHÍNH SÁCH BẢO MẬT"
            title="Bảo Vệ"
            highlight="Quyền Riêng Tư"
            color="purple">
            <p class="text-gray-500 text-xl max-w-3xl mx-auto leading-relaxed font-medium mt-6">
                FlexStyle cam kết bảo vệ thông tin cá nhân của khách hàng. Chúng tôi tuân thủ nghiêm ngặt các quy định về bảo mật dữ liệu và quyền riêng tư của người dùng.
            </p>
        </x-client.page-header>

        {{-- KHỐI 1: THÔNG TIN CHÚNG TÔI THU THẬP --}}
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 flex items-center gap-4">
                <i class="fa-solid fa-database text-[#7d3cff]"></i> Thông Tin Chúng Tôi Thu Thập
            </h2>
            <div class="grid md:grid-cols-3 gap-10">
                <x-client.info-card title="Thông tin cá nhân" :items="['Họ tên, email, số điện thoại', 'Địa chỉ giao hàng', 'Ngày sinh, giới tính']" />
                <x-client.info-card title="Thông tin giao dịch" :items="['Lịch sử mua hàng', 'Phương thức thanh toán', 'Địa chỉ thanh toán']" />
                <x-client.info-card title="Thông tin hành vi" :items="['Lịch sử duyệt website', 'Sản phẩm yêu thích', 'Tương tác với website']" />
            </div>
        </div>

        {{-- KHỐI 2: MỤC ĐÍCH SỬ DỤNG THÔNG TIN --}}
        <div class="bg-white p-12 rounded-[3rem] shadow-xl shadow-gray-200/50 border border-gray-50 mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 flex items-center gap-4">
                <i class="fa-solid fa-bullseye text-[#7d3cff]"></i> Mục Đích Sử Dụng Thông Tin
            </h2>
            @php
                $purposes = [
                    ['title' => 'Cung cấp dịch vụ', 'items' => ['Xử lý đơn hàng và giao hàng', 'Hỗ trợ khách hàng', 'Xác thực tài khoản', 'Quản lý thanh toán']],
                    ['title' => 'Cải thiện trải nghiệm', 'items' => ['Cá nhân hóa nội dung', 'Gợi ý sản phẩm phù hợp', 'Phân tích hành vi người dùng', 'Cải thiện website']],
                    ['title' => 'Marketing', 'items' => ['Gửi email khuyến mãi', 'Thông báo sản phẩm mới', 'Chương trình ưu đãi', 'Khảo sát ý kiến']],
                    ['title' => 'Tuân thủ pháp luật', 'items' => ['Báo cáo thuế', 'Tuân thủ quy định', 'Phòng chống gian lận', 'Bảo vệ quyền lợi']],
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($purposes as $purpose)
                <div class="space-y-4">
                    <h5 class="font-bold text-gray-800 text-2xl">{{ $purpose['title'] }}</h5>
                    <p class="text-lg text-gray-500 leading-relaxed">
                        @foreach($purpose['items'] as $item)
                            • {{ $item }}<br>
                        @endforeach
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- KHỐI 3: QUYỀN CỦA KHÁCH HÀNG --}}
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-10">Quyền Của Khách Hàng</h2>
            @php
                $rights = [
                    ['title' => 'Quyền truy cập', 'description' => 'Xem thông tin cá nhân chúng tôi đang lưu trữ'],
                    ['title' => 'Quyền chỉnh sửa', 'description' => 'Cập nhật, sửa đổi thông tin cá nhân bất kỳ lúc nào'],
                    ['title' => 'Quyền xóa', 'description' => 'Yêu cầu xóa tài khoản và dữ liệu cá nhân'],
                    ['title' => 'Quyền từ chối', 'description' => 'Từ chối nhận email marketing và quảng cáo'],
                    ['title' => 'Quyền khiếu nại', 'description' => 'Khiếu nại về việc xử lý dữ liệu cá nhân'],
                    ['title' => 'Quyền di chuyển', 'description' => 'Yêu cầu xuất dữ liệu cá nhân sang định dạng khác'],
                ];
            @endphp
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($rights as $right)
                    <x-client.rights-card title="{{ $right['title'] }}">
                        {{ $right['description'] }}
                    </x-client.rights-card>
                @endforeach
            </div>
        </div>

        {{-- KHỐI 4: CHÍNH SÁCH COOKIE --}}
        <div class="bg-[#f1f5f9] p-12 rounded-[3rem] border border-gray-200 mb-20 shadow-inner">
            <h3 class="text-3xl font-bold text-gray-900 mb-6">Chính Sách Cookie</h3>
            <p class="text-gray-700 mb-12 text-xl leading-relaxed font-medium">Chúng tôi sử dụng cookie để cải thiện trải nghiệm người dùng và phân tích lưu lượng truy cập website.</p>
            
            @php
                $cookies = [
                    ['title' => 'Cookie cần thiết', 'description' => 'Đảm bảo website hoạt động bình thường và bảo mật phiên đăng nhập.'],
                    ['title' => 'Cookie phân tích', 'description' => 'Giúp chúng tôi hiểu cách người dùng tương tác với website để cải thiện dịch vụ.'],
                    ['title' => 'Cookie marketing', 'description' => 'Sử dụng để cá nhân hóa quảng cáo và hiển thị nội dung phù hợp với sở thích.'],
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach($cookies as $cookie)
                <div>
                    <h5 class="font-bold text-gray-900 mb-4 text-2xl">{{ $cookie['title'] }}</h5>
                    <p class="text-gray-500 text-lg italic leading-relaxed">{{ $cookie['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- KHỐI 5: CHIA SẺ & BẢO MẬT --}}
        <div class="grid lg:grid-cols-2 gap-12 mb-20">
            {{-- Chia sẻ thông tin --}}
            <div class="bg-purple-50 p-12 rounded-[3rem] border-2 border-purple-100">
                <h4 class="font-bold text-2xl text-gray-900 mb-8">Chia Sẻ Thông Tin</h4>
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
                <h4 class="font-bold text-2xl mb-8">Biện Pháp Bảo Mật</h4>
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
        <x-client.cta-section 
            title="Có Thắc Mắc Về Quyền Riêng Tư?"
            description="">
            <div class="flex flex-wrap justify-center gap-16 text-2xl font-bold mt-6">
                <span class="flex items-center gap-4"><i class="fa-solid fa-phone text-[#7d3cff] text-4xl"></i> 1900 6789</span>
                <span class="flex items-center gap-4"><i class="fa-solid fa-envelope text-[#7d3cff] text-4xl"></i> support@flexstyle.com</span>
            </div>
        </x-client.cta-section>

    </div>
</div>
@endsection
