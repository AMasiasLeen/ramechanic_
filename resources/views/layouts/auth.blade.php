<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
    <title>@yield('title')</title>
</head>

<body>
    @yield('content')
    @stack('js')
</body>

</html>
