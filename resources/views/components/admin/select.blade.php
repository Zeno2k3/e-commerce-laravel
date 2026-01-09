{{-- Admin Select Component --}}
@props([
    'name' => '',
    'label' => '',
    'options' => [],
    'value' => '',
    'id' => null,
    'iconPosition' => 'right-5 inset-y-0 flex items-center',
])

<div class="relative">
    <select 
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        {{ $attributes->merge(['class' => 'appearance-none w-full pl-5 pr-12 py-3.5 bg-purple-500 text-white font-semibold rounded-xl cursor-pointer hover:bg-purple-600 focus:ring-2 focus:ring-purple-300 transition']) }}
    >
        <option value="" disabled {{ empty($value) ? 'selected' : '' }}>{{ $label }}</option>
        @foreach($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
        @endforeach
    </select>
    <div class="absolute {{ $iconPosition }} pointer-events-none">
        <i class="fa-solid fa-chevron-down text-white"></i>
    </div>
</div>
