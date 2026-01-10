@extends('admin.layouts.app')
@section('title', 'Danh mục sản phẩm')

@section('content')
<div class="flex h-full">
    {{-- Main Content - Product Grid --}}
    <div class="flex-1 p-6 overflow-y-auto">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Toolbar --}}
        <div class="flex items-center gap-3 mb-6">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center gap-3" id="sortForm">
                {{-- Preserve other filters --}}
                @if(request('categories'))
                    @foreach(request('categories') as $cat)
                        <input type="hidden" name="categories[]" value="{{ $cat }}">
                    @endforeach
                @endif
                @if(request('product_types'))
                    @foreach(request('product_types') as $type)
                        <input type="hidden" name="product_types[]" value="{{ $type }}">
                    @endforeach
                @endif
                @if(request('price_min'))<input type="hidden" name="price_min" value="{{ request('price_min') }}">@endif
                @if(request('price_max'))<input type="hidden" name="price_max" value="{{ request('price_max') }}">@endif
                @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                
                <div class="relative flex items-center">
                    <select name="sort" onchange="this.form.submit()" class="appearance-none bg-white border border-gray-200 rounded-lg px-4 py-2 pr-8 text-sm font-medium text-gray-700 focus:outline-none focus:border-purple-400">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </form>
            <div class="flex bg-purple-50 rounded-lg p-1">
                <button id="gridViewBtn" class="p-2.5 bg-white text-purple-600 rounded-lg shadow-sm"><i class="fa-solid fa-grip"></i></button>
                <button id="listViewBtn" class="p-2.5 text-purple-400 hover:text-purple-600 rounded-lg"><i class="fa-solid fa-list"></i></button>
            </div>
            
            @if(request()->hasAny(['categories', 'product_types', 'price_min', 'price_max', 'search']))
                <a href="{{ route('admin.categories.index') }}" class="text-sm text-purple-600 hover:underline">
                    <i class="fa-solid fa-times mr-1"></i>Xóa bộ lọc
                </a>
            @endif
        </div>

        {{-- Product Grid --}}
        <div id="productGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="product-card bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                    <div class="relative aspect-square bg-gray-100">
                        @if($product->discount_percentage ?? false)
                            <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $product->discount_percentage }}%</span>
                        @endif
                        @php
                            $image = $product->variants->first()?->url_image;
                        @endphp
                        @if($image)
                            <img src="{{ asset($image) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-image text-4xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $product->product_name }}</h3>
                        <div class="flex items-center gap-1 text-yellow-400 text-sm mb-2">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star {{ $i < 4 ? '' : 'text-gray-300' }}"></i>
                            @endfor
                            <span class="text-gray-500 ml-1">(69)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            @php
                                $price = $product->variants->first()?->price ?? 0;
                            @endphp
                            <span class="text-purple-600 font-bold">{{ number_format($price) }}đ</span>
                        </div>
                        <button onclick="openCategoryModal({{ $product->product_id }}, '{{ $product->category_id ?? '' }}')" 
                                class="w-full py-2 bg-purple-500 text-white text-sm font-semibold rounded-lg hover:bg-purple-600 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-pen-to-square"></i> Thay đổi danh mục
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-24 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                        <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Không tìm thấy sản phẩm nào</p>
                </div>
            @endforelse
        </div>
        
        @if($products->hasPages())
            <div class="mt-6 flex justify-center">{{ $products->links() }}</div>
        @endif
    </div>

    {{-- Right Sidebar - Filter Form --}}
    <div class="w-64 bg-white border-l border-gray-200 hidden lg:flex flex-col">
        <form method="GET" action="{{ route('admin.categories.index') }}" id="filterForm">
            {{-- Preserve sort --}}
            <input type="hidden" name="sort" value="{{ request('sort', 'newest') }}">
            
            {{-- SECTION 1: Bộ lọc (Filter) --}}
            <div class="p-5 border-b border-gray-100">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-filter text-gray-400"></i>
                    <span class="font-bold text-gray-900">Bộ lọc</span>
                </div>

                {{-- Loại sản phẩm filter --}}
                <h4 class="font-semibold text-gray-700 mb-2 text-sm">Loại sản phẩm</h4>
                <div class="space-y-2 mb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="product_types[]" value="nam" 
                               class="w-4 h-4 rounded border-purple-300 text-purple-600"
                               {{ in_array('nam', request('product_types', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-600">Nam</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="product_types[]" value="nu" 
                               class="w-4 h-4 rounded border-purple-300 text-purple-600"
                               {{ in_array('nu', request('product_types', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-600">Nữ</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="product_types[]" value="phu-kien" 
                               class="w-4 h-4 rounded border-purple-300 text-purple-600"
                               {{ in_array('phu-kien', request('product_types', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-600">Phụ kiện</span>
                    </label>
                </div>

                {{-- Khoảng giá --}}
                <h4 class="font-semibold text-gray-700 mb-2 text-sm">Khoảng giá</h4>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Từ" 
                           class="w-full px-2 py-1.5 border border-gray-200 rounded text-sm focus:outline-none focus:border-purple-400">
                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Đến" 
                           class="w-full px-2 py-1.5 border border-gray-200 rounded text-sm focus:outline-none focus:border-purple-400">
                </div>
            </div>

            {{-- SECTION 2: Quản lý Danh mục --}}
            <div class="flex-1 p-5 flex flex-col overflow-hidden">
                {{-- Search --}}
                <div class="flex items-center gap-2 mb-4 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm" 
                           class="flex-1 bg-transparent text-sm focus:outline-none">
                </div>

                {{-- Category List --}}
                <h4 class="font-bold text-gray-900 mb-3">Tất cả danh mục</h4>
                <div class="flex-1 overflow-y-auto space-y-2 mb-4 max-h-48">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $category->category_id }}" 
                                   class="w-4 h-4 rounded border-purple-300 text-purple-600"
                                   {{ in_array($category->category_id, request('categories', [])) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-600">{{ $category->category_name }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Add Category Button --}}
                <button type="button" onclick="openModal('createCategoryModal')" class="w-full py-2 mb-3 bg-purple-100 text-purple-600 text-sm font-semibold rounded-lg hover:bg-purple-200 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm danh mục</span>
                </button>

                {{-- Filter Button --}}
                <button type="submit" class="w-full py-2.5 bg-purple-500 text-white text-sm font-semibold rounded-lg hover:bg-purple-600 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i>
                    <span>Áp dụng bộ lọc</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Create Category Modal --}}
<x-admin.form-modal id="createCategoryModal" title="Thêm danh mục mới" action="{{ route('admin.categories.store') }}" method="POST">
    <x-admin.input name="category_name" label="Tên danh mục" placeholder="Nhập tên danh mục" required />
    <x-admin.input name="description" label="Mô tả" placeholder="Nhập mô tả (tùy chọn)" />
</x-admin.form-modal>

{{-- Change Category Modal --}}
<div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('categoryModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Thay đổi danh mục</h3>
            </div>
            <form id="categoryForm" method="POST">
                @csrf @method('PATCH')
                <div class="px-6 py-6">
                    <x-admin.select name="category_id" label="Chọn danh mục" :options="$categories->pluck('category_name', 'category_id')->toArray()" />
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-check"></i><span>Cập nhật</span>
                    </button>
                    <button type="button" onclick="closeModal('categoryModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i><span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCategoryModal(productId, currentCategoryId) {
        document.getElementById('categoryForm').action = '/admin/products/' + productId + '/category';
        if(currentCategoryId) {
            document.querySelector('#categoryModal select[name="category_id"]').value = currentCategoryId;
        }
        openModal('categoryModal');
    }

    // View toggle
    document.getElementById('gridViewBtn').addEventListener('click', function() {
        document.getElementById('productGrid').className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
        this.classList.add('bg-white', 'shadow-sm');
        document.getElementById('listViewBtn').classList.remove('bg-white', 'shadow-sm');
    });
    
    document.getElementById('listViewBtn').addEventListener('click', function() {
        document.getElementById('productGrid').className = 'grid grid-cols-1 gap-4';
        this.classList.add('bg-white', 'shadow-sm');
        document.getElementById('gridViewBtn').classList.remove('bg-white', 'shadow-sm');
    });
</script>
@endsection
