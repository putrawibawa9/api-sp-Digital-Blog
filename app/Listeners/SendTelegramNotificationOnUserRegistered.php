<?php

namespace App\Listeners;

use App\Services\TelegramNotificationService;
use Illuminate\Auth\Events\Login;

class SendTelegramNotificationOnUserLoggedIn
{
    protected $telegramService;

    public function __construct(TelegramNotificationService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function handle(Login $event)
    {
        $user = $event->user;
        $message = "User logged in: {$user->name} ({$user->email})";
        $this->telegramService->sendMessage($message);
    }
}
