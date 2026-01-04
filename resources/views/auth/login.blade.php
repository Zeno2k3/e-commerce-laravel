@extends('layout.guest')

@section('title')
    Trang đăng nhập
@endsection

@section('content')
    <div class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-gray-900/5">
        <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 text-center sm:px-10">
            <h2 class="text-3xl font-bold tracking-tight text-white">Đăng nhập</h2>
            <p class="mt-2 text-blue-10">Chào mừng bạn quay trở lại!</p>
        </div>

        <div class="px-6 py-8 sm:px-10">

            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" required placeholder="your@gmail.com"
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
                        <input type="password" name="password" id="password" required placeholder="••••••••"
                            class="block w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 shadow-sm"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Ghi nhớ</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">Quên mật khẩu?</a>
                    </div>
                </div>

                <x-button type="submit" variant="primary" class="flex w-full justify-center !rounded-lg py-3 text-sm font-semibold shadow-lg hover:shadow-indigo-500/30">
                    Đăng nhập
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
                    Đăng nhập bằng Google
                </a>
            </div>

            <p class="mt-8 text-center text-sm text-gray-600">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                    Đăng ký ngay
                </a>
            </p>
        </div>
    </div>
@endsection
