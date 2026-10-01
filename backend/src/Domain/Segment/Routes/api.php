<?php

declare(strict_types=1);

use Domain\Segment\Controllers\SegmentController;
use Illuminate\Support\Facades\Route;

Route::get('segments', [SegmentController::class, 'index']);
