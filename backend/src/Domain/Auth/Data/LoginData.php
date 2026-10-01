<?php

declare(strict_types=1);

namespace Domain\Auth\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

final class LoginData extends Data
{
    public function __construct(
        #[Required, Email]
        public readonly string $email,
        #[Required, StringType]
        public readonly string $password,
    ) {
    }
}
