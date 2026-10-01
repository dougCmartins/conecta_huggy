<?php

declare(strict_types=1);

namespace Domain\Content\Tests\Feature;

use Domain\Content\Models\Article;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ListArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_a_page_of_articles_with_the_author_name(): void
    {
        $author = User::factory()->create(['name' => 'Ada Lovelace']);
        Article::factory()->create([
            'user_id' => $author->id,
            'title' => 'Customer Success',
            'published' => true,
        ]);

        $response = $this->getJson('/api/articles?page=1&perPage=7');

        $response->assertOk()
            ->assertJsonPath('0.title', 'Customer Success')
            ->assertJsonPath('0.author_name', 'Ada Lovelace')
            ->assertJsonPath('0.published', true)
            ->assertJsonMissingPath('0.author');
    }

    public function test_rejects_an_invalid_page(): void
    {
        $response = $this->getJson('/api/articles?page=0');

        $response->assertStatus(422);
    }
}
