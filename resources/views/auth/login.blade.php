@extends('layout.guest')

@section('title')
    Trang đăng nhập
@endsection

@section('content')
    <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl">
        <h1 class='mb-1 text-center text-2xl font-bold text-gray-800'>Đăng nhập</h1>
        <p class='mb-6 text-center text-gray-400'>Đăng nhập vào tài khoản của bạn để tiếp tục mua sắm</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class='mb-4'>
                <label for="email" class='mb-1 block font-semibold'>Email:</label>
                <input type="email" name="email" id="email" placeholder="your@gmail.com"
                    class='w-full rounded border px-3 py-2' required>
            </div>
            <div class='mb-4'>
                <label for="password" class='mb-1 block font-semibold'>Mật khẩu:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class='w-full rounded border px-3 py-2' required>
            </div>
            <div>
                <x-button type="submit" variant="outline" class="mt-4 w-full">
                    Đăng nhập
                </x-button>
            </div>
            <div class="my-6 flex items-center justify-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-3 text-sm text-gray-500">Hoặc</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>
            <x-button type="button" variant="outline" class="mb-4 flex w-full items-center justify-center">
                <img src="{{ asset('images/google-logo-search-new-svgrepo-com.svg') }}" alt="Google Logo"
                    class="mr-2 inline h-5 w-5">
                Đăng nhập bằng Google
            </x-button>
        </form>
        <a href="#" class='text-blue-500 hover:underline'>Quên mật khẩu</a>

        <div>
            <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}"
                    class='text-blue-500 transition hover:underline'>Đăng
                    ký</a>
            </p>
        </div>
    </div>
@endsection
