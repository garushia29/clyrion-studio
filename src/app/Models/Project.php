<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)->where('status', 'published');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
