@extends('admin.layouts.app')
@section('title', 'Hồ sơ của tôi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Header Card --}}
    <div class="bg-gray-50 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Gradient Banner --}}
        <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600" style="background: linear-gradient(to right, #3b82f6, #9333ea);"></div>
        
        <div class="px-8 pb-8">
            <div class="relative flex justify-between items-end -mt-12 mb-6">
                {{-- Avatar --}}
                <div class="p-1.5 bg-white rounded-full">
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-500 border-4 border-white">
                        {{ strtoupper(substr($user->full_name ?? 'U', 0, 1)) }}
                    </div>
                </div>

                {{-- Action Button --}}
                <button onclick="openModal('editProfileModal')" 
                        class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 hover:text-purple-600 transition font-medium text-sm shadow-sm">
                    Chỉnh sửa thông tin
                </button>
            </div>

            <div class="space-y-1">
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->full_name }}</h1>
                <p class="text-gray-500">{{ $user->email }}</p>
                @if($user->role)
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium mt-2 capitalize">
                        {{ str_replace('_', ' ', $user->role) }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Details Sections --}}
    <div class="grid grid-cols-1 gap-6">
        {{-- Personal Info --}}
        <div class="bg-gray-50 rounded-2xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Thông tin cá nhân</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Họ và tên</label>
                    <p class="text-gray-800 font-medium">{{ $user->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Địa chỉ Email</label>
                    <p class="text-gray-800 font-medium">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Số điện thoại</label>
                    <p class="text-gray-800 font-medium">{{ $user->phone_number ?? 'Chưa cập nhật' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Ngày tham gia</label>
                    <p class="text-gray-800 font-medium">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{-- Danger Zone / Logout --}}
        <div class="bg-gray-50 rounded-2xl p-8 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-red-600 mb-4">Khu vực nguy hiểm</h3>
            <div class="bg-red-50 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h4 class="text-red-800 font-medium">Đăng xuất khỏi hệ thống</h4>
                    <p class="text-red-600 text-sm mt-1">Kết thúc phiên làm việc hiện tại của bạn.</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition font-medium text-sm shadow-sm">
                        Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Profile Modal --}}
<div id="editProfileModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('editProfileModal')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            {{-- Modal Gradient Header --}}
            <div class="h-24 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center px-6" style="background: linear-gradient(to right, #3b82f6, #9333ea);">
                <h3 class="text-xl font-bold text-white" id="modal-title">
                    Chỉnh sửa thông tin
                </h3>
            </div>
            
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        {{-- Tabs --}}
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button onclick="switchTab('info')" id="tab-info" class="border-purple-500 text-purple-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Thông tin chung
                                </button>
                                <button onclick="switchTab('password')" id="tab-password" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Đổi mật khẩu
                                </button>
                            </nav>
                        </div>

                        {{-- Info Form --}}
                        <div id="form-info">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Họ và tên</label>
                                        <input type="text" name="full_name" value="{{ $user->full_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" onclick="closeModal('editProfileModal')" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:text-sm">
                                        Hủy
                                    </button>
                                    <button type="submit" class="rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none sm:text-sm">
                                        Lưu thay đổi
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Password Form --}}
                        <div id="form-password" class="hidden">
                            <form action="{{ route('admin.profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
                                        <input type="password" name="current_password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
                                        <input type="password" name="new_password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
                                        <input type="password" name="new_password_confirmation" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm border p-2">
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" onclick="closeModal('editProfileModal')" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:text-sm">
                                        Hủy
                                    </button>
                                    <button type="submit" class="rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none sm:text-sm">
                                        Đổi mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <ul class="list-disc pl-4">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script>
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

    @if($errors->any())
        openModal('editProfileModal');
        @if($errors->has('current_password') || $errors->has('new_password'))
            switchTab('password');
        @endif
    @endif
</script>
@endsection
