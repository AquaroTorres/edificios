<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseTypes = [
            ['name' => 'Suministros de Oficina', 'description' => 'Papers, pens, and other office materials', 'account_id' => 1],
            ['name' => 'Servicios Públicos', 'description' => 'Electricity, water, gas, internet', 'account_id' => 1],
            ['name' => 'Alquiler', 'description' => 'Monthly rent payments', 'account_id' => 1],
            ['name' => 'Equipos', 'description' => 'Computers, furniture, tools', 'account_id' => 1],
            ['name' => 'Marketing', 'description' => 'Advertising and promotional expenses', 'account_id' => 1],
            ['name' => 'Viajes', 'description' => 'Transportation and accommodation', 'account_id' => 1],
            ['name' => 'Seguros', 'description' => 'Business insurance premiums', 'account_id' => 1],
            ['name' => 'Servicios Profesionales', 'description' => 'Legal, accounting, consulting', 'account_id' => 1],
            ['name' => 'Mantenimiento', 'description' => 'Repairs and upkeep', 'account_id' => 1],
            ['name' => 'Varios', 'description' => 'Other general expenses', 'account_id' => 1],
        ];

        foreach ($expenseTypes as $type) {
            \App\Models\ExpenseType::create($type);
        }
    }
}
