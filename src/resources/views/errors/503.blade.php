<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mantenimiento - Clyrion Studio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a0a0f;
            color: #e5e7eb;
        }
        .container { text-align: center; padding: 2rem; max-width: 500px; }
        .logo { font-size: 2.5rem; font-weight: 800; letter-spacing: -0.025em; margin-bottom: 1.5rem; }
        .logo span { color: #6366f1; }
        h1 { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.75rem; }
        p { color: #9ca3af; line-height: 1.6; margin-bottom: 2rem; }
        .icon { margin-bottom: 2rem; }
        .icon svg { width: 64px; height: 64px; color: #6366f1; }
        .bar { width: 64px; height: 3px; background: #6366f1; border-radius: 2px; margin: 0 auto; animation: pulse 2s ease-in-out infinite; }
        @keyframes pulse { 0%, 100% { opacity: 0.3; } 50% { opacity: 1; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div class="logo">Clyrion <span>Studio</span></div>
        <h1>Modo Mantenimiento</h1>
        <p>Estamos realizando mejoras en el sitio. Volvemos en breve.</p>
        <div class="bar"></div>
    </div>
</body>
</html>
