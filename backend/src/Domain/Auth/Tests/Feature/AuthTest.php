<?php

declare(strict_types=1);

namespace Domain\Auth\Tests\Feature;

use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_returns_a_token_inside_the_envelope(): void
    {
        User::factory()->create([
            'email' => 'ada@example.com',
            'password' => 'secret-pass',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'ada@example.com',
            'password' => 'secret-pass',
        ]);

        $response->assertCreated()
            ->assertJsonStructure(['token']);

        $this->assertNotSame('', $response->json('token'));
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'ada@example.com',
            'password' => 'secret-pass',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'ada@example.com',
            'password' => 'wrong-pass',
        ]);

        $response->assertStatus(401)
            ->assertJsonPath('code', 'INVALID_CREDENTIALS')
            ->assertJsonPath('data', null);
    }

    public function test_send_lead_posts_to_the_configured_webhook(): void
    {
        Http::fake([
            'https://hooks.example.test/*' => Http::response(['ok' => true], 200),
        ]);

        config([
            'services.zapier.webhook_url' => 'https://hooks.example.test/lead',
            'services.zapier.campaign_id' => 'campaign-1',
            'services.zapier.lead_source' => 'Teste',
        ]);

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/widget-event', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertCreated()
            ->assertJsonPath('delivered', true);

        Http::assertSent(function ($request): bool {
            return $request->url() === 'https://hooks.example.test/lead'
                && $request['nome'] === 'Ada Lovelace'
                && $request['email'] === 'ada@example.com'
                && $request['id_da_campanha'] === 'campaign-1';
        });
    }

    public function test_send_lead_requires_authentication(): void
    {
        $response = $this->postJson('/api/widget-event', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertUnauthorized();
    }

    public function test_send_lead_fails_when_the_webhook_is_missing(): void
    {
        config(['services.zapier.webhook_url' => null]);

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/widget-event', [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertStatus(500)
            ->assertJsonPath('code', 'LEAD_NOT_CONFIGURED');
    }
}
