@extends('admin.layouts.app')
@section('title', 'Quản lý Nhà cung cấp')

@section('add_button')
<button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition text-sm">
    <i class="fa-solid fa-plus"></i>
    <span>Thêm NCC</span>
</button>
@endsection

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    @if($suppliers->count() > 0)
        <div class="bg-gray-50 rounded-2xl shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Danh sách nhà cung cấp</h3>
                    <p class="text-sm text-gray-500">Quản lý thông tin các đối tác cung ứng</p>
                </div>
                <!-- Search -->
                <div class="w-full md:w-1/3">
                    <form action="{{ route('admin.suppliers.index') }}" method="GET" class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="w-full pl-10 pr-4 py-2 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-purple-500 transition placeholder-gray-400 text-sm"
                               placeholder="Tìm kiếm nhà cung cấp...">
                    </form>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-100">
                <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tên NCC</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">SĐT</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Địa chỉ</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Trạng thái</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($suppliers as $supplier)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $supplier->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $supplier->email ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $supplier->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ $supplier->address ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $supplier->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $supplier->status === 'active' ? 'Hoạt động' : 'Ngưng' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal({{ $supplier->supplier_id }}, '{{ addslashes($supplier->name) }}', '{{ $supplier->email }}', '{{ $supplier->phone }}', '{{ addslashes($supplier->address ?? '') }}', '{{ $supplier->status }}')" 
                                        class="text-purple-600 hover:text-purple-800 mr-3">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="deleteItem({{ $supplier->supplier_id }})" class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($suppliers->hasPages())
            <div class="mt-6 flex justify-center">{{ $suppliers->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-truck text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có nhà cung cấp nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Thêm Nhà cung cấp" action="{{ route('admin.suppliers.store') }}" method="POST">
    <x-admin.input name="name" label="Tên nhà cung cấp" placeholder="Công ty ABC" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="email" label="Email" type="email" placeholder="contact@abc.com" />
        <x-admin.input name="phone" label="Số điện thoại" placeholder="0901234567" />
    </div>
    <x-admin.input name="address" label="Địa chỉ" placeholder="123 Đường ABC, Quận 1, TP.HCM" />
    <x-admin.select name="status" label="Trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Ngưng hoạt động']" required />
</x-admin.form-modal>

{{-- Edit Modal --}}
<x-admin.form-modal id="editModal" title="Chỉnh sửa Nhà cung cấp" :action="''" method="PUT">
    <x-admin.input name="name" id="edit_name" label="Tên nhà cung cấp" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="email" id="edit_email" label="Email" type="email" />
        <x-admin.input name="phone" id="edit_phone" label="Số điện thoại" />
    </div>
    <x-admin.input name="address" id="edit_address" label="Địa chỉ" />
    <x-admin.select name="status" id="edit_status" label="Trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Ngưng hoạt động']" required />
</x-admin.form-modal>

{{-- Delete Form --}}
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
function openEditModal(id, name, email, phone, address, status) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email || '';
    document.getElementById('edit_phone').value = phone || '';
    document.getElementById('edit_address').value = address || '';
    document.getElementById('edit_status').value = status;
    document.getElementById('editModal').querySelector('form').action = `/admin/suppliers/${id}`;
    openModal('editModal');
}

function deleteItem(id) {
    if (confirm('Bạn có chắc muốn xóa nhà cung cấp này?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/suppliers/${id}`;
        form.submit();
    }
}
</script>
@endpush
@endsection
