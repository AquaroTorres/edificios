<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Crear 75 gastos de ejemplo distribuidos entre usuarios
        for ($i = 0; $i < 75; $i++) {
            Expense::factory()->create([
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
