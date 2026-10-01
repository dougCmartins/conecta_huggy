<?php

declare(strict_types=1);

namespace Domain\User\Exceptions;

use Domain\Shared\Exceptions\DomainException;

final class UserNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('User not found.');
    }

    public function getErrorCode(): string
    {
        return 'USER_NOT_FOUND';
    }

    public function getHttpStatus(): int
    {
        return 404;
    }
}
