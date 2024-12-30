<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'image' => $this->faker->imageUrl(),
            'category_id' => Category::all()->random()->id,
            'featured' => $this->faker->numberBetween(0, 1),
            'compare_price' => $this->faker->numberBetween(1000, 10000),
            'rating' => $this->faker->numberBetween(1, 5),
            'store_id' => $this->faker->numberBetween(1, 10),
            'slug' => $this->faker->slug(),
        ];
    }
}
