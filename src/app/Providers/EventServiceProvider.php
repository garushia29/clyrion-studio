<?php

namespace App\Providers;

use App\Events\ModelActivity;
use App\Listeners\DispatchWebhooks;
use App\Listeners\LogModelActivity;
use App\Listeners\NotifyAdmins;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ModelActivity::class => [
            LogModelActivity::class,
            NotifyAdmins::class,
            DispatchWebhooks::class,
        ],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
