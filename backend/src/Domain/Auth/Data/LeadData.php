<?php

declare(strict_types=1);

namespace Domain\Auth\Data;

use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

final class LeadData extends Data
{
    public function __construct(
        #[Required, BooleanType]
        public readonly bool $delivered,
    ) {
    }
}
