<?php

declare(strict_types=1);

use Domain\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('widget-event', [AuthController::class, 'sendLead'])->middleware('auth:sanctum');
