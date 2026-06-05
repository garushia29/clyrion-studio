<?php

/**
 * Model: Service
 *
 * Representa un servicio ofrecido, visible en la sección "Servicios"
 * de la página principal. Soporta auto-generación de slug y filtrado
 * por estado activo.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['title', 'slug', 'description', 'icon', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Filtra solo los servicios activos.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Boot: Auto-genera el slug a partir del título si no se proporciona.
     */
    protected static function booted(): void
    {
        static::creating(function (self $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }
}
