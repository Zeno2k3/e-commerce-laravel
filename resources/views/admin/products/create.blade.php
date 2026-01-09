@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="fixed inset-0 bg-gradient-to-br from-purple-900/20 via-blue-900/20 to-purple-900/20 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="my-8 w-full max-w-6xl relative animate-slideIn">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl border border-gray-200">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-8 py-6 rounded-t-3xl border-b border-purple-500/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-box-open text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Thêm Sản Phẩm Mới</h2>
                            <p class="text-purple-200 text-sm font-medium">Quản lý sản phẩm & biến thể</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.index') }}" 
                       class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <i class="fa-solid fa-times text-white text-xl"></i>
                    </a>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="p-8 space-y-8 max-h-[calc(100vh-240px)] overflow-y-auto">
                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fa-solid fa-exclamation-circle text-red-500"></i>
                                <p class="font-semibold text-red-800">Có lỗi xảy ra:</p>
                            </div>
                            <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Product Info --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-info-circle text-purple-500"></i>
                            Thông tin chính
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tên sản phẩm <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="product_name" value="{{ old('product_name') }}" required 
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition"
                                    placeholder="VD: Nike Air Jordan 1 Retro">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục</label>
                                <select name="category_id" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Mô tả</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 outline-none resize-none"
                                    placeholder="Mô tả chi tiết sản phẩm...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Variants Section --}}
                    <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-blue-400"></i>
                                Biến thể sản phẩm
                            </h3>
                            <button type="button" onclick="addVariantRow()" 
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold rounded-lg transition flex items-center gap-2">
                                <i class="fa-solid fa-plus"></i>
                                Thêm biến thể
                            </button>
                        </div>
                        <div id="variantsContainer" class="space-y-4">
                            {{-- Initial variant row --}}
                            <div class="variant-row bg-slate-800 rounded-xl p-5 border border-slate-700 relative">
                                <button type="button" onclick="this.closest('.variant-row').remove()" 
                                    class="absolute top-3 right-3 w-8 h-8 bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg transition flex items-center justify-center">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Size</label>
                                        <input type="text" name="variants[0][size]" value="{{ old('variants.0.size') }}"
                                            class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="42">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Màu sắc</label>
                                        <input type="text" name="variants[0][color]" value="{{ old('variants.0.color') }}"
                                            class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Đỏ">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Chất liệu</label>
                                        <input type="text" name="variants[0][material]" value="{{ old('variants.0.material') }}"
                                            class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Leather">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Giá <span class="text-red-400">*</span></label>
                                        <input type="number" name="variants[0][price]" value="{{ old('variants.0.price') }}" required
                                            class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="150000">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Tồn kho <span class="text-red-400">*</span></label>
                                        <input type="number" name="variants[0][stock]" value="{{ old('variants.0.stock') }}" required
                                            class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="100">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 mb-2">Ảnh biến thể</label>
                                    <div class="flex items-center gap-3">
                                        <input type="file" name="variants[0][url_image]" accept="image/*" onchange="previewImage(this, 0)"
                                            class="flex-1 text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500 file:text-white file:cursor-pointer hover:file:bg-blue-600">
                                        <div id="preview-0" class="hidden w-16 h-16 rounded-lg overflow-hidden border-2 border-slate-600">
                                            <img src="" class="w-full h-full object-cover" alt="Preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="sticky bottom-0 bg-white px-8 py-4 rounded-b-3xl border-t border-gray-200 flex justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}" 
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition flex items-center gap-2">
                        <i class="fa-solid fa-times"></i>
                        Hủy
                    </a>
                    <button type="submit" 
                        class="text-gray-600 px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 font-semibold rounded-xl shadow-lg transition flex items-center gap-2">
                        <i class="fa-solid fa-save"></i>
                        Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes slideIn {
    from { opacity: 0; transform: scale(0.95) translateY(-20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.animate-slideIn { animation: slideIn 0.3s ease-out; }
</style>

<script>
let variantIndex = 1;

function addVariantRow() {
    const container = document.getElementById('variantsContainer');
    const html = `
        <div class="variant-row bg-slate-800 rounded-xl p-5 border border-slate-700 relative animate-slideIn">
            <button type="button" onclick="this.closest('.variant-row').remove()" 
                class="absolute top-3 right-3 w-8 h-8 bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white rounded-lg transition flex items-center justify-center">
                <i class="fa-solid fa-trash text-sm"></i>
            </button>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-4">
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-1">Size</label>
                    <input type="text" name="variants[${variantIndex}][size]" 
                        class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="42">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-1">Màu sắc</label>
                    <input type="text" name="variants[${variantIndex}][color]" 
                        class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Đỏ">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-1">Chất liệu</label>
                    <input type="text" name="variants[${variantIndex}][material]" 
                        class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Leather">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-1">Giá <span class="text-red-400">*</span></label>
                    <input type="number" name="variants[${variantIndex}][price]" required
                        class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="150000">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 mb-1">Tồn kho <span class="text-red-400">*</span></label>
                    <input type="number" name="variants[${variantIndex}][stock]" required
                        class="w-full px-3 py-2 bg-slate-700 border-none rounded-lg text-white text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="100">
                </div>
            </div>

            <div class="flex flex-col space-y-3">
                <button type="submit" class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-500/40 hover:bg-blue-700 active:scale-95 transition-all uppercase tracking-widest text-xs">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu sản phẩm ngay
                </button>
                <a href="{{ route('admin.products.index') }}" class="w-full bg-white text-slate-400 font-black py-4 rounded-2xl border border-slate-100 text-center hover:bg-slate-50 transition-all uppercase tracking-widest text-[10px]">
                    Hủy bỏ & Quay lại
                </a>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    variantIndex++;
}

function previewImage(input, index) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById('preview-' + index);
        
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
