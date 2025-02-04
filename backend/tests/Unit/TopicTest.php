<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use App\Repositories\TopicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $category;
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->repository = app(TopicRepository::class);
    }

    public function test_get_all_topic(): void
    {
        $topic = Topic::factory()->create([
            'user_id' => $this->user->id,
            'category_id' => $this->category->id
        ]);

        $mockCollection = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([$topic]),
            1,
            15,
            1
        );

        $repository = Mockery::mock(TopicRepository::class);
        $repository->shouldReceive('getAll')
            ->andReturn($mockCollection);

        $this->app->instance(TopicRepository::class, $repository);

        $response = $this->getJson(route('topics.index'));
        $response->assertStatus(200)
            ->assertJsonFragment($topic->toArray());
    }

    public function test_get_by_id_topic(): void
    {
        $topicFakeId = 1;
        $res = $this->repository->getById($topicFakeId);

        $this->assertNotNull($res);
        $this->assertEquals($topicFakeId, $res->id);
    }

    public function test_get_by_id_topic_with_relation(): void
    {
        $topicFakeId = 1;
        $res = $this->repository->getByIdWithRelations($topicFakeId);

        $this->assertNotNull($res);
        $this->assertEquals($topicFakeId, $res->id);
        $this->assertNotNull($res->user);
        $this->assertNotNull($res->category);
    }
}
