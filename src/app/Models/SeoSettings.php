<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSettings extends Model
{
    use HasFactory;
    protected $table = 'seo_settings';

    protected $fillable = [
        'page_route', 'title', 'description', 'image', 'type', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Obtiene la configuración SEO activa para una ruta específica.
     */
    public static function forRoute(string $pageRoute): ?self
    {
        return self::where('page_route', $pageRoute)
            ->where('is_active', true)
            ->first();
    }
}
