<?php

namespace App\Traits;

use App\Events\ModelActivity;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            event(new ModelActivity($model, 'created'));
        });

        static::updated(function ($model) {
            event(new ModelActivity($model, 'updated'));
        });

        static::deleted(function ($model) {
            event(new ModelActivity($model, 'deleted'));
        });
    }
}
