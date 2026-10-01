<?php

declare(strict_types=1);

namespace Domain\Auth\Exceptions;

use Domain\Shared\Exceptions\DomainException;

final class LeadNotConfiguredException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Lead delivery is not configured.');
    }

    public function getErrorCode(): string
    {
        return 'LEAD_NOT_CONFIGURED';
    }

    public function getHttpStatus(): int
    {
        return 500;
    }
}
