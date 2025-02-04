<?php

namespace Tests\Unit;

use App\Models\Article;
use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{

    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /**
     * A basic unit test example.
     */
    public function test_get_all_category(): void
    {
        $article = Article::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $mockCollection = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([$article]),
            1,
            15,
            1
        );

        $repository = Mockery::mock(ArticleRepository::class);
        $repository->shouldReceive('getAll')->andReturn($mockCollection);

        $this->app->instance(ArticleRepository::class, $repository);
        $response = $this->getJson(route('articles.index'));
        $response->assertStatus(200)
            ->assertJsonFragment($article->toArray());
    }
}
