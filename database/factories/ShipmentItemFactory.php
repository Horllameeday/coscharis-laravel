<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShipmentItem>
 */
class ShipmentItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'name' => fake()->words(3, true),
            'category_id' => ProductCategory::inRandomOrder()->first()->id,
            'note' => fake()->randomElement([null, fake()->sentence(), null]),
            'images' => fake()->boolean(50) ? [
                "https://asset.cloudinary.com/horllameeday/da7d1e0ebb99515a34f9a00f141fc1f2"
            ] : null,
            'item_value' => fake()->randomFloat(2, 10, 5000),
            'quantity' => fake()->numberBetween(1, 20),
            'weight' => fake()->randomFloat(2, 0.5, 150.00),
        ];
    }
}
