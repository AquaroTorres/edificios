<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Main Warehouse',
                'Storage Room A',
                'Storage Room B',
                'Office Building',
                'Equipment Room',
                'Maintenance Area',
                'Reception',
                'Conference Room',
                'Archive Room',
                'Basement Storage',
            ]),
            'description' => fake()->sentence(),
            'address' => fake()->address(),
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}
