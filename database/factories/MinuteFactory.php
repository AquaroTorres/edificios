<?php

namespace Database\Factories;

use App\Models\MinuteType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Minute>
 */
class MinuteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'body' => '<h2>'.fake()->sentence().'</h2><p>'.fake()->paragraphs(3, true).'</p><h3>Acuerdos</h3><ul><li>'.fake()->sentence().'</li><li>'.fake()->sentence().'</li></ul><p>'.fake()->paragraph().'</p>',
            'minute_type_id' => fake()->boolean(70) ? MinuteType::inRandomOrder()->first()?->id : null,
            'is_public' => fake()->boolean(80),
            'created_by' => User::inRandomOrder()->first()?->id,
        ];
    }
}
