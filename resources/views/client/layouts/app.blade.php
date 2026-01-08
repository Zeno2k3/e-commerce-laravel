<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white antialiased">

    @include('client.layouts.partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('client.layouts.partials.footer')
{{-- DÁN ĐOẠN SCRIPT NÀY VÀO TRƯỚC THẺ ĐÓNG BODY --}}
    <script>
        function addToCartDemo(e) {
            // 1. Ngăn chặn hành vi mặc định (tránh load lại trang)
            if(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // 2. Tìm số lượng trên Header
            let cartCountElement = document.getElementById('cart-count');

            // 3. Kiểm tra xem có tìm thấy không
            if (cartCountElement) {
                // Lấy số cũ + 1
                let currentCount = parseInt(cartCountElement.innerText);
                cartCountElement.innerText = currentCount + 1;

                // Hiệu ứng rung nhẹ
                cartCountElement.parentElement.classList.add('animate-bounce');
                setTimeout(() => {
                    cartCountElement.parentElement.classList.remove('animate-bounce');
                }, 1000);

                // Thông báo (Dùng alert hoặc console.log để test)
                console.log("Đã thêm vào giỏ hàng!");
                // alert("Đã thêm sản phẩm vào giỏ hàng!"); // Bỏ comment dòng này nếu muốn hiện popup
            } else {
                console.error("LỖI: Không tìm thấy id='cart-count'. Kiểm tra file Header!");
                alert("Lỗi: Chưa tìm thấy icon giỏ hàng có id='cart-count'.");
            }
        }
    </script>
</body>
</html>

