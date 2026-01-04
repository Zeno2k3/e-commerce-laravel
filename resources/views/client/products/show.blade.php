@extends('client.layouts.app')

@section('content')
<div class="bg-white font-sans pb-20">
    <div class="container mx-auto px-4 py-8 max-w-7xl">

        {{-- 1. BREADCRUMB (Điều hướng) [cite: 968] --}}
        <nav class="flex text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="#" class="hover:text-[#7d3cff]">Trang chủ</a>
                </li>
                <li><span class="mx-1">/</span></li>
                <li class="inline-flex items-center">
                    <a href="#" class="hover:text-[#7d3cff]">Sản phẩm</a>
                </li>
                <li><span class="mx-1">/</span></li>
                <li class="text-gray-900 font-medium truncate max-w-xs">
                    Áo Khoác Jean Phối Nón The Original 039 Xanh Dương
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- 2. CỘT TRÁI: ẢNH SẢN PHẨM --}}
            <div class="space-y-4">
                {{-- Ảnh lớn --}}
                <div class="rounded-2xl overflow-hidden border border-gray-100 relative">
                    {{-- Dùng ảnh placeholder tạm thời --}}
                    <img src="images/jacket.png" alt="Áo Khoác Jean" class="w-full h-auto object-cover">
                    {{-- Nhãn giảm giá -90% [cite: 975] --}}
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">-90%</span>
                </div>
                {{-- Ảnh nhỏ (Thumbnails) --}}
                <div class="grid grid-cols-4 gap-4">
                    <div class="rounded-xl overflow-hidden border-2 border-[#7d3cff] cursor-pointer">
                         <img src="images/jacket.png" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-gray-200 cursor-pointer hover:border-gray-400">
                         <img src="images/jacket.png" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-gray-200 cursor-pointer hover:border-gray-400">
                         <img src="images/jacket.png" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-gray-200 cursor-pointer hover:border-gray-400">
                         <img src="images/jacket.png" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            {{-- 3. CỘT PHẢI: THÔNG TIN CHI TIẾT --}}
            <div>
                {{-- Tên sản phẩm [cite: 971, 972] --}}
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-4">
                    Áo Khoác Jean Phối Nón The Original 039 Xanh Dương
                </h1>

                {{-- Đánh giá & Mã SP [cite: 973, 974] --}}
                <div class="flex items-center gap-6 text-sm text-gray-500 mb-6">
                    <div class="flex items-center text-yellow-400 gap-1">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star text-gray-300"></i>
                        <span class="text-gray-500 ml-2 font-medium">(69 đánh giá)</span>
                    </div>
                    <div class="h-4 w-px bg-gray-300"></div>
                    <span>Mã SP: <span class="font-mono text-gray-900 font-bold">W9ED09E</span></span>
                </div>

                {{-- Giá tiền [cite: 975] --}}
                <div class="bg-gray-50 p-6 rounded-2xl mb-8">
                    <div class="flex items-end gap-4">
                        <span class="text-4xl font-black text-[#7d3cff]">1.000.000₫</span>
                        <span class="text-xl text-gray-400 line-through mb-1">10.999.000₫</span>
                        <span class="text-red-600 font-bold bg-red-100 px-2 py-1 rounded-md text-sm mb-2">Tiết kiệm 90%</span>
                    </div>
                </div>

                {{-- Mô tả ngắn [cite: 976] --}}
                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Áo khoác jean 100% có nón, form regular fit, phù hợp mặc hàng ngày. Chất liệu bền đẹp, phong cách trẻ trung.
                </p>

                {{-- Chọn Size [cite: 977-982] --}}
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-900 text-lg">Kích thước</span>
                        <a href="#" class="text-[#7d3cff] text-sm font-medium hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-ruler"></i> Bảng size
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button class="w-14 h-12 rounded-xl border border-gray-200 font-bold text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff] transition-all">S</button>
                        <button class="w-14 h-12 rounded-xl border-2 border-[#7d3cff] font-bold text-[#7d3cff] bg-purple-50">M</button>
                        <button class="w-14 h-12 rounded-xl border border-gray-200 font-bold text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff] transition-all">L</button>
                        <button class="w-14 h-12 rounded-xl border border-gray-200 font-bold text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff] transition-all">XL</button>
                        <button class="w-14 h-12 rounded-xl border border-gray-200 font-bold text-gray-600 hover:border-[#7d3cff] hover:text-[#7d3cff] transition-all">XXL</button>
                    </div>
                </div>

                {{-- Chọn Số lượng & Buttons Action [cite: 983-987] --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10 pb-10 border-b border-gray-100">
                    <div class="flex items-center border border-gray-300 rounded-xl w-fit bg-white">
                        <button class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff]"><i class="fa-solid fa-minus"></i></button>
                        <input type="text" value="1" class="w-10 text-center border-none focus:ring-0 font-bold text-gray-900 p-0">
                        <button class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#7d3cff]"><i class="fa-solid fa-plus"></i></button>
                    </div>

                    <button class="flex-1 bg-[#7d3cff] hover:bg-[#6c2bd9] text-white font-bold text-lg py-3 px-6 rounded-xl shadow-lg shadow-purple-200 transition-all transform active:scale-95 flex items-center justify-center gap-3">
                        <i class="fa-solid fa-cart-plus"></i>
                        Thêm vào giỏ hàng
                    </button>

                    <button class="w-14 h-14 flex-shrink-0 border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 hover:border-red-200 transition-all">
                        <i class="fa-regular fa-heart text-2xl"></i>
                    </button>
                </div>

                {{-- Chính sách [cite: 988-990] --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xl flex-shrink-0">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Giao hàng miễn phí</p>
                            <p class="text-sm text-gray-500">Cho đơn hàng trên 500k</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600 text-xl flex-shrink-0">
                            <i class="fa-solid fa-rotate-left"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Đổi trả dễ dàng</p>
                            <p class="text-sm text-gray-500">Trong vòng 15 ngày</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- 4. PHẦN TAB THÔNG TIN & ĐÁNH GIÁ (PAGE 24) --}}
        <div class="mt-20" x-data="{ activeTab: 'reviews' }"> {{-- Sử dụng AlpineJS nhẹ để chuyển Tab nếu muốn, hoặc mặc định show Reviews --}}

            {{-- Tab Headers --}}
            <div class="flex gap-8 border-b border-gray-200 mb-8 overflow-x-auto">
                <button @click="activeTab = 'description'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'description', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'description' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Mô tả chi tiết
                </button>
                <button @click="activeTab = 'specs'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'specs', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'specs' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Thông số kỹ thuật
                </button>
                <button @click="activeTab = 'reviews'"
                        :class="{ 'border-[#7d3cff] text-[#7d3cff]': activeTab === 'reviews', 'border-transparent text-gray-500 hover:text-gray-800': activeTab !== 'reviews' }"
                        class="pb-4 border-b-4 font-bold text-lg whitespace-nowrap transition-colors">
                    Đánh giá (69)
                </button>
            </div>

            {{-- 1. Nội dung Tab: Mô tả chi tiết (Theo trang 23) --}}
            <div x-show="activeTab === 'description'" class="bg-gray-50 rounded-2xl p-8 text-gray-700 leading-relaxed">
                <p class="mb-6 text-lg">Áo khoác jean 100% có nón, form regular fit, phù hợp mặc hàng ngày.</p>

                <h4 class="font-bold text-gray-900 text-xl mb-4">Đặc điểm nổi bật:</h4>
                <ul class="list-disc pl-6 space-y-3 text-base">
                    <li>Chất liệu cao cấp, bền đẹp theo thời gian</li>
                    <li>Thiết kế hiện đại, phù hợp nhiều dịp</li>
                    <li>Form dáng chuẩn, tôn dáng người mặc</li>
                    <li>Dễ dàng phối đồ với nhiều trang phục khác</li>
                    <li>Chăm sóc đơn giản, giặt máy được</li>
                </ul>
            </div>

             {{-- 2. Nội dung Tab: Thông số kỹ thuật (Theo trang 25) --}}
            <div x-show="activeTab === 'specs'" class="bg-gray-50 rounded-2xl p-8 text-gray-700 leading-relaxed" style="display: none;">
                <div class="grid md:grid-cols-2 gap-10">

                    {{-- Cột trái: Thông tin sản phẩm --}}
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl mb-4 border-b border-gray-200 pb-2">Thông tin sản phẩm</h4>
                        <ul class="space-y-4">
                            <li class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Chất liệu : Jean</span>

                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Xuất xứ : Việt Nam</span>

                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Thương hiệu : LaravelShop</span>

                            </li>
                        </ul>
                    </div>

                    {{-- Cột phải: Hướng dẫn bảo quản --}}
                    <div>
                        <h4 class="font-bold text-gray-900 text-xl mb-4 border-b border-gray-200 pb-2">Hướng dẫn bảo quản</h4>
                        <ul class="list-disc pl-6 space-y-3">
                            <li>Giặt máy ở nhiệt độ dưới 30°C</li>
                            <li>Không sử dụng chất tẩy rửa mạnh</li>
                            <li>Phơi nơi thoáng mát, tránh ánh nắng trực tiếp</li>
                            <li>Ủi ở nhiệt độ thấp để bảo vệ vải</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Nội dung Tab: ĐÁNH GIÁ (GIAO DIỆN TRANG 24) --}}
            <div x-show="activeTab === 'reviews'" class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- Cột trái: Tổng quan điểm số [cite: 1030-1035] --}}
                <div class="lg:col-span-4">
                    <div class="bg-purple-50 rounded-2xl p-8 text-center border border-purple-100 h-full">
                        <div class="text-6xl font-black text-[#7d3cff] mb-2">4.0</div>
                        <div class="flex justify-center gap-1 text-yellow-400 text-xl mb-2">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star text-gray-300"></i>
                        </div>
                        <p class="text-gray-500 font-medium mb-8">(36 đánh giá)</p>

                        {{-- Thanh tiến trình từng sao --}}
                        <div class="space-y-3 text-sm text-gray-600">
                            {{-- 5 Sao --}}
                            <div class="flex items-center gap-3">
                                <span class="w-8 font-bold">5 <i class="fa-solid fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#7d3cff] w-[40%] rounded-full"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400">40%</span>
                            </div>
                            {{-- 4 Sao --}}
                            <div class="flex items-center gap-3">
                                <span class="w-8 font-bold">4 <i class="fa-solid fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#7d3cff] w-[30%] rounded-full"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400">30%</span>
                            </div>
                            {{-- 3 Sao --}}
                            <div class="flex items-center gap-3">
                                <span class="w-8 font-bold">3 <i class="fa-solid fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#7d3cff] w-[15%] rounded-full"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400">15%</span>
                            </div>
                            {{-- 2 Sao --}}
                            <div class="flex items-center gap-3">
                                <span class="w-8 font-bold">2 <i class="fa-solid fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#7d3cff] w-[5%] rounded-full"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400">5%</span>
                            </div>
                            {{-- 1 Sao --}}
                            <div class="flex items-center gap-3">
                                <span class="w-8 font-bold">1 <i class="fa-solid fa-star text-yellow-400 text-xs"></i></span>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#7d3cff] w-[10%] rounded-full"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400">10%</span>
                            </div>
                        </div>

                        {{-- Nút Viết đánh giá --}}
                        <button class="mt-8 w-full bg-white border-2 border-[#7d3cff] text-[#7d3cff] font-bold py-3 px-6 rounded-xl hover:bg-[#7d3cff] hover:text-white transition-all">
                            Viết đánh giá
                        </button>
                    </div>
                </div>

                {{-- Cột phải: Danh sách bình luận [cite: 1036-1038] --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- Review Item 1: Nguyễn Văn A --}}
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                {{-- Avatar giả --}}
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-lg">
                                    N
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">Nguyễn Văn A</h4>
                                    <div class="flex items-center gap-2 text-sm">
                                        <div class="flex text-yellow-400 text-xs">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star text-gray-300"></i>
                                        </div>
                                        <span class="text-gray-400">• 2 ngày trước</span>
                                    </div>
                                </div>
                            </div>
                            {{-- Dấu 3 chấm (Option) --}}
                            <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-ellipsis"></i></button>
                        </div>

                        <p class="text-gray-600 leading-relaxed">
                            Sản phẩm rất đẹp, chất lượng tốt. Giao hàng nhanh, đóng gói cẩn thận. Mình rất hài lòng với trải nghiệm mua hàng tại FlexStyle!
                        </p>

                        {{-- Ảnh đính kèm (nếu có) --}}
                        <div class="flex gap-2 mt-4">
                            <img src="images/shirt.png" class="w-20 h-20 rounded-lg object-cover cursor-pointer hover:opacity-80">
                            <img src="images/shirt.png" class="w-20 h-20 rounded-lg object-cover cursor-pointer hover:opacity-80">
                        </div>

                        {{-- Nút like/reply --}}
                        <div class="flex gap-6 mt-4 pt-4 border-t border-gray-50">
                            <button class="flex items-center gap-2 text-sm text-gray-500 hover:text-[#7d3cff]">
                                <i class="fa-regular fa-thumbs-up"></i> Hữu ích (12)
                            </button>
                            <button class="flex items-center gap-2 text-sm text-gray-500 hover:text-[#7d3cff]">
                                <i class="fa-regular fa-comment"></i> Phản hồi
                            </button>
                        </div>
                    </div>

                    {{-- Review Item 2 (Demo thêm) --}}
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-[#7d3cff] font-bold text-lg">
                                    T
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">Trần Thị B</h4>
                                    <div class="flex items-center gap-2 text-sm">
                                        <div class="flex text-yellow-400 text-xs">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="text-gray-400">• 1 tuần trước</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Áo mặc rất mát, form chuẩn như hình. Sẽ ủng hộ shop dài dài.
                        </p>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-center mt-6">
                        <button class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">Xem thêm đánh giá</button>
                    </div>

                </div>
            </div>
        </div>

        {{-- 5. SẢN PHẨM LIÊN QUAN --}}
        <div class="mt-24">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">Sản phẩm liên quan</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Item 1 --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    {{-- QUAN TRỌNG: Thêm h-72 (chiều cao cố định) và object-cover --}}
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <img src="images/jacket.png"
                             alt="Áo Khoác Jean 01"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-50%</span>
                    </div>

                    {{-- Phần thông tin bên dưới tự giãn --}}
                    <div class="mt-auto">
                        <h3 class="font-bold text-gray-900 mb-1 truncate">Áo Khoác Jean 01</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">500.000₫</span>
                            <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <img src="images/bag.png"
                             alt="Túi Xách"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="mt-auto">
                        <h3 class="font-bold text-gray-900 mb-1 truncate">Áo Khoác Jean 02</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">650.000₫</span>
                            <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <img src="images/shirt.png"
                             alt="Áo Thun"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="mt-auto">
                        <h3 class="font-bold text-gray-900 mb-1 truncate">Áo Khoác Jean 03</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">750.000₫</span>
                            <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Item 4 --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all group flex flex-col">
                    <div class="relative overflow-hidden rounded-xl mb-4 h-72 w-full">
                        <img src="images/jacket.png"
                             alt="Áo Khoác"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                         <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-20%</span>
                    </div>
                    <div class="mt-auto">
                        <h3 class="font-bold text-gray-900 mb-1 truncate">Áo Khoác Jean 04</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-[#7d3cff] font-bold">850.000₫</span>
                            <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#7d3cff] hover:text-white transition-colors">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
