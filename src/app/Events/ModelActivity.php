<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;

class ModelActivity
{
    use Dispatchable;

    public function __construct(
        public Model $model,
        public string $action, // created, updated, deleted
        public ?string $description = null,
    ) {}
}
