@extends('admin.layouts.app')

@section('title', 'Quản lý khách hàng')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center space-x-3">
        <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter border-b-4 border-indigo-600 pb-2">
            Khách hàng
        </h2>
        <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-1 rounded font-bold italic border border-slate-200 uppercase">
            Table: user
        </span>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
            <tr>
                <th class="px-6 py-5">Khách hàng (full_name)</th>
                <th class="px-6 py-5">Email</th>
                <th class="px-6 py-5 text-center">Vai trò (role)</th>
                <th class="px-6 py-5 text-center">Trạng thái (status)</th>
                <th class="px-6 py-5 text-right">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            {{-- Vòng lặp lấy dữ liệu thật từ bảng user --}}
            {{-- @foreach($users as $user) ... @endforeach --}}
        </tbody>
    </table>

    {{-- Hiển thị khi database trống (Trừ tài khoản admin đang đăng nhập) --}}
    <div class="py-24 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4 text-slate-200">
            <i class="fa-solid fa-users-slash text-3xl"></i>
        </div>
        <p class="text-slate-400 font-black italic uppercase tracking-widest text-[10px]">
            Chưa có dữ liệu người dùng khác trong hệ thống
        </p>
        <p class="text-slate-300 text-[9px] mt-1 font-bold">Kiểm chứng: Khớp bảng `user` (ecommerce_db)</p>
    </div>
</div>

<script>
    function viewCustomer(id) {
        // Sau này dùng route('admin.customers.show', id)
        alert('Xem chi tiết khách hàng ID: ' + id);
    }

    function deleteCustomer(id) {
        if(confirm('Mày có chắc muốn xóa khách hàng này? Mọi lịch sử đơn hàng và địa chỉ liên quan sẽ bị ảnh hưởng!')) {
            alert('Đã gửi yêu cầu xóa khách hàng ID: ' + id);
        }
    }
</script>
@endsection