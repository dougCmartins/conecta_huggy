<?php

namespace Database\Seeders;

use Domain\User\Models\Preference;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::factory()->count(1)->create([
            'password' => Hash::make('123')
        ]);

        Preference::create([
            'user_id'       => $user->first()->id,
            'is_subscribed' => true,
        ]);
    }
}
