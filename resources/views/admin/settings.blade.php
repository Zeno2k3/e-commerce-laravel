@extends('admin.layouts.app')

@section('title', 'Cài đặt tài khoản Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-indigo-600 pb-2">Thiết lập tài khoản</h2>
        <span class="bg-indigo-50 text-indigo-600 text-[10px] px-3 py-1 rounded-full font-black uppercase italic border border-indigo-100">Quyền: Administrator</span>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
        <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest flex items-center">
            <i class="fa-solid fa-user-gear mr-2 text-indigo-500"></i> Thông tin cá nhân
        </h3>
        <form action="{{ route('admin.settings.updateProfile') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-black text-slate-400 uppercase text-[10px] tracking-widest mb-2 block">Họ và tên hiển thị</label>
                    <input type="text" name="full_name" value="{{ $admin->full_name }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 outline-none focus:ring-2 focus:ring-indigo-500/20 transition">
                </div>
                <div>
                    <label class="font-black text-slate-400 uppercase text-[10px] tracking-widest mb-2 block">Email đăng nhập</label>
                    <input type="email" name="email" value="{{ $admin->email }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 outline-none focus:ring-2 focus:ring-indigo-500/20 transition">
                </div>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">
                Lưu thay đổi thông tin
            </button>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
        <h3 class="font-black text-slate-700 mb-6 uppercase text-xs italic border-b pb-4 tracking-widest flex items-center">
            <i class="fa-solid fa-shield-halved mr-2 text-red-500"></i> Bảo mật tài khoản
        </h3>
        <form action="{{ route('admin.settings.updatePassword') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-black text-slate-400 uppercase text-[10px] tracking-widest mb-2 block">Mật khẩu mới</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 outline-none focus:ring-2 focus:ring-red-500/10 transition">
                </div>
                <div>
                    <label class="font-black text-slate-400 uppercase text-[10px] tracking-widest mb-2 block">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 outline-none focus:ring-2 focus:ring-red-500/10 transition">
                </div>
            </div>
            <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 flex items-start space-x-3">
                <i class="fa-solid fa-circle-exclamation text-amber-500 mt-1"></i>
                <p class="text-[11px] font-bold text-amber-700 leading-relaxed italic">
                    Lưu ý: Mật khẩu nên bao gồm chữ cái, chữ số và ký tự đặc biệt để đảm bảo an toàn cho hệ thống quản trị Laravel.
                </p>
            </div>
            <button type="submit" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-red-600 transition-all">
                Cập nhật mật khẩu mới
            </button>
        </form>
    </div>
</div>
@endsection