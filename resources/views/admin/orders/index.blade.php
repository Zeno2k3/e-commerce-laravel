@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-blue-600 pb-2">
            Danh sách đơn hàng
        </h2>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-6 py-5">Mã đơn (order_id)</th>
                    <th class="px-6 py-5">Khách hàng (user_id)</th>
                    <th class="px-6 py-5 text-center">Tổng tiền</th>
                    <th class="px-6 py-5 text-center">Trạng thái (status)</th>
                    <th class="px-6 py-5 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-bold text-sm text-slate-700">
                {{-- Mày sẽ dùng vòng lặp @foreach($orders as $order) ở đây --}}
                {{-- Dữ liệu sẽ trống cho đến khi mày kết nối Database --}}
            </tbody>
        </table>
        
        {{-- Hiển thị thông báo nếu chưa có đơn hàng --}}
        <div class="p-20 text-center">
            <i class="fa-solid fa-box-open text-slate-200 text-6xl mb-4"></i>
            <p class="text-slate-400 font-bold italic uppercase tracking-widest text-xs">Chưa có dữ liệu đơn hàng trong Database</p>
        </div>
    </div>
</div>
@endsection