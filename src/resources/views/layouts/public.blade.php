<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Clyrion Studio | JIMMY'))</title>
    <meta name="description" content="@yield('description', 'Building scalable digital solutions')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white font-sans antialiased">

    {{-- Public Navigation --}}
    <nav class="border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">
                    Clyrion <span class="text-blue-500">Studio</span>
                </a>
                <div class="hidden sm:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-sm text-gray-300 hover:text-blue-400 transition">Inicio</a>
                    <a href="#servicios" class="text-sm text-gray-300 hover:text-blue-400 transition">Servicios</a>
                    <a href="#proyectos" class="text-sm text-gray-300 hover:text-blue-400 transition">Proyectos</a>
                    <a href="#blog" class="text-sm text-gray-300 hover:text-blue-400 transition">Blog</a>
                    <a href="#contacto" class="text-sm text-gray-300 hover:text-blue-400 transition">Contacto</a>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-300 hover:text-blue-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-blue-400 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-800 py-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} <span class="text-blue-400">Clyrion Studio</span> | JIMMY — Building scalable digital solutions</p>
    </footer>

</body>
</html>
