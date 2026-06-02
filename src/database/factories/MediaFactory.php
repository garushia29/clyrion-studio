<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'original_name' => fake()->word() . '.jpg',
            'path' => 'uploads/' . fake()->uuid() . '.jpg',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(1000, 5000000),
            'user_id' => User::factory(),
        ];
    }
}
