<?php

namespace Database\Seeders;

use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->firstOrCreate(
            ['email' => 'ana@conecta.test'],
            [
                'name' => 'Ana',
                'password' => '123',
            ],
        );

        $user->preference()->firstOrCreate(
            ['user_id' => $user->id],
            ['is_subscribed' => true],
        );
    }
}
