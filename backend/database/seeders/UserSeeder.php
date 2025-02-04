<?php

namespace Database\Seeders;

use App\Models\Preference;
use Illuminate\Database\Seeder;
use App\Models\User;
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
