<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeType>
 */
class IncomeTypeFactory extends Factory
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
                'Membership Fees', 'Donations', 'Event Sales', 'Merchandise', 'Sponsorships',
                'Grants', 'Interest', 'Fundraising', 'Consulting', 'Other Income',
            ]),
            'description' => fake()->optional(0.7)->sentence(),
            'account_id' => 1,
            'is_active' => fake()->boolean(85),
        ];
    }
}
