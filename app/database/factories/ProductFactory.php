<?php

namespace Database\Factories;

use App\Models\Category;
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
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(512),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'price_discount' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }

}
