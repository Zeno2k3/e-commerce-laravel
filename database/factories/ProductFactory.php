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
        static $sequence = null;

        if ($sequence === null) {
            $lastProduct = \App\Models\Product::latest('product_id')->first();
            if ($lastProduct && preg_match('/PR(\d+)/', $lastProduct->product_code ?? '', $matches)) {
                $sequence = intval($matches[1]) + 1;
            } else {
                $sequence = 1;
            }
        }

        $code = 'PR' . str_pad($sequence++, 2, '0', STR_PAD_LEFT);

        return [
            'product_name' => fake()->words(3, true),
            'product_code' => $code,
            'description' => fake()->paragraph(),
            'product_type' => fake()->randomElement(['nam', 'nu', 'phu-kien']),
            'status' => 'active',
            'rating' => fake()->randomFloat(1, 3, 5),
            'reviews_count' => fake()->numberBetween(0, 500),
            'discount_percentage' => fake()->randomElement([0, 10, 15, 20, 25, 30]),
            'old_price' => fake()->randomFloat(2, 500000, 2000000),
        ];
    }
}
