<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RockBarlang')</title>
    @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
</head>
<body>
    <main>@yield('content')</main>
    @include('components.navbar')
</body>
</html>