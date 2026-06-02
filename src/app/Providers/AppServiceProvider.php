<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

/**
 * Provider: AppServiceProvider
 *
 * Registra servicios y configuraciones globales de la aplicación.
 * Configura Tailwind para la paginación por defecto.
 */
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
