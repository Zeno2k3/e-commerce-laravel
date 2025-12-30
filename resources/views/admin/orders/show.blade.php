@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-red-500 pb-2">Chi tiết đơn hàng</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black text-slate-400 hover:text-blue-600 transition uppercase tracking-widest">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Sản phẩm đã đặt</h3>
                
                <div class="space-y-4">
                    {{-- Vòng lặp lấy từ bảng order_detail --}}
                </div>

                <div class="mt-8 pt-6 border-t space-y-3">
                    <div class="flex justify-between text-xs font-bold text-slate-500 uppercase italic">
                        <span>Phí vận chuyển (shipping_fee)</span>
                        <span>$0.00</span>
                    </div>
                    <div class="flex justify-between items-center text-blue-600 font-black">
                        <span class="uppercase text-xs tracking-widest">Tổng thanh toán</span>
                        <span class="text-2xl">$0.00</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-4 uppercase text-[10px] tracking-widest italic">Ghi chú từ khách hàng (notes)</h3>
                <div class="p-4 bg-slate-50 rounded-2xl text-sm italic text-slate-500 border border-dashed border-slate-200">
                    {{-- Hiển thị trường notes ở đây --}}
                    Không có ghi chú.
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Địa chỉ nhận hàng</h3>
                <div class="text-[11px] space-y-4 font-bold text-slate-500 italic">
                    {{-- Thông tin từ bảng address --}}
                    <p class="text-slate-800 uppercase not-italic font-black text-sm underline decoration-blue-500 underline-offset-4">Tên người nhận</p>
                    <p><i class="fa-solid fa-phone mr-2 text-blue-400"></i> Số điện thoại</p>
                    <p><i class="fa-solid fa-location-dot mr-2 text-blue-400"></i> Địa chỉ chi tiết</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 text-center">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Trạng thái đơn hàng</h3>
                <form action="#" method="POST">
                    @csrf
                    <select name="status" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-[10px] font-black uppercase tracking-widest outline-none mb-4 cursor-pointer focus:ring-2 focus:ring-blue-500 transition">
                        <option value="pending">Chờ xử lý</option>
                        <option value="shipping">Đang giao hàng</option>
                        <option value="completed">Đã hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-blue-600 active:scale-95 transition-all shadow-lg shadow-slate-200">
                        Cập nhật trạng thái
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection