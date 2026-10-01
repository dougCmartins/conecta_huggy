<?php

namespace Database\Factories;

use Domain\Content\Models\Article;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Content\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
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
