<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model: Project
 *
 * Representa un proyecto del portafolio. Soporta filtrado por
 * estado publicado/destacado y almacena tecnologías como array.
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'technologies',
        'year',
        'url',
        'github_url',
        'featured',
        'sort_order',
        'status',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
        'year' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', true)->where('status', 'published');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }
}
