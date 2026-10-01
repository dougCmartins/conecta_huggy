<?php

declare(strict_types=1);

use Domain\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('user', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::post('user', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::patch('users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::put('user/preference', [UserController::class, 'syncPreferences']);
