<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owners

        $units = [
            ['correlative' => 1,  'unit_type_id' => 1, 'number' => 1,  'floor' => 1,  'rol' => '4040-774', 'surface' => 60.84, 'proration' => 3.73, 'owner_id' => 6],
            ['correlative' => 2,  'unit_type_id' => 1, 'number' => 2,  'floor' => 1,  'rol' => '4040-775', 'surface' => 49.38, 'proration' => 3.03, 'owner_id' => 12],
            ['correlative' => 3,  'unit_type_id' => 1, 'number' => 3,  'floor' => 1,  'rol' => '4040-776', 'surface' => 152.67, 'proration' => 9.36, 'owner_id' => 15],
            ['correlative' => 4,  'unit_type_id' => 1, 'number' => 4,  'floor' => 1,  'rol' => '4040-777', 'surface' => 131.59, 'proration' => 8.07, 'owner_id' => 15],
            ['correlative' => 5,  'unit_type_id' => 1, 'number' => 5,  'floor' => 1,  'rol' => '4040-778', 'surface' => 129.25, 'proration' => 7.93, 'owner_id' => 15],
            ['correlative' => 6,  'unit_type_id' => 1, 'number' => 6,  'floor' => 1,  'rol' => '4040-779', 'surface' => 92.88, 'proration' => 5.70, 'owner_id' => 4],
            ['correlative' => 7,  'unit_type_id' => 1, 'number' => 7,  'floor' => 1,  'rol' => '4040-780', 'surface' => 68.58, 'proration' => 4.21, 'owner_id' => 2],
            ['correlative' => 8,  'unit_type_id' => 2, 'number' => 2,  'floor' => 1,  'rol' => '4040-781', 'surface' => 48.77, 'proration' => 2.99, 'owner_id' => 15],
            ['correlative' => 9,  'unit_type_id' => 2, 'number' => 3,  'floor' => 1,  'rol' => '4040-782', 'surface' => 40.39, 'proration' => 2.48, 'owner_id' => 15],
            ['correlative' => 10, 'unit_type_id' => 2, 'number' => 4,  'floor' => 1,  'rol' => '4040-783', 'surface' => 67.69, 'proration' => 4.15, 'owner_id' => 12],
            ['correlative' => 11, 'unit_type_id' => 2, 'number' => 5,  'floor' => 1,  'rol' => '4040-784', 'surface' => 55.41, 'proration' => 3.40, 'owner_id' => 15],
            ['correlative' => 12, 'unit_type_id' => 2, 'number' => 6,  'floor' => 1,  'rol' => '4040-785', 'surface' => 51.18, 'proration' => 3.14, 'owner_id' => 11],
            ['correlative' => 13, 'unit_type_id' => 2, 'number' => 7,  'floor' => 2,  'rol' => '4040-786', 'surface' => 51.18, 'proration' => 3.14, 'owner_id' => 9],
            ['correlative' => 14, 'unit_type_id' => 2, 'number' => 8,  'floor' => 2,  'rol' => '4040-787', 'surface' => 55.41, 'proration' => 3.40, 'owner_id' => 9],
            ['correlative' => 15, 'unit_type_id' => 2, 'number' => 9,  'floor' => 2,  'rol' => '4040-788', 'surface' => 67.71, 'proration' => 4.15, 'owner_id' => 7],
            ['correlative' => 16, 'unit_type_id' => 2, 'number' => 10, 'floor' => 2,  'rol' => '4040-789', 'surface' => 45.13, 'proration' => 2.77, 'owner_id' => 2],
            ['correlative' => 17, 'unit_type_id' => 2, 'number' => 11, 'floor' => 2,  'rol' => '4040-790', 'surface' => 49.03, 'proration' => 3.01, 'owner_id' => 8],
            ['correlative' => 18, 'unit_type_id' => 2, 'number' => 12, 'floor' => 2,  'rol' => '4040-791', 'surface' => 44.56, 'proration' => 2.73, 'owner_id' => 14],
            ['correlative' => 19, 'unit_type_id' => 2, 'number' => 13, 'floor' => 2,  'rol' => '4040-792', 'surface' => 37.96, 'proration' => 2.33, 'owner_id' => 12],
            ['correlative' => 20, 'unit_type_id' => 2, 'number' => 14, 'floor' => 2,  'rol' => '4040-793', 'surface' => 53.13, 'proration' => 3.26, 'owner_id' => 13],
            ['correlative' => 21, 'unit_type_id' => 2, 'number' => 15, 'floor' => 2,  'rol' => '4040-794', 'surface' => 53.13, 'proration' => 3.26, 'owner_id' => 3],
            ['correlative' => 22, 'unit_type_id' => 2, 'number' => 16, 'floor' => 2,  'rol' => '4040-795', 'surface' => 38.61, 'proration' => 2.37, 'owner_id' => 5],
            ['correlative' => 23, 'unit_type_id' => 3, 'number' => 41, 'floor' => -1, 'rol' => '4040-478', 'surface' => 13.15, 'proration' => 0.27, 'owner_id' => 9],
            ['correlative' => 24, 'unit_type_id' => 3, 'number' => 42, 'floor' => -1, 'rol' => '4040-479', 'surface' => 12.77, 'proration' => 0.26, 'owner_id' => 9],
            ['correlative' => 25, 'unit_type_id' => 3, 'number' => 43, 'floor' => -1, 'rol' => '4040-480', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 12],
            ['correlative' => 26, 'unit_type_id' => 3, 'number' => 44, 'floor' => -1, 'rol' => '4040-481', 'surface' => 12.79, 'proration' => 0.26, 'owner_id' => 12],
            ['correlative' => 27, 'unit_type_id' => 3, 'number' => 45, 'floor' => -1, 'rol' => '4040-482', 'surface' => 12.75, 'proration' => 0.26, 'owner_id' => 12],
            ['correlative' => 28, 'unit_type_id' => 3, 'number' => 46, 'floor' => -1, 'rol' => '4040-483', 'surface' => 12.77, 'proration' => 0.26, 'owner_id' => null],
            ['correlative' => 29, 'unit_type_id' => 3, 'number' => 47, 'floor' => -1, 'rol' => '4040-484', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => null],
            ['correlative' => 30, 'unit_type_id' => 3, 'number' => 48, 'floor' => -1, 'rol' => '4040-485', 'surface' => 13.85, 'proration' => 0.28, 'owner_id' => 5],
            ['correlative' => 31, 'unit_type_id' => 3, 'number' => 49, 'floor' => -1, 'rol' => '4040-486', 'surface' => 13.85, 'proration' => 0.28, 'owner_id' => null],
            ['correlative' => 32, 'unit_type_id' => 3, 'number' => 50, 'floor' => -1, 'rol' => '4040-487', 'surface' => 12.77, 'proration' => 0.26, 'owner_id' => 14],
            ['correlative' => 33, 'unit_type_id' => 3, 'number' => 51, 'floor' => -1, 'rol' => '4040-488', 'surface' => 12.79, 'proration' => 0.26, 'owner_id' => 3],
            ['correlative' => 34, 'unit_type_id' => 3, 'number' => 52, 'floor' => -1, 'rol' => '4040-489', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 10],
            ['correlative' => 35, 'unit_type_id' => 3, 'number' => 53, 'floor' => -1, 'rol' => '4040-490', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 12],
            ['correlative' => 36, 'unit_type_id' => 3, 'number' => 54, 'floor' => -1, 'rol' => '4040-491', 'surface' => 12.78, 'proration' => 0.26, 'owner_id' => 13],
            ['correlative' => 37, 'unit_type_id' => 3, 'number' => 55, 'floor' => -1, 'rol' => '4040-492', 'surface' => 12.78, 'proration' => 0.26, 'owner_id' => 13],
            ['correlative' => 38, 'unit_type_id' => 3, 'number' => 56, 'floor' => -1, 'rol' => '4040-493', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 8],
            ['correlative' => 39, 'unit_type_id' => 3, 'number' => 57, 'floor' => -1, 'rol' => '4040-494', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 14],
            ['correlative' => 40, 'unit_type_id' => 3, 'number' => 58, 'floor' => -1, 'rol' => '4040-495', 'surface' => 12.79, 'proration' => 0.26, 'owner_id' => 7],
            ['correlative' => 41, 'unit_type_id' => 3, 'number' => 59, 'floor' => -1, 'rol' => '4040-496', 'surface' => 12.77, 'proration' => 0.26, 'owner_id' => 7],
            ['correlative' => 42, 'unit_type_id' => 3, 'number' => 60, 'floor' => -1, 'rol' => '4040-497', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 11],
            ['correlative' => 43, 'unit_type_id' => 3, 'number' => 61, 'floor' => -1, 'rol' => '4040-498', 'surface' => 12.81, 'proration' => 0.26, 'owner_id' => 6],
            ['correlative' => 44, 'unit_type_id' => 3, 'number' => 62, 'floor' => -1, 'rol' => '4040-499', 'surface' => 12.75, 'proration' => 0.26, 'owner_id' => 6],
            ['correlative' => 45, 'unit_type_id' => 3, 'number' => 63, 'floor' => -1, 'rol' => '4040-500', 'surface' => 12.68, 'proration' => 0.26, 'owner_id' => 15],
            ['correlative' => 46, 'unit_type_id' => 3, 'number' => 64, 'floor' => -1, 'rol' => '4040-501', 'surface' => 13.09, 'proration' => 0.27, 'owner_id' => 15],
            ['correlative' => 47, 'unit_type_id' => 3, 'number' => 65, 'floor' => -1, 'rol' => '4040-502', 'surface' => 13.09, 'proration' => 0.27, 'owner_id' => 15],
            ['correlative' => 48, 'unit_type_id' => 3, 'number' => 66, 'floor' => -1, 'rol' => '4040-503', 'surface' => 12.73, 'proration' => 0.26, 'owner_id' => 15],
            ['correlative' => 49, 'unit_type_id' => 3, 'number' => 67, 'floor' => -1, 'rol' => '4040-504', 'surface' => 13.11, 'proration' => 0.27, 'owner_id' => 15],
            ['correlative' => 50, 'unit_type_id' => 3, 'number' => 68, 'floor' => -1, 'rol' => '4040-505', 'surface' => 15.84, 'proration' => 0.32, 'owner_id' => 15],
            ['correlative' => 51, 'unit_type_id' => 3, 'number' => 69, 'floor' => -1, 'rol' => '4040-506', 'surface' => 15.88, 'proration' => 0.32, 'owner_id' => 15],
            ['correlative' => 52, 'unit_type_id' => 3, 'number' => 70, 'floor' => -1, 'rol' => '4040-507', 'surface' => 15.15, 'proration' => 0.31, 'owner_id' => 15],
            ['correlative' => 53, 'unit_type_id' => 3, 'number' => 71, 'floor' => -1, 'rol' => '4040-508', 'surface' => 14.00, 'proration' => 0.28, 'owner_id' => 15],
            ['correlative' => 54, 'unit_type_id' => 3, 'number' => 72, 'floor' => -1, 'rol' => '4040-509', 'surface' => 15.15, 'proration' => 0.31, 'owner_id' => 15],
            ['correlative' => 55, 'unit_type_id' => 3, 'number' => 83, 'floor' => -1, 'rol' => '4040-520', 'surface' => 15.34, 'proration' => 0.31, 'owner_id' => 15],
            ['correlative' => 56, 'unit_type_id' => 3, 'number' => 84, 'floor' => -1, 'rol' => '4040-521', 'surface' => 12.59, 'proration' => 0.26, 'owner_id' => 15],
            ['correlative' => 57, 'unit_type_id' => 3, 'number' => 85, 'floor' => -1, 'rol' => '4040-522', 'surface' => 15.85, 'proration' => 0.32, 'owner_id' => 15],
            ['correlative' => 58, 'unit_type_id' => 3, 'number' => 86, 'floor' => -1, 'rol' => '4040-523', 'surface' => 15.28, 'proration' => 0.31, 'owner_id' => 15],
            ['correlative' => 59, 'unit_type_id' => 3, 'number' => 87, 'floor' => -1, 'rol' => '4040-524', 'surface' => 16.04, 'proration' => 0.33, 'owner_id' => 15],
            ['correlative' => 60, 'unit_type_id' => 3, 'number' => 88, 'floor' => -1, 'rol' => '4040-525', 'surface' => 13.12, 'proration' => 0.27, 'owner_id' => 15],
            ['correlative' => 61, 'unit_type_id' => 3, 'number' => 89, 'floor' => -1, 'rol' => '4040-526', 'surface' => 14.44, 'proration' => 0.29, 'owner_id' => 15],
            ['correlative' => 62, 'unit_type_id' => 4, 'number' => 1,  'floor' => -1, 'rol' => '4040-252', 'surface' => 2.94, 'proration' => 0.06, 'owner_id' => 12],
            ['correlative' => 63, 'unit_type_id' => 4, 'number' => 2,  'floor' => -1, 'rol' => '4040-253', 'surface' => 3.04, 'proration' => 0.06, 'owner_id' => 12],
            ['correlative' => 64, 'unit_type_id' => 4, 'number' => 3,  'floor' => -1, 'rol' => '4040-254', 'surface' => 3.07, 'proration' => 0.06, 'owner_id' => 9],
            ['correlative' => 65, 'unit_type_id' => 4, 'number' => 4,  'floor' => -1, 'rol' => '4040-255', 'surface' => 6.13, 'proration' => 0.12, 'owner_id' => 9],
            ['correlative' => 66, 'unit_type_id' => 4, 'number' => 5,  'floor' => -1, 'rol' => '4040-256', 'surface' => 2.38, 'proration' => 0.05, 'owner_id' => null],
            ['correlative' => 67, 'unit_type_id' => 4, 'number' => 6,  'floor' => -1, 'rol' => '4040-257', 'surface' => 2.28, 'proration' => 0.05, 'owner_id' => 6],
            ['correlative' => 68, 'unit_type_id' => 4, 'number' => 7,  'floor' => -1, 'rol' => '4040-258', 'surface' => 3.34, 'proration' => 0.07, 'owner_id' => 15],
            ['correlative' => 69, 'unit_type_id' => 4, 'number' => 9,  'floor' => -1, 'rol' => '4040-260', 'surface' => 3.13, 'proration' => 0.06, 'owner_id' => 15],
            ['correlative' => 70, 'unit_type_id' => 4, 'number' => 10, 'floor' => -1, 'rol' => '4040-261', 'surface' => 3.13, 'proration' => 0.06, 'owner_id' => 15],
            ['correlative' => 71, 'unit_type_id' => 4, 'number' => 12, 'floor' => -1, 'rol' => '4040-263', 'surface' => 2.49, 'proration' => 0.05, 'owner_id' => 15],
            ['correlative' => 72, 'unit_type_id' => 4, 'number' => 13, 'floor' => -1, 'rol' => '4040-264', 'surface' => 4.37, 'proration' => 0.09, 'owner_id' => 15],

        ];

        DB::table('units')->insert($units);
    }
}
