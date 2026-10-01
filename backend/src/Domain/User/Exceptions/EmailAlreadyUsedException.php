<?php

declare(strict_types=1);

namespace Domain\User\Exceptions;

use Domain\Shared\Exceptions\DomainException;

final class EmailAlreadyUsedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Email is already in use.');
    }

    public function getErrorCode(): string
    {
        return 'EMAIL_ALREADY_USED';
    }

    public function getHttpStatus(): int
    {
        return 422;
    }
}
