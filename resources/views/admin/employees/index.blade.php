@extends('admin.layouts.app')

@section('title', 'Quản lý tài khoản quản lý')

@section('add_button')
<button onclick="openModal('createModal')" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-200 transition">
    <i class="fa-solid fa-user-plus"></i>
</button>
@endsection

@section('content')
<div class="bg-white min-h-full">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($employees->count() > 0)
        @foreach($employees as $user)
            <x-admin.card 
                :title="$user->full_name"
                :subtitle="$user->role == 'admin' ? 'Quản lý' : 'Nhân viên'"
                :email="$user->email"
                :phone="$user->phone_number"
                :status="$user->status"
                :id="$user->user_id"
                :onEdit="'openEditModal(' . $user->user_id . ', \'' . addslashes($user->full_name) . '\', \'' . $user->email . '\', \'' . $user->phone_number . '\', \'' . $user->role . '\', \'' . $user->status . '\')'"
                :onDelete="'deleteEmployee(' . $user->user_id . ')'"
            />
        @endforeach
        
        @if($employees->hasPages())
            <div class="px-6 py-4 flex justify-center">
                {{ $employees->links() }}
            </div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-users-slash text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có dữ liệu tài khoản nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm tài khoản mới" action="{{ route('admin.employees.store') }}" method="POST">
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="full_name" label="Họ và tên" placeholder="Nguyễn Văn Quản Lý" required />
        <x-admin.input name="phone_number" label="Số điện thoại" placeholder="0123456789" />
    </div>
    <x-admin.input name="email" label="Nhập email" type="email" placeholder="email@example.com" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="password" label="Nhập mật khẩu" type="password" placeholder="Nhập mật khẩu" required />
        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" placeholder="Nhập lại mật khẩu" required />
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <x-admin.select name="role" label="Chức vụ" :options="['admin' => 'Quản lý', 'employee' => 'Nhân viên']" />
        <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
    </div>
</x-admin.form-modal>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 transition-opacity" onclick="closeModal('editModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa tài khoản</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="px-6 py-6">
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="edit_full_name" label="Họ và tên" placeholder="Nguyễn Văn Quản Lý" required />
                        <x-admin.input name="edit_phone_number" label="Số điện thoại" placeholder="0123456789" />
                    </div>
                    <x-admin.input name="edit_email" label="Nhập email" type="email" placeholder="email@example.com" required />
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="password" label="Nhập mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" placeholder="Nhập lại mật khẩu" />
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <x-admin.select name="role" label="Chức vụ" :options="['admin' => 'Quản lý', 'employee' => 'Nhân viên']" />
                        <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-floppy-disk"></i><span>Lưu</span>
                    </button>
                    <button type="button" onclick="closeModal('editModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i><span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Form --}}
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function openEditModal(id, fullName, email, phone, role, status) {
        document.getElementById('editForm').action = '/admin/employees/' + id;
        document.getElementById('edit_full_name').value = fullName;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone_number').value = phone || '';
        document.querySelector('#editModal select[name="role"]').value = role;
        document.querySelector('#editModal select[name="status"]').value = status;
        openModal('editModal');
    }

    function deleteEmployee(id) {
        if(confirm('Bạn có chắc muốn xóa tài khoản này?')) {
            const form = document.getElementById('deleteForm');
            form.action = '/admin/employees/' + id;
            form.submit();
        }
    }
</script>
@endsection
