<?php

namespace Database\Factories;

use App\Enums\MembershipStatus;
use App\Enums\RowPosition;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $socialNetworks = [];

        if (fake()->boolean(70)) { // 70% chance of having social networks
            $networks = ['facebook', 'instagram', 'twitter', 'linkedin', 'tiktok'];
            $count = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $network = fake()->randomElement($networks);
                $socialNetworks[] = [
                    'name' => $network,
                    'url' => fake()->url(),
                ];
                // Remove to avoid duplicates
                $networks = array_diff($networks, [$network]);
            }
        }

        // Weighted distribution for membership_status: 90% active, 5% suspended, 5% inactive
        $statusRandom = fake()->numberBetween(1, 100);
        if ($statusRandom <= 90) {
            $membershipStatus = MembershipStatus::Activo;
        } elseif ($statusRandom <= 95) {
            $membershipStatus = MembershipStatus::Suspendido;
        } else {
            $membershipStatus = MembershipStatus::Inactivo;
        }

        return [
            'name' => fake()->name(),
            'run' => fake()->unique()->numerify('########-#'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'join_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'is_active' => fake()->boolean(85), // 85% probability of being active
            'is_admin' => fake()->boolean(10), // 10% probability of being admin
            'membership_status' => $membershipStatus,
            'user_type_id' => \App\Models\UserType::inRandomOrder()->first()?->id ?? \App\Models\UserType::factory(),
            'gender' => fake()->randomElement(['masculino', 'femenino']),
            'baptism' => fake()->boolean(80), // 80% probability of being baptized
            'initiation' => fake()->boolean(80), // 80% probability of being initiated
            'confirmation' => fake()->boolean(60), // 60% probability of being confirmed
            'row_position' => fake()->randomElement(RowPosition::cases()),
            'address' => fake()->address(),
            'commune_id' => Commune::inRandomOrder()->first()?->id,
            'health_background' => fake()->boolean(30) ? fake()->sentence(10) : null, // 30% have health background
            'photo_path' => null, // Will be set manually or via upload
            'social_networks' => $socialNetworks,
            'annotations' => [],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
