@extends('admin.layouts.app')
@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-blue-600 inline-block pb-2">Danh sách khách hàng</h2>
    
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-5">Họ tên (Bảng user)</th>
                    <th class="px-6 py-5 text-center">Email</th>
                    <th class="px-6 py-5 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm font-bold">
                <tr class="hover:bg-blue-50/50 transition duration-300">
                    <td class="px-6 py-6 flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px]">TV</div>
                        <span class="text-slate-800 uppercase">Trần Văn Phú</span>
                    </td>
                    <td class="px-6 py-4 text-center text-slate-500 italic">phu.master@luxe.com</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button type="button" onclick="alert('Tính năng xem hồ sơ sắp ra mắt!')" class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition active:scale-90"><i class="fa-solid fa-eye"></i></button>
                            <button type="button" onclick="alert('Tính năng xóa sắp ra mắt!')" class="w-8 h-8 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition active:scale-90"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection