<?php

declare(strict_types=1);

namespace Domain\User\Data;

use Spatie\LaravelData\Attributes\FromRouteParameter;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class UpdateUserData extends Data
{
    public function __construct(
        #[FromRouteParameter('id'), Required, IntegerType, Min(1)]
        public readonly int $id,
        #[Nullable, StringType, Max(255)]
        public readonly ?string $name,
        #[Nullable, Email, Max(255)]
        public readonly ?string $email,
        #[Nullable, StringType, Min(6)]
        public readonly ?string $password,
    ) {
    }
}
