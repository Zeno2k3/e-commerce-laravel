@extends('layout.guest')

@section('title')
    Trang đăng ký
@endsection

@section('content')
    <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-gray-900/5">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 text-center sm:px-10">
            <h2 class="text-3xl font-bold tracking-tight text-white">Tạo tài khoản</h2>
            <p class="mt-2 text-blue-100">Đăng ký để bắt đầu mua sắm ngay hôm nay</p>
        </div>

        <div class="px-6 py-8 sm:px-10">
            <x-alert />

            <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="full_name" id="full_name" placeholder="Nguyễn Văn A" required
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 shadow-sm"
                        >
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" placeholder="your@gmail.com" required
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 shadow-sm"
                        >
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" placeholder="••••••••" required
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 shadow-sm"
                        >
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Nhập lại mật khẩu</label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 shadow-sm"
                        >
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-medium text-gray-700">Tôi đồng ý với <a href="#" class="text-indigo-600 hover:text-indigo-500">điều khoản</a> và <a href="#" class="text-indigo-600 hover:text-indigo-500">chính sách bảo mật</a></label>
                    </div>
                </div>
                <x-button type="submit" variant="primary" class="flex w-full justify-center !rounded-lg py-3 text-sm font-semibold shadow-lg hover:shadow-indigo-500/30">
                    Đăng ký
                </x-button>
            </form>
            <div class="relative mt-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-2 text-gray-500">Hoặc</span>
                </div>
            </div>
             <div class="mt-6">
                 <a href="{{ route('gg.redirect') }}" class="flex w-full transform items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:scale-[1.01]">
                    <img src="{{ asset('images/google-logo-search-new-svgrepo-com.svg') }}" alt="Google" class="mr-3 h-5 w-5">
                    Đăng ký bằng Google
                 </a>
            </div>

            <p class="mt-8 text-center text-sm text-gray-600">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                    Đăng nhập ngay
                </a>
            </p>
        </div>
    </div>
@endsection
