<?php

namespace App\Repositories;

use App\Models\Preference;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class UserRepository implements UserRepositoryInterface
{
     public function create(array $data): User
     {
        $user = User::create($data);

         /** @var Preference $preference */
         $preference = $user->preference()->create([
             'is_subscribed' => true,
         ]);

         $preference->segments()->attach($data['segment_ids']);

         return $user->load('preference.segments');
     }

    public function syncUserPreferences(array $data): User
    {
        $user = User::query()->where(
            [
                'name' => $data['name'],
                'email' => $data['email']
            ]
        )->first();

        $user->update($data);

        if ($data && $data['preference']) {
            $user->preference()->updateOrCreate(
                ['user_id' => $user->id],
                ['is_subscribed' =>  $data['preference']['is_subscribed'] ?? true]
            );

            if ($data['preference']['segment_ids']) {
                $user->preference->segments()->sync($data['preference']['segment_ids']);
            }
        }

        Cache::forget("user:{$user->id}");

        return $user->load('preference.segments');
    }
}
