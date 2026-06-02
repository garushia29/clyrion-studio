<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tutorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'series_id', 'order_in_series',
        'difficulty', 'duration_minutes', 'prerequisites',
        'thumbnail', 'status', 'published_at',
        'meta_title', 'meta_description', 'user_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')->whereNotNull('published_at');
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(TutorialSeries::class, 'series_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function readingTime(): string
    {
        if ($this->duration_minutes) {
            return $this->duration_minutes . ' min';
        }

        $words = str_word_count(strip_tags($this->content ?? ''));
        $minutes = max(1, (int) ceil($words / 200));

        return $minutes . ' min';
    }

    public function difficultyLabel(): string
    {
        return match ($this->difficulty) {
            'beginner' => 'Principiante',
            'intermediate' => 'Intermedio',
            'advanced' => 'Avanzado',
            default => ucfirst($this->difficulty),
        };
    }

    public function difficultyColor(): string
    {
        return match ($this->difficulty) {
            'beginner' => 'text-green-400 bg-green-500/10',
            'intermediate' => 'text-yellow-400 bg-yellow-500/10',
            'advanced' => 'text-red-400 bg-red-500/10',
            default => 'text-gray-400 bg-gray-500/10',
        };
    }

    protected static function booted(): void
    {
        static::creating(function (self $tutorial) {
            if (empty($tutorial->slug)) {
                $tutorial->slug = Str::slug($tutorial->title);
            }
        });
    }
}
