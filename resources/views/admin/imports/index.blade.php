@extends('admin.layouts.app')
@section('title', 'Quản lý Phiếu nhập hàng')

@section('add_button')
<button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition text-sm">
    <i class="fa-solid fa-plus"></i>
    <span>Tạo phiếu nhập</span>
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

    @if($receipts->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Mã phiếu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nhà cung cấp</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Người tạo</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Số lượng</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Ngày tạo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Trạng thái</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($receipts as $receipt)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-sm text-gray-900">#{{ $receipt->receipt_id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $receipt->supplier->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $receipt->creator->full_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold bg-blue-50 text-blue-600">
                                    {{ $receipt->quantity }} SP
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $receipt->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'confirmed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-600',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Chờ xác nhận',
                                        'confirmed' => 'Đã xác nhận',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$receipt->status] ?? '' }}">
                                    {{ $statusLabels[$receipt->status] ?? $receipt->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($receipt->status === 'pending')
                                    <form action="{{ route('admin.imports.confirm', $receipt->receipt_id) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Xác nhận phiếu nhập này? Số lượng sẽ được cộng vào tồn kho.')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600">
                                            <i class="fa-solid fa-check"></i>
                                            Xác nhận
                                        </button>
                                    </form>
                                @elseif($receipt->status === 'confirmed')
                                    <span class="text-gray-400 text-sm">
                                        <i class="fa-solid fa-user-check mr-1"></i>
                                        {{ $receipt->confirmer->full_name ?? 'N/A' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($receipts->hasPages())
            <div class="mt-6 flex justify-center">{{ $receipts->links() }}</div>
        @endif
    @else
        <div class="py-24 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <i class="fa-solid fa-file-invoice text-3xl text-gray-300"></i>
            </div>
            <p class="text-gray-500 font-medium">Chưa có phiếu nhập hàng nào</p>
        </div>
    @endif
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Tạo Phiếu nhập hàng" action="{{ route('admin.imports.store') }}" method="POST">
    <x-admin.select name="supplier_id" label="Nhà cung cấp" :options="$suppliers->pluck('name', 'supplier_id')->toArray()" required />
    <x-admin.textarea name="content" label="Ghi chú" placeholder="Ghi chú cho phiếu nhập..." />
    
    <div class="border-t pt-4 mt-4">
        <h4 class="font-semibold text-gray-700 mb-3">Chi tiết sản phẩm</h4>
        <div id="importItems">
            <div class="grid grid-cols-12 gap-2 mb-2 import-item">
                <div class="col-span-6">
                    <select name="items[0][variant_id]" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Chọn sản phẩm</option>
                        @foreach($variants as $variant)
                            <option value="{{ $variant->variant_id }}">
                                {{ $variant->product->product_name ?? 'SP' }} - {{ $variant->size ?? '' }} {{ $variant->color ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <input type="number" name="items[0][quantity]" placeholder="SL" class="w-full border rounded-lg px-3 py-2 text-sm" min="1" required>
                </div>
                <div class="col-span-3">
                    <input type="number" name="items[0][unit_price]" placeholder="Đơn giá" class="w-full border rounded-lg px-3 py-2 text-sm" min="0" required>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <button type="button" onclick="addItem()" class="mt-2 text-purple-600 hover:text-purple-800 text-sm">
            <i class="fa-solid fa-plus mr-1"></i> Thêm sản phẩm
        </button>
    </div>
</x-admin.form-modal>

@push('scripts')
<script>
let itemIndex = 1;

function addItem() {
    const container = document.getElementById('importItems');
    const html = `
        <div class="grid grid-cols-12 gap-2 mb-2 import-item">
            <div class="col-span-6">
                <select name="items[${itemIndex}][variant_id]" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Chọn sản phẩm</option>
                    @foreach($variants as $variant)
                        <option value="{{ $variant->variant_id }}">
                            {{ $variant->product->product_name ?? 'SP' }} - {{ $variant->size ?? '' }} {{ $variant->color ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-2">
                <input type="number" name="items[${itemIndex}][quantity]" placeholder="SL" class="w-full border rounded-lg px-3 py-2 text-sm" min="1" required>
            </div>
            <div class="col-span-3">
                <input type="number" name="items[${itemIndex}][unit_price]" placeholder="Đơn giá" class="w-full border rounded-lg px-3 py-2 text-sm" min="0" required>
            </div>
            <div class="col-span-1 flex items-center justify-center">
                <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    itemIndex++;
}

function removeItem(btn) {
    const items = document.querySelectorAll('.import-item');
    if (items.length > 1) {
        btn.closest('.import-item').remove();
    }
}
</script>
@endpush
@endsection
