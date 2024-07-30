<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Services\TelegramNotificationService;
use Laravel\Sanctum\PersonalAccessToken;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $telegramService = app(TelegramNotificationService::class);

        // Listen to a new User Register
        User::created(function ($user) use ($telegramService) {
            $telegramService->sendMessage("User baru telah terdaftar dengan nama *". $user['username'] . "*");
        });

        // Listen to a new issued token
        PersonalAccessToken::created(function ($token) use ($telegramService) {
            $telegramService->sendMessage("Token baru telah dibuat oleh *". Auth::user()['username'] . "*");
        });



        // Listen to the created event
        Post::created(function ($post) use ($telegramService) {
             // Eager load the user relationship to avoid N+1 problem
            $user = Auth::user();
            $telegramService->sendMessage("Judul baru ditambahkan oleh *". Auth::user()['username'] . "* dengan judul " . "*". $post['title']."*");
        });

        // Listen to the updated event
        Post::updated(function ($post) use ($telegramService) {
            $telegramService->sendMessage("Judul telah diubah oleh *". Auth::user()['username'] . "* dengan judul " . "*". $post['title']."*");
        });

        // Listen to the deleted event
        Post::deleted(function ($post) use ($telegramService) {
            // $user =Auth::user();
            $telegramService->sendMessage("Post with title *" . $post->title . "* has been deleted by *".  Auth::user()['username']."*");
        });
    }
}
