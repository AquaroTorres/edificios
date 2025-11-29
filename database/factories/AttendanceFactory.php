<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('first day of January this year', 'last day of December this year')->format('Y-m-d'),
            'subject' => $this->faker->sentence(3),
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
