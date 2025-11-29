<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'issued_date' => fake()->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'user_id' => \App\Models\User::inRandomOrder()->first()?->id ?? \App\Models\User::factory(),
            'certificate_type_id' => \App\Models\CertificateType::inRandomOrder()->first()?->id ?? \App\Models\CertificateType::factory(),
            'signer_id_1' => 4,
            'signer_id_2' => null,
            'signer_id_3' => 2,
            'citation_start' => fake()->optional()->dateTimeBetween('-6 months', 'now'),
            'citation_end' => fake()->optional()->dateTimeBetween('now', '+6 months'),
            'institution' => fake()->company(),
            'pdf_path' => fake()->filePath(),
        ];
    }
}
