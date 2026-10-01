<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Data\ShowUserData;
use Domain\User\Data\UpdateUserData;
use Domain\User\Data\UserData;
use Domain\User\Exceptions\EmailAlreadyUsedException;
use Domain\User\Exceptions\UserNotFoundException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

final class UpdateUser
{
    public function __construct(private readonly ShowUser $showUser)
    {
    }

    public function handle(UpdateUserData $data): UserData
    {
        $user = User::query()->find($data->id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        if ($data->email !== null && User::query()->where('email', $data->email)->whereKeyNot($user->id)->exists()) {
            throw new EmailAlreadyUsedException();
        }

        $changes = array_filter([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ], fn (mixed $value): bool => $value !== null);

        if ($changes !== []) {
            $user->update($changes);
        }

        Cache::forget("user:{$user->id}");

        Log::info('User updated', ['user_id' => $user->id]);

        return $this->showUser->handle(new ShowUserData(id: (int) $user->id));
    }
}
