<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\Data\ApplyUserPreferencesData;
use Domain\User\Data\ShowUserData;
use Domain\User\Data\UserData;
use Domain\User\Exceptions\UserNotFoundException;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

final class ApplyUserPreferences
{
    public function __construct(
        private readonly ShowUser $showUser,
        private readonly SyncPreferenceSegments $syncPreferenceSegments,
    ) {
    }

    public function handle(ApplyUserPreferencesData $data): UserData
    {
        $user = User::query()
            ->where('name', $data->name)
            ->where('email', $data->email)
            ->first();

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $user->update([
            'name' => $data->name,
            'email' => $data->email,
        ]);

        if ($data->is_subscribed !== null) {
            $user->preference()->updateOrCreate(
                ['user_id' => $user->id],
                ['is_subscribed' => $data->is_subscribed],
            );
        }

        if ($data->segment_ids !== []) {
            $this->syncPreferenceSegments->handle($user->id, $data->segment_ids);
        }

        Cache::forget("user:{$user->id}");

        Log::info('User preferences applied', ['user_id' => $user->id]);

        return $this->showUser->handle(new ShowUserData(id: (int) $user->id));
    }
}
