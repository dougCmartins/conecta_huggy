<?php

declare(strict_types=1);

namespace Domain\Segment\Actions;

use Domain\Segment\Exceptions\SegmentNotFoundException;
use Domain\Segment\Models\Segment;

final class EnsureSegments
{
    /**
     * @param  list<int>  $segmentIds
     */
    public function handle(array $segmentIds): void
    {
        $ids = array_values(array_unique(array_map('intval', $segmentIds)));

        if ($ids === [] || in_array(0, $ids, true)) {
            throw new SegmentNotFoundException();
        }

        $found = Segment::query()->whereIn('id', $ids)->count();

        if ($found !== count($ids)) {
            throw new SegmentNotFoundException();
        }
    }
}
