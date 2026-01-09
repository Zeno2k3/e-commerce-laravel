@extends('admin.layouts.app')
@section('title', 'Quản lý nhân viên')

@section('content')
<div class="p-6">
    {{-- Header Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="relative flex-1 max-w-lg">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm shadow-sm" placeholder="Tìm kiếm...">
        </div>
        <button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition shadow-sm text-sm">
            <i class="fa-solid fa-plus"></i>
            <span>Thêm nhân viên</span>
        </button>
    </div>

    <div class="bg-white min-h-full rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 m-6 mb-0">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-bold text-gray-900 text-lg">Danh sách nhân viên</h2>
            <p class="text-sm text-gray-500">Quản lý thông tin nhân viên</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Tên tài khoản</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Chức vụ</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Trạng thái</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($employees as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 text-center">{{ $user->full_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">
                            @php
                                $roles = [
                                    'admin' => 'Admin',
                                    'employee' => 'Nhân viên'
                                ];
                            @endphp
                            {{ $roles[$user->role] ?? $user->role }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($user->status == 'active')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    Còn hoạt động
                                </span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                    Ngưng hoạt động
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="openEditModal({{ $user->user_id }}, '{{ addslashes($user->full_name) }}', '{{ $user->email }}', '{{ $user->phone_number }}', '{{ $user->role }}', '{{ $user->status }}')" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-gray-700 text-xs font-bold rounded-lg border border-gray-300 hover:bg-gray-50 transition shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Chưa có nhân viên nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($employees->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm nhân viên mới" action="{{ route('admin.employees.store') }}" method="POST">
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="full_name" label="Họ và tên" placeholder="Nguyễn Văn A" required />
        <x-admin.input name="phone_number" label="Số điện thoại" placeholder="090..." />
    </div>
    
    <div class="grid grid-cols-1 gap-4 mt-4">
        <x-admin.input name="email" label="Email" type="email" placeholder="email@example.com" required />
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <x-admin.input name="password" label="Mật khẩu" type="password" required />
        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" required />
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Chức vụ <span class="text-red-500">*</span></label>
            <select name="role" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition">
                <option value="employee">Nhân viên</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
    </div>
</x-admin.form-modal>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('editModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa thông tin</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="px-6 py-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                            <input type="text" name="full_name" id="edit_full_name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="text" name="phone_number" id="edit_phone_number" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="edit_email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="password" label="Mật khẩu mới (tùy chọn)" type="password" />
                        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Chức vụ</label>
                            <select name="role" id="edit_role" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition">
                                <option value="employee">Nhân viên</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                            <select name="status" id="edit_status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition">
                                <option value="active">Đang hoạt động</option>
                                <option value="inactive">Ngưng hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-check"></i><span>Lưu thay đổi</span>
                    </button>
                    <button type="button" onclick="closeModal('editModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i><span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, fullName, email, phone, role, status) {
        document.getElementById('editForm').action = '/admin/employees/' + id;
        document.getElementById('edit_full_name').value = fullName;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone_number').value = phone || '';
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_status').value = status;
        
        openModal('editModal');
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
