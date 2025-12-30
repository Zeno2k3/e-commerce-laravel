@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center space-x-3">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-green-600 pb-2">Đơn hàng</h2>
        <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-1 rounded font-bold italic border border-slate-200">Table: order & user</span>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
    {{-- Kiểm tra xem biến $orders từ OrderController có dữ liệu không --}}
    @if(isset($orders) && $orders->count() > 0)
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-6 py-5">Mã đơn (Order ID)</th>
                    <th class="px-6 py-5">Khách hàng</th>
                    <th class="px-6 py-5 text-center">Tổng tiền</th>
                    <th class="px-6 py-5 text-center">Trạng thái</th>
                    <th class="px-6 py-5 text-center">Ngày đặt</th>
                    <th class="px-6 py-5 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($orders as $order)
                <tr class="hover:bg-slate-50 transition duration-200">
                    <td class="px-6 py-4 font-black text-blue-600 text-xs uppercase">
                        #ORD-{{ $order->order_id }}
                    </td>
                    <td class="px-6 py-4 text-xs">
                        <div class="font-black text-slate-800 uppercase">{{ $order->full_name }}</div>
                        <div class="text-[9px] text-slate-400 italic">User ID: #{{ $order->user_id }}</div>
                    </td>
                    <td class="px-6 py-4 text-center font-black text-slate-700 italic text-xs">
    ${{ number_format($order->final_total, 2) }}
</td>
                    <td class="px-6 py-4 text-center">
                        @if($order->status == 'completed')
                            <span class="px-2 py-1 bg-green-100 text-green-600 text-[9px] font-black rounded uppercase">Hoàn thành</span>
                        @elseif($order->status == 'pending')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-600 text-[9px] font-black rounded uppercase">Chờ xử lý</span>
                        @else
                            <span class="px-2 py-1 bg-slate-100 text-slate-500 text-[9px] font-black rounded uppercase">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-[10px] font-bold text-slate-400 italic">
                        {{ date('d/m/Y H:i', strtotime($order->created_at)) }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order->order_id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition inline-block">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        {{-- Hiện thông báo này nếu database table `order` đang trống --}}
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4">
                <i class="fa-solid fa-file-invoice-dollar text-slate-200 text-3xl"></i>
            </div>
            <p class="text-slate-400 font-black italic uppercase tracking-widest text-[10px]">Chưa có đơn hàng nào được ghi nhận</p>
            <p class="text-slate-300 text-[9px] mt-1 font-bold italic uppercase">Dữ liệu lấy từ bảng `order` của database ecommerce_db</p>
        </div>
    @endif
</div>
@endsection