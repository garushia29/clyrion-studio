<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Clyrion Studio | JIMMY'))</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @hasSection('meta')
        @yield('meta')
    @else
        <x-meta-tags :route="Route::currentRouteName()" />
    @endif

    <style>[x-cloak] { display: none !important; }</style>

    {{-- hreflang for multilingual ES/EN --}}
    @php $currentUrl = url()->current(); @endphp
    <link rel="alternate" hreflang="es" href="{{ $currentUrl }}" />
    <link rel="alternate" hreflang="en" href="{{ $currentUrl }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $currentUrl }}" />

    {{-- Default schemas: WebSite + Organization --}}
    <x-schema-org type="WebSite" />
    <x-schema-org type="Organization"
        :name="config('app.name')"
        url="/"
        description="Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables." />
    @hasSection('schema')
        @yield('schema')
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
                <div class="hidden sm:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.home') }}</a>
                    <a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.about') }}</a>
                    <a href="{{ route('projects.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.projects') }}</a>
                    <a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.blog') }}</a>
                    <a href="{{ route('tutorials.index') }}" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.tutorials') }}</a>
                    <a href="{{ route('home') }}#contacto" class="text-sm text-gray-400 hover:text-brand-400 transition">{{ __('nav.contact') }}</a>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Theme toggle --}}
                    <button x-data="{ dark: document.documentElement.classList.contains('dark') }"
                            x-init="$watch('dark', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light'); })"
                            @click="dark = !dark"
                            class="p-2 rounded-lg text-gray-500 hover:text-gray-300 hover:bg-surface-hover transition"
                            aria-label="Toggle theme">
                        <svg x-show="!dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

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
