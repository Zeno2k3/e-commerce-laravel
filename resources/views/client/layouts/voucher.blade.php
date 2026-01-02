@extends('client.layouts.app')

@section('content')
<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12 max-w-3xl mx-auto">
                <span class="inline-block py-2 px-5 rounded-lg bg-purple-100 text-[#7d3cff] font-bold text-2xl mb-5 tracking-widest uppercase">
                    <i class="fa-solid fa-user-tie mr-2"></i> Mã Giảm Giá
                </span>

                <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                    Voucher <span class="text-[#7d3cff]">Ưu Đãi</span>
                </h1>

                <p class="text-gray-500 text-1xl">
                    Khám phá những mã giảm giá hấp dẫn và tiết kiệm chi phí mua sắm. Cập nhật liên tục các chương trình khuyến mãi đặc biệt dành riêng cho bạn.
                </p>
        </div>

    <div class="container mx-auto px-4 md:px-8 max-w-7xl">
        <div class="container mx-auto px-4 py-12">
            <div class="mb-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center md:text-left">Mã Giảm Giá Đang Có Hiệu Lực</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-[#f3f6f9] rounded-2xl p-6 relative border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-user-plus text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Chào mừng thành viên mới</h3>
                                <p class="text-gray-500 text-sm">Giảm 50.000₫ cho đơn hàng đầu tiên từ 300.000₫</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-4xl font-black text-[#7d3cff]">50.000₫</span>
                            <div class="text-sm text-gray-500 mt-1">Đơn tối thiểu: 300.000₫</div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                                <div class="bg-blue-500 h-full w-[25%]"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-400 mt-1">
                                <span>Đã dùng: 1,250/5,000</span>
                                <span><i class="fa-regular fa-calendar mr-1"></i> HSD: 31/03/2026</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-auto">
                            <span class="text-2xl font-black text-gray-800 tracking-tight">WELCOME50</span>
                            <button class="bg-white border border-gray-300 hover:border-[#7d3cff] hover:text-[#7d3cff] text-gray-700 font-semibold py-1.5 px-4 rounded-lg flex items-center gap-2 transition text-sm shadow-sm">
                                <i class="fa-regular fa-copy"></i> Copy
                            </button>
                        </div>
                        <div class="absolute left-0 top-6 bottom-6 w-1 bg-blue-400 rounded-r-full"></div>
                    </div>

                    <div class="bg-[#f3f6f9] rounded-2xl p-6 relative border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-percent text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Giảm giá 20%</h3>
                                <p class="text-gray-500 text-sm">Giảm 20% tối đa 200.000₫ cho tất cả sản phẩm</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-4xl font-black text-[#7d3cff]">20%</span>
                            <div class="text-sm text-gray-500 mt-1">Đơn tối thiểu: 500.000₫</div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                                <div class="bg-green-500 h-full w-[30%]"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-400 mt-1">
                                <span>Đã dùng: 3,000/10,000</span>
                                <span><i class="fa-regular fa-calendar mr-1"></i> HSD: 28/02/2026</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-auto">
                            <span class="text-2xl font-black text-gray-800 tracking-tight">SALE20</span>
                            <button class="bg-white border border-gray-300 hover:border-[#7d3cff] hover:text-[#7d3cff] text-gray-700 font-semibold py-1.5 px-4 rounded-lg flex items-center gap-2 transition text-sm shadow-sm">
                                <i class="fa-regular fa-copy"></i> Copy
                            </button>
                        </div>
                        <div class="absolute left-0 top-6 bottom-6 w-1 bg-green-400 rounded-r-full"></div>
                    </div>

                    <div class="bg-[#f3f6f9] rounded-2xl p-6 relative border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-truck-fast text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Miễn phí vận chuyển</h3>
                                <p class="text-gray-500 text-sm">Miễn phí ship toàn quốc cho mọi đơn hàng</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-3xl font-black text-[#7d3cff]">Free Ship</span>
                            <div class="text-sm text-gray-500 mt-1">Áp dụng cho mọi đơn hàng</div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                                <div class="bg-[#7d3cff] h-full w-[56%]"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-400 mt-1">
                                <span>Đã dùng: 8,500/15,000</span>
                                <span><i class="fa-regular fa-calendar mr-1"></i> HSD: 15/04/2026</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-auto">
                            <span class="text-2xl font-black text-gray-800 tracking-tight">FREESHIP</span>
                            <button class="bg-white border border-gray-300 hover:border-[#7d3cff] hover:text-[#7d3cff] text-gray-700 font-semibold py-1.5 px-4 rounded-lg flex items-center gap-2 transition text-sm shadow-sm">
                                <i class="fa-regular fa-copy"></i> Copy
                            </button>
                        </div>
                        <div class="absolute left-0 top-6 bottom-6 w-1 bg-[#7d3cff] rounded-r-full"></div>
                    </div>

                    <div class="bg-[#f3f6f9] rounded-2xl p-6 relative border border-gray-100 hover:shadow-md transition duration-300">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-crown text-yellow-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Ưu đãi VIP</h3>
                                <p class="text-gray-500 text-sm">Giảm 100.000₫ dành riêng cho thành viên VIP</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-4xl font-black text-[#7d3cff]">100.000₫</span>
                            <div class="text-sm text-gray-500 mt-1">Đơn tối thiểu: 1.000.000₫</div>
                            <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                                <div class="bg-yellow-500 h-full w-[45%]"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-400 mt-1">
                                <span>Đã dùng: 450/1,000</span>
                                <span><i class="fa-regular fa-calendar mr-1"></i> HSD: 30/06/2026</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-auto">
                            <span class="text-2xl font-black text-gray-800 tracking-tight">VIP100</span>
                            <button class="bg-white border border-gray-300 hover:border-[#7d3cff] hover:text-[#7d3cff] text-gray-700 font-semibold py-1.5 px-4 rounded-lg flex items-center gap-2 transition text-sm shadow-sm">
                                <i class="fa-regular fa-copy"></i> Copy
                            </button>
                        </div>
                        <div class="absolute left-0 top-6 bottom-6 w-1 bg-yellow-400 rounded-r-full"></div>
                    </div>

                </div>
            </div>

            <div class="mb-16 border-t border-gray-100 pt-12">
                <h2 class="text-2xl font-bold text-gray-700 mb-8 text-center">Mã Giảm Giá Đã Hết Hạn</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 opacity-60">

                    <div class="bg-[#f8f9fa] border border-gray-200 rounded-xl p-5 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Tết nguyên đán 2025</h4>
                            <p class="text-sm text-gray-500 mb-1">Giảm 30% tối đa 300.000₫</p>
                            <span class="text-lg font-bold text-gray-400">NEWYEAR2025</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-gray-400 text-white text-xs font-bold px-3 py-1 rounded">Hết hạn</span>
                            <p class="text-xs text-gray-400 mt-2">HSD: 15/02/2025</p>
                        </div>
                    </div>

                    <div class="bg-[#f8f9fa] border border-gray-200 rounded-xl p-5 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg">Valentine's Day</h4>
                            <p class="text-sm text-gray-500 mb-1">Giảm 14% cho các sản phẩm thời trang</p>
                            <span class="text-lg font-bold text-gray-400">VALENTINE</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-gray-400 text-white text-xs font-bold px-3 py-1 rounded">Hết hạn</span>
                            <p class="text-xs text-gray-400 mt-2">HSD: 14/02/2025</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Cách Sử Dụng Voucher</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-[#f3f6f9] rounded-2xl p-8 text-center h-full">
                        <div class="w-14 h-14 bg-[#7d3cff] text-white rounded-full flex items-center justify-center mx-auto mb-5 text-xl font-bold">1</div>
                        <h4 class="font-bold text-gray-900 mb-2">Chọn sản phẩm</h4>
                        <p class="text-gray-500 text-sm">Thêm sản phẩm yêu thích vào giỏ hàng</p>
                    </div>
                    <div class="bg-[#f3f6f9] rounded-2xl p-8 text-center h-full">
                        <div class="w-14 h-14 bg-[#7d3cff] text-white rounded-full flex items-center justify-center mx-auto mb-5 text-xl font-bold">2</div>
                        <h4 class="font-bold text-gray-900 mb-2">Vào giỏ hàng</h4>
                        <p class="text-gray-500 text-sm">Kiểm tra sản phẩm và số lượng</p>
                    </div>
                    <div class="bg-[#f3f6f9] rounded-2xl p-8 text-center h-full">
                        <div class="w-14 h-14 bg-[#7d3cff] text-white rounded-full flex items-center justify-center mx-auto mb-5 text-xl font-bold">3</div>
                        <h4 class="font-bold text-gray-900 mb-2">Nhập mã Voucher</h4>
                        <p class="text-gray-500 text-sm">Nhập mã vào ô 'Mã giảm giá' và nhấn áp dụng</p>
                    </div>
                    <div class="bg-[#f3f6f9] rounded-2xl p-8 text-center h-full">
                        <div class="w-14 h-14 bg-[#7d3cff] text-white rounded-full flex items-center justify-center mx-auto mb-5 text-xl font-bold">4</div>
                        <h4 class="font-bold text-gray-900 mb-2">Hoàn tất thanh toán</h4>
                        <p class="text-gray-500 text-sm">Kiểm tra giá đã giảm và thanh toán</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#f3f6f9] rounded-2xl p-8 md:p-10 border border-gray-100">
                <h2 class="text-lg font-bold text-gray-900 mb-6">Điều Kiện Sử Dụng</h2>
                <div class="space-y-3">
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> Mỗi voucher chỉ được sử dụng một lần cho mỗi tài khoản
                    </p>
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> Không áp dụng đồng thời nhiều voucher cho một đơn hàng
                    </p>
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> Voucher không có giá trị quy đổi thành tiền mặt
                    </p>
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> FashionStore có quyền thay đổi điều kiện mà không cần báo trước
                    </p>
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> Voucher không áp dụng cho sản phẩm đã giảm giá trên 50%
                    </p>
                    <p class="flex items-start gap-3 text-sm text-gray-600">
                        <span class="text-black font-bold">•</span> Liên hệ CSKH nếu gặp vấn đề khi sử dụng voucher
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
