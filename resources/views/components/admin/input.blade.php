{{-- Admin Input Component --}}
@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-gray-800 font-semibold mb-2">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-0 py-2 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b-2 border-gray-200 focus:border-purple-500 focus:ring-0 transition']) }}
    >
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
