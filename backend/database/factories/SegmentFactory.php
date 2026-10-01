<?php

namespace Database\Factories;

use Domain\Segment\Models\Segment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Segment\Models\Segment>
 */
class SegmentFactory extends Factory
{
    protected $model = Segment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->word(),
        ];
    }
}
