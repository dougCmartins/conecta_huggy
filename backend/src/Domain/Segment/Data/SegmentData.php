<?php

declare(strict_types=1);

namespace Domain\Segment\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class SegmentData extends Data
{
    public function __construct(
        #[Required, Min(1)]
        public readonly int $id,
        #[Required, StringType, Max(255)]
        public readonly string $name,
        #[Nullable, StringType]
        public readonly ?string $description,
    ) {
    }
}
