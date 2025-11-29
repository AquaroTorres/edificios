<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Bailarines mayor 12 años Nuevo' => ['description' => 'Bailarines', 'fee' => 20000],
            'Bailarines mayor 12 años Antiguo' => ['description' => 'Bailarines', 'fee' => 15000],
            'Bailarines menor 12 años Nuevo' => ['description' => 'Bailarines jóvenes', 'fee' => 10000],
            'Bailarines menor 12 años Antiguo' => ['description' => 'Bailarines jóvenes', 'fee' => 6700],
            'Socios' => ['description' => 'Socios de la organización', 'fee' => 8350],
        ];

        foreach ($types as $name => $data) {
            UserType::create(array_merge(['name' => $name], $data));
        }
    }
}
