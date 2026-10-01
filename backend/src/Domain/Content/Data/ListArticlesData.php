<?php

declare(strict_types=1);

namespace Domain\Content\Data;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

final class ListArticlesData extends Data
{
    public function __construct(
        #[IntegerType, Min(1)]
        public readonly int $page = 1,
        #[IntegerType, Min(1), Max(100)]
        public readonly int $perPage = 10,
    ) {
    }
}
