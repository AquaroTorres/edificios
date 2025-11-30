<?php

namespace Database\Factories;

use App\Enums\PaymentMechanism;
use App\Models\IncomeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $incomeTypeId = IncomeType::inRandomOrder()->first()?->id;

        $currentYear = now()->year;
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        return [
            'concept' => fake()->sentence(3),
            'notes' => fake()->optional()->sentence(),
            'amount' => fake()->numberBetween(5000, 100000),
            'date' => fake()->dateTimeBetween($startOfYear, $endOfYear)->format('Y-m-d'),
            'income_type_id' => $incomeTypeId,
            'mechanism' => fake()->randomElement(PaymentMechanism::cases())->value,
            'user_id' => null,
        ];
    }

    /**
     * Create an income for a regular non-membership payment
     */
    public function regularIncome(): static
    {
        return $this->state(fn (array $attributes) => [
            'income_type_id' => IncomeType::where('id', '>', 2)->inRandomOrder()->first()?->id ?? 3,
        ]);
    }
}
