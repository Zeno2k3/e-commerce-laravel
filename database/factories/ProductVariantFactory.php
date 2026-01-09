<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL', '38', '39', '40', '41', '42']),
            'color' => fake()->colorName(),
            'material' => fake()->randomElement(['Cotton', 'Leather', 'Polyester', 'Silk']),
            'price' => fake()->randomFloat(2, 100000, 2000000),
            'stock' => fake()->numberBetween(0, 100),
            'url_image' => null, // Or fake a URL if needed, e.g., 'storage/products/fake.jpg'
        ];
    }
}
