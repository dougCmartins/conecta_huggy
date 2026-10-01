<?php

declare(strict_types=1);

namespace Domain\Orchestrator\Auth\Data;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class SyncUserPreferencesData extends Data
{
    /**
     * @param  list<int>  $segment_ids
     */
    public function __construct(
        #[Required, StringType, Max(255)]
        public readonly string $name,
        #[Required, Email, Max(255)]
        public readonly string $email,
        #[Nullable, BooleanType]
        public readonly ?bool $is_subscribed,
        public readonly array $segment_ids = [],
    ) {
    }
}
