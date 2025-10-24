@php
    $styles = [
        'primary' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        'outline' => 'border border-gray-400 text-gray-700 hover:bg-gray-100',
    ];
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "px-4 py-2 rounded-lg font-semibold transition duration-200 {$styles[$variant]}"]) }}>
    {{ $slot }}
</button>
