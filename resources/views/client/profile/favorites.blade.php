@extends('client.layouts.app')

@section('title', 'Sản phẩm yêu thích')

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
                        <span class="text-gray-900 font-medium">Sản phẩm yêu thích</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar --}}
            <div class="lg:w-1/4">
               @include('client.profile.partials.sidebar')
            </div>

            {{-- Main Content --}}
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <i class="fa-solid fa-heart text-red-500 mr-3"></i>Sản phẩm yêu thích
                        </h1>
                        <span class="text-gray-500 text-sm bg-gray-100 px-3 py-1 rounded-full">{{ $products->total() }} sản phẩm</span>
                    </div>

                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="product-item-wrapper h-full">
                                    <x-product-card :product="$product" :removeOnUnfavorite="true" />
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                                <i class="fa-regular fa-heart text-5xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Chưa có sản phẩm yêu thích</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">Hãy thả tim các sản phẩm bạn yêu thích để lưu lại và xem lại sau này nhé!</p>
                            <a href="{{ route('client.products.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-[#7d3cff] text-white font-bold rounded-xl hover:bg-[#6c2bd9] transition-all shadow-lg shadow-purple-200 hover:shadow-purple-300 transform hover:-translate-y-1">
                                Khám phá ngay
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
