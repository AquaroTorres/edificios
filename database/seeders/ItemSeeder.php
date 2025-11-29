<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\File;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 50 items de ejemplo usando las categorías existentes
        $categories = Category::all();

        Item::factory(50)->create([
            'category_id' => $categories->random()->id,
        ])->each(function (Item $item) {
            // 60% chance of having files associated
            if (fake()->boolean(60)) {
                File::factory(rand(1, 3))->create([
                    'fileable_type' => Item::class,
                    'fileable_id' => $item->id,
                ]);
            }
        });
    }
}
