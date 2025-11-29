<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->regexify('[A-Z]{2}[0-9]{4}'), // Generates codes like AB1234
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1000, 50000), // Integer value between 1000 and 50000
            'active' => fake()->boolean(90), // 90% chance of being active
            'photo_path' => fake()->boolean(50) ? 'items/photos/'.fake()->uuid().'.jpg' : null, // 50% chance of having a photo
            'category_id' => \App\Models\Category::factory(),
            'location_id' => fake()->boolean(80) ? \App\Models\Location::inRandomOrder()->first()?->id ?? \App\Models\Location::factory() : null, // 80% chance of having a location
        ];
    }
}
