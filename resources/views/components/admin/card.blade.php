{{-- Admin Card Component --}}
@props([
    'title' => '',
    'subtitle' => null,
    'email' => null,
    'phone' => null,
    'status' => 'active',
    'id' => null,
    'onEdit' => null,
    'onDelete' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white border-b border-gray-100 py-5 px-6 hover:bg-gray-50/50 transition']) }}>
    <div class="flex items-start justify-between">
        {{-- Left: Info --}}
        <div class="flex-1">
            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $title }}</h3>
            <div class="space-y-1 text-sm text-gray-600">
                @if($subtitle)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user text-gray-400 w-4"></i>
                        <span>{{ $subtitle }}</span>
                    </div>
                @endif
                @if($email)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-gray-400 w-4"></i>
                        <span>{{ $email }}</span>
                    </div>
                @endif
                @if($phone)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-gray-400 w-4"></i>
                        <span>{{ $phone }}</span>
                    </div>
                @endif
            </div>
        </div>
        
        {{-- Right: Status + Actions --}}
        <div class="flex flex-col items-end gap-3">
            <x-admin.status-badge :status="$status" />
            <x-admin.action-buttons :id="$id" :onEdit="$onEdit" :onDelete="$onDelete" />
        </div>
    </div>
</div>
