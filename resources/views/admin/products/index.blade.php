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
    {{-- Kiểm tra nếu có dữ liệu từ Controller gửi sang --}}
    @if($products->count() > 0)
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-6 py-5">Thông tin chính (Product)</th>
                    <th class="px-6 py-5 text-center">Danh mục (Category)</th>
                    <th class="px-6 py-5 text-center">Giá từ (Min Price)</th>
                    <th class="px-6 py-5 text-center">Tồn kho (Stock)</th>
                    <th class="px-6 py-5 text-right">Quản lý</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($products as $product)
                <tr class="hover:bg-slate-50 transition duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-image text-xl"></i>
                            </div>
                            <div>
                                <div class="font-black uppercase text-xs text-slate-800">{{ $product->product_name }}</div>
                                <div class="text-[9px] text-slate-400 italic font-bold">MÃ SP: #{{ $product->product_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-[10px] font-black uppercase px-2 py-1 bg-blue-50 text-blue-500 rounded border border-blue-100 italic">
                            {{ $product->category_name ?? 'Chưa phân loại' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="font-black text-slate-700 italic text-sm">
                            ${{ number_format($product->min_price, 2) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded-full uppercase tracking-tighter">
                            Tổng: {{ $product->total_stock ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-1">
                            <button onclick="handleEdit({{ $product->product_id }})" class="p-2 text-slate-400 hover:text-blue-600 transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="handleDelete({{ $product->product_id }})" class="p-2 text-slate-400 hover:text-red-500 transition">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        {{-- Hiển thị khi database thực sự trống --}}
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4">
                <i class="fa-solid fa-box-open text-slate-200 text-3xl"></i>
            </div>
            <p class="text-slate-400 font-black italic uppercase tracking-widest text-[10px]">Hiện tại không có sản phẩm nào</p>
            <p class="text-slate-300 text-[9px] mt-1 font-bold italic uppercase">Vui lòng kiểm tra bảng `product` trong `ecommerce_db`</p>
        </div>
    @endif
</div>

<script>
    function handleEdit(id) {
        alert('Mở chỉnh sửa sản phẩm ID: ' + id);
    }

    function handleDelete(id) {
        if(confirm('Mày có chắc muốn xóa sản phẩm này? Mọi biến thể (Size, Màu) sẽ bị xóa sạch!')) {
            alert('Đã xóa ID: ' + id);
        }
    }
</script>
@endsection