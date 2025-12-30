@extends('admin.layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Sản phẩm</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold shadow-lg hover:bg-blue-700 transition">
        + Thêm mới
    </a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Thông tin</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Giá</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Trạng thái</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-6 py-4 flex items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-lg mr-3 border">
                    <span class="font-bold text-slate-700 text-sm">Nike Air Jordan 1</span>
                </td>
                <td class="px-6 py-4 font-black text-slate-900">$120.00</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-600 text-[10px] font-black rounded-md">CÒN HÀNG</span>
                </td>
                <td class="px-6 py-4 text-right">
    <div class="flex justify-end items-center space-x-3">
        <button type="button" 
                onclick="handleEdit('Nike Air Jordan 1')" 
                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white active:scale-90 transition-all shadow-sm border border-blue-100" 
                title="Sửa sản phẩm">
            <i class="fas fa-edit text-xs"></i>
        </button>

        <button type="button" 
                onclick="handleDelete('Nike Air Jordan 1')" 
                class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white active:scale-90 transition-all shadow-sm border border-red-100" 
                title="Xóa sản phẩm">
            <i class="fas fa-trash text-xs"></i>
        </button>
    </div>
</td>

<script>
    function handleEdit(name) {
        alert('Chức năng sửa sản phẩm sắp ra mắt!');
    }

    function handleDelete(name) {
        alert('Chức năng xóa sản phẩm sắp ra mắt!');
    }
</script>
            </tr>
        </tbody>
    </table>
</div>
@endsection