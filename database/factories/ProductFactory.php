<?php

namespace Database\Factories;

use Faker\Guesser\Name;
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
        //Creating fake data for the products
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'unit-price' => $this->faker->randomFloat(2, 1, 2000),
            'stock' => $this->faker->numberBetween(1, 100),
            'disabled' => $this->faker->boolean(false)
        ];
    }
}
