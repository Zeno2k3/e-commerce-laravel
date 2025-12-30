@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->order_id)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-red-500 pb-2">
            Chi tiết đơn hàng #{{ $order->order_id }}
        </h2>
        <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black text-slate-400 hover:text-blue-600 transition uppercase tracking-widest">
            <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Sản phẩm đã đặt</h3>
                
                <div class="space-y-4">
                    @foreach($orderDetails as $item)
                    <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-slate-400">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <div>
                                <p class="font-black text-xs uppercase text-slate-800">{{ $item->product_name }}</p>
                                <p class="text-[9px] text-slate-400 font-bold italic uppercase">
                                    Màu: {{ $item->color }} | Size: {{ $item->size }} | SL: {{ $item->quantity }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-slate-700">${{ number_format($item->unit_price, 2) }}</p>
                            <p class="text-[10px] font-bold text-blue-600 italic">Tổng: ${{ number_format($item->total_price, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t space-y-3">
                    <div class="flex justify-between text-xs font-bold text-slate-500 uppercase italic">
                        <span>Phí vận chuyển (shipping_fee)</span>
                        <span>${{ number_format($order->shipping_fee ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-blue-600 font-black">
                        <span class="uppercase text-xs tracking-widest">Tổng thanh toán</span>
                        {{-- Tính tổng từ order_detail nếu bảng order chưa có cột tổng --}}
                        <span class="text-2xl">${{ number_format($orderDetails->sum('total_price') + ($order->shipping_fee ?? 0), 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-4 uppercase text-[10px] tracking-widest italic">Ghi chú từ khách hàng (notes)</h3>
                <div class="p-4 bg-slate-50 rounded-2xl text-sm italic text-slate-500 border border-dashed border-slate-200">
                    {{ $order->notes ?? 'Không có ghi chú từ khách hàng.' }}
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Địa chỉ nhận hàng</h3>
                <div class="text-[11px] space-y-4 font-bold text-slate-500 italic">
                    {{-- Dữ liệu lấy từ bảng user và thông tin liên quan trong bảng order --}}
                    <p class="text-slate-800 uppercase not-italic font-black text-sm underline decoration-blue-500 underline-offset-4">
                        {{ $order->full_name }}
                    </p>
                    <p><i class="fa-solid fa-envelope mr-2 text-blue-400"></i> {{ $order->email }}</p>
                    <p><i class="fa-solid fa-phone mr-2 text-blue-400"></i> {{ $order->phone ?? 'Chưa cập nhật số' }}</p>
                    <p><i class="fa-solid fa-location-dot mr-2 text-blue-400"></i> {{ $order->address_detail ?? 'Chưa có địa chỉ chi tiết' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 text-center">
                <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest">Trạng thái đơn hàng</h3>
                {{-- Route xử lý cập nhật trạng thái sẽ cần được định nghĩa sau --}}
                <form action="#" method="POST">
                    @csrf
                    <select name="status" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-[10px] font-black uppercase tracking-widest outline-none mb-4 cursor-pointer focus:ring-2 focus:ring-blue-500 transition">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
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