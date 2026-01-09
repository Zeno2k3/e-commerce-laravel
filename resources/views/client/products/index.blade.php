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
                <div class="bg-[#f8f9fa] p-5 rounded-2xl border border-gray-100 sticky top-24">

                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-200">
                        <i class="fa-solid fa-filter text-gray-800 text-lg"></i>
                        <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">Bộ lọc</h2>
                    </div>

                    <div class="mb-8">
                        <h3 class="font-bold text-gray-900 mb-4 text-base uppercase tracking-wide">Danh mục</h3>
                        <div class="space-y-3.5">
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition">
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Nam</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition">
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Nữ</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group select-none">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#7d3cff] focus:ring-[#7d3cff] transition">
                                <span class="text-gray-600 group-hover:text-[#7d3cff] transition text-base font-medium">Phụ kiện</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-900 mb-4 text-base uppercase tracking-wide">Khoảng giá</h3>
                        <div class="relative">
                            <select class="w-full bg-white border border-gray-300 text-gray-700 py-3 pl-4 pr-10 rounded-lg focus:outline-none focus:border-[#7d3cff] focus:ring-1 focus:ring-[#7d3cff] appearance-none cursor-pointer text-sm font-medium shadow-sm hover:border-gray-400 transition">
                                <option>Tất cả</option>
                                <option>Dưới 100k</option>
                                <option>100k - 500k</option>
                                <option>Trên 500k</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-4/5 flex-1">

                <div class="flex flex-wrap items-center justify-between mb-6">
                    <span class="text-gray-500 font-medium text-sm">Hiển thị {{ count($products) }} sản phẩm</span>

                    <div class="flex items-center gap-3">
                        <div class="relative min-w-[160px]">
                            <select class="w-full appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-10 rounded-lg focus:outline-none focus:border-[#7d3cff] cursor-pointer text-sm font-medium shadow-sm hover:border-gray-400 transition">
                                <option>Mới nhất</option>
                                <option>Giá thấp đến cao</option>
                                <option>Giá cao đến thấp</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
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
