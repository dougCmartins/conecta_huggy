<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArticleController,
    AuthController,
    UserController,
    SegmentController,
    TopicController
};

Route::get('/user', [UserController::class, 'getUser'])
    ->middleware('auth:sanctum');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware('auth:sanctum');
Route::patch('/users/{user}', [UserController::class, 'update'])
    ->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/widget-event', [AuthController::class, 'sendToZapier'])
    ->middleware('auth:sanctum');

Route::post('/user', [UserController::class, 'store']);
Route::put('/user/preference', [UserController::class, 'syncUserPreferences']);

Route::get('/segments', [SegmentController::class, 'index']);
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
