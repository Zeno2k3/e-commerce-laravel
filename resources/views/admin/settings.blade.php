@extends('admin.layouts.app')

@section('title', 'Cài đặt hệ thống')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter">Cài đặt hệ thống</h2>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Tên cửa hàng</label>
                    <input type="text" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition" value="LUXE SHOP">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Email thông báo</label>
                    <input type="email" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition" value="admin@luxe.com">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-tighter">Địa chỉ kho hàng</label>
                <textarea class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none transition" rows="3">Quận 1, TP. Hồ Chí Minh</textarea>
            </div>

            <div class="pt-6 border-t flex justify-end">
                <button type="button" class="bg-blue-600 text-white font-black px-12 py-4 rounded-2xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition uppercase tracking-widest text-xs">
                    Cập nhật cài đặt
                </button>
            </div>
        </div>
    </div>
</div>
@endsection