<?php

namespace Database\Factories;

use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TutorialFactory extends Factory
{
    protected $model = Tutorial::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(4, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->sentence(),
            'content' => fake()->paragraphs(5, true),
            'difficulty' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'status' => fake()->randomElement(['draft', 'published']),
            'duration_minutes' => fake()->numberBetween(5, 120),
            'prerequisites' => fake()->optional()->sentence(),
            'thumbnail' => null,
            'published_at' => fn(array $attrs) => $attrs['status'] === 'published' ? now() : null,
            'user_id' => User::factory(),
        ];
    }
}
