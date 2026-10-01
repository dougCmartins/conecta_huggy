<?php

declare(strict_types=1);

namespace Domain\Content\Data;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class ArticleData extends Data
{
    public function __construct(
        #[Required, Min(1)]
        public readonly int $id,
        #[Required, StringType, Max(255)]
        public readonly string $title,
        #[Nullable, StringType, Max(255)]
        public readonly ?string $subtitle,
        #[Required, StringType]
        public readonly string $content,
        #[Nullable, StringType, Max(255)]
        public readonly ?string $image,
        #[Required, BooleanType]
        public readonly bool $published,
        #[Required, StringType]
        public readonly string $created_at,
        #[Required, StringType, Max(255)]
        public readonly string $author_name,
    ) {
    }
}
