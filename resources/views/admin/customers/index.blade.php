@extends('admin.layouts.app')

@section('title', 'Quản lý khách hàng')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách khách hàng</h2>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-6 py-5">Khách hàng</th>
                    <th class="px-6 py-5 text-center">Email</th>
                    <th class="px-6 py-5 text-center">Số điện thoại</th>
                    <th class="px-6 py-5 text-center">Trạng thái</th>
                    <th class="px-6 py-5 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <tr class="hover:bg-blue-50/50 transition duration-300 group">
                    <td class="px-6 py-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-white text-xs shadow-lg shadow-blue-500/30">
                                TV
                            </div>
                            <div>
                                <p class="font-black text-slate-800 uppercase tracking-tighter text-base">Trần Văn Phú</p>
                                <p class="text-[10px] text-blue-500 font-black italic uppercase tracking-widest">Thành viên VIP</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-slate-500 italic font-bold">
                        phu.master@luxe.com
                    </td>
                    <td class="px-6 py-4 text-center font-black text-slate-800 tracking-tighter text-base">
                        090 123 4567
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-4 py-1.5 bg-emerald-100 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-widest border border-emerald-200">
                            Hoạt động
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center space-x-3">
                            <button type="button" 
                                    onclick="alert('Tính năng xem chi tiết hồ sơ khách hàng sắp ra mắt!')" 
                                    class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all active:scale-90 shadow-sm border border-blue-100"
                                    title="Xem chi tiết">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button type="button" 
                                    onclick="alert('Tính năng xóa dữ liệu khách hàng sắp ra mắt!')" 
                                    class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all active:scale-90 shadow-sm border border-red-100"
                                    title="Xóa khách hàng">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection