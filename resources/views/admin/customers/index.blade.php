@extends('admin.layouts.app')
@section('title', 'Quản lý người dùng')

@section('add_button')
<button onclick="openModal('createModal')" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-200 transition">
    <i class="fa-solid fa-user-plus"></i>
</button>
@endsection

@section('content')
<div class="p-6">
    <div class="bg-gray-50 min-h-full rounded-2xl shadow-sm p-6">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        @if($customers->count() > 0)
            @foreach($customers as $customer)
                <x-admin.card 
                    :title="$customer->full_name"
                    subtitle="Khách hàng"
                    :email="$customer->email"
                    :phone="$customer->phone_number"
                    :status="$customer->status"
                    :id="$customer->user_id"
                    :onEdit="'openEditModal(' . $customer->user_id . ', \'' . addslashes($customer->full_name) . '\', \'' . $customer->email . '\', \'' . $customer->phone_number . '\', \'' . $customer->status . '\')'"
                    :onDelete="'deleteItem(' . $customer->user_id . ')'"
                />
            @endforeach
            
            @if($customers->hasPages())
                <div class="px-6 py-4 flex justify-center">{{ $customers->links() }}</div>
            @endif
        @else
            <div class="py-24 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fa-solid fa-users-slash text-3xl text-gray-300"></i>
                </div>
                <p class="text-gray-500 font-medium">Chưa có người dùng nào</p>
            </div>
        @endif
    </div>
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm người dùng mới" action="{{ route('admin.customers.store') }}" method="POST">
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="full_name" label="Họ và tên" placeholder="Nguyễn Văn A" required />
        <x-admin.input name="phone_number" label="Số điện thoại" placeholder="0123456789" />
    </div>
    <x-admin.input name="email" label="Email" type="email" placeholder="email@example.com" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="password" label="Mật khẩu" type="password" placeholder="Nhập mật khẩu" required />
        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" placeholder="Nhập lại mật khẩu" required />
    </div>
    <div class="mt-4">
        <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Đang hoạt động', 'inactive' => 'Ngưng hoạt động']" />
    </div>
</x-admin.form-modal>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('editModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa người dùng</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="px-6 py-6">
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="edit_full_name" label="Họ và tên" placeholder="Nguyễn Văn A" required />
                        <x-admin.input name="edit_phone_number" label="Số điện thoại" placeholder="0123456789" />
                    </div>
                    <x-admin.input name="edit_email" label="Email" type="email" placeholder="email@example.com" required />
                    <div class="grid grid-cols-2 gap-4">
                        <x-admin.input name="password" label="Mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        <x-admin.input name="password_confirmation" label="Nhập lại mật khẩu" type="password" placeholder="Nhập lại mật khẩu" />
                    </div>
                    <div class="mt-4">
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

<form id="deleteForm" method="POST" style="display: none;">@csrf @method('DELETE')</form>

<script>
    function openEditModal(id, fullName, email, phone, status) {
        document.getElementById('editForm').action = '/admin/customers/' + id;
        document.getElementById('edit_full_name').value = fullName;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone_number').value = phone || '';
        document.querySelector('#editModal select[name="status"]').value = status;
        openModal('editModal');
    }
    function deleteItem(id) {
        if(confirm('Bạn có chắc muốn xóa?')) {
            document.getElementById('deleteForm').action = '/admin/customers/' + id;
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection
