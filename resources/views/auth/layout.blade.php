<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/client.css', 'resources/js/client.js'])
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-900">
    <div class="flex min-h-screen items-center justify-center bg-[conic-gradient(at_top_right,_var(--tw-gradient-stops))] from-blue-100 via-white to-purple-100 p-4 selection:bg-indigo-500 selection:text-white">
        @yield('content')
    </div>
</body>

</html>
