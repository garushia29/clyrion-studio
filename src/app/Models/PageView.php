<?php

/**
 * Model: PageView
 *
 * Representa una visita a una página pública del sitio. Se utiliza
 * en el sistema de analytics para contabilizar visitas totales,
 * visitantes únicos, páginas más visitadas y tráfico por día.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['path', 'referer', 'user_agent', 'ip_address', 'visitor_id'];

    /**
     * Obtiene el número de visitantes únicos en un período.
     */
    public static function uniqueVisitors(int $days = 30): int
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->distinct('visitor_id')
            ->count('visitor_id');
    }

    /**
     * Obtiene las páginas más visitadas.
     */
    public static function topPages(int $limit = 10, int $days = 30): array
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('path, COUNT(*) as visits')
            ->groupBy('path')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Obtiene visitas por día para un período.
     */
    public static function viewsByDay(int $days = 30): array
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as visits')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }

    /**
     * Obtiene visitas por día en un rango de fechas.
     */
    public static function viewsByDayRange(\Illuminate\Support\Carbon $start, \Illuminate\Support\Carbon $end): array
    {
        return self::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as visits')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }

    /**
     * Obtiene las páginas más visitadas en un rango de fechas.
     */
    public static function topPagesByRange(int $limit, \Illuminate\Support\Carbon $start, \Illuminate\Support\Carbon $end): array
    {
        return self::whereBetween('created_at', [$start, $end])
            ->selectRaw('path, COUNT(*) as visits')
            ->groupBy('path')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
