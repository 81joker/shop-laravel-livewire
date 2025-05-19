<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'path' => fake()->unique($reset = true)->randomElement(['media/1.jpg', 'media/2.jpg', 'media/3.jpg', 'media/4.jpg', 'media/5.jpg']),
        ];
    }
}
