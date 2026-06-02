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

    <style>[x-cloak] { display: none !important; }</style>

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
                <div class="hidden sm:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.home') }}</a>
                    <a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.about') }}</a>
                    <a href="{{ route('projects.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.projects') }}</a>
                    <a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.blog') }}</a>
                    <a href="{{ route('tutorials.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.tutorials') }}</a>
                    <a href="{{ route('home') }}#contacto" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.contact') }}</a>
                </div>
                <div class="flex items-center gap-4">
                    {{-- Locale switcher --}}
                    <div class="flex items-center gap-1 mr-2">
                        <a href="{{ route('locale.switch', 'es') }}" class="text-xs px-1.5 py-0.5 rounded {{ app()->getLocale() === 'es' ? 'text-brand-400 bg-brand-500/10' : 'text-gray-500 hover:text-gray-300' }} transition">ES</a>
                        <span class="text-gray-600">|</span>
                        <a href="{{ route('locale.switch', 'en') }}" class="text-xs px-1.5 py-0.5 rounded {{ app()->getLocale() === 'en' ? 'text-brand-400 bg-brand-500/10' : 'text-gray-500 hover:text-gray-300' }} transition">EN</a>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.login') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg transition">{{ __('nav.register') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <livewire:components.flash-message />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-surface-border py-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} <span class="text-brand-400">Clyrion Studio</span> | JIMMY — {{ __('footer.copyright') }}</p>
    </footer>

</body>
</html>
