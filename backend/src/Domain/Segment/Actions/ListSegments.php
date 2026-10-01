<?php

declare(strict_types=1);

namespace Domain\Segment\Actions;

use Domain\Segment\Data\SegmentData;
use Domain\Segment\Models\Segment;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\DataCollection;

final class ListSegments
{
    /**
     * @return DataCollection<int, SegmentData>
     */
    public function handle(): DataCollection
    {
        $segments = Segment::query()
            ->orderBy('id')
            ->get()
            ->map(fn (Segment $segment): SegmentData => new SegmentData(
                id: (int) $segment->id,
                name: $segment->name,
                description: $segment->description,
            ))
            ->all();

        Log::info('Segments listed', ['count' => count($segments)]);

        return new DataCollection(SegmentData::class, $segments);
    }
}
