<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(4, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->sentence(),
            'content' => fake()->paragraphs(5, true),
            'featured_image' => null,
            'category' => fake()->word(),
            'tags' => [fake()->word(), fake()->word()],
            'published_at' => now(),
            'status' => 'published',
            'meta_title' => $title,
            'meta_description' => fake()->sentence(),
            'user_id' => User::factory(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn(array $attrs) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
