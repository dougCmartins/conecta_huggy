<?php

declare(strict_types=1);

namespace Domain\Auth\Data;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class AccessTokenData extends Data
{
    public function __construct(
        #[Required, StringType]
        public readonly string $token,
    ) {
    }
}
