{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Facultad De Ingeniería UFPSO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Contenido principal --}}
    <div class="flex-1 flex flex-col ml-64">
        {{-- Header con perfil --}}
        @include('layouts.header')

        {{-- Contenido dinámico --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-200 text-center py-3 text-sm text-gray-600">
            © {{ date('Y') }} Facultad de Ingeniería UFPSO - Sistema de Gestión
        </footer>
    </div>

</body>
</html>