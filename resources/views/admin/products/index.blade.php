@extends('admin.layouts.app')
@section('title', 'Quản lý sản phẩm')

@section('add_button')
<button onclick="openCreateModal()" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-200 transition">
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
    
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    @if($products->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mx-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 font-bold tracking-wider">
                            <th class="p-4">Tên sản phẩm</th>
                            <th class="p-4">Danh mục</th>
                            <th class="p-4">Giá bán</th>
                            <th class="p-4">Màu</th>
                            <th class="p-4">Biến thể</th>
                            <th class="p-4 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                            @php
                                $firstVariant = $product->variants->first();
                                $imageUrl = $firstVariant && $firstVariant->url_image 
                                    ? asset($firstVariant->url_image) 
                                    : 'https://placehold.co/600x400?text=No+Image';
                                $price = $firstVariant ? number_format($firstVariant->price, 0, ',', '.') . ' đ' : 'Liên hệ';
                                $color = $firstVariant ? $firstVariant->color : '-';
                                $variantCount = $product->variants->count();
                            @endphp
                            <tr class="hover:bg-gray-50 transition group">
                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-lg border border-gray-200 p-1 bg-white shrink-0">
                                            <img src="{{ $imageUrl }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover rounded">
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition">{{ $product->product_name }}</h3>
                                            <p class="text-xs text-gray-500 line-clamp-1">{{ $product->description ?? 'Chưa có mô tả' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="text-sm font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-full">
                                        {{ $product->category->category_name ?? 'Chưa phân loại' }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm font-bold text-gray-900">
                                    {{ $price }}
                                </td>
                                <td class="p-4 text-sm text-gray-600">
                                    {{ $color }}
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $variantCount }} biến thể
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition">
                                        <button onclick="openEditModal({{ $product->product_id }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Chỉnh sửa">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        <button onclick="deleteItem({{ $product->product_id }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Xóa">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 flex justify-center bg-gray-50">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có sản phẩm nào</p>
        </div>
    @endif
</div>

{{-- CREATE MODAL - FULL FEATURED --}}
<div id="createModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden overflow-y-auto" style="z-index: 9999;">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-6xl border border-gray-200 animate-slideIn">
            {{-- Header --}}
            <div class="sticky top-0 bg-purple-600 px-8 py-6 rounded-t-3xl border-b border-purple-500/20 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-box-open text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Thêm Sản Phẩm Mới</h2>
                            <p class="text-purple-100 text-sm font-medium">Quản lý sản phẩm & biến thể</p>
                        </div>
                    </div>
                    <button onclick="closeCreateModal()" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <i class="fa-solid fa-times text-white text-xl"></i>
                    </button>
                </div>
            </div>

            {{-- Form --}}
            <form id="createForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8 space-y-8 max-h-[calc(100vh-240px)] overflow-y-auto">
                    {{-- Product Info --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-purple-500"></i>
                            Thông tin chính
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tên sản phẩm <span class="text-red-500">*</span></label>
                                <input type="text" name="product_name" required 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition"
                                    placeholder="VD: Nike Air Jordan 1 Retro">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục</label>
                                <select name="category_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Loại sản phẩm <span class="text-red-500">*</span></label>
                                <select name="product_type" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                                    <option value="nam" selected>Nam</option>
                                    <option value="nu">Nữ</option>
                                    <option value="phu-kien">Phụ kiện</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Mô tả</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none"
                                    placeholder="Mô tả chi tiết sản phẩm..."></textarea>
                            </div>
                            <!-- Status field fallback hidden input or default handling -->
                            <input type="hidden" name="status" value="active">
                        </div>
                    </div>

                    {{-- Variants Section --}}
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-blue-400"></i>
                                Biến thể sản phẩm
                            </h3>
                            <button type="button" onclick="addVariantRow('create')" 
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold rounded-lg transition flex items-center gap-2">
                                <i class="fa-solid fa-plus"></i>
                                Thêm biến thể
                            </button>
                        </div>
                        <div id="createVariantsContainer" class="space-y-4">
                            {{-- Initial variant row --}}
                            <div class="variant-row bg-gray-800 rounded-xl p-5 border border-gray-700 relative">
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-1">Size</label>
                                        <input type="text" name="variants[0][size]" 
                                            class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="42">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-1">Màu sắc</label>
                                        <input type="text" name="variants[0][color]" 
                                            class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Đỏ">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-1">Chất liệu</label>
                                        <input type="text" name="variants[0][material]" 
                                            class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Leather">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-1">Giá <span class="text-red-400">*</span></label>
                                        <input type="number" name="variants[0][price]" required
                                            class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="150000">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 mb-1">Tồn kho <span class="text-red-400">*</span></label>
                                        <input type="number" name="variants[0][stock]" required
                                            class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="100">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 mb-2">Ảnh biến thể</label>
                                    <div class="flex items-center gap-3">
                                        <input type="file" name="variants[0][url_image]" accept="image/*" onchange="previewVariantImage(this, 0, 'create')"
                                            class="flex-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500 file:text-white file:cursor-pointer hover:file:bg-blue-600">
                                        <div id="create-preview-0" class="hidden w-16 h-16 rounded-lg overflow-hidden border-2 border-gray-600">
                                            <img src="" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="sticky bottom-0 bg-white px-8 py-4 rounded-b-3xl border-t border-gray-200 flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" 
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition">
                        <i class="fa-solid fa-times mr-2"></i>Hủy
                    </button>
                    <button type="submit" 
                        class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow-lg transition">
                        <i class="fa-solid fa-check mr-2"></i>Tạo sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL - FULL FEATURED --}}
<div id="editModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden overflow-y-auto" style="z-index: 9999;">
    <div class="min-h-screen px-4 py-8 flex items-center justify-center">
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-6xl border border-gray-200 animate-slideIn">
            <div class="sticky top-0 bg-blue-600 px-8 py-6 rounded-t-3xl border-b border-blue-500/20 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-edit text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Chỉnh Sửa Sản Phẩm</h2>
                            <p class="text-blue-100 text-sm font-medium">Cập nhật thông tin & biến thể</p>
                        </div>
                    </div>
                    <button onclick="closeEditModal()" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <i class="fa-solid fa-times text-white text-xl"></i>
                    </button>
                </div>
            </div>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-8 space-y-8 max-h-[calc(100vh-240px)] overflow-y-auto">
                    {{-- Loading State --}}
                    <div id="editLoading" class="hidden text-center py-12">
                        <i class="fa-solid fa-spinner fa-spin text-4xl text-blue-500"></i>
                        <p class="mt-4 text-gray-500">Đang tải dữ liệu...</p>
                    </div>

                    <div id="editContent">
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-info-circle text-blue-500"></i>
                                Thông tin chính
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tên sản phẩm <span class="text-red-500">*</span></label>
                                    <input type="text" id="edit_product_name" name="product_name" required 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục</label>
                                    <select id="edit_category_id" name="category_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Loại sản phẩm <span class="text-red-500">*</span></label>
                                    <select id="edit_product_type" name="product_type" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                        <option value="phu-kien">Phụ kiện</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mô tả</label>
                                    <textarea id="edit_description" name="description" rows="3"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                                </div>
                                {{-- Status hidden or specific field if user wants --}}
                                <input type="hidden" id="edit_status" name="status" value="active">
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 shadow-xl mt-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                    <i class="fa-solid fa-layer-group text-purple-400"></i>
                                    Biến thể sản phẩm
                                </h3>
                                <button type="button" onclick="addVariantRow('edit')" 
                                    class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white text-sm font-semibold rounded-lg transition flex items-center gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    Thêm biến thể
                                </button>
                            </div>
                            <div id="editVariantsContainer" class="space-y-4">
                                {{-- Variants will be loaded dynamically --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky bottom-0 bg-white px-8 py-4 rounded-b-3xl border-t border-gray-200 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" 
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition">
                        <i class="fa-solid fa-times mr-2"></i>Hủy
                    </button>
                    <button type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg transition">
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
let variantIndex = 1;

function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.body.style.overflow = '';
    // Optional: Reset form
    // document.getElementById('createForm').reset();
}

function openEditModal(productId) {
    document.getElementById('editModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Show loading, hide content
    document.getElementById('editLoading').classList.remove('hidden');
    document.getElementById('editContent').classList.add('hidden');
    
    document.getElementById('editForm').action = '/admin/products/' + productId;

    // Fetch data
    fetch(`/admin/products/${productId}/edit`, {
        headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                throw new Error(res.status + ': ' + res.statusText + ' - ' + text); // Detailed error
            }
            return res.json();
        })
        .then(data => {
            fillEditForm(data);
            document.getElementById('editLoading').classList.add('hidden');
            document.getElementById('editContent').classList.remove('hidden');
        })
        .catch(err => {
            console.error('Error loading product:', err);
            alert('Lỗi tải dữ liệu: ' + err.message); // Show detail to user/us
            closeEditModal();
        });
}

function fillEditForm(data) {
    const product = data.product;
    const variants = data.variants;

    document.getElementById('edit_product_name').value = product.product_name;
    document.getElementById('edit_category_id').value = product.category_id || '';
    document.getElementById('edit_product_type').value = product.product_type || 'nam';
    document.getElementById('edit_description').value = product.description || '';
    document.getElementById('edit_status').value = product.status || 'active';

    const container = document.getElementById('editVariantsContainer');
    container.innerHTML = ''; // Clear old

    variants.forEach((variant, index) => {
        addVariantRow('edit', variant);
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function addVariantRow(type, variant = null) {
    const container = document.getElementById(type + 'VariantsContainer');
    const idx = variant ? variant.variant_id : 'new_' + variantIndex++; // Unique ID logic
    // NOTE: Name attribute needs to be array friendly. 
    // If Editing, we might want to include the variant ID to update existing ones.
    
    const size = variant ? variant.size : '';
    const color = variant ? variant.color : '';
    const material = variant ? variant.material : '';
    const price = variant ? variant.price : '';
    const stock = variant ? variant.stock : '';
    const imageUrl = variant ? variant.url_image : null; // Logic to show preview if exists

    // If variant exists, add a hidden input for ID
    const idInput = variant ? `<input type="hidden" name="variants[${idx}][id]" value="${variant.variant_id}">` : '';

    const html = `
        <div class="variant-row bg-gray-800 rounded-xl p-5 border border-gray-700 relative animate-slideIn">
            <button type="button" onclick="this.closest('.variant-row').remove()" 
                class="absolute top-3 right-3 w-8 h-8 bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg transition flex items-center justify-center">
                <i class="fa-solid fa-trash text-sm"></i>
            </button>
            ${idInput}
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1">Size</label>
                    <input type="text" name="variants[${idx}][size]" value="${size}"
                        class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1">Màu sắc</label>
                    <input type="text" name="variants[${idx}][color]" value="${color}"
                        class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1">Chất liệu</label>
                    <input type="text" name="variants[${idx}][material]" value="${material}"
                        class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1">Giá <span class="text-red-400">*</span></label>
                    <input type="number" name="variants[${idx}][price]" value="${price}" required
                        class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-1">Tồn kho <span class="text-red-400">*</span></label>
                    <input type="number" name="variants[${idx}][stock]" value="${stock}" required
                        class="w-full px-3 py-2 bg-gray-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-2">Ảnh biến thể</label>
                <div class="flex items-center gap-3">
                    <input type="file" name="variants[${idx}][url_image]" accept="image/*" onchange="previewVariantImage(this, '${idx}', '${type}')"
                        class="flex-1 text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500 file:text-white file:cursor-pointer hover:file:bg-blue-600">
                    <div id="${type}-preview-${idx}" class="${imageUrl ? '' : 'hidden'} w-16 h-16 rounded-lg overflow-hidden border-2 border-gray-600">
                        <img src="${imageUrl ? '/' + imageUrl : ''}" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
}

function previewVariantImage(input, index, type) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById(type + '-preview-' + index);
        
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteItem(id) {
    if(confirm('Bạn có chắc muốn xóa sản phẩm này? Tất cả biến thể sẽ bị xóa!')) {
        document.getElementById('deleteForm').action = '/admin/products/' + id;
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection
