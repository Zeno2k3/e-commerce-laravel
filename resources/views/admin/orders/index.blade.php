@extends('admin.layouts.app')
@section('title', 'Danh sách Đơn hàng')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách đơn hàng</h2>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Mã Đơn</th>
                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Khách hàng</th>
                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tổng tiền</th>
                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Trạng thái</th>
                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-6 py-4 font-black text-blue-600 italic text-center">#ORD-9921</td>
                <td class="px-6 py-4 font-bold text-slate-700 tracking-tighter">Trần Văn Phú</td>
                <td class="px-6 py-4 font-black text-slate-900 text-center">$240.00</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 bg-amber-100 text-amber-600 text-[10px] font-black rounded-full uppercase italic">Chờ xử lý</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.orders.show') }}" class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl font-bold text-xs hover:bg-blue-600 hover:text-white transition shadow-sm">
                        <i class="fa-solid fa-eye mr-1"></i> Xem chi tiết
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection