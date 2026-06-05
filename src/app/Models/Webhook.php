<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Webhook extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'url', 'events', 'secret', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function calls(): HasMany
    {
        return $this->hasMany(WebhookCall::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function shouldFire(string $event): bool
    {
        if (!$this->is_active) return false;
        if (empty($this->events)) return true;
        $events = array_map('trim', explode(',', $this->events));
        return in_array($event, $events);
    }
}
