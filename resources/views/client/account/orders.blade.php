@extends('client.layouts.app')

@section('content')

{{--
    CẤU HÌNH XEM TRƯỚC GIAO DIỆN:
    - true:  Xem giao diện CÓ đơn hàng.
    - false: Xem giao diện CHƯA CÓ đơn hàng (Trống).
--}}
@php $showList = true; @endphp

<div class="bg-[#f9fafb] min-h-screen font-sans py-12">
    <div class="container mx-auto px-4 max-w-5xl">

        {{-- KHUNG CHÍNH --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 min-h-[500px] flex flex-col">

            {{-- TIÊU ĐỀ (Dùng chung) --}}
            <div class="p-8 border-b border-gray-100">
                <h1 class="text-2xl font-extrabold text-gray-900">Đơn hàng của tôi</h1>
                <p class="text-gray-500 mt-1">Xem lịch sử đơn hàng và trạng thái giao hàng</p>
            </div>

            <div class="p-8 flex-1">

                @if($showList)
                {{-- ==============================================================
                     GIAO DIỆN 1: DANH SÁCH ĐƠN HÀNG (Khi đã mua)
                     ============================================================== --}}
                    <div class="space-y-8">

                        {{-- Item 1: Đang giao --}}
                        <div class="flex flex-col sm:flex-row gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            {{-- Ảnh sản phẩm --}}
                            <div class="w-24 h-24 rounded-lg border border-gray-100 overflow-hidden shrink-0">
                                <img src="https://placehold.co/150x150?text=Jacket" class="w-full h-full object-cover">
                            </div>

                            {{-- Thông tin chi tiết --}}
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight">Áo Khoác Jean Phối Nón The Original 039 Xanh Dương</h3>
                                    <p class="text-gray-500 text-sm mt-1">Size: S &nbsp;&nbsp;|&nbsp;&nbsp; Màu: Đen</p>
                                </div>

                                {{-- Giá & Trạng thái --}}
                                <div class="flex items-center justify-between mt-4 sm:mt-0">
                                    <span class="text-[#7d3cff] font-extrabold text-xl">1.000.000₫</span>
                                    <span class="font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-lg text-sm">
                                        Đang giao
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Item 2: Hoàn tất --}}
                        <div class="flex flex-col sm:flex-row gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                            <div class="w-24 h-24 rounded-lg border border-gray-100 overflow-hidden shrink-0">
                                <img src="https://placehold.co/150x150?text=Jacket" class="w-full h-full object-cover">
                            </div>

                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight">Áo Khoác Jean Phối Nón The Original 039 Xanh Dương</h3>
                                    <p class="text-gray-500 text-sm mt-1">Size: S &nbsp;&nbsp;|&nbsp;&nbsp; Màu: Đen</p>
                                </div>

                                <div class="flex items-center justify-between mt-4 sm:mt-0">
                                    <span class="text-[#7d3cff] font-extrabold text-xl">1.000.000₫</span>
                                    <span class="font-bold text-green-600 bg-green-50 px-3 py-1 rounded-lg text-sm">
                                        Hoàn tất
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                @else
                {{-- ==============================================================
                     GIAO DIỆN 2: CHƯA CÓ ĐƠN HÀNG (Trống)
                     ============================================================== --}}
                    <div class="h-full flex flex-col items-center justify-center text-center py-16">
                        <p class="text-gray-600 text-lg mb-8 font-medium">Bạn chưa có đơn hàng nào</p>

                        <a href="{{ route('client.products.index') }}" class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-purple-200 transition-all active:scale-95 text-lg">
                            Bắt đầu mua sắm
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
