@extends('admin.layouts.app')
@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic">Chi tiết đơn #ORD-1245</h2>
        <span class="px-4 py-1.5 bg-amber-100 text-amber-600 rounded-xl text-xs font-black uppercase tracking-widest">Đang chờ xử lý</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Sản phẩm trong đơn</h3>
                <div class="flex items-center justify-between group">
                    <div class="flex items-center space-x-5">
                        <img src="https://via.placeholder.com/80" class="w-20 h-20 rounded-2xl object-cover border shadow-sm group-hover:scale-105 transition">
                        <div>
                            <p class="font-black text-slate-800 uppercase tracking-tighter">Nike Air Jordan 1 High</p>
                            <p class="text-xs text-slate-400 font-bold italic">Size: 42 | Số lượng: x1</p>
                        </div>
                    </div>
                    <p class="font-black text-slate-900 text-lg">$120.00</p>
                </div>
                <div class="mt-8 pt-6 border-t flex justify-between items-center bg-slate-50 p-6 rounded-2xl">
                    <span class="font-black text-slate-400 uppercase text-xs">Tổng tiền đơn hàng</span>
                    <span class="text-2xl font-black text-blue-600">$120.00</span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-sm italic border-b pb-4">Khách hàng</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-black">N</div>
                        <p class="font-black text-slate-800 text-sm tracking-tighter uppercase">Nguyễn Văn A</p>
                    </div>
                    <div class="text-xs space-y-3 font-bold text-slate-500 italic">
                        <p><i class="fa-solid fa-phone mr-2 text-blue-400"></i> 090 123 4567</p>
                        <p><i class="fa-solid fa-envelope mr-2 text-blue-400"></i> customer@example.com</p>
                        <p><i class="fa-solid fa-location-dot mr-2 text-blue-400"></i> 123 Quận 1, TP.HCM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection