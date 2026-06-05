@php
// Breadcrumbs dinámicos basados en la ruta actual
$routeName = request()->route()?->getName();
$breadcrumbMap = [
    'admin.dashboard' => [['label' => 'Dashboard']],
    'admin.posts.index' => [['label' => 'Blog', 'url' => route('admin.dashboard')], ['label' => 'Posts']],
    'admin.posts.create' => [['label' => 'Blog', 'url' => route('admin.dashboard')], ['label' => 'Posts', 'url' => route('admin.posts.index')], ['label' => 'Nuevo']],
    'admin.posts.edit' => [['label' => 'Blog', 'url' => route('admin.dashboard')], ['label' => 'Posts', 'url' => route('admin.posts.index')], ['label' => 'Editar']],
    'admin.projects.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Proyectos']],
    'admin.projects.create' => [['label' => 'Proyectos', 'url' => route('admin.projects.index')], ['label' => 'Nuevo']],
    'admin.projects.edit' => [['label' => 'Proyectos', 'url' => route('admin.projects.index')], ['label' => 'Editar']],
    'admin.tutorials.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Tutoriales']],
    'admin.tutorials.create' => [['label' => 'Tutoriales', 'url' => route('admin.tutorials.index')], ['label' => 'Nuevo']],
    'admin.tutorials.edit' => [['label' => 'Tutoriales', 'url' => route('admin.tutorials.index')], ['label' => 'Editar']],
    'admin.series.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Series']],
    'admin.series.create' => [['label' => 'Series', 'url' => route('admin.series.index')], ['label' => 'Nuevo']],
    'admin.series.edit' => [['label' => 'Series', 'url' => route('admin.series.index')], ['label' => 'Editar']],
    'admin.categories.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categorías']],
    'admin.categories.create' => [['label' => 'Categorías', 'url' => route('admin.categories.index')], ['label' => 'Nuevo']],
    'admin.categories.edit' => [['label' => 'Categorías', 'url' => route('admin.categories.index')], ['label' => 'Editar']],
    'admin.tags.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Tags']],
    'admin.tags.create' => [['label' => 'Tags', 'url' => route('admin.tags.index')], ['label' => 'Nuevo']],
    'admin.tags.edit' => [['label' => 'Tags', 'url' => route('admin.tags.index')], ['label' => 'Editar']],
    'admin.users.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Usuarios']],
    'admin.users.create' => [['label' => 'Usuarios', 'url' => route('admin.users.index')], ['label' => 'Nuevo']],
    'admin.users.edit' => [['label' => 'Usuarios', 'url' => route('admin.users.index')], ['label' => 'Editar']],
    'admin.media.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Media']],
    'admin.messages.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Mensajes']],
    'admin.analytics.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Analytics']],
    'admin.services.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Servicios']],
    'admin.services.create' => [['label' => 'Servicios', 'url' => route('admin.services.index')], ['label' => 'Nuevo']],
    'admin.services.edit' => [['label' => 'Servicios', 'url' => route('admin.services.index')], ['label' => 'Editar']],
    'admin.blocks.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Bloques']],
    'admin.seo.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'SEO']],
    'admin.roles.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Roles']],
    'admin.roles.create' => [['label' => 'Roles', 'url' => route('admin.roles.index')], ['label' => 'Nuevo']],
    'admin.roles.edit' => [['label' => 'Roles', 'url' => route('admin.roles.index')], ['label' => 'Editar']],
    'admin.permissions.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Permisos']],
    'admin.permissions.create' => [['label' => 'Permisos', 'url' => route('admin.permissions.index')], ['label' => 'Nuevo']],
    'admin.permissions.edit' => [['label' => 'Permisos', 'url' => route('admin.permissions.index')], ['label' => 'Editar']],
    'admin.notifications.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Notificaciones']],
    'admin.activity.index' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Actividad']],
    'profile.edit' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Perfil']],
];
$breadcrumbs = $breadcrumbMap[$routeName] ?? [];
@endphp

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

    <style>[x-cloak] { display: none !important; }</style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="overflow-hidden">

    <livewire:components.flash-message />

    <div class="flex h-screen overflow-hidden bg-surface">

        {{-- Sidebar --}}
        <x-admin-sidebar />

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Top bar --}}
            <header class="h-16 bg-surface-card border-b border-surface-border flex items-center justify-between px-4 lg:px-6 shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <x-breadcrumbs :items="$breadcrumbs" class="hidden sm:flex" />
                </div>

                <div class="flex items-center gap-1">
                    {{-- Theme toggle --}}
                    <button x-data="{ dark: document.documentElement.classList.contains('dark') }"
                            x-init="$watch('dark', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light'); })"
                            @click="dark = !dark"
                            class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-surface-hover transition"
                            aria-label="Toggle theme">
                        <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    {{-- Notification bell --}}
                    <livewire:admin.notification-bell wire:key="notif-bell" />

                    {{-- View site --}}
                    <a href="{{ route('home') }}" target="_blank"
                       class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-surface-hover transition hidden sm:block"
                       title="Ver sitio">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>

                    {{-- User dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-surface-hover transition">
                                <span class="w-7 h-7 rounded-full bg-brand-500/20 flex items-center justify-center text-brand-400 text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </span>
                                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 overflow-y-auto scrollbar-thin">
                @isset($header)
                    <div class="border-b border-surface-border bg-surface-card">
                        <div class="px-4 lg:px-8 py-6">
                            <x-breadcrumbs :items="$breadcrumbs" class="sm:hidden mb-3" />
                            {{ $header }}
                        </div>
                    </div>
                @else
                    <div class="px-4 lg:px-8 py-6">
                        <x-breadcrumbs :items="$breadcrumbs" />
                    </div>
                @endisset

                <div class="px-4 lg:px-8 pb-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
