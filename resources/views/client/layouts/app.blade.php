<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/client.css', 'resources/js/client.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-white antialiased">

    @include('client.layouts.partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('client.layouts.partials.footer')

</body>
</html>

