@extends('client.layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
    <div class="bg-gray-50 py-10">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center text-left">Hồ sơ của tôi</h1>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="relative h-32 bg-gradient-to-r from-blue-500 to-purple-600">
                    <div class="absolute -bottom-10 left-8">
                        <div class="h-24 w-24 rounded-full bg-white p-1 shadow-md">
                             <div class="h-full w-full rounded-full bg-gray-200 flex items-center justify-center text-3xl text-gray-500 font-bold overflow-hidden">
                                 {{ substr(Auth::user()->full_name ?? 'U', 0, 1) }}
                             </div>
                        </div>
                    </div>
                </div>

                <div class="pt-14 px-8 pb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold text-gray-900">{{ Auth::user()->full_name }}</h2>
                            <p class="text-gray-500">{{ Auth::user()->email }}</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                Thành viên
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm whitespace-nowrap">
                                <i class="fa-regular fa-pen-to-square mr-2"></i>Chỉnh sửa thông tin
                            </button>

                            <a href="{{route('client.account.orders')}}" class="flex items-center justify-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg text-sm font-medium text-blue-700 hover:bg-blue-100 transition shadow-sm whitespace-nowrap">
                                <i class="fa-solid fa-clock-rotate-left mr-2"></i>Lịch sử mua hàng
                            </a>
                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Thông tin cá nhân</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Họ và tên</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">{{ Auth::user()->full_name }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Địa chỉ Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">{{ Auth::user()->email }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Số điện thoại</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">
                                    {{ Auth::user()->phone ?? 'Chưa cập nhật' }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Địa chỉ</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">
                                    {{ Auth::user()->address ?? 'Chưa cập nhật' }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Ngày tham gia</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">{{ Auth::user()->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-10 border-t border-gray-100 pt-8">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Cài đặt tài khoản</h3>
                            <p class="text-sm text-gray-500 mt-1">Quản lý cài đặt bảo mật và thông báo</p>
                        </div>

                        <div class="space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-gray-50 last:border-0 last:pb-0">
                                <div class="mb-4 sm:mb-0">
                                    <h4 class="text-sm font-medium text-gray-900">Đổi mật khẩu</h4>
                                    <p class="text-sm text-gray-500 mt-1">Cập nhật mật khẩu để bảo mật tài khoản</p>
                                </div>
                                <button class="w-full sm:w-40 flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm whitespace-nowrap">
                                    Đổi mật khẩu
                                </button>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-gray-50 last:border-0 last:pb-0">
                                <div class="mb-4 sm:mb-0">
                                    <h4 class="text-sm font-medium text-gray-900">Thông báo email</h4>
                                    <p class="text-sm text-gray-500 mt-1">Nhận thông báo về đơn hàng và khuyến mãi</p>
                                </div>

                                <div class="w-full sm:w-auto flex justify-end">
                                    <button id="btn-setup-email" onclick="showEmailOptions()" class="w-full sm:w-40 flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm whitespace-nowrap">
                                        Cài đặt
                                    </button>

                                    <div id="email-options-group" class="hidden flex-col sm:flex-row gap-2 w-full sm:w-auto">
                                        <button onclick="handleEmailChoice('subscribe')" class="flex-1 sm:flex-none flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:text-purple-600 hover:border-purple-200 hover:bg-purple-50 transition shadow-sm whitespace-nowrap">
                                            <i class="fa-solid fa-gift mr-2"></i> Nhận thông báo
                                        </button>

                                        <button onclick="handleEmailChoice('unsubscribe')" class="flex-1 sm:flex-none flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition shadow-sm whitespace-nowrap">
                                            <i class="fa-solid fa-xmark mr-2"></i> Hủy đăng ký
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                                <div class="mb-4 sm:mb-0">
                                    <h4 class="text-sm font-medium text-gray-900">Xóa tài khoản</h4>
                                    <p class="text-sm text-gray-500 mt-1">Xóa vĩnh viễn tài khoản và dữ liệu</p>
                                </div>
                                <button class="w-full sm:w-40 flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 transition shadow-sm whitespace-nowrap">
                                    Xóa tài khoản
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-semibold text-red-600 mb-4">Khu vực nguy hiểm</h3>
                        <div class="bg-red-50 border border-red-100 rounded-lg p-4 flex items-center justify-between">
                            <div>
                                <h4 class="text-red-800 font-medium">Đăng xuất khỏi hệ thống</h4>
                                <p class="text-red-600 text-sm mt-1">Kết thúc phiên làm việc hiện tại của bạn.</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg text-sm font-medium hover:bg-red-50 hover:text-red-700 transition shadow-sm">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function showEmailOptions() {
            document.getElementById('btn-setup-email').style.display = 'none';
            const group = document.getElementById('email-options-group');
            group.classList.remove('hidden');
            group.classList.add('flex');
        }

        function handleEmailChoice(type) {
            if(type === 'subscribe') {
                alert('Đã chọn: Nhận thông báo quà tặng!');
            } else {
                alert('Đã chọn: Hủy đăng ký thông báo!');
            }
        }
    </script>
@endsection
