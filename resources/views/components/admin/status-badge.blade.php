{{-- Admin Status Badge Component --}}
@props(['status' => 'active', 'text' => null])

@php
    $statusConfig = [
        'active' => ['text' => 'ĐANG HOẠT ĐỘNG', 'class' => 'bg-green-50 text-green-600 border-green-200'],
        'inactive' => ['text' => 'NGƯNG HOẠT ĐỘNG', 'class' => 'bg-gray-100 text-gray-500 border-gray-200'],
    ];
    $config = $statusConfig[$status] ?? $statusConfig['active'];
    $displayText = $text ?? $config['text'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border {$config['class']}"]) }}>
    {{ $displayText }}
</span>
