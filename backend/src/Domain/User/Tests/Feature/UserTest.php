<?php

declare(strict_types=1);

namespace Domain\User\Tests\Feature;

use Domain\Segment\Models\Segment;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_registers_a_user_with_segments(): void
    {
        $segment = Segment::factory()->create();

        $response = $this->postJson('/api/user', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'password' => 'secret-pass',
            'segment_ids' => [$segment->id],
        ]);

        $response->assertCreated()
            ->assertJsonPath('name', 'Ada Lovelace')
            ->assertJsonPath('email', 'ada@example.com')
            ->assertJsonPath('is_subscribed', true)
            ->assertJsonPath('segment_ids.0', $segment->id);

        $this->assertDatabaseHas('users', ['email' => 'ada@example.com']);
    }

    public function test_register_rejects_an_unknown_segment(): void
    {
        $response = $this->postJson('/api/user', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'password' => 'secret-pass',
            'segment_ids' => [999],
        ]);

        $response->assertStatus(404)
            ->assertJsonPath('code', 'SEGMENT_NOT_FOUND');

        $this->assertDatabaseMissing('users', ['email' => 'ada@example.com']);
    }

    public function test_register_rejects_a_missing_password(): void
    {
        $segment = Segment::factory()->create();

        $response = $this->postJson('/api/user', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'segment_ids' => [$segment->id],
        ]);

        $response->assertStatus(422);
    }

    public function test_shows_the_authenticated_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);
        $user->preference()->create(['is_subscribed' => true]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/user');

        $response->assertOk()
            ->assertJsonPath('email', 'ada@example.com')
            ->assertJsonPath('is_subscribed', true);
    }

    public function test_show_requires_authentication(): void
    {
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_updates_preferences_for_an_existing_user(): void
    {
        $segment = Segment::factory()->create();
        $user = User::factory()->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);
        $user->preference()->create(['is_subscribed' => true]);

        $response = $this->putJson('/api/user/preference', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'is_subscribed' => false,
            'segment_ids' => [$segment->id],
        ]);

        $response->assertOk()
            ->assertJsonPath('is_subscribed', false)
            ->assertJsonPath('segment_ids.0', $segment->id);
    }

    public function test_preference_update_returns_not_found_for_an_unknown_user(): void
    {
        $response = $this->putJson('/api/user/preference', [
            'name' => 'Missing',
            'email' => 'missing@example.com',
            'is_subscribed' => true,
        ]);

        $response->assertStatus(404)
            ->assertJsonPath('code', 'USER_NOT_FOUND');
    }

    public function test_updates_the_user_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);
        $user->preference()->create(['is_subscribed' => true]);

        Sanctum::actingAs($user);

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Ada Byron',
        ]);

        $response->assertOk()
            ->assertJsonPath('name', 'Ada Byron');
    }
}
