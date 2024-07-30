<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramNotificationService
{
    protected $telegramBotToken;
    protected $chatId;

    public function __construct()
    {
        $this->telegramBotToken = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }

    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot{$this->telegramBotToken}/sendMessage";

        Http::get($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);
    }
}
