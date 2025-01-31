<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Repositories\Interfaces\PreferenceRepositoryInterface;

class PreferenceRepository implements PreferenceRepositoryInterface
{
    public function create(int $userId, array $data): Preference
    {
        $preference = Preference::create([
            'user_id'       => $userId,
            'is_subscribed' => $data['is_subscribed'],
        ]);

        $preference->segments()->sync($data['segment_ids']);

        return $preference;
    }

    public function update(int $id, array $data): Preference
    {
        $preference = Preference::findOrFail($id);

        $preference->update([
            'is_subscribed' => $data['is_subscribed']
        ]);

        $preference->segments()->sync($data['segment_ids']);

        return $preference;
    }
}
