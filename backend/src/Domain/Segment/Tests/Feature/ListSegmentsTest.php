<?php

declare(strict_types=1);

namespace Domain\Segment\Tests\Feature;

use Domain\Segment\Models\Segment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ListSegmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_segments_inside_the_envelope(): void
    {
        Segment::factory()->create([
            'name' => 'customer_success',
            'description' => 'Canal de Relacionamento',
        ]);

        $response = $this->getJson('/api/segments');

        $response->assertOk()
            ->assertJsonPath('0.name', 'customer_success')
            ->assertJsonPath('0.description', 'Canal de Relacionamento');
    }

    public function test_returns_an_empty_list_when_there_are_no_segments(): void
    {
        $response = $this->getJson('/api/segments');

        $response->assertOk()
            ->assertExactJson([]);
    }
}
