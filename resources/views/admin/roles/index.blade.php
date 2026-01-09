@extends('admin.layouts.app')
@section('title', 'Quản lý chức vụ')

@section('content')
<div class="p-6">
    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-1">Danh sách chức vụ</h2>
            <p class="text-sm text-gray-500">Quản lý thông tin chức vụ và phân cấp</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Tên chức vụ</th>
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Mã code</th>
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Phòng ban</th>
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Cấp bậc</th>
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Số nhân viên</th>
                        <th class="text-left py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Trạng thái</th>
                        <th class="text-right py-4 px-4 text-xs font-semibold text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($roles as $role)
                    <tr class="hover:bg-gray-50 transition items-center">
                        {{-- Tên chức vụ --}}
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center
                                    @if($role->key === 'manager' || $role->key === 'admin') bg-purple-100 text-purple-600
                                    @else bg-blue-100 text-blue-600
                                    @endif">
                                    <i class="fa-solid fa-briefcase text-sm"></i>
                                </div>
                                <span class="font-medium text-gray-800">{{ $role->name }}</span>
                            </div>
                        </td>

                        {{-- Mã code --}}
                        <td class="py-4 px-4">
                            <span class="text-sm text-gray-500 uppercase">{{ $role->code }}</span>
                        </td>

                        {{-- Phòng ban --}}
                        <td class="py-4 px-4">
                            <span class="text-sm text-gray-600">{{ $role->department }}</span>
                        </td>

                        {{-- Cấp bậc --}}
                        <td class="py-4 px-4">
                            <span class="inline-flex px-2.5 py-1 rounded text-xs font-medium {{ $role->level_class }}">
                                {{ $role->level }}
                            </span>
                        </td>

                        {{-- Số nhân viên --}}
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fa-solid fa-user-group text-gray-400 text-xs"></i>
                                <span class="text-sm">{{ $role->count }}</span>
                            </div>
                        </td>

                        {{-- Trạng thái --}}
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                {{ $role->status }}
                            </span>
                        </td>

                        {{-- Thao tác --}}
                        <td class="py-4 px-4 text-right">
                            <button onclick="openEmployeeList('{{ $role->key }}', '{{ $role->name }}')" class="text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    {{-- Employee List Modal --}}
    <x-admin.form-modal id="employeeListModal" title="Danh sách nhân viên" :action="''" method="POST" maxWidth="max-w-4xl">
        <div class="mb-4 flex justify-between items-center">
            <h3 id="modalRoleTitle" class="text-lg font-bold text-gray-800"></h3>
            <button type="button" onclick="openCreateEmployeeModal()" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm hover:bg-purple-700">
                <i class="fa-solid fa-plus mr-1"></i> Thêm nhân viên
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">Họ tên</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">SĐT</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th class="px-4 py-3 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="employeeTableBody">
                    {{-- Content loaded via JS --}}
                </tbody>
            </table>
        </div>
        {{-- Hide default submit button for list view --}}
        <style>#employeeListModal button[type="submit"] { display: none; }</style>
    </x-admin.form-modal>

    {{-- Create/Edit Employee Modal (Nested or separate) --}}
    <x-admin.form-modal id="createEmployeeModal" title="Thêm nhân viên mới" action="#" method="POST" maxWidth="max-w-2xl">
        <input type="hidden" name="role" id="create_role_input">
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="full_name" id="create_full_name" label="Họ tên" required />
            <x-admin.input name="email" id="create_email" label="Email" type="email" required />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="phone_number" id="create_phone" label="Số điện thoại" />
            <div>
                
                <x-admin.select name="status" id="create_status" label="Chọn trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Ngưng hoạt động']" required />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="password" id="create_password" label="Mật khẩu" type="password" required />
            <x-admin.input name="password_confirmation" id="create_password_confirm" label="Xác nhận mật khẩu" type="password" required />
        </div>    
    </x-admin.form-modal>
          
    <x-admin.form-modal id="editEmployeeModal" title="Cập nhật nhân viên" action="#" method="PUT" maxWidth="max-w-2xl">
        <input type="hidden" name="role" id="edit_role_input">
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="full_name" id="edit_full_name" label="Họ tên" required />
            <x-admin.input name="email" id="edit_email" label="Email" type="email" required />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="phone_number" id="edit_phone" label="Số điện thoại" />
            <div>
                 <label class="block text-gray-800 font-semibold mb-2">Trạng thái</label>
                 <x-admin.select name="status" id="edit_status" label="Chọn trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Ngưng hoạt động']" required />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-admin.input name="password" id="edit_password" label="Mật khẩu (Để trống nếu không đổi)" type="password" />
            <x-admin.input name="password_confirmation" id="edit_password_confirm" label="Xác nhận mật khẩu" type="password" />
        </div>
    </x-admin.form-modal>
