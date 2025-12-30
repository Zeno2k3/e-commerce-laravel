@extends('admin.layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter">Chi tiết đơn hàng #ORD-9921</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition uppercase">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại danh sách
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Danh mục hàng hóa</h3>
                <div class="flex items-center justify-between group py-4">
                    <div class="flex items-center space-x-5">
                        <img src="https://via.placeholder.com/80" class="w-20 h-20 rounded-2xl object-cover border shadow-sm group-hover:scale-105 transition">
                        <div>
                            <p class="font-black text-slate-800 uppercase tracking-tighter text-sm">Nike Air Jordan 1 High Retro</p>
                            <p class="text-[10px] text-slate-400 font-bold italic uppercase">Số lượng: x2 | Size: 42</p>
                        </div>
                    </div>
                    <p class="font-black text-slate-900 text-lg">$240.00</p>
                </div>
                
                <div class="mt-8 pt-6 border-t space-y-3 bg-slate-50 p-6 rounded-2xl font-bold text-sm">
                    <div class="flex justify-between text-slate-500">
                        <span>Tạm tính</span>
                        <span>$240.00</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Phí vận chuyển</span>
                        <span>Miễn phí</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-slate-200">
                        <span class="font-black text-slate-400 uppercase text-[10px] tracking-widest">Tổng cộng thanh toán</span>
                        <span class="text-2xl font-black text-blue-600">$240.00</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Người nhận hàng</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 border-b pb-4">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-black text-xs">AD</div>
                        <p class="font-black text-slate-800 text-xs tracking-tighter uppercase">Trần Văn Phú</p>
                    </div>
                    <div class="text-[11px] space-y-3 font-bold text-slate-500 italic">
                        <p><i class="fa-solid fa-phone mr-2 text-blue-400"></i> 090 123 4567</p>
                        <p><i class="fa-solid fa-location-dot mr-2 text-blue-400"></i> Quận 1, TP. Hồ Chí Minh</p>
                        <p><i class="fa-solid fa-envelope mr-2 text-blue-400"></i> phu.master@luxe.com</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Cập nhật đơn hàng</h3>
                <div class="space-y-4">
                    <select class="w-full bg-slate-50 border-none rounded-xl p-3 text-xs font-bold outline-none focus:ring-2 focus:ring-blue-500/20">
                        <option selected italic>Đang chờ xử lý</option>
                        <option italic>Đã xác nhận</option>
                        <option italic>Đang giao hàng</option>
                        <option italic>Đã hoàn thành</option>
                        <option italic>Đã hủy</option>
                    </select>
                    <button class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition shadow-lg shadow-slate-900/20">
                        Lưu trạng thái
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection