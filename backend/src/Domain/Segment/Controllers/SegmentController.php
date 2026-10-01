<?php

declare(strict_types=1);

namespace Domain\Segment\Controllers;

use Domain\Segment\Actions\ListSegments;
use Spatie\LaravelData\DataCollection;

final class SegmentController
{
    public function index(ListSegments $action): DataCollection
    {
        return $action->handle();
    }
}
