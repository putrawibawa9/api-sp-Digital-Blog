<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::get('/users', [\App\Http\Controllers\Api\AuthController::class, 'getUsers'])->middleware('auth:sanctum');
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class)->middleware('auth:sanctum');