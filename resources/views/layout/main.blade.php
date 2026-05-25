<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RockBarlang')</title>
    @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Petemoss&display=swap" rel="stylesheet">
</head>

<body>
    <x-top-line />
    <main>@yield('content')</main>
    <x-upper />
    @include('components.navbar')
</body>

</html>