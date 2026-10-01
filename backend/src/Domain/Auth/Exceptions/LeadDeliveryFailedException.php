<?php

declare(strict_types=1);

namespace Domain\Auth\Exceptions;

use Domain\Shared\Exceptions\DomainException;

final class LeadDeliveryFailedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Lead delivery failed.');
    }

    public function getErrorCode(): string
    {
        return 'LEAD_DELIVERY_FAILED';
    }

    public function getHttpStatus(): int
    {
        return 502;
    }
}
