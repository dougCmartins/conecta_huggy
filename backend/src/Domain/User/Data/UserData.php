<?php

declare(strict_types=1);

namespace Domain\User\Data;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class UserData extends Data
{
    /**
     * @param  list<int>  $segment_ids
     */
    public function __construct(
        #[Required, Min(1)]
        public readonly int $id,
        #[Required, StringType, Max(255)]
        public readonly string $name,
        #[Required, Email, Max(255)]
        public readonly string $email,
        #[Required, BooleanType]
        public readonly bool $is_subscribed,
        #[Required]
        public readonly array $segment_ids,
    ) {
    }
}
