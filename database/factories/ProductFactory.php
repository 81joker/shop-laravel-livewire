<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Tishirt', 'Laravel Cup', 'Blue Shirt', 'Shoes', 'Pants']),
            'description' => fake()->text('100'),
            'price' => fake()->numberBetween(1, 100),
            'main_image' => fake()->numberBetween(1, 10),

        ];
    }
}
