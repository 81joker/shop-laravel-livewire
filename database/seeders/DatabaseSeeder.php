<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Product::factory(4)->hasVariants(5)
        ->has(Image::factory(3)->sequence(fn ($sequence) => ['featured' => $sequence->index === 0]))
        // ->hasImages(3)
        // ->has(Image::factory(3)->squence()->state(fn (array $attributes, Product $product) => ['product_id' => $product->id]))
        ->create();
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
