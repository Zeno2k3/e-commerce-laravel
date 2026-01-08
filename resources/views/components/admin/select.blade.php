{{-- Admin Select Component --}}
@props([
    'name' => '',
    'label' => '',
    'options' => [],
    'value' => '',
])

<div class="relative">
    <select 
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'appearance-none w-full px-5 py-3 bg-purple-500 text-white font-semibold rounded-xl cursor-pointer hover:bg-purple-600 focus:ring-2 focus:ring-purple-300 transition']) }}
    >
        <option value="" disabled {{ empty($value) ? 'selected' : '' }}>{{ $label }}</option>
        @foreach($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
        @endforeach
    </select>
    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
        <i class="fa-solid fa-chevron-down text-white"></i>
    </div>
</div>
