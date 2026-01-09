@extends('admin.layouts.app')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter">Thông tin sản phẩm mới</h2>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Tên sản phẩm</label>
                        <input type="text" name="name" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition font-bold text-slate-700" placeholder="VD: Nike Air Jordan 1 Retro">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Mô tả sản phẩm</label>
                        <textarea name="description" rows="4" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm font-medium" placeholder="Nhập mô tả chi tiết về chất liệu, kiểu dáng..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Giá niêm yết ($)</label>
                            <input type="number" name="price" class="w-full bg-slate-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500 transition font-black text-blue-600">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Danh mục (Table: category)</label>
                            <select name="category_id" class="w-full bg-slate-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer font-bold text-slate-700">
                                <option value="1">Giày Nam</option>
                                <option value="2">Giày Nữ</option>
                                <option value="3">Phụ kiện</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-3xl p-8 shadow-xl">
                    <h3 class="text-white font-black uppercase italic text-sm mb-6 flex items-center">
                        <i class="fa-solid fa-layer-group mr-2 text-blue-400"></i> Quản lý biến thể (Size & Kho)
                    </h3>
                    <div id="variant-container" class="space-y-4">
                        <div class="grid grid-cols-3 gap-4 bg-slate-800 p-4 rounded-2xl border border-slate-700">
                            <div>
                                <label class="block text-[9px] font-black text-slate-500 uppercase mb-1">Kích cỡ (Size)</label>
                                <input type="text" name="variants[0][size]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs outline-none focus:ring-1 focus:ring-blue-500" placeholder="VD: 42">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-slate-500 uppercase mb-1">Số lượng tồn</label>
                                <input type="number" name="variants[0][stock]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs outline-none focus:ring-1 focus:ring-blue-500" placeholder="0">
                            </div>
                            <div class="flex items-end">
                                <button type="button" class="w-full h-[42px] bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition active:scale-95">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="addVariant()" class="mt-4 w-full py-3 border-2 border-dashed border-slate-700 rounded-2xl text-slate-400 font-black text-[10px] uppercase tracking-widest hover:border-blue-500 hover:text-blue-500 transition">
                        + Thêm biến thể mới
                    </button>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 text-center">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 text-left">Hình ảnh sản phẩm</label>
                    <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-200 border-dashed rounded-3xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition relative overflow-hidden group">
                        <div id="placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fa-solid fa-cloud-arrow-up text-slate-300 text-4xl mb-3 group-hover:text-blue-500 transition"></i>
                            <p class="text-[10px] text-slate-500 font-black uppercase italic">Nhấp để tải ảnh lên</p>
                        </div>
                        <img id="preview" class="hidden absolute inset-0 w-full h-full object-contain p-4 bg-white">
                        <input type="file" name="image" class="hidden" accept="image/*" onchange="showPreview(this)">
                    </label>
                    <p class="mt-4 text-[10px] text-slate-400 italic">Hỗ trợ: JPG, PNG, WEBP (Tối đa 2MB)</p>
                </div>

                <div class="flex flex-col space-y-3">
                    <button type="submit" class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-500/30 hover:bg-blue-700 active:scale-95 transition uppercase tracking-widest text-xs">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu sản phẩm
                    </button>
                    <button type="button" onclick="window.history.back();" class="w-full bg-white text-slate-400 font-black py-4 rounded-2xl border border-slate-100 hover:bg-slate-50 transition uppercase tracking-widest text-[10px]">
                        Hủy bỏ
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Preview ảnh
    function showPreview(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview');
                img.src = e.target.result;
                img.classList.remove('hidden');
                document.getElementById('placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Thêm biến thể động
    let variantCount = 1;
    function addVariant() {
        const container = document.getElementById('variant-container');
        const html = `
            <div class="grid grid-cols-3 gap-4 bg-slate-800 p-4 rounded-2xl border border-slate-700 animate-fadeIn">
                <div>
                    <input type="text" name="variants[${variantCount}][size]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs outline-none focus:ring-1 focus:ring-blue-500" placeholder="VD: 43">
                </div>
                <div>
                    <input type="number" name="variants[${variantCount}][stock]" class="w-full bg-slate-700 border-none rounded-xl p-3 text-white text-xs outline-none focus:ring-1 focus:ring-blue-500" placeholder="0">
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-full h-[42px] bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        variantCount++;
    }
</script>

<style>
    .animate-fadeIn { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
