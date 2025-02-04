<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
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
