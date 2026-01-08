@extends('admin.layouts.app')
@section('title', 'Quản lý sản phẩm')

@section('add_button')
<button onclick="openModal('createModal')" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-200 transition">
    <i class="fa-solid fa-plus"></i>
</button>
@endsection

@section('content')
<div class="bg-white min-h-full">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($products->count() > 0)
        @foreach($products as $product)
            <x-admin.card 
                :title="$product->product_name"
                :subtitle="$product->category->category_name ?? 'Chưa phân loại'"
                :email="$product->description ?? 'Không có mô tả'"
                status="active"
                :id="$product->product_id"
                :onEdit="'openEditModal(' . $product->product_id . ', \'' . addslashes($product->product_name) . '\', \'' . addslashes($product->description ?? '') . '\', \'' . ($product->category_id ?? '') . '\')'"
                :onDelete="'deleteItem(' . $product->product_id . ')'"
            />
        @endforeach
        
        @if($products->hasPages())
            <div class="px-6 py-4 flex justify-center">{{ $products->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có sản phẩm nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm sản phẩm mới" action="{{ route('admin.products.store') }}" method="POST">
    <x-admin.input name="product_name" label="Tên sản phẩm" placeholder="Nhập tên sản phẩm" required />
    <x-admin.input name="description" label="Mô tả" placeholder="Nhập mô tả sản phẩm" />
    <div class="mt-4">
        <x-admin.select name="category_id" label="Danh mục" :options="$categories->pluck('category_name', 'category_id')->toArray()" />
    </div>
</x-admin.form-modal>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('editModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa sản phẩm</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="px-6 py-6">
                    <x-admin.input name="edit_product_name" label="Tên sản phẩm" placeholder="Nhập tên sản phẩm" required />
                    <x-admin.input name="edit_description" label="Mô tả" placeholder="Nhập mô tả sản phẩm" />
                    <div class="mt-4">
                        <x-admin.select name="category_id" label="Danh mục" :options="$categories->pluck('category_name', 'category_id')->toArray()" />
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-floppy-disk"></i><span>Lưu</span>
                    </button>
                    <button type="button" onclick="closeModal('editModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i><span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">@csrf @method('DELETE')</form>

<script>
    function openEditModal(id, name, description, categoryId) {
        document.getElementById('editForm').action = '/admin/products/' + id;
        document.getElementById('edit_product_name').value = name;
        document.getElementById('edit_description').value = description;
        if(categoryId) document.querySelector('#editModal select[name="category_id"]').value = categoryId;
        openModal('editModal');
    }
    function deleteItem(id) {
        if(confirm('Bạn có chắc muốn xóa?')) {
            document.getElementById('deleteForm').action = '/admin/products/' + id;
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection