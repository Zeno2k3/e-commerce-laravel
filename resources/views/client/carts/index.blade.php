@extends('client.layouts.app')

@section('content')
<div class="min-h-[80vh] flex flex-col items-center justify-center bg-white px-4">

    <div class="mb-8 text-gray-300 opacity-90">
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.2"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="w-48 h-48"> <path d="M16 10a4 4 0 0 1-8 0" />
            <rect x="5" y="10" width="14" height="11" rx="2" />
        </svg>
    </div>

    <h1 class="text-5xl md:text-6xl font-black text-gray-800 mb-4 text-center tracking-tight">
        Giỏ hàng đang trống
    </h1>

    <p class="text-gray-500 text-lg md:text-xl mb-12 text-center">
        Có vẻ như bạn chưa thêm sản phẩm nào.
    </p>

    <a href="{{ route('client.products.index') }}" class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white text-xl md:text-2xl font-bold py-4 px-16 rounded-full shadow-lg hover:shadow-purple-300 transition-all duration-300 transform hover:-translate-y-1">
        Tiếp tục mua sắm
    </a>

</div>
@endsection
