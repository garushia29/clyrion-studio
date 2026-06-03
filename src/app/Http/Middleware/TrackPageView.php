<?php

/**
 * Middleware: TrackPageView
 *
 * Registra una visita en la tabla `page_views` para las rutas
 * públicas del sitio. Excluye rutas de admin, assets, sitemap,
 * feed RSS y peticiones Livewire. Genera un visitor_id hash
 * a partir de IP + user agent para privacidad.
 */
namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    private const EXCLUDED_PREFIXES = [
        '/admin', '/build', '/hot', '/storage',
        '/sitemap.xml', '/blog/feed.xml', '/up',
        'trix',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if ($this->shouldTrack($request)) {
            try {
                PageView::create([
                    'path' => $request->path(),
                    'referer' => $request->header('referer'),
                    'user_agent' => $request->userAgent(),
                    'ip_address' => $request->ip(),
                    'visitor_id' => $this->visitorId($request),
                ]);
            } catch (\Exception $e) {
                Log::warning('TrackPageView: no se pudo registrar la visita', [
                    'path' => $request->path(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    private function shouldTrack(Request $request): bool
    {
        if ($request->method() !== 'GET' || $request->ajax() || $request->expectsJson()) {
            return false;
        }

        if ($request->header('Livewire')) {
            return false;
        }

        foreach (self::EXCLUDED_PREFIXES as $prefix) {
            if (str_starts_with($request->path(), $prefix)) {
                return false;
            }
        }

        return true;
    }

    private function visitorId(Request $request): string
    {
        return md5($request->ip() . '|' . $request->userAgent());
    }
}
