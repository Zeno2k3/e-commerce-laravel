@extends('client.layouts.app')

@section('content')



<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- PHẦN HEADER: SALE BANNER --}}
        <x-client.page-header 
            icon="fa-solid fa-percent"
            tag="Khuyến mãi lớn"
            color="red">
            <h1 class="text-4xl md:text-5xl lg:text-5xl font-black text-gray-800 mb-4 tracking-tight leading-tight uppercase">
                SALE UP TO <span class="text-[#ff424e]">36%</span>
            </h1>
            <p class="text-gray-600 text-xl mb-2 font-medium">
                Cơ hội vàng sở hữu những món đồ thời trang yêu thích với giá ưu đãi
            </p>
            <p class="text-gray-500 text-base flex items-center justify-center gap-2">
                <i class="fa-regular fa-clock"></i> Thời gian có hạn - Nhanh tay kẻo lỡ!
            </p>
        </x-client.page-header>

        {{-- PHẦN BỘ LỌC (FILTER BAR) --}}
        <x-client.sort-bar 
            title="Sản phẩm khuyến mãi"
            :count="count($products)"
            :sortOptions="['Giảm nhiều nhất', 'Giá thấp nhất', 'Tên A-Z']"
            :activeSort="0"
            color="purple" />

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Chưa có sản phẩm khuyến mãi nào</p>
                </div>
            @endforelse
        </div>

        {{-- PHÂN TRANG --}}
        <div class="flex justify-center">
            {{ $pagination->links() }}
        </div>

    </div>
</div>
@endsection
