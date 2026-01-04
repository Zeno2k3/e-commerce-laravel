@extends('client.layouts.app')

@section('content')
<div class="bg-white min-h-[60vh] flex items-center justify-center">
    <div class="text-center">
        {{-- Icon & Tiêu đề --}}
        <div class="mb-4">
            <h1 class="text-4xl font-bold text-gray-800">
                Đặt hàng <span class="text-[#7d3cff]">Thành công</span>
                <i class="fa-regular fa-face-smile text-[#7d3cff] ml-2"></i>
            </h1>
        </div>

        {{-- Dòng thông báo --}}
        <p class="text-gray-600 text-lg font-medium mb-6">
            Bạn đã đặt hàng thành công
        </p>

        {{-- Mã đơn hàng --}}
        <div class="text-xl text-gray-800">
            Mã đơn hàng của bạn là :
            {{-- Hiển thị mã đơn hàng nếu có, hoặc để trống --}}
            <span class="font-bold text-black">{{ $orderId ?? '.....' }}</span>
        </div>

        {{-- Nút quay về (Thêm vào cho UX tốt hơn) --}}
        <div class="mt-10">
            <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 rounded-full bg-[#7d3cff] text-white font-bold hover:bg-[#6c2bd9] transition shadow-lg shadow-purple-200">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
@endsection
