@extends('admin.layouts.app')
@section('title', 'Chi tiết đơn hàng #' . $order->order_id)

@section('content')
<div class="p-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Chi tiết đơn hàng #{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}</h1>
            <p class="text-gray-500 text-sm mt-1">Ngày đặt: {{ $order->created_at->format('H:i d/m/Y') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Products --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Order Items --}}
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Sản phẩm đã đặt</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 rounded-l-lg">Sản phẩm</th>
                                <th class="px-4 py-3 text-center">Đơn giá</th>
                                <th class="px-4 py-3 text-center">Số lượng</th>
                                <th class="px-4 py-3 text-right rounded-r-lg">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->orderDetails as $item)
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-white border border-gray-200 flex items-center justify-center overflow-hidden">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-box text-gray-300"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $item->product->product_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->product->sku ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-sm text-gray-600">{{ number_format($item->price) }}đ</td>
                                <td class="px-4 py-4 text-center text-sm text-gray-600">x{{ $item->quantity }}</td>
                                <td class="px-4 py-4 text-right text-sm font-bold text-gray-900">{{ number_format($item->total_price) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-t border-gray-200">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right text-sm text-gray-500">Tạm tính:</td>
                                <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">{{ number_format($order->orderDetails->sum('total_price')) }}đ</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right text-sm text-gray-500">Phí vận chuyển:</td>
                                <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">{{ number_format($order->shipping_fee) }}đ</td>
                            </tr>
                            @if($order->voucher)
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right text-sm text-gray-500">Voucher ({{ $order->voucher->code }}):</td>
                                <td class="px-4 py-3 text-right text-sm font-medium text-green-600">-{{ number_format($order->discount_amount ?? 0) }}đ</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-right text-base font-bold text-gray-900">Tổng cộng:</td>
                                <td class="px-4 py-4 text-right text-xl font-bold text-purple-600">{{ number_format($order->total_amount) }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Status History --}}
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-200">
                 <h3 class="text-lg font-bold text-gray-800 mb-4">Lịch sử trạng thái</h3>
                 <div class="relative pl-4 border-l-2 border-gray-200 space-y-6">
                    {{-- @forelse($order->statusHistory as $history)
                        <div class="relative">
                            <span class="absolute -left-[21px] top-1 w-3 h-3 rounded-full bg-purple-500 border-2 border-white"></span>
                            <p class="text-sm font-bold text-gray-900 ucfirst">{{ $history->status }}</p>
                            <p class="text-xs text-gray-500">{{ $history->created_at->format('H:i d/m/Y') }}</p>
                            @if($history->note)
                                <p class="text-sm text-gray-600 mt-1 italic">"{{ $history->note }}"</p>
                            @endif
                        </div>
                    @empty --}}
                        <p class="text-sm text-gray-500">Chưa có lịch sử trạng thái (Tính năng đang phát triển)</p>
                    {{-- @endforelse --}}
                 </div>
            </div>
        </div>

        {{-- Right Column: Customer Info --}}
        <div class="space-y-6">
            {{-- Customer --}}
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Thông tin khách hàng</h3>
                <div class="flex items-center gap-4 mb-4">
                     <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-lg">
                        {{ strtoupper(substr($order->user->full_name ?? 'U', 0, 1)) }}
                     </div>
                     <div>
                         <p class="font-bold text-gray-900">{{ $order->user->full_name ?? 'Khách lẻ' }}</p>
                         <p class="text-sm text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                     </div>
                </div>
                <div class="space-y-3 pt-4 border-t border-gray-200">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Số điện thoại</p>
                        <p class="text-sm font-medium text-gray-800">{{ $order->user->phone_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold">Địa chỉ giao hàng</p>
                        <p class="text-sm font-medium text-gray-800">{{ $order->address->specific_address ?? 'N/A' }}</p>
                    </div>
                    @if($order->note)
                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100 mt-2">
                        <p class="text-xs text-yellow-700 font-bold uppercase mb-1">Ghi chú từ khách:</p>
                        <p class="text-sm text-yellow-800 italic">"{{ $order->note }}"</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Current Status --}}
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Trạng thái hiện tại</h3>
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        'processing' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'shipping' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                    ];
                    $statusTexts = [
                        'pending' => 'Đang xử lý',
                        'processing' => 'Đang giao hàng',
                        'shipping' => 'Đang vận chuyển',
                        'completed' => 'Hoàn tất',
                        'cancelled' => 'Đã hủy',
                    ];
                @endphp
                <div class="flex items-center justify-center p-4 rounded-xl border {{ $statusColors[$order->status] ?? 'bg-gray-100 border-gray-200' }}">
                    <span class="text-lg font-bold uppercase">{{ $statusTexts[$order->status] ?? $order->status }}</span>
                </div>
                
                <div class="mt-4">
                    <button onclick="openStatusModal({{ $order->order_id }}, '{{ $order->status }}')" class="w-full py-2.5 bg-purple-600 text-white font-bold rounded-xl hover:bg-purple-700 transition shadow-sm">
                        Cập nhật trạng thái
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Update Modal (Reuse) --}}
<div id="statusModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('statusModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Cập nhật trạng thái</h3>
            </div>
            <form id="statusForm" method="POST">
                @csrf @method('PATCH')
                <div class="px-6 py-6">
                    <x-admin.select name="status" label="Trạng thái mới" :options="[
                        'pending' => 'Đang xử lý',
                        'processing' => 'Đang giao hàng',
                        'shipping' => 'Đang vận chuyển',
                        'completed' => 'Hoàn tất',
                        'cancelled' => 'Đã hủy',
                    ]" />
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-check"></i><span>Lưu</span>
                    </button>
                    <button type="button" onclick="closeModal('statusModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i><span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openStatusModal(id, currentStatus) {
        document.getElementById('statusForm').action = '/admin/orders/' + id + '/status';
        
        document.querySelector('#statusModal select[name="status"]').value = currentStatus;
        openModal('statusModal');
    }
</script>
@endsection
