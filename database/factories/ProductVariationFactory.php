<?php

namespace Database\Factories;

use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = ProductVariation::class;

    public function definition(): array
    {
        return [
            'product_id' => null,  // This will be set when creating variations linked to a product
            'sku' => $this->faker->unique()->numberBetween(1000, 9999),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'color' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Black', 'White']),
            'price' => $this->faker->randomFloat(2, 1, 10),
            'inventory' => $this->faker->numberBetween(10, 100),
        ];
    }
}
