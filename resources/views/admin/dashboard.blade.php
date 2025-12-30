@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        
        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-2xl font-black italic text-slate-800">0</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tổng đơn hàng</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-cart-shopping"></i></div>
            </div>
            <div class="text-[9px] text-gray-400 italic">Dữ liệu từ bảng: order</div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-2xl font-black italic text-slate-800">$0</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Doanh thu</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center"><i class="fa-solid fa-dollar-sign"></i></div>
            </div>
            <div class="text-[9px] text-gray-400 italic">Tổng total_price từ order_detail</div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-2xl font-black italic text-slate-800">0</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sản phẩm hiện có</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-yellow-50 text-yellow-500 flex items-center justify-center"><i class="fa-solid fa-box"></i></div>
            </div>
            <div class="text-[9px] text-gray-400 italic">Dữ liệu từ bảng: product</div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="text-2xl font-black italic text-slate-800">1</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Khách hàng</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="text-[9px] text-gray-400 italic">Dữ liệu từ bảng: user</div>
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