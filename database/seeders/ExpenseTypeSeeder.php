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
            ['name' => 'GASTOS DE  SERVICIO ADMINISTRACION', 'description' => 'Papers, pens, and other office materials', 'account_id' => 1],
            ['name' => 'GASTOS DE MANTENCION PREVENTIVA OBLIGATOTORIAS EXTABLECIDAS POR CONTRATO', 'description' => 'Electricity, water, gas, internet', 'account_id' => 1],
            ['name' => 'GASTOS DE SERVICIOS EXTERNOS, REPARACIONES  Y  CONSUMOS BASICOS', 'description' => 'Monthly rent payments', 'account_id' => 1],
            ['name' => 'OTROS', 'description' => 'Computers, furniture, tools', 'account_id' => 1],
        ];

        foreach ($expenseTypes as $type) {
            \App\Models\ExpenseType::create($type);
        }
    }
}
