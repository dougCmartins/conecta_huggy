<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'title'       => $this->faker->sentence(6),
            'subtitle'    => $this->faker->sentence(10),
            'content'     => $this->faker->paragraph(4),
            'image'       => 'digital.jpg',
            'published'   => $this->faker->boolean(10),
        ];
    }
}
