<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create User
        if (! User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'full_name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password123',
                'phone_number' => '0123456789',
                'role' => 'admin',
                'status' => 'active',
            ]);
        }

        // 2. Create Categories
        $categories = Category::factory(5)->create();

        // 3. Create Products with Variants
        Product::factory(20)
            ->recycle($categories) // Assign products to created categories
            ->has(ProductVariant::factory()->count(3), 'variants')
            ->create();
    }
}
