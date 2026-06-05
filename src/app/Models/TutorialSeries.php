<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TutorialSeries extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['title', 'slug', 'description', 'thumbnail', 'difficulty', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tutorials(): HasMany
    {
        return $this->hasMany(Tutorial::class, 'series_id')->orderBy('order_in_series');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    protected static function booted(): void
    {
        static::creating(function (self $series) {
            if (empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });
    }
}
