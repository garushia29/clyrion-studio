<?php

/**
 * Middleware: SetLocale
 *
 * Establece el idioma de la aplicación basado en la sesión del
 * usuario. Soporta 'es' (español) y 'en' (inglés). Si no hay
 * idioma definido, usa el que el navegador prefiera o español
 * por defecto.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale');

        if (!$locale) {
            $locale = $request->getPreferredLanguage(['es', 'en']) ?? 'es';
        }

        if (in_array($locale, ['es', 'en'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
