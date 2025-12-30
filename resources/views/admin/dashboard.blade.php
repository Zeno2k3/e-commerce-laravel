@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-black italic tracking-tighter text-slate-800">1,245</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tổng đơn hàng</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-500 shadow-sm">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-500 font-black text-[10px] uppercase tracking-widest hover:text-blue-700 active:scale-95 transition-all">
                Xem chi tiết <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                 <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-black italic tracking-tighter text-slate-800">$54,300</div>
                        <span class="p-1 rounded bg-green-100 text-green-600 text-[10px] font-black leading-none ml-2">+12%</span>
                    </div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Doanh thu (Table: payment)</div>
                </div>
                 <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-50 text-green-500 shadow-sm">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
             <a href="javascript:void(0)" onclick="alert('Tính năng báo cáo đang được cập nhật!')" class="inline-flex items-center text-green-600 font-black text-[10px] uppercase tracking-widest hover:text-green-700 active:scale-95 transition-all">
                Xem báo cáo <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-black italic tracking-tighter text-slate-800">2,150</div>
                         <span class="p-1 rounded bg-red-100 text-red-600 text-[10px] font-black leading-none ml-2">-2%</span>
                    </div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sản phẩm hiện có</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-50 text-yellow-500 shadow-sm">
                   <i class="fa-solid fa-box"></i>
                </div>
            </div>
             <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-yellow-600 font-black text-[10px] uppercase tracking-widest hover:text-yellow-700 active:scale-95 transition-all">
                Quản lý kho <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-black italic tracking-tighter text-slate-800">15,300</div>
                    </div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Khách hàng (Table: user)</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 shadow-sm">
                  <i class="fa-solid fa-users"></i>
                </div>
            </div>
             <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center text-indigo-600 font-black text-[10px] uppercase tracking-widest hover:text-indigo-700 active:scale-95 transition-all">
                Xem khách hàng <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-2xl">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-black text-slate-700 uppercase text-xs italic tracking-widest">Thống kê doanh thu</div>
            </div>
            <div class="h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-2xl">
             <div class="flex justify-between mb-4 items-start">
                <div class="font-black text-slate-700 uppercase text-xs italic tracking-widest">Đơn hàng theo tháng</div>
            </div>
             <div class="h-[300px]">
                 <canvas id="orderChart"></canvas>
            </div>
        </div>
    </div>
@endsection