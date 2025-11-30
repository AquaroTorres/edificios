<?php

namespace Database\Factories;

use App\Enums\MembershipStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'run' => fake()->unique()->numerify('########-#'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'join_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'position' => fake()->jobTitle(),
            'is_active' => fake()->boolean(85), // 85% probability of being active
            'is_admin' => fake()->boolean(10), // 10% probability of being admin
            'is_super_admin' => false,
            'membership_status' => MembershipStatus::Activo,
            'password' => Hash::make('password'),
        ];
    }
}
