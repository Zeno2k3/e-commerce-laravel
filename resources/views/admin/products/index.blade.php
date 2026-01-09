@extends('admin.layouts.app')
@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4 flex-1">
            <div class="relative w-full max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm shadow-sm" placeholder="Tìm kiếm theo mã hoặc tên...">
            </div>
            <button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition shadow-sm text-sm whitespace-nowrap">
                <i class="fa-solid fa-plus"></i>
                <span>Thêm sản phẩm</span>
            </button>
        </div>
        <div>
            <select class="block w-40 pl-3 pr-10 py-2.5 text-base border-gray-200 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-xl shadow-sm bg-white">
                <option>Tất cả</option>
                <option>Đang hoạt động</option>
                <option>Ngưng hoạt động</option>
            </select>
        </div>
    </div>

    <div class="bg-white min-h-full rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 m-6 mb-0">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-bold text-gray-900 text-lg">Danh sách sản phẩm</h2>
            <p class="text-sm text-gray-500">Quản lý thông tin sản phẩm</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="w-10 px-6 py-4 text-center"></th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tên sản phẩm</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Danh mục</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Giá bán</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Màu</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Biến thể</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition group">
                        <td class="px-6 py-4 text-center cursor-pointer" onclick="toggleDetail({{ $product->product_id }})">
                            <i id="icon-{{ $product->product_id }}" class="fa-solid fa-chevron-down text-gray-400 transition-transform"></i>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                    @php
                                        $firstVariant = $product->variants->first();
                                        $image = $firstVariant?->url_image;
                                    @endphp
                                    @if($image)
                                        <img src="{{ asset($image) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-image text-gray-400"></i>
                                    @endif
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $product->product_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $product->category->category_name ?? 'Chưa phân loại' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium text-center">{{ number_format($firstVariant?->price ?? 0) }} đ</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $firstVariant?->color ?? '--' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($product->variants->count() > 0)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">{{ $product->variants->count() }} biến thể</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">Chưa có</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="toggleDetail({{ $product->product_id }})" class="p-2 text-gray-400 hover:text-purple-600 transition rounded-lg hover:bg-purple-50" title="Xem chi tiết">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button onclick='openEditModal({{ $product->product_id }}, @json($product->product_name), @json($product->description ?? ""), "{{ $product->category_id }}")' 
                                        class="p-2 text-gray-400 hover:text-blue-600 transition rounded-lg hover:bg-blue-50" title="Chỉnh sửa">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="deleteItem({{ $product->product_id }})" class="p-2 text-gray-400 hover:text-red-600 transition rounded-lg hover:bg-red-50" title="Xóa">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr id="detail-{{ $product->product_id }}" class="hidden bg-gray-50/50">
                        <td colspan="7" class="px-6 py-4">
                            <div class="pl-14">
                                <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Mô tả:</span> {{ $product->description ?? 'Chưa có mô tả' }}</p>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">Chưa có sản phẩm nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm sản phẩm mới" action="{{ route('admin.products.store') }}" method="POST">
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="product_name" label="Tên sản phẩm" placeholder="Nhập tên sản phẩm" required />
        <x-admin.select name="category_id" label="Danh mục" :options="$categories->pluck('category_name', 'category_id')->toArray()" />
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <x-admin.input name="selling_price" label="Giá bán" type="number" placeholder="0" required />
        <x-admin.input name="color" label="Màu sắc" placeholder="Ví dụ: Đen, Trắng..." />
    </div>
    <div class="mt-4">
        <x-admin.textarea name="description" label="Mô tả" placeholder="Nhập mô tả sản phẩm..." rows="3" />
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
        {{-- Image input placeholder --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh</label>
            <input type="file" name="images[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"/>
        </div>
    </div>
</x-admin.form-modal>

{{-- EDIT MODAL - FULL FEATURED --}}
<div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden overflow-y-auto">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="relative bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl w-full max-w-6xl border border-gray-200 animate-slideIn">
            <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6 rounded-t-3xl border-b border-blue-500/20 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-edit text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Chỉnh Sửa Sản Phẩm</h2>
                            <p class="text-blue-200 text-sm font-medium">Cập nhật thông tin & biến thể</p>
                        </div>
                    </div>
                    <button onclick="closeEditModal()" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <i class="fa-solid fa-times text-white text-xl"></i>
                    </button>
                </div>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="px-6 py-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="product_name" id="edit_product_name" label="Tên sản phẩm" required />
                        <x-admin.select name="category_id" id="edit_category_id" label="Danh mục" :options="$categories->pluck('category_name', 'category_id')->toArray()" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="selling_price" id="edit_selling_price" label="Giá bán" type="number" required />
                        <x-admin.input name="color" id="edit_color" label="Màu sắc" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                        <textarea name="description" id="edit_description" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.select name="status" id="edit_status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cập nhật ảnh</label>
                            <input type="file" name="images[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"/>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-floppy-disk"></i><span>Lưu thay đổi</span>
                    </button>
                    <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg transition">
                        <i class="fa-solid fa-save mr-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">@csrf @method('DELETE')</form>

<style>
@keyframes slideIn {
    from { opacity: 0; transform: scale(0.95) translateY(-20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.animate-slideIn { animation: slideIn 0.3s ease-out; }
</style>

<script>
    function openEditModal(id, name, description, categoryId, price, color, status) {
        document.getElementById('editForm').action = '/admin/products/' + id;
        document.getElementById('edit_product_name').value = name;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_selling_price').value = price;
        document.getElementById('edit_color').value = color || '';
        document.getElementById('edit_status').value = status;
        if(categoryId) document.getElementById('edit_category_id').value = categoryId;
        openModal('editModal');
    }

    function deleteItem(id) {
        if(confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
            document.getElementById('deleteForm').action = '/admin/products/' + id;
            document.getElementById('deleteForm').submit();
        }
    }

    function toggleDetail(id) {
        const row = document.getElementById('detail-' + id);
        const icon = document.getElementById('icon-' + id);
        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            row.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
    
    // Search
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr.group'); // Only main rows
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
