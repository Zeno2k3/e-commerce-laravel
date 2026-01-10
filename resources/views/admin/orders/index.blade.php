@extends('admin.layouts.app')
@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Quản lý đơn hàng</h1>
        <p class="text-gray-500 text-sm">Xử lý đơn hàng và đơn lỗi</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 bg-white">
            <h2 class="font-bold text-gray-900">Danh sách đơn hàng</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Mã đơn</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Khách hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Thời gian</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Số SP</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Tổng tiền</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Vấn đề</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Chi tiết</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">ORD-{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $order->user->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $order->orderDetails->count() ?? 0 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                            @php
                                $displayTotal = $order->total_amount > 0 
                                    ? $order->total_amount 
                                    : ($order->orderDetails->sum('total_price') + ($order->shipping_fee ?? 0));
                            @endphp
                            {{ number_format($displayTotal) }}đ
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'shipping' => 'bg-purple-100 text-purple-700',
                                    'completed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                                $statusTexts = [
                                    'pending' => 'Đang xử lý',
                                    'processing' => 'Đang giao hàng',
                                    'shipping' => 'Đang vận chuyển',
                                    'completed' => 'Hoàn tất',
                                    'cancelled' => 'Bị lỗi',
                                ];
                            @endphp
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $statusTexts[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($order->status === 'cancelled')
                                <div class="flex items-center justify-center gap-1 text-red-500 font-medium">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <span>Lỗi</span>
                                </div>
                            @else
                                <div class="flex items-center justify-center gap-1 text-green-500 font-medium">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Tốt</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.orders.show', $order->order_id) }}" 
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-gray-600 text-xs font-bold rounded-lg hover:bg-purple-50 hover:text-purple-600 transition border border-gray-200">
                                <i class="fa-solid fa-eye"></i> Xem
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">Chưa có đơn hàng nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-white">{{ $orders->links() }}</div>
        @endif
    </div>
</div>

{{-- Status Update Modal --}}
<div id="statusModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('statusModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Cập nhật trạng thái đơn hàng</h3>
            </div>
            <form id="statusForm" method="POST">
                @csrf @method('PATCH')
                <div class="px-6 py-6">
                    <x-admin.select name="order_status" label="Trạng thái" :options="[
                        'pending' => 'Đang xử lý',
                        'processing' => 'Đang giao hàng',
                        'shipping' => 'Đang vận chuyển',
                        'completed' => 'Hoàn tất',
                        'cancelled' => 'Đã hủy',
                    ]" />
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-check"></i><span>Cập nhật</span>
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
        document.querySelector('#statusModal select[name="order_status"]').value = currentStatus;
        openModal('statusModal');
    }
</script>
@endsection
