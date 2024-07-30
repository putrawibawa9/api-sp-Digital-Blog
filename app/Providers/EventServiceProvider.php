<?php

namespace App\Providers;

use App\Listeners\SendTelegramNotificationOnUserLoggedIn;
use App\Listeners\SendTelegramNotificationOnUserRegistered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendTelegramNotificationOnUserRegistered::class,
        ],
        Login::class => [
            SendTelegramNotificationOnUserLoggedIn::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
