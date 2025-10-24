<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        @yield('content')
    </div>

</body>

</html>
