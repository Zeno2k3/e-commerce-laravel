@extends('layout.guest')

@section('title')
    Trang đăng ký
@endsection

@section('content')
    <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl">
        <h1 class='mb-1 text-center text-2xl font-bold text-gray-800'>Đăng ký</h1>
        <p class='mb-6 text-center text-gray-400'>Tạo tài khoản của bạn để tiếp tục mua sắm</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class='mb-4'>
                <label for="text" class='mb-1 block font-semibold'>Nhập họ và tên:</label>
                <input type="text" name="text" id="text" placeholder="Nguyen Van A"
                    class='w-full rounded border px-3 py-2' required>
            </div>
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
            <div class='mb-4'>
                <label for="password" class='mb-1 block font-semibold'>Nhập lại mật khẩu:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class='w-full rounded border px-3 py-2' required>
            </div>
            <label class="flex items-center">
                <input type="checkbox" class="form-checkbox h-5 w-5">

                <span class="ml-2 mt-0.5 gap-1 text-gray-700 checked:text-blue-600">
                    Tôi đồng ý với
                    <span class="cursor-pointer text-blue-400">điều khoản sử dụng</span>
                    và
                    <span class="cursor-pointer text-blue-400">chính sách bảo mật</span>
                </span>

            </label>
            <x-button type="submit" variant="primary" class="mb-4 mt-4 w-full">
                Đăng ký
            </x-button>
        </form>

        <p>Đã có tài khoản? <a href="{{ route('login') }}" class='text-blue-500 transition hover:underline'>Đăng
                nhập ngay</a>
        </p>
    </div>
@endsection
