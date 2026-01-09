@extends('client.layouts.app')

@section('content')


<div class="bg-white min-h-screen font-sans pb-20">
    <div class="container mx-auto px-4 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Tất cả sản phẩm</h1>
            <p class="text-gray-500 text-base">Khám phá bộ sưu tập thời trang đa dạng</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="lg:w-1/5 shrink-0">
                <form id="filterForm" method="GET" action="{{ route('client.products.index') }}" class="bg-[#f8f9fa] p-5 rounded-2xl border border-gray-100 sticky top-24">
                    {{-- Preserve Search and Sort when filtering --}}
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <input type="hidden" name="sort" value="{{ request('sort', 'newest') }}">

                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-filter text-gray-800 text-lg"></i>
                            <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">Bộ lọc</h2>
                        </div>
                        @if(request()->hasAny(['product_types', 'categories', 'price_min', 'price_max']))
                            <a href="{{ route('client.products.index') }}" class="text-xs text-red-500 hover:underline">Xóa lọc</a>
                        @endif
                    </div>

                    {{-- FILTER: Product Types --}}
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 text-base uppercase tracking-wide">Loại sản phẩm</h3>
                        <div class="space-y-3.5">
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" name="product_types[]" value="nam" 
                                       class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition"
                                       {{ in_array('nam', request('product_types', [])) ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Nam</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" name="product_types[]" value="nu" 
                                       class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition"
                                       {{ in_array('nu', request('product_types', [])) ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Nữ</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" name="product_types[]" value="phu-kien" 
                                       class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition"
                                       {{ in_array('phu-kien', request('product_types', [])) ? 'checked' : '' }}>
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Phụ kiện</span>
                            </label>
                        </div>
                    </div>

                    {{-- FILTER: Price Range --}}
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 text-base uppercase tracking-wide">Khoảng giá</h3>
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Từ" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#7d3cff] focus:ring-1 focus:ring-[#7d3cff]">
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Đến" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#7d3cff] focus:ring-1 focus:ring-[#7d3cff]">
                        </div>
                    </div>

                    {{-- FILTER: Categories --}}
                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 text-base uppercase tracking-wide">Danh mục</h3>
                        <div class="space-y-3.5 max-h-60 overflow-y-auto pr-2">
                            @foreach($categories as $cat)
                                <label class="flex items-center gap-3 cursor-pointer group select-none">
                                    <input type="checkbox" name="categories[]" value="{{ $cat['id'] }}" 
                                           class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition"
                                           {{ in_array($cat['id'], request('categories', [])) ? 'checked' : '' }}>
                                    <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">{{ $cat['name'] }} <span class="text-gray-400 text-sm">({{ $cat['count'] }})</span></span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[#7d3cff] text-white font-bold rounded-xl shadow-lg shadow-purple-200 hover:shadow-purple-300 hover:-translate-y-1 transition">
                        Áp dụng bộ lọc
                    </button>
                </form>
            </div>

            <div class="lg:w-4/5 flex-1">

                <div class="flex flex-wrap items-center justify-between mb-6">
                    <span class="text-gray-500 font-medium text-sm">Hiển thị {{ count($products) }} sản phẩm</span>

                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            {{-- Sorting Buttons --}}
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition border {{ request('sort', 'newest') == 'newest' ? 'bg-[#7d3cff] text-white border-[#7d3cff]' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                Nổi bật
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition border {{ request('sort') == 'price_asc' ? 'bg-[#7d3cff] text-white border-[#7d3cff]' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                Giá thấp
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition border {{ request('sort') == 'price_desc' ? 'bg-[#7d3cff] text-white border-[#7d3cff]' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                Giá cao
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name']) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition border {{ request('sort') == 'name' ? 'bg-[#7d3cff] text-white border-[#7d3cff]' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                Tên A-Z
                            </a>
                        </div>

                        <div class="flex bg-white rounded-lg p-1 border border-gray-200 shadow-sm">
                            <button class="bg-[#7d3cff] text-white w-8 h-8 flex items-center justify-center rounded-md shadow-sm transition">
                                <i class="fa-solid fa-border-all text-sm"></i>
                            </button>
                            <button class="text-gray-400 hover:text-gray-700 hover:bg-gray-50 w-8 h-8 flex items-center justify-center rounded-md transition">
                                <i class="fa-solid fa-list text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-full text-center py-12">
                            <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">Chưa có sản phẩm nào</p>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $pagination->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
