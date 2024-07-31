<?php

use Mockery\Matcher\Not;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use App\Http\Middleware\NotificationMiddleware;

Route::post('/v1/auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/v1/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::get('/v1/users', [\App\Http\Controllers\Api\AuthController::class, 'getUsers'])->middleware('auth:sanctum');
Route::apiResource('/v1/posts', App\Http\Controllers\Api\PostController::class)->middleware('auth:sanctum');


