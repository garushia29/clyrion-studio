<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'technologies' => [fake()->word(), fake()->word(), fake()->word()],
            'year' => fake()->numberBetween(2020, 2026),
            'url' => fake()->url(),
            'github_url' => 'https://github.com/' . fake()->userName() . '/' . Str::slug($title),
            'featured' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(0, 10),
            'status' => 'published',
            'meta_title' => $title,
            'meta_description' => fake()->sentence(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn(array $attrs) => ['status' => 'draft']);
    }
}
