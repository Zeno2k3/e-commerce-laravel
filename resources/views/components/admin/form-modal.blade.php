@props([
    'id' => 'modal',
    'title' => 'Form',
    'action' => '#',
    'method' => 'POST',
    'maxWidth' => 'max-w-lg', // Default width
])

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'fixed inset-0 z-50 hidden overflow-y-auto']) }} role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/40 transition-opacity" onclick="closeModal('{{ $id }}')"></div>
    
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-xl w-full {{ $maxWidth }} transform transition-all">
            @if($title)
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">{{ $title }}</h3>
                </div>
            @endif
            
            <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" enctype="multipart/form-data">
                @csrf
                @if(!in_array($method, ['GET', 'POST']))
                    @method($method)
                @endif
                
                <div class="px-6 py-6">{{ $slot }}</div>
                
                <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-500 text-white font-semibold rounded-xl hover:bg-purple-600 transition">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Lưu</span>
                    </button>
                    <button type="button" onclick="closeModal('{{ $id }}')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-xmark"></i>
                        <span>Hủy</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
