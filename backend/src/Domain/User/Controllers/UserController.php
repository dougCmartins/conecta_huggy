<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use Domain\Orchestrator\Auth\Actions\RegisterUser;
use Domain\Orchestrator\Auth\Actions\SyncUserPreferences;
use Domain\Orchestrator\Auth\Data\RegisterUserData;
use Domain\Orchestrator\Auth\Data\SyncUserPreferencesData;
use Domain\User\Actions\ShowUser;
use Domain\User\Actions\UpdateUser;
use Domain\User\Data\ShowUserData;
use Domain\User\Data\UpdateUserData;
use Domain\User\Data\UserData;
use Illuminate\Support\Facades\Auth;

final class UserController
{
    public function show(ShowUser $action): UserData
    {
        return $action->handle(ShowUserData::from(ShowUserData::validate([
            'id' => Auth::id(),
        ])));
    }

    public function store(RegisterUserData $data, RegisterUser $action): UserData
    {
        return $action->handle($data);
    }

    public function update(UpdateUserData $data, UpdateUser $action): UserData
    {
        return $action->handle($data);
    }

    public function syncPreferences(SyncUserPreferencesData $data, SyncUserPreferences $action): UserData
    {
        return $action->handle($data);
    }
}
