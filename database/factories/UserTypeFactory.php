<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserType>
 */
class UserTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Socio' => ['description' => 'Miembro regular de la organización', 'fee' => 90000],
            'Bailarín' => ['description' => 'Miembro premium con beneficios adicionales', 'fee' => 175000],
            'Vitalicio' => ['description' => 'Miembro de la junta directiva', 'fee' => 0],
            'Voluntario' => ['description' => 'Voluntario activo de la organización', 'fee' => 50000],
        ];

        $name = fake()->randomElement(array_keys($types));

        return [
            'name' => $name,
            'description' => $types[$name]['description'],
            'fee' => $types[$name]['fee'],
        ];
    }
}
