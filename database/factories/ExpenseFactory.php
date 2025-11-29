<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'concept' => fake()->sentence(3),
            'amount' => fake()->numberBetween(5000, 100000),
            'date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'notes' => fake()->optional()->sentence(),
            'user_id' => User::factory(),
            'expense_type_id' => \App\Models\ExpenseType::inRandomOrder()->first()?->id ?? \App\Models\ExpenseType::factory(),
        ];
    }
}
