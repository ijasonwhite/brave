<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed products first
        \App\Models\Product::factory(10)->create()->each(function ($product) {
        // For each product, create multiple variations
        \App\Models\ProductVariation::factory(5)->create([
            'product_id' => $product->id,
        ]);
    });

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
