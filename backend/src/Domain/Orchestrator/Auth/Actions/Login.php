<?php

declare(strict_types=1);

namespace Domain\Orchestrator\Auth\Actions;

use Domain\Auth\Actions\AttemptLogin;
use Domain\Auth\Data\AccessTokenData;
use Domain\Auth\Data\LoginData;
use Domain\User\Actions\IssueAccessToken;
use Illuminate\Support\Facades\DB;

final class Login
{
    public function __construct(
        private readonly AttemptLogin $attemptLogin,
        private readonly IssueAccessToken $issueAccessToken,
    ) {
    }

    public function handle(LoginData $data): AccessTokenData
    {
        $userId = $this->attemptLogin->handle($data);

        $token = DB::transaction(fn (): string => $this->issueAccessToken->handle($userId));

        return new AccessTokenData(token: $token);
    }
}
