@extends('admin.layouts.app')
@section('title', 'Đơn hàng lỗi')

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-4">
        <div class="flex items-center gap-2 text-red-600">
            <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            <h2 class="text-lg font-bold">Đơn hàng cần xử lý</h2>
        </div>
        <p class="text-gray-500 text-sm">Đơn hàng đã hủy hoặc chờ xử lý quá 24 giờ</p>
    </div>

    @if($orders->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Mã ĐH</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Khách hàng</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Ngày đặt</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Trạng thái</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Vấn đề</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">#{{ $order->order_id }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $order->user->full_name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500">{{ $order->user->email ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'cancelled' => 'bg-red-100 text-red-600',
                                    ];
                                @endphp
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $order->status === 'pending' ? 'Chờ xử lý' : 'Đã hủy' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-red-600">
                                @if($order->status === 'cancelled')
                                    Đơn hàng đã bị hủy
                                @else
                                    Chờ quá lâu ({{ $order->created_at->diffForHumans() }})
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="tel:{{ $order->user->phone_number ?? '' }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 mr-2">
                                    <i class="fa-solid fa-phone"></i>
                                    Liên hệ
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
            <div class="mt-6 flex justify-center">{{ $orders->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center bg-white rounded-2xl">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                <i class="fa-solid fa-check text-3xl text-green-500"></i>
            </div>
            <p class="text-gray-500 font-medium">Không có đơn hàng lỗi nào!</p>
        </div>
    @endif
</div>
@endsection
