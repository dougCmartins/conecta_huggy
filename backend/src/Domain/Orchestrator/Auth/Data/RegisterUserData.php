<?php

declare(strict_types=1);

namespace Domain\Orchestrator\Auth\Data;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class RegisterUserData extends Data
{
    /**
     * @param  list<int>  $segment_ids
     */
    public function __construct(
        #[Required, StringType, Max(255)]
        public readonly string $name,
        #[Required, Email, Max(255)]
        public readonly string $email,
        #[Required, StringType, Min(6)]
        public readonly string $password,
        #[Required, ArrayType, Min(1)]
        public readonly array $segment_ids,
    ) {
    }
}
