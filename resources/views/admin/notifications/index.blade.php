@extends('admin.layouts.app')
@section('title', 'Quản lý thông báo')

@section('add_button')
<button onclick="openModal('createModal')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition text-sm">
    <i class="fa-solid fa-plus"></i>
    <span>Tạo thông báo</span>
</button>
@endsection

@section('content')
<div class="p-6">
    <div class="bg-gray-50 min-h-full rounded-2xl shadow-sm p-6">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Danh sách thông báo</h3>
                <p class="text-sm text-gray-500">Quản lý các thông báo gửi đến người dùng</p>
            </div>
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="group relative bg-white border border-gray-100 rounded-xl p-5 hover:bg-gray-50 transition-all hover:shadow-md">
                        <div class="flex items-start gap-4">
                            {{-- Icon based on type --}}
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                @if($notification->type === 'promotion') bg-pink-100 text-pink-500
                                @elseif($notification->type === 'policy') bg-blue-100 text-blue-500
                                @else bg-gray-100 text-gray-500
                                @endif">
                                @if($notification->type === 'promotion') 
                                    <i class="fa-solid fa-gift text-xl"></i>
                                @elseif($notification->type === 'policy') 
                                    <i class="fa-solid fa-shield-halved text-xl"></i>
                                @else 
                                    <i class="fa-solid fa-bell text-xl"></i>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                            @if($notification->type === 'promotion') bg-pink-100 text-pink-600
                                            @elseif($notification->type === 'policy') bg-blue-100 text-blue-600
                                            @else bg-gray-100 text-gray-600
                                            @endif">
                                            {{ $notification->type == 'promotion' ? 'Khuyến mãi' : ($notification->type == 'policy' ? 'Chính sách' : 'Chung') }}
                                        </span>
                                        <span class="text-xs text-gray-400">• {{ $notification->created_at->format('H:i d/m/Y') }}</span>
                                    </div>
                                    
                                    {{-- Delete Button --}}
                                    <button onclick="deleteNotification({{ $notification->notification_id }})" class="text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <h4 class="text-base font-bold text-gray-800 mb-1 truncate">{{ $notification->title }}</h4>
                                <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">{{ $notification->content }}</p>
                                
                                @if($notification->event || $notification->voucher)
                                    <div class="mt-3 flex gap-3 text-xs text-gray-500 bg-gray-50 p-2 rounded-lg inline-flex">
                                        @if($notification->event)
                                            <span class="flex items-center gap-1"><i class="fa-solid fa-calendar-star text-purple-500"></i> Event: {{ $notification->event->name }}</span>
                                        @endif
                                        @if($notification->voucher)
                                            <span class="flex items-center gap-1"><i class="fa-solid fa-ticket text-orange-500"></i> Voucher: {{ $notification->voucher->voucher_code }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($notifications->hasPages())
                <div class="mt-6 flex justify-center">{{ $notifications->links() }}</div>
            @endif
        @else
            <div class="py-24 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fa-solid fa-bell-slash text-3xl text-gray-300"></i>
                </div>
                <p class="text-gray-500 font-medium">Chưa có thông báo nào</p>
            </div>
        @endif
    </div>
</div>

{{-- Create Modal --}}
<x-admin.form-modal id="createModal" title="Tạo thông báo mới" action="{{ route('admin.notifications.store') }}" method="POST">
    <x-admin.input name="title" label="Tiêu đề thông báo" placeholder="Nhập tiêu đề..." required />
    
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Loại thông báo <span class="text-red-500">*</span></label>
        <select name="type" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition" required>
            <option value="general">Thông báo chung</option>
            <option value="promotion">Khuyến mãi & Ưu đãi</option>
            <option value="policy">Chính sách & Cập nhật</option>
        </select>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung <span class="text-red-500">*</span></label>
        <textarea name="content" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition" placeholder="Nhập nội dung thông báo..." required></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <x-admin.select name="event_id" label="Gắn sự kiện (tùy chọn)" :options="$events->pluck('name', 'event_id')->toArray()" />
        <x-admin.select name="voucher_id" label="Gắn voucher (tùy chọn)" :options="$vouchers->pluck('voucher_code', 'voucher_id')->toArray()" />
    </div>
</x-admin.form-modal>

{{-- Delete Form --}}
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
function deleteNotification(id) {
    if (confirm('Bạn có chắc muốn xóa thông báo này?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/notifications/${id}`;
        form.submit();
    }
}
</script>
@endpush
@endsection
