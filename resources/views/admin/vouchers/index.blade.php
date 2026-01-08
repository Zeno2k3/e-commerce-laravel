@extends('admin.layouts.app')
@section('title', 'Quản lý Voucher')

@section('add_button')
<button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition text-sm">
    <i class="fa-solid fa-plus"></i>
    <span>Tạo voucher</span>
</button>
@endsection

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if($vouchers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($vouchers as $voucher)
                <div class="bg-white border border-purple-200 rounded-2xl p-5 hover:shadow-lg transition relative overflow-hidden">
                    {{-- Left purple accent --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-purple-500"></div>
                    
                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-base font-bold text-gray-900 uppercase leading-tight pr-4">
                            {{ $voucher->description ?? 'CHÀO MỪNG THÀNH VIÊN MỚI' }}
                        </h3>
                        <div class="text-right flex-shrink-0">
                            <div class="flex items-center gap-1 text-gray-500 text-xs">
                                <i class="fa-solid fa-calendar"></i>
                                <span>{{ $voucher->start_date ? date('d/m/Y', strtotime($voucher->start_date)) : '01/01/2026' }} -</span>
                            </div>
                            <div class="text-gray-500 text-xs">{{ $voucher->end_date ? date('d/m/Y', strtotime($voucher->end_date)) : '31/12/2026' }}</div>
                        </div>
                    </div>
                    
                    {{-- Discount Info --}}
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-purple-600 font-bold text-xl">
                                @if($voucher->discount_percentage > 0)
                                    Giảm {{ $voucher->discount_percentage }}%
                                @else
                                    Free Ship
                                @endif
                            </p>
                            <p class="text-gray-500 text-sm">{{ $voucher->usage_conditions ?? 'Đơn tối thiểu 300.000đ' }}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold {{ $voucher->status ? 'bg-green-50 text-green-600 border border-green-200' : 'bg-orange-50 text-orange-600 border border-orange-200' }}">
                            {{ $voucher->status ? 'CÒN HOẠT ĐỘNG' : 'NGƯNG HOẠT ĐỘNG' }}
                        </span>
                    </div>
                    
                    {{-- Footer --}}
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <span class="font-bold text-gray-900 text-lg tracking-wide">{{ $voucher->voucher_code }}</span>
                        <div class="flex items-center gap-3">
                            <button onclick="openEditModal({{ $voucher->voucher_id }}, '{{ addslashes($voucher->description ?? '') }}', '{{ $voucher->voucher_code }}', '{{ addslashes($voucher->usage_conditions ?? '') }}', {{ $voucher->max_discount_value ?? 0 }}, '{{ $voucher->start_date }}', '{{ $voucher->end_date }}', {{ $voucher->status ? 1 : 0 }}, {{ $voucher->discount_percentage ?? 0 }})" 
                                    class="text-gray-500 hover:text-purple-600 text-sm flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Chỉnh sửa</span>
                            </button>
                            <button onclick="deleteItem({{ $voucher->voucher_id }})" class="text-gray-500 hover:text-red-600 text-sm flex items-center gap-1">
                                <i class="fa-solid fa-xmark"></i>
                                <span>Xóa</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($vouchers->hasPages())
            <div class="mt-6 flex justify-center">{{ $vouchers->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-ticket text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có voucher nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Tạo Voucher mới" action="{{ route('admin.vouchers.store') }}" method="POST">
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="description" label="Tên voucher" placeholder="CHÀO MỪNG THÀNH VIÊN MỚI" required />
        <x-admin.input name="voucher_code" label="Mã voucher" placeholder="WELCOME50" required />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="usage_conditions" label="Điều kiện" placeholder="Đơn tối thiểu 300.000đ" />
        <x-admin.input name="discount_percentage" label="% Giảm giá" type="number" placeholder="50" required />
    </div>
    <div class="grid grid-cols-2 gap-4">
        <x-admin.input name="start_date" label="Ngày bắt đầu" type="date" required />
        <x-admin.input name="end_date" label="Ngày kết thúc" type="date" required />
    </div>
    <input type="hidden" name="quantity" value="100">
    <div class="mt-4">
        <x-admin.select name="status" label="Trạng thái" :options="['1' => 'Còn hoạt động', '0' => 'Ngưng hoạt động']" />
    </div>
</x-admin.form-modal>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog">
    <div class="fixed inset-0 bg-black/40" onclick="closeModal('editModal')"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900">Chỉnh sửa Voucher</h3>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="px-6 py-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tên voucher</label>
                            <input type="text" name="description" id="edit_description" placeholder="CHÀO MỪNG THÀNH VIÊN MỚI" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mã voucher</label>
                            <input type="text" name="voucher_code" id="edit_voucher_code" placeholder="WELCOME50" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Điều kiện</label>
                            <input type="text" name="usage_conditions" id="edit_usage_conditions" placeholder="Đơn tối thiểu 300.000đ" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">% Giảm giá</label>
                            <input type="number" name="discount_percentage" id="edit_discount_percentage" placeholder="50" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ngày bắt đầu</label>
                            <input type="date" name="start_date" id="edit_start_date" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ngày kết thúc</label>
                            <input type="date" name="end_date" id="edit_end_date" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400">
                        </div>
                    </div>
                    <input type="hidden" name="quantity" value="100">
                    <x-admin.select name="status" label="Trạng thái" :options="['1' => 'Còn hoạt động', '0' => 'Ngưng hoạt động']" />
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
    function openEditModal(id, desc, code, conditions, maxDiscount, startDate, endDate, status, discountPercent) {
        document.getElementById('editForm').action = '/admin/vouchers/' + id;
        document.getElementById('edit_description').value = desc;
        document.getElementById('edit_voucher_code').value = code;
        document.getElementById('edit_usage_conditions').value = conditions;
        document.getElementById('edit_discount_percentage').value = discountPercent;
        document.getElementById('edit_start_date').value = startDate;
        document.getElementById('edit_end_date').value = endDate;
        document.querySelector('#editModal select[name="status"]').value = status;
        openModal('editModal');
    }
    function deleteItem(id) {
        if(confirm('Bạn có chắc muốn xóa?')) {
            document.getElementById('deleteForm').action = '/admin/vouchers/' + id;
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection
