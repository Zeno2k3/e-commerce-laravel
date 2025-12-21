@extends('client.layouts.app')

@section('content')
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class='container flex min-h-screen flex-col items-center justify-center'>
        <h1 class='font-medium'>Welcome to the Home Page</h1>
        <p>This is a sample home page using Blade templating in Laravel.</p>
        <a href="{{ route('login') }}" class='italic text-blue-500 underline'>Login</a>
    </div>
</body>

</html>
@endsection
