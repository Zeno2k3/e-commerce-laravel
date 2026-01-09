@extends('admin.layouts.app')
@section('title', 'Quản lý Sự kiện ưu đãi')

@section('add_button')
<button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition text-sm">
    <i class="fa-solid fa-plus"></i>
    <span>Thêm sự kiện</span>
</button>
@endsection

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($events->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tên sự kiện</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Ngày bắt đầu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Ngày kết thúc</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">% Giảm</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Mô tả</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Trạng thái</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($events as $event)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $event->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $event->start_date->format('H:i d/m/Y') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $event->end_date->format('H:i d/m/Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-3 py-1 rounded-full text-sm font-bold text-purple-600 bg-purple-50">
                                    {{ $event->discount_percent }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ $event->description ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'active' => 'bg-green-100 text-green-700',
                                        'inactive' => 'bg-gray-100 text-gray-600',
                                        'expired' => 'bg-red-100 text-red-600',
                                    ];
                                    $statusLabels = [
                                        'active' => 'Còn hoạt động',
                                        'inactive' => 'Tạm dừng',
                                        'expired' => 'Hết hạn',
                                    ];
                                @endphp
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$event->status] ?? '' }}">
                                    {{ $statusLabels[$event->status] ?? $event->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal({{ $event->event_id }}, '{{ addslashes($event->name) }}', '{{ $event->start_date->format('Y-m-d\TH:i') }}', '{{ $event->end_date->format('Y-m-d\TH:i') }}', {{ $event->discount_percent }}, '{{ addslashes($event->description ?? '') }}', '{{ $event->status }}')" 
                                        class="text-purple-600 hover:text-purple-800 mr-3">
                                    <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($events->hasPages())
            <div class="mt-6 flex justify-center">{{ $events->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-calendar-star text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có sự kiện ưu đãi nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Tạo Sự kiện ưu đãi" action="{{ route('admin.events.store') }}" method="POST">
    <x-admin.input name="name" label="Tên sự kiện" placeholder="Flash Sale 11/11" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="start_date" label="Ngày bắt đầu" type="datetime-local" required />
        <x-admin.input name="end_date" label="Ngày kết thúc" type="datetime-local" required />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="discount_percent" label="Phần trăm giảm (%)" type="number" min="1" max="100" placeholder="50" required />
        <div>
            
            <x-admin.select name="status" label="Chọn trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Tạm dừng']" required />
        </div>
    </div>
    <x-admin.textarea name="description" label="Mô tả" placeholder="Mô tả sự kiện..." />
</x-admin.form-modal>

{{-- Edit Modal --}}
<x-admin.form-modal id="editModal" title="Chỉnh sửa Sự kiện" :action="''" method="PUT">
    <x-admin.input name="name" id="edit_name" label="Tên sự kiện" required />
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="start_date" id="edit_start_date" label="Ngày bắt đầu" type="datetime-local" required />
        <x-admin.input name="end_date" id="edit_end_date" label="Ngày kết thúc" type="datetime-local" required />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="discount_percent" id="edit_discount_percent" label="Phần trăm giảm (%)" type="number" required />
        <div>
            <label class="block text-gray-800 font-semibold mb-2">Trạng thái</label>
            <x-admin.select name="status" id="edit_status" label="Chọn trạng thái" :options="['active' => 'Hoạt động', 'inactive' => 'Tạm dừng', 'expired' => 'Hết hạn']" required />
        </div>
    </div>
    <x-admin.textarea name="description" id="edit_description" label="Mô tả" />
</x-admin.form-modal>

@push('scripts')
<script>
function openEditModal(id, name, startDate, endDate, discountPercent, description, status) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_start_date').value = startDate;
    document.getElementById('edit_end_date').value = endDate;
    document.getElementById('edit_discount_percent').value = discountPercent;
    document.getElementById('edit_description').value = description || '';
    document.getElementById('edit_status').value = status;
    document.getElementById('editModal').querySelector('form').action = `/admin/events/${id}`;
    openModal('editModal');
}
</script>
@endpush
@endsection
