@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-blue-600 pb-2">
            Thông tin sản phẩm mới
        </h2>
        <span class="bg-slate-100 text-slate-500 text-[10px] px-3 py-1 rounded-full font-bold italic border border-slate-200">
            Target Tables: product & product_variant
        </span>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tên sản phẩm (product_name)</label>
                    <input type="text" name="product_name" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition font-bold" placeholder="VD: Nike Air Jordan 1 Retro">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mô tả chi tiết (description)</label>
                    <textarea name="description" rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm" placeholder="Nhập mô tả sản phẩm..."></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Danh mục chính (category_id)</label>
                    <select name="category_id" class="w-full bg-slate-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer font-bold">
                        <option value="1">Giày Nam</option>
                        <option value="2">Giày Nữ</option>
                        <option value="3">Phụ kiện</option>
                    </select>
                </div>
            </div>

            <div class="bg-slate-900 rounded-3xl p-8 shadow-2xl">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-black uppercase italic text-sm tracking-widest">
                        <i class="fa-solid fa-layer-group mr-2 text-blue-400"></i> Quản lý biến thể (product_variant)
                    </h3>
                </div>
                
                <div id="variant-wrapper" class="space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 bg-slate-800 p-4 rounded-2xl border border-slate-700 animate-fadeIn">
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase mb-1 text-center">Size</label>
                            <input type="text" name="variants[0][size]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none focus:ring-1 focus:ring-blue-500" placeholder="42">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase mb-1 text-center">Màu (color)</label>
                            <input type="text" name="variants[0][color]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none focus:ring-1 focus:ring-blue-500" placeholder="Red">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase mb-1 text-center">Chất liệu</label>
                            <input type="text" name="variants[0][material]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none focus:ring-1 focus:ring-blue-500" placeholder="Leather">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase mb-1 text-center">Kho (stock)</label>
                            <input type="number" name="variants[0][stock]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none focus:ring-1 focus:ring-blue-500" placeholder="0">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase mb-1 text-center">Giá riêng</label>
                            <input type="number" name="variants[0][price]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none focus:ring-1 focus:ring-blue-500" placeholder="$">
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addNewVariant()" class="mt-6 w-full py-4 border-2 border-dashed border-slate-700 rounded-2xl text-slate-500 font-black text-[10px] uppercase tracking-[0.3em] hover:border-blue-500 hover:text-blue-500 transition-all active:scale-95">
                    + Thêm một biến thể khác
                </button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 text-center">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-left">Ảnh đại diện</label>
                <div class="relative group cursor-pointer h-64 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl overflow-hidden hover:bg-slate-100 transition">
                    <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                    <div id="upload-placeholder" class="flex flex-col items-center justify-center h-full">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-300 group-hover:text-blue-500 transition mb-2"></i>
                        <p class="text-[10px] font-black text-slate-400 uppercase italic">Tải ảnh lên</p>
                    </div>
                    <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-contain p-4 bg-white">
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
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    let variantIdx = 1;
    function addNewVariant() {
        const wrapper = document.getElementById('variant-wrapper');
        const html = `
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 bg-slate-800 p-4 rounded-2xl border border-slate-700 animate-fadeIn">
                <input type="text" name="variants[${variantIdx}][size]" class="bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none" placeholder="Size">
                <input type="text" name="variants[${variantIdx}][color]" class="bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none" placeholder="Màu">
                <input type="text" name="variants[${variantIdx}][material]" class="bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none" placeholder="Chất liệu">
                <input type="number" name="variants[${variantIdx}][stock]" class="bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none" placeholder="Kho">
                <div class="flex space-x-2">
                    <input type="number" name="variants[${variantIdx}][price]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs text-center outline-none" placeholder="$">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-white hover:bg-red-500 p-2 rounded-lg transition"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        variantIdx++;
    }
</script>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out; }
</style>
@endsection