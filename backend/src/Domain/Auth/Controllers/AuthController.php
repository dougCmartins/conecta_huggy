<?php

declare(strict_types=1);

namespace Domain\Auth\Controllers;

use Domain\Auth\Actions\SendLead;
use Domain\Auth\Data\AccessTokenData;
use Domain\Auth\Data\LeadData;
use Domain\Auth\Data\LoginData;
use Domain\Auth\Data\SendLeadData;
use Domain\Orchestrator\Auth\Actions\Login;

final class AuthController
{
    public function login(LoginData $data, Login $action): AccessTokenData
    {
        return $action->handle($data);
    }

    public function sendLead(SendLeadData $data, SendLead $action): LeadData
    {
        return $action->handle($data);
    }
}
