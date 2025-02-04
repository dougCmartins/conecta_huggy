<?php

namespace Tests\Unit;

use App\Models\Segment;
use App\Repositories\SegmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Mockery;

class SegmentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     */
    public function test_index_returns_segments(): void
    {
        $segments = Segment::factory()->count(3)->create();

        $repository = Mockery::mock(SegmentRepository::class);
        $repository->shouldReceive('getAll')->andReturn($segments);

        $this->app->instance(SegmentRepository::class, $repository);
        $response = $this->getJson(route('segments.index'));

        $response->assertStatus(200)
            ->assertJson($segments->toArray());
    }
}
