<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     */
    public function test_create_user(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john' . now()->timestamp . '@google.com',
            'password' => 'password',
            'segment_ids' => [1, 2, 3]
        ];

        $repository = new UserRepository();

        $user = $repository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);

        $this->assertNotNull($user->preference);
        $this->assertNotNull($user->preference->segments);
        $this->assertCount(3, $user->preference->segments);
    }
}
