<?php

declare(strict_types=1);

namespace Domain\Segment\Exceptions;

use Domain\Shared\Exceptions\DomainException;

final class SegmentNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Segment not found.');
    }

    public function getErrorCode(): string
    {
        return 'SEGMENT_NOT_FOUND';
    }

    public function getHttpStatus(): int
    {
        return 404;
    }
}
