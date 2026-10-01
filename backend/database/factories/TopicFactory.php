<?php

namespace Database\Factories;

use Domain\Content\Models\Category;
use Domain\Content\Models\Topic;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Content\Models\Topic>
 */
class TopicFactory extends Factory
{
    protected $model = Topic::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'category_id' => Category::factory(),
            'title'       => $this->faker->sentence(6),
            'subtitle'    => $this->faker->sentence(10),
            'content'     => $this->faker->paragraph(4),
            'image'       => 'digital.jpg',
            'is_closed'   => $this->faker->boolean(10),
        ];
    }
}
