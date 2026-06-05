<?php

namespace App\Listeners;

use App\Events\ModelActivity;
use App\Models\User;
use App\Notifications\ModelActivityNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAdmins
{
    public function handle(ModelActivity $event): void
    {
        if ($event->action === 'deleted') {
            return;
        }

        $user = auth()->user();
        if ($user && ! $user->isAdmin()) {
            return;
        }

        Notification::send(
            User::role(['super-admin', 'admin'])->get(),
            new ModelActivityNotification($event->model, $event->action)
        );
    }
}
