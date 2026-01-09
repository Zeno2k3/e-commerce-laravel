@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-500 text-sm mt-1">Tổng quan hoạt động kinh doanh</p>
            </div>
            <div class="text-sm text-gray-500">
                Hôm nay: {{ date('d/m/Y') }}
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Revenue --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Doanh thu</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalRevenue) }}đ</h3>
                    </div>
                    <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                        <i class="fa-solid fa-sack-dollar text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs text-gray-500">
                    <span class="text-green-500 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>Completed</span>
                    </span>
                    <span class="mx-1">•</span>
                    <span>Tổng doanh thu</span>
                </div>
            </div>

            {{-- Orders --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Đơn hàng</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalOrders) }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs text-gray-500">
                    <span class="text-blue-500 font-medium">Total Order</span>
                </div>
            </div>

            {{-- Products --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Sản phẩm</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalProducts) }}</h3>
                    </div>
                    <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl">
                        <i class="fa-solid fa-box text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs text-gray-500">
                    <span class="text-yellow-500 font-medium">Available</span>
                </div>
            </div>

            {{-- Customers --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Khách hàng</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div class="p-3 bg-pink-50 text-pink-600 rounded-xl">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center text-xs text-gray-500">
                    <span class="text-pink-500 font-medium">Total User</span>
                </div>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Đơn hàng gần đây</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">Xem tất cả</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-gray-500 uppercase border-b border-gray-100">
                            <th class="px-4 py-3 font-semibold">Mã đơn</th>
                            <th class="px-4 py-3 font-semibold">Khách hàng</th>
                            <th class="px-4 py-3 font-semibold">Ngày đặt</th>
                            <th class="px-4 py-3 font-semibold text-right">Tổng tiền</th>
                            <th class="px-4 py-3 font-semibold text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4">
                                <span class="font-medium text-gray-900">#{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                        {{ strtoupper(substr($order->user->full_name ?? 'G', 0, 1)) }}
                                    </div>
                                    <span class="text-sm text-gray-700">{{ $order->user->full_name ?? 'Khách lẻ' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-4 text-right font-medium text-gray-900">
                                {{ number_format($order->total_amount) }}đ
                            </td>
                            <td class="px-4 py-4 text-center">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'shipping' => 'bg-purple-100 text-purple-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                    $statusTexts = [
                                        'pending' => 'Chờ xử lý',
                                        'processing' => 'Đang xử lý',
                                        'shipping' => 'Đang giao',
                                        'completed' => 'Hoàn tất',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $statusTexts[$order->status] ?? $order->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">Chưa có đơn hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
