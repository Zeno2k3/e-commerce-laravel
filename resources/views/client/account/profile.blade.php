@extends('client.layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
@php
    $user = Auth::user();
@endphp

<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        
        {{-- Breadcrumb --}}
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-purple-600 transition-colors">
                        <i class="fa-solid fa-house mr-2"></i>Trang chủ
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-gray-900 font-medium">Hồ sơ cá nhân</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar --}}
            <div class="lg:w-1/4">
               @include('client.profile.partials.sidebar')
            </div>

            {{-- Main Content --}}
            <div class="flex-1">
                {{-- Header Card (Removed massive banner, kept simpler) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                     <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-1">Thông tin tài khoản</h1>
                            <p class="text-gray-500">Quản lý và cập nhật thông tin cá nhân của bạn</p>
                        </div>
                        <button onclick="openModal('editProfileModal')" 
                                class="px-5 py-2.5 bg-[#7d3cff] text-white rounded-xl hover:bg-[#6c2bd9] transition font-bold text-sm shadow-lg shadow-purple-200">
                            <i class="fa-solid fa-user-pen mr-2"></i> Chỉnh sửa
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Chi tiết hồ sơ</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Họ và tên</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $user->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Địa chỉ Email</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Số điện thoại</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $user->phone_number ?? 'Chưa cập nhật' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ngày tham gia</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
{{-- Lớp ngoài cùng dùng z-50 để đè lên tất cả --}}
<div id="editProfileModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    
       
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeModal('editProfileModal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Modal Content (Nội dung Form) --}}
        <div class="relative z-10 inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full ring-1 ring-black/5">
            
            {{-- Modal Header --}}
            <div class="h-24 bg-gradient-to-r from-blue-600 to-purple-600 flex items-center px-8 justify-between relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 opacity-50 backdrop-blur-3xl"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-white flex items-center gap-3 tracking-tight" id="modal-title">
                        <span class="bg-white/20 p-2 rounded-xl"><i class="fa-solid fa-user-pen"></i></span>
                        Chỉnh sửa hồ sơ
                    </h3>
                    <p class="text-blue-100 text-sm mt-1 font-medium">Cập nhật thông tin cá nhân của bạn</p>
                </div>
                <button type="button" onclick="closeModal('editProfileModal')" class="relative z-10 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition text-white backdrop-blur-sm">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <div class="bg-white">
                {{-- Tabs --}}
                <div class="flex border-b border-gray-100">
                    <button onclick="switchTab('info')" id="tab-info" class="flex-1 py-4 text-sm font-bold text-center border-b-2 border-purple-600 text-purple-600 bg-purple-50/50 transition-all">
                        <i class="fa-regular fa-id-card mr-2"></i>Thông tin chung
                    </button>
                    <button onclick="switchTab('password')" id="tab-password" class="flex-1 py-4 text-sm font-bold text-center border-b-2 border-transparent text-gray-400 hover:text-gray-600 hover:bg-gray-50 transition-all">
                        <i class="fa-solid fa-lock mr-2"></i>Đổi mật khẩu
                    </button>
                </div>

                <div class="p-8">
                    {{-- Info Form --}}
                    <div id="form-info" class="animate-fadeIn">
                        <form action="{{ route('client.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-5">
                                {{-- Avatar Display Only --}}
                                <div class="flex justify-center mb-6">
                                    <div class="relative">
                                        <div class="w-24 h-24 rounded-full p-1 bg-gradient-to-tr from-blue-500 to-purple-500">
                                            <div class="w-full h-full rounded-full bg-white p-0.5 overflow-hidden">
                                                @if($user->avatar)
                                                    <img class="w-full h-full rounded-full object-cover" src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar) }}" alt="Current">
                                                @else
                                                    <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-2xl font-bold text-gray-400">
                                                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="absolute bottom-0 right-0 bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center border-2 border-white text-xs shadow-sm">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Họ và tên</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all placeholder-gray-400 font-semibold" 
                                            placeholder="Nhập họ tên của bạn">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all placeholder-gray-400 font-semibold" 
                                            placeholder="name@example.com">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Số điện thoại</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-phone text-gray-400"></i>
                                        </div>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all placeholder-gray-400 font-semibold" 
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
                                <button type="button" onclick="closeModal('editProfileModal')" class="rounded-xl px-6 py-3 text-sm font-bold text-gray-500 hover:bg-gray-100 transition-colors">
                                    Hủy bỏ
                                </button>
                                <button type="submit" class="rounded-xl px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-bold shadow-lg shadow-purple-500/30 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Password Form --}}
                    <div id="form-password" class="hidden animate-fadeIn">
                        <form action="{{ route('client.profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mật khẩu hiện tại</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-lock text-gray-400"></i>
                                        </div>
                                        <input type="password" name="current_password" required 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all font-semibold" 
                                            placeholder="••••••••">
                                    </div>
                                    @error('current_password') <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mật khẩu mới</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-key text-gray-400"></i>
                                        </div>
                                        <input type="password" name="new_password" required 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all font-semibold" 
                                            placeholder="••••••••">
                                    </div>
                                    @error('new_password') <span class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Xác nhận mật khẩu</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-check-double text-gray-400"></i>
                                        </div>
                                        <input type="password" name="new_password_confirmation" required 
                                            class="pl-11 w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent block p-4 transition-all font-semibold" 
                                            placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
                                <button type="button" onclick="closeModal('editProfileModal')" class="rounded-xl px-6 py-3 text-sm font-bold text-gray-500 hover:bg-gray-100 transition-colors">
                                    Hủy bỏ
                                </button>
                                <button type="submit" class="rounded-xl px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-bold shadow-lg shadow-purple-500/30 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-shield-halved"></i> Đổi mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Notifications UI --}}
@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce flex items-center gap-2">
    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center gap-2 mb-2 font-bold">
        <i class="fa-solid fa-triangle-exclamation"></i> Có lỗi xảy ra:
    </div>
    <ul class="list-disc pl-4 text-sm">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function switchTab(tab) {
        const infoForm = document.getElementById('form-info');
        const passForm = document.getElementById('form-password');
        const infoTab = document.getElementById('tab-info');
        const passTab = document.getElementById('tab-password');

        if (tab === 'info') {
            infoForm.classList.remove('hidden');
            passForm.classList.add('hidden');
            
            infoTab.classList.add('border-purple-500', 'text-purple-600');
            infoTab.classList.remove('border-transparent', 'text-gray-500');
            
            passTab.classList.remove('border-purple-500', 'text-purple-600');
            passTab.classList.add('border-transparent', 'text-gray-500');
        } else {
            infoForm.classList.add('hidden');
            passForm.classList.remove('hidden');

            passTab.classList.add('border-purple-500', 'text-purple-600');
            passTab.classList.remove('border-transparent', 'text-gray-500');

            infoTab.classList.remove('border-purple-500', 'text-purple-600');
            infoTab.classList.add('border-transparent', 'text-gray-500');
        }
    }

    // Logic tự động mở lại Modal khi validation fails
    @if($errors->any())
        openModal('editProfileModal');
        @if($errors->has('current_password') || $errors->has('new_password'))
            switchTab('password');
        @else
            switchTab('info');
        @endif
    @endif
</script>
@endsection