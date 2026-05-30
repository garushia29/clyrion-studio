<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Clyrion Studio | JIMMY'))</title>

    @hasSection('meta')
        @yield('meta')
    @else
        <x-meta-tags />
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Public Navigation --}}
    <nav class="border-b border-surface-border">
        <div class="container-page">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-white">
                    Clyrion <span class="text-brand-500">Studio</span>
                </a>
                <div class="hidden sm:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Inicio</a>
                    <a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Sobre mí</a>
                    <a href="{{ route('projects.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Proyectos</a>
                    <a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Blog</a>
                    <a href="{{ route('home') }}#contacto" class="text-sm text-gray-400 hover:text-brand-400 transition">Contacto</a>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg transition">Register</a>
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
    <footer class="border-t border-surface-border py-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} <span class="text-brand-400">Clyrion Studio</span> | JIMMY — Building scalable digital solutions</p>
    </footer>

</body>
</html>
