<?php

namespace App\Repositories\Interfaces;

use App\Models\Preference;

interface PreferenceRepositoryInterface
{
    public function create(int $userId, array $data): Preference;

    public function update(int $id, array $data): Preference;
}
