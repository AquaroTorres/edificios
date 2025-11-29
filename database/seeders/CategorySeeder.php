<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Deportes', 'description' => 'Artículos deportivos y equipamiento', 'color' => '#10B981'],
            ['name' => 'Oficina', 'description' => 'Material de oficina y administración', 'color' => '#3B82F6'],
            ['name' => 'Mobiliario', 'description' => 'Muebles y mobiliario del club', 'color' => '#8B5CF6'],
            ['name' => 'Limpieza', 'description' => 'Productos de limpieza y mantenimiento', 'color' => '#F59E0B'],
            ['name' => 'Tecnología', 'description' => 'Equipos tecnológicos y electrónicos', 'color' => '#EF4444'],
            ['name' => 'Cocina', 'description' => 'Utensilios y equipos de cocina', 'color' => '#06B6D4'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
