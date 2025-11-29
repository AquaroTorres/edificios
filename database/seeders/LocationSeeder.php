<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Sede Central - La Tirana',
                'description' => 'Primary storage facility for large equipment and bulk items',
                'address' => '123 Industrial Blvd, Warehouse District',
                'is_active' => true,
            ],
            [
                'name' => 'Sede Iquique - Bodega A',
                'description' => 'Storage area on the second floor for IT equipment',
                'address' => '456 Business Ave, Suite 200',
                'is_active' => true,
            ],
            [
                'name' => 'Sede Iquique - Bodega B',
                'description' => 'Storage area on the second floor for office supplies',
                'address' => '456 Business Ave, Suite 300',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }

        // Create additional random locations
        // Location::factory()->count(4)->create();
    }
}
