<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'logo_image' => $this->faker->imageUrl(),
            'description' => $this->faker->text(),
            'cover_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([1,0]),
            'slug' => $this->faker->slug(),
        ];
    }
}
