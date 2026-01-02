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
                        
                        <div class="flex gap-3">
                            <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                                Chỉnh sửa thông tin
                            </button>
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
                                <dt class="text-sm font-medium text-gray-500">Ngày tham gia</dt>
                                <dd class="mt-1 text-sm text-gray-900 border-b border-gray-100 pb-2">{{ Auth::user()->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>
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
@endsection

