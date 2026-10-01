<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Exceptions\UserNotFoundException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Log;

final class IssueAccessToken
{
    public function handle(int $userId): string
    {
        $user = User::query()->find($userId);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $user->tokens()->delete();

        $token = $user->createToken('ConectaHuggy', ['expiration' => 525600])->plainTextToken;

        Log::info('Access token issued', ['user_id' => $user->id]);

        return $token;
    }
}
