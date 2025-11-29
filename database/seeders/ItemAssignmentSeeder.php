<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $items = \App\Models\Item::all();

        // Crear asignaciones para cada item (algunas activas, otras devueltas)
        foreach ($items as $item) {
            // Crear entre 1 y 4 asignaciones históricas por item
            $assignmentCount = rand(1, 4);

            for ($i = 0; $i < $assignmentCount; $i++) {
                \App\Models\ItemAssignment::factory()->create([
                    'item_id' => $item->id,
                    'user_id' => $users->random()->id,
                    'assigned_by' => $users->random()->id,
                ]);
            }
        }
    }
}
