<?php

namespace Database\Seeders;

use App\Models\Minute;
use Illuminate\Database\Seeder;

class MinuteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 30 actas de ejemplo
        Minute::factory(30)->create();
    }
}
