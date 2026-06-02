<?php

namespace Database\Factories;

use App\Models\TutorialSeries;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TutorialSeriesFactory extends Factory
{
    protected $model = TutorialSeries::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence(),
            'difficulty' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'thumbnail' => null,
            'sort_order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
