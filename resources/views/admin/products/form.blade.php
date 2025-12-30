@extends('admin.layouts.app')
@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 uppercase tracking-tight">Thông tin sản phẩm mới</h2>
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Tên sản phẩm</label>
                        <input type="text" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="VD: Nike Jordan 1">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Giá ($)</label>
                            <input type="number" class="w-full bg-slate-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Danh mục</label>
                            <select class="w-full bg-slate-50 border-none rounded-2xl p-4 outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                                <option>Giày Nam</option>
                                <option>Giày Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Hình ảnh sản phẩm</label>
                    <label class="flex flex-col items-center justify-center w-full h-52 border-2 border-slate-200 border-dashed rounded-3xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition relative overflow-hidden group">
                        <div id="placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fa-solid fa-cloud-arrow-up text-slate-300 text-4xl mb-3 group-hover:text-blue-500 transition"></i>
                            <p class="text-xs text-slate-500 font-bold uppercase italic">Tải ảnh lên tại đây</p>
                        </div>
                        <img id="preview" class="hidden absolute inset-0 w-full h-full object-contain p-4 bg-white">
                        <input type="file" name="image" class="hidden" accept="image/*" onchange="showPreview(this)">
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t flex justify-end space-x-4">
                <button type="button" onclick="window.history.back();" class="text-slate-400 font-bold px-6 py-3 hover:text-slate-600 transition">
    Hủy bỏ
</button>
                <button type="submit" class="bg-blue-600 text-white font-black px-12 py-4 rounded-2xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition uppercase tracking-widest text-xs">Lưu dữ liệu</button>
            </div>
        </form>
    </div>
</div>

<script>
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
</script>
@endsection