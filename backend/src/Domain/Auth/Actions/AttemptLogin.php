<?php

declare(strict_types=1);

namespace Domain\Auth\Actions;

use Domain\Auth\Data\LoginData;
use Domain\Auth\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class AttemptLogin
{
    public function handle(LoginData $data): int
    {
        $authenticated = Auth::attempt([
            'email' => $data->email,
            'password' => $data->password,
        ]);

        if (! $authenticated) {
            throw new InvalidCredentialsException();
        }

        Log::info('Login attempted', ['user_id' => Auth::id()]);

        return (int) Auth::id();
    }
}
