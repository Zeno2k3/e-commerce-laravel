@extends('client.layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

<div class="bg-white min-h-screen font-sans py-12">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- HEADER: TIÊU ĐỀ & NÚT XÓA TẤT CẢ --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">Chọn sản phẩm để thanh toán</h1>

            <button class="flex items-center gap-2 text-gray-900 hover:text-red-600 font-bold transition-colors bg-white border border-gray-200 px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md">
                <i class="fa-regular fa-trash-can"></i>
                <span>Xóa tất cả</span>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- CỘT TRÁI: DANH SÁCH SẢN PHẨM (8 phần) --}}
            <div class="lg:col-span-8 space-y-6">

                {{-- ITEM 1 --}}
                <div class="bg-[#eff2f5] rounded-xl p-6 flex flex-col sm:flex-row items-center gap-6 border border-transparent hover:border-gray-200 transition-all" x-data="{ qty: 1 }">

                    {{-- Checkbox --}}
                    <div class="flex-shrink-0">
                        <input type="checkbox" class="w-6 h-6 border-gray-300 rounded focus:ring-[#7d3cff] cursor-pointer accent-[#7d3cff] checked:bg-[#7d3cff]">
                    </div>

                    {{-- Ảnh --}}
                    <div class="w-32 h-32 flex-shrink-0 bg-white rounded-lg overflow-hidden border border-gray-200 p-2">
                        <img src="https://placehold.co/150x150?text=Jean" class="w-full h-full object-cover rounded-md">
                    </div>

                    {{-- Thông tin --}}
                    <div class="flex-1 w-full space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800 text-lg leading-tight pr-4">Áo Khoác Jean Phối Nón The Original 039 Xanh Dương</h3>
                            {{-- Nút xóa --}}
                            <button class="text-gray-500 hover:text-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-xl"></i>
                            </button>
                        </div>

                        <p class="text-gray-500 text-sm">Size: S &nbsp;&nbsp; Màu: Đen</p>

                        {{-- Giá tiền --}}
                        <div class="pt-2">
                             <span class="text-[#7d3cff] font-extrabold text-xl">1.000.000₫</span>
                        </div>
                    </div>

                    {{-- Bộ chỉnh số lượng (Nằm ngang hàng hoặc dưới tùy mobile/desktop) --}}
                    <div class="flex items-center gap-3">
                        <button @click="if(qty > 1) qty--" class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded-lg shadow-sm hover:bg-gray-50 transition-all font-bold text-lg">
                            <i class="fa-solid fa-minus text-xs"></i>
                        </button>
                        <input type="text" x-model="qty" class="w-8 text-center bg-transparent font-bold text-lg text-gray-900 border-none focus:ring-0 p-0" readonly>
                        <button @click="qty++" class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded-lg shadow-sm hover:bg-gray-50 transition-all font-bold text-lg">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- ITEM 2 (Copy y hệt) --}}
                <div class="bg-[#eff2f5] rounded-xl p-6 flex flex-col sm:flex-row items-center gap-6 border border-transparent hover:border-gray-200 transition-all" x-data="{ qty: 1 }">
                    <div class="flex-shrink-0">
                        <input type="checkbox" class="w-6 h-6 border-gray-300 rounded focus:ring-[#7d3cff] cursor-pointer accent-[#7d3cff] checked:bg-[#7d3cff]" checked>
                    </div>
                    <div class="w-32 h-32 flex-shrink-0 bg-white rounded-lg overflow-hidden border border-gray-200 p-2">
                        <img src="https://placehold.co/150x150?text=Jean" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="flex-1 w-full space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800 text-lg leading-tight pr-4">Áo Khoác Jean Phối Nón The Original 039 Xanh Dương</h3>
                            <button class="text-gray-500 hover:text-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-xl"></i>
                            </button>
                        </div>
                        <p class="text-gray-500 text-sm">Size: S &nbsp;&nbsp; Màu: Đen</p>
                        <div class="pt-2">
                             <span class="text-[#7d3cff] font-extrabold text-xl">1.000.000₫</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button @click="if(qty > 1) qty--" class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded-lg shadow-sm hover:bg-gray-50 transition-all font-bold text-lg">
                            <i class="fa-solid fa-minus text-xs"></i>
                        </button>
                        <input type="text" x-model="qty" class="w-8 text-center bg-transparent font-bold text-lg text-gray-900 border-none focus:ring-0 p-0" readonly>
                        <button @click="qty++" class="w-10 h-10 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded-lg shadow-sm hover:bg-gray-50 transition-all font-bold text-lg">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>

            </div>

            {{-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG (4 phần) --}}
            <div class="lg:col-span-4">
                <div class="bg-[#eff2f5] rounded-xl p-8 sticky top-24">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Tóm tắt đơn hàng</h2>

                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-300">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600 font-medium">Tạm tính (2 sản phẩm)</span>
                            <span class="font-bold text-gray-900">2.000.000 ₫</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600 font-medium">Phí vận chuyển</span>
                            <span class="font-bold text-[#7d3cff]">Miễn phí</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end mb-8">
                        <span class="text-xl font-bold text-gray-900">Tổng cộng</span>
                        <span class="text-2xl font-black text-[#7d3cff]">2.000.000 ₫</span>
                    </div>

                    <div class="space-y-4">
                        {{-- Nút Thanh toán --}}
                        <a href="{{ route('client.carts.payment') }}" class="block w-full bg-[#7d3cff] hover:bg-[#6c2bd9] text-white text-center font-bold py-4 rounded-xl shadow-lg shadow-purple-200 transition-all active:scale-95 text-lg">
                            Thanh toán
                        </a>

                        {{-- Nút Tiếp tục mua sắm --}}
                        <a href="{{ route('products.index') }}" class="block w-full bg-[#eff2f5] border-2 border-gray-200 hover:bg-white hover:border-gray-300 text-gray-700 text-center font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2 active:scale-95">
                            <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
