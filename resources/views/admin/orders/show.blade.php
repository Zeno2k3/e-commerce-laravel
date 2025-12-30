@extends('admin.layouts.app')
@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic italic">Chi tiết đơn hàng #ORD-9921</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition uppercase">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại danh sách
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Danh mục hàng hóa</h3>
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-5">
                    <img src="https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/81575850-891d-402b-a434-6019a647d7c6/air-jordan-1-retro-high-og-shoes-00WTSV.png" class="w-20 h-20 rounded-2xl object-cover border shadow-sm">
                    <div>
                        <p class="font-black text-slate-800 uppercase tracking-tighter text-sm">Nike Air Jordan 1 High Retro</p>
                        <p class="text-[10px] text-slate-400 font-bold italic uppercase tracking-widest">Số lượng: x2 | Size: 42</p>
                    </div>
                </div>
                <p class="font-black text-slate-900 text-lg">$240.00</p>
            </div>
            <div class="mt-8 pt-6 border-t bg-slate-50 p-6 rounded-2xl font-black">
                <div class="flex justify-between items-center text-blue-600">
                    <span class="uppercase text-[10px] tracking-widest">Tổng cộng thanh toán</span>
                    <span class="text-2xl">$240.00</span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Người nhận hàng</h3>
                <div class="text-[11px] space-y-3 font-bold text-slate-500 italic">
                    <p class="text-slate-800 uppercase not-italic font-black text-xs">Trần Văn Phú</p>
                    <p><i class="fa-solid fa-phone mr-2 text-blue-400"></i> 090 123 4567</p>
                    <p><i class="fa-solid fa-location-dot mr-2 text-blue-400"></i> Quận 1, TP. Hồ Chí Minh</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 text-center">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Trạng thái đơn hàng</h3>
                <select id="stt" class="w-full bg-slate-50 border-none rounded-xl p-3 text-xs font-black outline-none mb-4">
                    <option>Đang chờ xử lý</option>
                    <option>Đang giao hàng</option>
                    <option>Đã hoàn thành</option>
                </button>
                <button type="button" onclick="alert('Đã cập nhật trạng thái vào Database!')" class="w-full bg-slate-900 text-white py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition">
                    Lưu trạng thái
                </button>
            </div>
        </div>
    </div>
</div>
@endsection