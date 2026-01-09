@extends('client.layouts.app')

@section('content')



<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-12">

        {{-- HEADER --}}
        <x-client.page-header 
            icon="fa-solid fa-gem"
            tag="Phụ kiện"
            title="Hoàn Thiện"
            highlight="Phong Cách"
            description="Bộ sưu tập phụ kiện cao cấp để tôn lên vẻ đẹp và cá tính riêng của bạn."
            color="amber" />

        {{-- CATEGORY FILTER --}}
        <x-client.category-filter 
            :categories="$categories" 
            activeCategory="all"
            color="amber" />

        {{-- SORT BAR --}}
        <x-client.sort-bar 
            title="Phụ kiện thời trang"
            :count="count($products)"
            :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao', 'Tên A-Z']"
            :activeSort="0"
            color="amber" />

        {{-- GRID SẢN PHẨM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mb-12">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Chưa có sản phẩm nào</p>
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
