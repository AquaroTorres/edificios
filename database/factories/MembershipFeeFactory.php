<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MembershipFee>
 */
class MembershipFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = fake()->numberBetween(2024, 2026);
        $period = fake()->randomElement([1, 2]);
        $amount = fake()->numberBetween(50000, 90000);
        $paidAmount = fake()->numberBetween(0, $amount);

        $status = match (true) {
            $paidAmount >= $amount => 'pagado',
            $paidAmount > 0 => 'parcial',
            default => fake()->randomElement(['pendiente', 'vencido']),
        };

        return [
            'user_id' => \App\Models\User::factory(),
            'concept' => 'Cuota',
            'year' => $year,
            'period' => $period,
            'amount' => $amount,
            'paid_amount' => $paidAmount,
            'due_at' => $period === 1
                ? "{$year}-04-30"
                : "{$year}-06-30",
            'paid_at' => $status === 'pagado' ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'income_type_id' => 2, // "Membership Fees"
            'status' => $status,
        ];
    }
}
