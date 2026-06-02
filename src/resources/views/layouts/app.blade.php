<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clyrion Studio | JIMMY') }}</title>

    <style>[x-cloak] { display: none !important; }</style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="min-h-screen bg-surface">

        <livewire:components.flash-message />

        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-surface-border">
                <div class="container-page py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-surface-border py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} <span class="text-brand-400">Clyrion Studio</span> | JIMMY
        </footer>

    </div>

</body>
</html>