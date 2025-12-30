@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center space-x-3">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-blue-600 pb-2">Sản phẩm</h2>
        <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-1 rounded font-bold italic border border-slate-200">Table: product & variant</span>
    </div>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-5 py-3 rounded-2xl font-black shadow-lg shadow-blue-500/30 hover:bg-blue-700 active:scale-95 transition-all uppercase text-[10px] tracking-widest">
        <i class="fa-solid fa-plus mr-2"></i> Thêm sản phẩm mới
    </a>
</div>

<div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
            <tr>
                <th class="px-6 py-5">Thông tin chính (Product)</th>
                <th class="px-6 py-5 text-center">Danh mục (Category)</th>
                <th class="px-6 py-5 text-center">Giá (Variant Price)</th>
                <th class="px-6 py-5 text-center">Tồn kho (Stock)</th>
                <th class="px-6 py-5 text-right">Quản lý</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            {{-- CHỖ NÀY ĐỂ TRỐNG ĐỂ ĐỔ DỮ LIỆU THẬT --}}
            {{-- Mày sẽ dùng: @foreach($products as $product) ... @endforeach --}}
        </tbody>
    </table>

    <div class="py-24 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4">
            <i class="fa-solid fa-box-open text-slate-200 text-3xl"></i>
        </div>
        <p class="text-slate-400 font-black italic uppercase tracking-widest text-[10px]">Hiện tại không có sản phẩm nào</p>
        <p class="text-slate-300 text-[9px] mt-1 font-bold">Vui lòng thêm sản phẩm mới để hiển thị tại đây</p>
    </div>
</div>

<script>
    function handleEdit(id) {
        // Sau này truyền ID thật từ Database vào đây
        alert('Đang mở trình chỉnh sửa cho ID: ' + id);
    }

    function handleDelete(id) {
        if(confirm('Mày có chắc muốn xóa sản phẩm này? Mọi biến thể (Size, Màu) liên quan sẽ bị xóa sạch khỏi Database!')) {
            alert('Đã gửi lệnh xóa cho ID: ' + id);
        }
    }
</script>
@endsection