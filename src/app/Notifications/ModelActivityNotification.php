<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class ModelActivityNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected Model $model,
        protected string $action,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $modelName = class_basename($this->model);
        $label = method_exists($this->model, 'activityLogLabel')
            ? $this->model->activityLogLabel()
            : ($this->model->getAttribute('title') ?? $this->model->getAttribute('name') ?? "ID: {$this->model->getKey()}");

        return [
            'action' => $this->action,
            'model_type' => $modelName,
            'model_id' => $this->model->getKey(),
            'label' => $label,
            'message' => match ($this->action) {
                'created' => "Nuevo {$modelName}: \"{$label}\"",
                'updated' => "{$modelName} actualizado: \"{$label}\"",
                default => "{$modelName} {$this->action}: \"{$label}\"",
            },
            'url' => $this->guessUrl(),
        ];
    }

    protected function guessUrl(): ?string
    {
        $model = $this->model;
        $key = $model->getKey();

        $routes = [
            'App\Models\Post' => fn() => $model->exists ? route('admin.posts.edit', $key) : null,
            'App\Models\Project' => fn() => $model->exists ? route('admin.projects.edit', $key) : null,
            'App\Models\Tutorial' => fn() => $model->exists ? route('admin.tutorials.edit', $key) : null,
            'App\Models\Service' => fn() => $model->exists ? route('admin.services.edit', $key) : null,
            'App\Models\Category' => fn() => $model->exists ? route('admin.categories.edit', $key) : null,
            'App\Models\Tag' => fn() => $model->exists ? route('admin.tags.edit', $key) : null,
            'App\Models\User' => fn() => $model->exists ? route('admin.users.edit', $key) : null,
            'App\Models\ContactMessage' => fn() => route('admin.messages.index'),
        ];

        $class = get_class($model);
        $resolver = $routes[$class] ?? null;

        return $resolver ? $resolver() : null;
    }
}
