@extends('admin.layouts.app')

@section('title', 'Cài đặt hệ thống')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-blue-600 pb-2">
            Cài đặt hệ thống
        </h2>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-10">
        <form action="#" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Tên cửa hàng</label>
                    <input type="text" name="shop_name" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-2xl p-4 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-bold text-slate-700" 
                           placeholder="Nhập tên cửa hàng của mày...">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Email thông báo</label>
                    <input type="email" name="shop_email" 
                           class="w-full bg-slate-50 border-2 border-transparent rounded-2xl p-4 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-bold text-slate-700" 
                           placeholder="admin@ten-shop.com">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 italic">Địa chỉ kho hàng</label>
                <textarea name="shop_address" rows="3" 
                          class="w-full bg-slate-50 border-2 border-transparent rounded-[2rem] p-6 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-bold text-slate-700 text-sm" 
                          placeholder="Địa chỉ cụ thể dùng để tính phí vận chuyển..."></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-500/30 hover:bg-blue-700 active:scale-95 transition-all uppercase text-xs tracking-[0.2em]">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Cập nhật cài đặt
                </button>
            </div>
        </form>
    </div>

    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 flex items-start space-x-3">
        <i class="fa-solid fa-circle-info text-amber-500 mt-1"></i>
        <p class="text-[10px] text-amber-700 font-bold italic">
            Lưu ý: Database `ecommerce_db` của mày hiện tại chưa có bảng để lưu các thông tin này. Mày cần tạo thêm bảng `settings` (key, value) để dữ liệu không bị mất khi F5.
        </p>
    </div>
</div>
@endsection