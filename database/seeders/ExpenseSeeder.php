<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $expenses = [
            ['billing_period_id' => 1, 'expense_type_id' => 1, 'concept' => 'Empresa externa Elizabeth nuñez espinoza e.i.r.l FACT.', 'amount' => 4879000, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 1, 'concept' => 'Insumos de administración', 'amount' => 0, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 1, 'concept' => 'Administración', 'amount' => 500000, 'user_id' => 1, 'date' => '2025-11-01'],

            ['billing_period_id' => 1, 'expense_type_id' => 2, 'concept' => 'Mantencion cuenta banco santander', 'amount' => 41000, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 2, 'concept' => 'Mantencion Preventiva de ascensores INGENIERIA EMSEL ASCENSORES LTDA. FACT.', 'amount' => 188701, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 2, 'concept' => 'MANTENCION PREVENTIVA BOMBAS DE AGUA Y GENERADOR MAS PORTON FACT.', 'amount' => 300000, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 2, 'concept' => 'SEGURO OBLIGATORIO AREAS COMUNES', 'amount' => 376608, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 2, 'concept' => 'ARRIENDO RETIRO DE BASURA', 'amount' => 512000, 'user_id' => 1, 'date' => '2025-11-01'],

            ['billing_period_id' => 1, 'expense_type_id' => 3, 'concept' => 'consumo de enegia electrina Boleta: 359833342', 'amount' => 280400, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 3, 'concept' => 'AGUINALDO GUARDIAS', 'amount' => 300000, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 3, 'concept' => 'Empresa GTD (internet) 2359520', 'amount' => 0, 'user_id' => 1, 'date' => '2025-11-01'],
            ['billing_period_id' => 1, 'expense_type_id' => 3, 'concept' => 'REPARACION CERRAMICA', 'amount' => 430000, 'user_id' => 1, 'date' => '2025-11-01'],
        ];

        foreach ($expenses as $expense) {
            Expense::create($expense);
        }
    }
}
