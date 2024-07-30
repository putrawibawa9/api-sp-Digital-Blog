<?php

namespace App\Listeners;

use App\Services\TelegramNotificationService;
use Illuminate\Auth\Events\Registered;

class SendTelegramNotificationOnUserRegistered
{
    protected $telegramService;

    public function __construct(TelegramNotificationService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function handle(Registered $event)
    {
        $user = $event->user;
        $message = "New user registered: {$user->name} ({$user->email})";
        $this->telegramService->sendMessage($message);
    }
}
