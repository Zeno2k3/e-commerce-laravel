@extends('client.layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

{{-- Thêm biến showNotiModal: false để quản lý popup Trang 28 --}}
<div class="bg-[#f9fafb] min-h-screen font-sans pb-24"
     x-data="{ currentTab: 'settings', isEditing: false, showNotiModal: false }">

    <div class="container mx-auto px-6 py-12 max-w-7xl">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3">Tài khoản của tôi</h1>
            <p class="text-gray-500 text-xl font-medium">Quản lý thông tin cá nhân và cài đặt tài khoản</p>
        </div>

        <div class="grid lg:grid-cols-4 gap-10">

            {{-- SIDEBAR --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden sticky top-24 cursor-pointer">
                    <div @click="currentTab = 'profile'"
                         :class="currentTab === 'profile' ? 'bg-purple-50 text-[#7d3cff] border-[#7d3cff]' : 'text-gray-500 hover:text-[#7d3cff] hover:bg-gray-50 border-transparent'"
                         class="flex items-center gap-4 p-5 border-l-[6px] transition-all duration-200">
                        <i class="fa-solid fa-user text-xl"></i>
                        <span class="font-bold text-lg">Thông tin cá nhân</span>
                    </div>
                    <div @click="currentTab = 'settings'"
                         :class="currentTab === 'settings' ? 'bg-purple-50 text-[#7d3cff] border-[#7d3cff]' : 'text-gray-500 hover:text-[#7d3cff] hover:bg-gray-50 border-transparent'"
                         class="flex items-center gap-4 p-5 border-l-[6px] transition-all duration-200">
                        <i class="fa-solid fa-gear text-xl"></i>
                        <span class="font-bold text-lg">Cài đặt</span>
                    </div>
                </div>
            </div>

            {{-- NỘI DUNG CHÍNH --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm p-10 md:p-12 border border-gray-100 min-h-[500px]">

                    {{-- TAB 1: THÔNG TIN CÁ NHÂN --}}
                    <div x-show="currentTab === 'profile'" x-cloak x-transition.opacity.duration.300ms>
                        <div class="mb-10 border-b border-gray-100 pb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Thông tin cá nhân</h2>
                            <p class="text-gray-500 text-lg">Cập nhật thông tin cá nhân của bạn</p>
                        </div>
                        <form action="" method="POST">
                            @csrf
                            <div class="space-y-10">
                                <div class="grid md:grid-cols-12 gap-6 items-center">
                                    <div class="md:col-span-4"><label class="text-gray-400 font-bold text-base uppercase tracking-wider">Họ và tên</label></div>
                                    <div class="md:col-span-8">
                                        <div x-show="!isEditing">
                                            <p class="text-gray-900 font-black text-2xl leading-snug">Nguyễn Văn Khách Hàng</p>
                                            <p class="text-[#7d3cff] text-xl font-semibold mt-1">customer@example.com</p>
                                        </div>
                                        <div x-show="isEditing" x-cloak><input type="text" value="Nguyễn Văn Khách Hàng" class="w-full text-2xl font-bold text-gray-900 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:outline-none transition-all"></div>
                                    </div>
                                </div>
                                <hr class="border-gray-50">
                                <div class="grid md:grid-cols-12 gap-6 items-center">
                                    <div class="md:col-span-4"><label class="text-gray-400 font-bold text-base uppercase tracking-wider">Số điện thoại</label></div>
                                    <div class="md:col-span-8">
                                        <div x-show="!isEditing"><p class="text-gray-300 text-2xl font-medium italic">Chưa cập nhật</p></div>
                                        <div x-show="isEditing" x-cloak><input type="text" placeholder="Nhập số điện thoại..." class="w-full text-xl font-medium text-gray-900 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:outline-none transition-all"></div>
                                    </div>
                                </div>
                                <hr class="border-gray-50">
                                <div class="grid md:grid-cols-12 gap-6 items-center">
                                    <div class="md:col-span-4"><label class="text-gray-400 font-bold text-base uppercase tracking-wider">Email đăng nhập</label></div>
                                    <div class="md:col-span-8">
                                        <div x-show="!isEditing"><p class="text-gray-900 font-bold text-2xl">your@email.com</p></div>
                                        <div x-show="isEditing" x-cloak><input type="email" value="your@email.com" class="w-full text-xl font-medium text-gray-900 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:outline-none transition-all"></div>
                                    </div>
                                </div>
                                <hr class="border-gray-50">
                                <div class="grid md:grid-cols-12 gap-6 items-start">
                                    <div class="md:col-span-4"><label class="text-gray-400 font-bold text-base uppercase tracking-wider md:pt-2">Địa chỉ</label></div>
                                    <div class="md:col-span-8">
                                        <div x-show="!isEditing"><p class="text-gray-300 text-2xl font-medium italic leading-relaxed">Chưa cập nhật</p></div>
                                        <div x-show="isEditing" x-cloak><textarea rows="3" placeholder="Nhập địa chỉ giao hàng..." class="w-full text-xl font-medium text-gray-900 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#7d3cff] focus:outline-none transition-all resize-none"></textarea></div>
                                    </div>
                                </div>
                                <div class="mt-16 pt-8 border-t border-gray-100 flex justify-end gap-4">
                                    <button type="button" x-show="!isEditing" @click="isEditing = true" class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-10 py-4 rounded-xl font-bold text-lg transition-all shadow-md shadow-purple-100 flex items-center gap-3 active:scale-95"><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa</button>
                                    <button type="button" x-show="isEditing" x-cloak @click="isEditing = false" class="px-8 py-4 rounded-xl font-bold text-lg text-gray-500 hover:bg-gray-100 transition-all">Hủy bỏ</button>
                                    <button type="button" x-show="isEditing" x-cloak @click="isEditing = false" class="bg-[#7d3cff] hover:bg-[#6c2bd9] text-white px-10 py-4 rounded-xl font-bold text-lg transition-all shadow-md shadow-purple-100 flex items-center gap-3 active:scale-95"><i class="fa-solid fa-floppy-disk"></i> Lưu thông tin</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- TAB 2: CÀI ĐẶT --}}
                    <div x-show="currentTab === 'settings'" x-cloak x-transition.opacity.duration.300ms>
                        <div class="mb-12 border-b border-gray-100 pb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Cài đặt tài khoản</h2>
                            <p class="text-gray-500 text-lg">Quản lý cài đặt bảo mật và thông báo</p>
                        </div>
                        <div class="space-y-8">
                            {{-- Đổi mật khẩu --}}
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 hover:bg-gray-50 rounded-2xl transition-colors">
                                <div><h3 class="font-bold text-xl text-gray-900 mb-1">Đổi mật khẩu</h3><p class="text-gray-500 text-base">Cập nhật mật khẩu để bảo mật tài khoản</p></div>
                                <button class="w-full md:w-52 py-3 bg-white border border-gray-200 rounded-xl font-bold text-lg text-gray-700 hover:bg-gray-100 hover:border-gray-300 transition-all shadow-sm flex justify-center items-center">Đổi mật khẩu</button>
                            </div>
                            <hr class="border-gray-50">

                            {{-- Thông báo email (CÓ NÚT GỌI MODAL PAGE 28) --}}
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 hover:bg-gray-50 rounded-2xl transition-colors">
                                <div><h3 class="font-bold text-xl text-gray-900 mb-1">Thông báo email</h3><p class="text-gray-500 text-base">Nhận thông báo về đơn hàng và khuyến mãi</p></div>
                                {{-- Khi ấn nút này sẽ mở Modal --}}
                                <button @click="showNotiModal = true" class="w-full md:w-52 py-3 bg-white border border-gray-200 rounded-xl font-bold text-lg text-gray-700 hover:bg-gray-100 hover:border-gray-300 transition-all shadow-sm flex justify-center items-center">
                                    Cài đặt
                                </button>
                            </div>
                            <hr class="border-gray-50">

                            {{-- Xóa tài khoản --}}
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 hover:bg-red-50 rounded-2xl transition-colors group">
                                <div><h3 class="font-bold text-xl text-gray-900 group-hover:text-red-600 transition-colors mb-1">Xóa tài khoản</h3><p class="text-gray-500 text-base group-hover:text-red-400">Xóa vĩnh viễn tài khoản và dữ liệu</p></div>
                                <button class="w-full md:w-52 py-3 bg-red-600 text-white rounded-xl font-bold text-lg hover:bg-red-700 transition-all shadow-md shadow-red-100 flex justify-center items-center">Xóa tài khoản</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- MODAL TRANG 28: CÀI ĐẶT THÔNG BÁO  --}}
    {{-- ========================================================== --}}
    <div x-show="showNotiModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-opacity"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8 relative transform transition-all"
             @click.away="showNotiModal = false">

            {{-- Tiêu đề Modal --}}
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-extrabold text-gray-900">Cài đặt thông báo</h3>
                <button @click="showNotiModal = false" class="text-gray-400 hover:text-gray-600 text-2xl transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-6">
                {{-- Item 1: Nhận thông báo (Toggle) [cite: 1065] --}}
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold text-gray-700">Nhận thông báo</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-[#7d3cff]"></div>
                    </label>
                </div>

                {{-- Nút Hủy đăng ký [cite: 1066] --}}
                <button class="w-full py-4 rounded-xl border-2 border-red-100 text-red-500 font-bold text-lg hover:bg-red-50 hover:border-red-200 transition-all flex items-center justify-center gap-2 group">
                    <i class="fa-solid fa-ban group-hover:rotate-12 transition-transform"></i>
                    Hủy đăng ký nhận tin
                </button>

                {{-- Nút Lưu (Thêm vào cho hoàn chỉnh) --}}
                <button @click="showNotiModal = false" class="w-full py-4 rounded-xl bg-[#7d3cff] text-white font-bold text-lg hover:bg-[#6c2bd9] shadow-lg shadow-purple-200 transition-all active:scale-95">
                    Lưu thay đổi
                </button>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
