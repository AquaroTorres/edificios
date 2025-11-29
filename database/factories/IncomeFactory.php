<?php

namespace Database\Factories;

use App\Enums\PaymentMechanism;
use App\Models\IncomeType;
use App\Models\MembershipFee;
use App\Models\User;
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

        // Si es tipo de cuota de membresía (id: 2), asociarlo a una cuota existente
        if ($incomeTypeId === 2) {
            // Obtener una cuota que tenga saldo pendiente
            $membershipFee = MembershipFee::where('status', '!=', 'pagado')
                ->whereColumn('paid_amount', '<', 'amount')
                ->inRandomOrder()
                ->first();

            // Si no hay cuotas pendientes, buscar cualquier cuota
            if (! $membershipFee) {
                $membershipFee = MembershipFee::inRandomOrder()->first();
            }

            // Calcular el monto máximo a pagar (no puede exceder el pendiente)
            $maxAmount = $membershipFee ? $membershipFee->pending_amount : 0;

            // Si no hay pendiente, usar el monto de la cuota
            if ($maxAmount <= 0 && $membershipFee) {
                $maxAmount = $membershipFee->amount;
            }

            // Generar un monto entre 1000 y el máximo pendiente
            $amount = $maxAmount > 0
                ? fake()->numberBetween(min(1000, $maxAmount), $maxAmount)
                : fake()->numberBetween(5000, 50000);

            return [
                'concept' => $membershipFee
                    ? "Pago cuota período {$membershipFee->period} {$membershipFee->year}"
                    : 'Pago cuota membresía',
                'notes' => fake()->optional()->sentence(),
                'amount' => $amount,
                'date' => fake()->dateTimeBetween($startOfYear, $endOfYear)->format('Y-m-d'),
                'income_type_id' => 2,
                'mechanism' => fake()->randomElement(PaymentMechanism::cases())->value,
                'user_id' => $membershipFee?->user_id ?? User::inRandomOrder()->first()?->id,
                'membership_fee_id' => $membershipFee?->id,
            ];
        }

        // Para otros tipos de ingreso
        return [
            'concept' => fake()->sentence(3),
            'notes' => fake()->optional()->sentence(),
            'amount' => fake()->numberBetween(5000, 100000),
            'date' => fake()->dateTimeBetween($startOfYear, $endOfYear)->format('Y-m-d'),
            'income_type_id' => $incomeTypeId,
            'mechanism' => fake()->randomElement(PaymentMechanism::cases())->value,
            'user_id' => null,
            'membership_fee_id' => null,
        ];
    }

    /**
     * Indicate that this income is a membership fee payment
     */
    public function membershipFeePayment(): static
    {
        return $this->state(function (array $attributes) {
            // Obtener una cuota que tenga saldo pendiente
            $membershipFee = MembershipFee::where('status', '!=', 'pagado')
                ->whereColumn('paid_amount', '<', 'amount')
                ->inRandomOrder()
                ->first();

            // Si no hay cuotas pendientes, buscar cualquier cuota
            if (! $membershipFee) {
                $membershipFee = MembershipFee::inRandomOrder()->first();
            }

            if (! $membershipFee) {
                throw new \Exception('No hay cuotas de membresía disponibles. Crea cuotas primero.');
            }

            // Calcular el monto máximo a pagar (no puede exceder el pendiente)
            $maxAmount = $membershipFee->pending_amount > 0
                ? $membershipFee->pending_amount
                : $membershipFee->amount;

            // Generar un monto entre 1000 y el máximo pendiente
            $amount = fake()->numberBetween(min(1000, $maxAmount), $maxAmount);

            return [
                'income_type_id' => 2, // Membership Fees
                'mechanism' => fake()->randomElement(PaymentMechanism::cases())->value,
                'membership_fee_id' => $membershipFee->id,
                'user_id' => $membershipFee->user_id,
                'concept' => "Pago cuota período {$membershipFee->period} {$membershipFee->year}",
                'amount' => $amount,
            ];
        });
    }

    /**
     * Create an income for a regular non-membership payment
     */
    public function regularIncome(): static
    {
        return $this->state(fn (array $attributes) => [
            'income_type_id' => IncomeType::where('id', '>', 2)->inRandomOrder()->first()?->id ?? 3,
            'membership_fee_id' => null,
        ]);
    }
}
