<?php

declare(strict_types=1);

namespace Domain\Orchestrator\Auth\Actions;

use Domain\Orchestrator\Auth\Data\RegisterUserData;
use Domain\Segment\Actions\EnsureSegments;
use Domain\User\Actions\CreateUser;
use Domain\User\Actions\ShowUser;
use Domain\User\Actions\SyncPreferenceSegments;
use Domain\User\Data\CreateUserData;
use Domain\User\Data\ShowUserData;
use Domain\User\Data\UserData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class RegisterUser
{
    public function __construct(
        private readonly EnsureSegments $ensureSegments,
        private readonly CreateUser $createUser,
        private readonly SyncPreferenceSegments $syncPreferenceSegments,
        private readonly ShowUser $showUser,
    ) {
    }

    public function handle(RegisterUserData $data): UserData
    {
        return DB::transaction(function () use ($data): UserData {
            $segmentIds = array_map('intval', $data->segment_ids);

            $this->ensureSegments->handle($segmentIds);

            $user = $this->createUser->handle(new CreateUserData(
                name: $data->name,
                email: $data->email,
                password: $data->password,
            ));

            $this->syncPreferenceSegments->handle($user->id, $segmentIds);
            Cache::forget("user:{$user->id}");

            return $this->showUser->handle(new ShowUserData(id: (int) $user->id));
        });
    }
}