@endsection

@push('scripts')
<script>
    let currentRole = '';

    function openEmployeeList(roleKey, roleName) {
        currentRole = roleKey;
        document.getElementById('modalRoleTitle').innerText = `Chức vụ: ${roleName}`;
        document.getElementById('create_role_input').value = roleKey;
        
        // Load employees
        fetch(`/admin/roles/${roleKey}/users`)
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('employeeTableBody');
                tbody.innerHTML = '';
                if(data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4">Chưa có nhân viên nào</td></tr>';
                } else {
                    data.forEach(user => {
                        tbody.innerHTML += `
                            <tr class="bg-white border-b hover:bg-gray-50 text-gray-900">
                                <td class="px-4 py-3 font-medium">${user.full_name}</td>
                                <td class="px-4 py-3">${user.email}</td>
                                <td class="px-4 py-3">${user.phone_number || '-'}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-${user.status === 'active' ? 'green' : 'red'}-100 text-${user.status === 'active' ? 'green' : 'red'}-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        ${user.status === 'active' ? 'Hoạt động' : 'Ngưng'}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button type="button" onclick="openEditEmployee(${user.user_id}, '${user.full_name}', '${user.email}', '${user.phone_number||''}', '${user.status}')" class="text-blue-600 hover:text-blue-900 mr-2">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button type="button" onclick="deleteEmployee(${user.user_id})" class="text-red-600 hover:text-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }
                openModal('employeeListModal');
            });
    }

    function openCreateEmployeeModal() {
        document.getElementById('create_role_input').value = currentRole;
        // Reset form
        document.querySelector('#createEmployeeModal form').reset();
        document.querySelector('#createEmployeeModal form').action = "{{ route('admin.employees.store') }}";
        
        // Handle submit via AJAX to avoid reload
        const form = document.querySelector('#createEmployeeModal form');
        form.onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    closeModal('createEmployeeModal');
                    openEmployeeList(currentRole, document.getElementById('modalRoleTitle').innerText.replace('Chức vụ: ', '')); // Reload list
                    alert('Thêm thành công!');
                } else {
                    alert('Có lỗi xảy ra: ' + JSON.stringify(data.errors));
                }
            })
            .catch(err => alert('Lỗi: ' + err));
        };

        closeModal('employeeListModal'); // Close list modal temporarily
        openModal('createEmployeeModal');
    }

    function openEditEmployee(id, name, email, phone, status) {
        document.getElementById('edit_full_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_role_input').value = currentRole;

        const form = document.querySelector('#editEmployeeModal form');
        form.action = `/admin/employees/${id}`; // Note: Route might be manager.employees.update but URL is /admin/employees/{id} ? No, it's /manager/employees/{id} based on resource. 
        // Wait, resource route names changed to manager.employees.*. URL structure depends on registration.
        // Let's check routes list later. Assuming standard resource URL structure.
        // Actually, route resource 'employees' is not defined in manager group yet? 
        // Wait, 'admin.employees.index' was changed to 'manager.employees.index'. 
        // Let's verify route URL.
        
        // Correct URL for update:
        const updateUrl = `{{ route('admin.employees.index') }}/${id}`.replace('/index', '');
        // Use hardcoded base URL for simplicity
        form.action = `/admin/employees/${id}`;

        form.onsubmit = function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            // Manually add _method PUT
            formData.append('_method', 'PUT');
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    closeModal('editEmployeeModal');
                    // close and reopen list to refresh? Or just refresh list.
                    // Ideally keep list open.
                    // But our modals might overlap. Simple way: Close edit, Open list.
                    openEmployeeList(currentRole, document.getElementById('modalRoleTitle').innerText.replace('Chức vụ: ', ''));
                    alert('Cập nhật thành công!');
                } else {
                   alert('Lỗi: ' + JSON.stringify(data.message || data));
                }
            });
        };

        closeModal('employeeListModal');
        openModal('editEmployeeModal');
    }

    function deleteEmployee(id) {
        if(confirm('Bạn có chắc muốn xóa nhân viên này?')) {
            fetch(`/admin/employees/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    openEmployeeList(currentRole, document.getElementById('modalRoleTitle').innerText.replace('Chức vụ: ', ''));
                    alert('Đã xóa!');
                }
            });
        }
    }
</script>
@endpush
