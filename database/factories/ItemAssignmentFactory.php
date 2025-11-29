<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemAssignment>
 */
class ItemAssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $assignedAt = fake()->dateTimeBetween('-1 year', 'now');
        $isReturned = fake()->boolean(70); // 70% probabilidad de estar devuelto

        return [
            'item_id' => \App\Models\Item::factory(),
            'user_id' => \App\Models\User::factory(),
            'assigned_at' => $assignedAt,
            'returned_at' => $isReturned ? fake()->dateTimeBetween($assignedAt, 'now') : null,
            'notes' => fake()->optional(0.6)->sentence(),
            'assigned_by' => \App\Models\User::factory(),
        ];
    }
}
