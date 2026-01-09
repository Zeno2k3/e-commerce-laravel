@extends('client.layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-purple-600 transition-colors">
                        <i class="fa-solid fa-house mr-2"></i>Trang chủ
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right mx-2 text-gray-400"></i>
                        <a href="{{ route('client.profile.index') }}" class="hover:text-purple-600 transition-colors">Tài khoản</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-gray-900 font-medium">Lịch sử đơn hàng</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar --}}
            <div class="lg:w-1/4">
               @include('client.profile.partials.sidebar')
               
               {{-- Quay lại nút (Optional, nếu muốn nút back riêng biệt) --}}
               <a href="{{ route('client.profile.index') }}" class="mt-4 block w-full text-center py-3 border border-gray-200 rounded-xl text-gray-600 hover:bg-white hover:border-gray-300 hover:text-[#7d3cff] transition font-bold bg-white lg:hidden">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại hồ sơ
               </a>
            </div>

            {{-- Main Content --}}
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <i class="fa-solid fa-box-open text-[#7d3cff] mr-3"></i>Đơn hàng của tôi
                        </h1>
                        <span class="text-gray-500 text-sm bg-gray-100 px-3 py-1 rounded-full">{{ $orders->total() }} đơn hàng</span>
                    </div>

                    @if($orders->count() > 0)
                        <div class="space-y-6">
                            @foreach($orders as $order)
                                <div class="border border-gray-100 rounded-xl p-6 hover:shadow-md transition-shadow bg-white">
                                    {{-- Order Header --}}
                                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4 pb-4 border-b border-dashed border-gray-100">
                                        <div>
                                            <span class="text-sm text-gray-500">Mã đơn hàng:</span>
                                            <span class="font-bold text-gray-900 ml-1">#{{ $order->order_id }}</span>
                                            <span class="mx-2 text-gray-300">|</span>
                                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-50 text-yellow-700',
                                                    'processing' => 'bg-blue-50 text-blue-700',
                                                    'shipped' => 'bg-purple-50 text-purple-700',
                                                    'delivered' => 'bg-green-50 text-green-700',
                                                    'cancelled' => 'bg-red-50 text-red-700',
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Chờ xử lý',
                                                    'processing' => 'Đang xử lý',
                                                    'shipped' => 'Đang giao hàng',
                                                    'delivered' => 'Giao hàng thành công',
                                                    'cancelled' => 'Đã hủy',
                                                ];
                                                $status = strtolower($order->status); // Ensure lowercase for matching
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$status] ?? 'bg-gray-50 text-gray-700' }}">
                                                {{ $statusLabels[$status] ?? $order->status }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Order Items (Show first 2 items) --}}
                                    <div class="space-y-4">
                                        @foreach($order->orderDetails->take(2) as $detail)
                                            <div class="flex items-start gap-4">
                                                 <div class="w-16 h-16 rounded-lg border border-gray-100 overflow-hidden shrink-0">
                                                    @if($detail->variant && $detail->variant->url_image)
                                                        <img src="{{ asset($detail->variant->url_image) }}" alt="Product Image" class="w-full h-full object-cover">
                                                    @else
                                                        <img src="{{ asset('images/no-image.png') }}" class="w-full h-full object-cover">
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-800 text-sm line-clamp-1">
                                                        {{ $detail->variant->product->product_name ?? 'Sản phẩm đã xóa' }}
                                                    </h4>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ $detail->variant->color }} / {{ $detail->variant->size }} x {{ $detail->quantity }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="font-bold text-[#7d3cff]">{{ number_format($detail->unit_price, 0, ',', '.') }}₫</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderDetails->count() > 2)
                                            <p class="text-xs text-gray-400 text-center italic">...và {{ $order->orderDetails->count() - 2 }} sản phẩm khác</p>
                                        @endif
                                    </div>

                                    {{-- Order Footer --}}
                                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                        <div>
                                            <span class="text-sm text-gray-500">Tổng tiền:</span>
                                            <span class="text-lg font-bold text-[#7d3cff] ml-2">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
                                        </div>
                                        {{-- 
                                        <a href="#" class="px-4 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 text-sm font-bold transition">
                                            Xem chi tiết
                                        </a>
                                        --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-8">
                            {{ $orders->links() }}
                        </div>

                    @else
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                                <i class="fa-solid fa-box-open text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Bạn chưa có đơn hàng nào</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">Hãy khám phá các sản phẩm tuyệt vời của chúng tôi và đặt hàng ngay hôm nay!</p>
                            <a href="{{ route('client.products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#7d3cff] text-white font-bold rounded-xl hover:bg-[#6c2bd9] transition-all shadow-lg shadow-purple-200 hover:shadow-purple-300 transform hover:-translate-y-1">
                                Mua sắm ngay
                            </a>
                        </div>
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
