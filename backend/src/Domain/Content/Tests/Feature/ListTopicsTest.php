<?php

declare(strict_types=1);

namespace Domain\Content\Tests\Feature;

use Domain\Content\Models\Category;
use Domain\Content\Models\Topic;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ListTopicsTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_topics_with_author_and_category_names(): void
    {
        $author = User::factory()->create(['name' => 'Grace Hopper']);
        $category = Category::factory()->create(['name' => 'Atendimento']);
        Topic::factory()->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'title' => 'Fila de atendimento',
            'is_closed' => false,
        ]);

        $response = $this->getJson('/api/topics?page=1');

        $response->assertOk()
            ->assertJsonPath('0.title', 'Fila de atendimento')
            ->assertJsonPath('0.author_name', 'Grace Hopper')
            ->assertJsonPath('0.category_name', 'Atendimento')
            ->assertJsonPath('0.is_closed', false);
    }

    public function test_rejects_an_invalid_page(): void
    {
        $response = $this->getJson('/api/topics?page=0');

        $response->assertStatus(422);
    }
}
