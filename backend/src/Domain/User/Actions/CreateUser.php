<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Data\CreateUserData;
use Domain\User\Data\ShowUserData;
use Domain\User\Data\UserData;
use Domain\User\Exceptions\EmailAlreadyUsedException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Log;

final class CreateUser
{
    public function __construct(private readonly ShowUser $showUser)
    {
    }

    public function handle(CreateUserData $data): UserData
    {
        if (User::query()->where('email', $data->email)->exists()) {
            throw new EmailAlreadyUsedException();
        }

        $user = User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        $user->preference()->create([
            'is_subscribed' => true,
        ]);

        Log::info('User created', ['user_id' => $user->id]);

        return $this->showUser->handle(new ShowUserData(id: (int) $user->id));
    }
}
