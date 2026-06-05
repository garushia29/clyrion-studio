<?php

namespace App\Listeners;

use App\Events\ModelActivity;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class LogModelActivity
{
    public function handle(ModelActivity $event): void
    {
        $model = $event->model;
        $user = auth()->user();

        $description = $event->description ?? $this->defaultDescription($model, $event->action);

        ActivityLog::create([
            'user_id' => $user?->id,
            'log_type' => $event->action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'description' => $description,
            'properties' => $this->extractProperties($model),
            'ip_address' => Request::ip(),
        ]);
    }

    protected function defaultDescription(Model $model, string $action): string
    {
        $modelName = class_basename($model);
        $label = method_exists($model, 'activityLogLabel')
            ? $model->activityLogLabel()
            : ($model->getAttribute('title') ?? $model->getAttribute('name') ?? $model->getKey());

        return match ($action) {
            'created' => "{$modelName} \"{$label}\" fue creado",
            'updated' => "{$modelName} \"{$label}\" fue actualizado",
            'deleted' => "{$modelName} \"{$label}\" fue eliminado",
            default => "{$modelName} \"{$label}\" {$action}",
        };
    }

    protected function extractProperties(Model $model): ?array
    {
        if (! $model->exists) {
            return null;
        }

        $hidden = ['password', 'remember_token', 'content', 'excerpt'];
        $data = $model->toArray();

        foreach ($hidden as $key) {
            unset($data[$key]);
        }

        return array_filter($data);
    }
}
