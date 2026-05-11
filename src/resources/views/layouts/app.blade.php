<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clyrion Studio | JIMMY') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-950 text-white min-h-screen font-sans antialiased">

    <div class="min-h-screen bg-gray-950">

        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-gray-800">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} <span class="text-blue-400">Clyrion Studio</span> | JIMMY
        </footer>

    </div>

</body>
</html>