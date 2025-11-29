<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Crear 100 ingresos de ejemplo distribuidos entre usuarios
        for ($i = 0; $i < 20; $i++) {
            Income::factory()->create([
                'user_id' => $users->random()->id,
                'receiver_id' => 3, // tesorero
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            Income::factory()->create([
                'user_id' => $users->random()->id,
                'receiver_id' => 3, // tesorero
                'income_type_id' => 2,
            ]);
        }
    }
}
