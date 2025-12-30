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
    @if($users->count() > 0)
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
                @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white text-[10px] font-black uppercase">
                                {{ substr($user->full_name, 0, 2) }}
                            </div>
                            <span class="font-black text-slate-700 uppercase text-xs">{{ $user->full_name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-xs italic font-bold text-slate-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-[10px] font-black uppercase px-2 py-1 bg-slate-100 rounded text-slate-400">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 {{ $user->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} text-[9px] font-black rounded uppercase">
                            {{ $user->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <button onclick="viewCustomer({{ $user->user_id }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button onclick="deleteCustomer({{ $user->user_id }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                <i class="fa-solid fa-trash"></i>
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
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4 text-slate-200">
                <i class="fa-solid fa-users-slash text-3xl"></i>
            </div>
            <p class="text-slate-400 font-black italic uppercase tracking-widest text-[10px]">
                Chưa có dữ liệu người dùng nào trong Database
            </p>
            <p class="text-slate-300 text-[9px] mt-1 font-bold italic">Check database: ecommerce_db -> table: user</p>
        </div>
    @endif
</div>

<script>
    function viewCustomer(id) {
        alert('Xem chi tiết khách hàng ID: ' + id);
    }

    function deleteCustomer(id) {
        if(confirm('Mày có chắc muốn xóa khách hàng này?')) {
            alert('Đã gửi yêu cầu xóa khách hàng ID: ' + id);
        }
    }
</script>
@endsection