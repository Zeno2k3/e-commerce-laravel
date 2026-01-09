{{-- Admin Textarea Component --}}
@props([
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'rows' => 3,
    'id' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $id ?? $name }}" class="block text-gray-800 font-semibold mb-2">{{ $label }}</label>
    @endif
    <textarea 
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 text-gray-600 placeholder-gray-400 bg-transparent border-2 border-gray-200 rounded-lg focus:border-purple-500 focus:ring-0 transition resize-none']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
