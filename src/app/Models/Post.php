<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Model: Post
 *
 * Representa una entrada del blog. Soporta categorías, tags,
 * auto-generación de slug, tiempo de lectura y posts relacionados.
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'published_at',
        'status',
        'meta_title',
        'meta_description',
        'user_id',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')->whereNotNull('published_at');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tagsRelation(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function readingTime(): string
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        $minutes = max(1, (int) ceil($words / 200));

        return $minutes . ' min de lectura';
    }

    public function relatedPosts(int $limit = 3): Collection
    {
        $categoryIds = $this->categories()->pluck('categories.id');

        if ($categoryIds->isEmpty()) {
            return self::published()
                ->where('id', '!=', $this->id)
                ->orderByDesc('published_at')
                ->take($limit)
                ->get();
        }

        return self::published()
            ->where('id', '!=', $this->id)
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds))
            ->orderByDesc('published_at')
            ->take($limit)
            ->get();
    }
}
