<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseType>
 */
class ExpenseTypeFactory extends Factory
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
                'Office Supplies', 'Utilities', 'Rent', 'Equipment', 'Marketing',
                'Travel', 'Insurance', 'Professional Services', 'Maintenance', 'Miscellaneous',
            ]),
            'description' => fake()->optional(0.7)->sentence(),
            'account_id' => 1,
            'is_active' => fake()->boolean(85),
        ];
    }
}
