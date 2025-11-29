<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomeTypes = [
            // ['name' => 'Membresias', 'description' => 'Monthly or annual membership payments', 'is_active' => true],
            // ['name' => 'Inscripción', 'description' => 'Pago único de inscripción al ingresar como miembro', 'is_active' => true],
            ['name' => 'Donaciones', 'description' => 'Charitable donations from members or public', 'account_id' => 1, 'is_active' => true],
            ['name' => 'Ventas en Eventos', 'description' => 'Revenue from events and activities', 'account_id' => 1, 'is_active' => true],
            ['name' => 'Mercancías', 'description' => 'Sales of club merchandise and products', 'account_id' => 1, 'is_active' => true],
            ['name' => 'Patrocinios', 'description' => 'Corporate sponsorship income', 'account_id' => 1, 'is_active' => true],
            ['name' => 'Recaudación de Fondos', 'description' => 'Special fundraising campaigns', 'account_id' => 1, 'is_active' => true],
            ['name' => 'Otros Ingresos', 'description' => 'Miscellaneous income sources', 'account_id' => 1, 'is_active' => true],
        ];

        foreach ($incomeTypes as $type) {
            \App\Models\IncomeType::create($type);
        }
    }
}
