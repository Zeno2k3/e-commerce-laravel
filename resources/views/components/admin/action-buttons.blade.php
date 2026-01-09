{{-- Admin Action Buttons Component --}}
@props(['id' => null, 'onEdit' => null, 'editUrl' => null, 'onDelete' => null])

<div class="flex items-center gap-2">
    @if($editUrl)
        <a href="{{ $editUrl }}" 
           class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            <i class="fa-solid fa-pen-to-square text-xs"></i>
            <span>Chỉnh sửa</span>
        </a>
    @elseif($onEdit)
        <button onclick="{{ $onEdit }}" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            <i class="fa-solid fa-pen-to-square text-xs"></i>
            <span>Chỉnh sửa</span>
        </button>
    @endif

    @if($onDelete)
        <button onclick="{{ $onDelete }}" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-red-50 hover:text-red-600 transition">
            <i class="fa-solid fa-xmark text-xs"></i>
            <span>Xóa</span>
        </button>
    @endif
</div>
