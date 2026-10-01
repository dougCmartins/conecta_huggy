<?php

declare(strict_types=1);

use Domain\Content\Controllers\ArticleController;
use Domain\Content\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('articles', [ArticleController::class, 'index']);
Route::get('topics', [TopicController::class, 'index']);
