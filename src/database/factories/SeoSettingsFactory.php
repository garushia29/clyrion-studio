<?php

namespace Database\Factories;

use App\Models\SeoSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeoSettingsFactory extends Factory
{
    protected $model = SeoSettings::class;

    public function definition(): array
    {
        return [
            'page_route' => fake()->unique()->slug(2),
            'title' => fake()->sentence(4),
            'description' => fake()->sentence(10),
            'image' => null,
            'type' => 'website',
            'is_active' => true,
        ];
    }
}
