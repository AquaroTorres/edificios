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
        $units = [
            ['correlative' => 1, 'unit_type_id' => 1, 'number' => 1, 'floor' => 1, 'rol' => '4040-774', 'surface' => 60.84, 'proration' => 3.731],
            ['correlative' => 2, 'unit_type_id' => 1, 'number' => 2, 'floor' => 1, 'rol' => '4040-775', 'surface' => 49.38, 'proration' => 3.028],
            ['correlative' => 3, 'unit_type_id' => 1, 'number' => 3, 'floor' => 1, 'rol' => '4040-776', 'surface' => 152.67, 'proration' => 9.308],
            ['correlative' => 4, 'unit_type_id' => 1, 'number' => 4, 'floor' => 1, 'rol' => '4040-777', 'surface' => 131.59, 'proration' => 8.070],
            ['correlative' => 5, 'unit_type_id' => 1, 'number' => 5, 'floor' => 1, 'rol' => '4040-778', 'surface' => 129.25, 'proration' => 7.926],
            ['correlative' => 6, 'unit_type_id' => 1, 'number' => 6, 'floor' => 1, 'rol' => '4040-779', 'surface' => 92.88, 'proration' => 5.692],
            ['correlative' => 7, 'unit_type_id' => 1, 'number' => 7, 'floor' => 1, 'rol' => '4040-780', 'surface' => 68.58, 'proration' => 4.206],
            ['correlative' => 8, 'unit_type_id' => 2, 'number' => 2, 'floor' => 1, 'rol' => '4040-781', 'surface' => 40.39, 'proration' => 2.477],
            ['correlative' => 9, 'unit_type_id' => 2, 'number' => 3, 'floor' => 1, 'rol' => '4040-782', 'surface' => 51.18, 'proration' => 3.138],
            ['correlative' => 10, 'unit_type_id' => 2, 'number' => 10, 'floor' => 2, 'rol' => '4040-783', 'surface' => 45.13, 'proration' => 2.768],
            ['correlative' => 11, 'unit_type_id' => 2, 'number' => 11, 'floor' => 2, 'rol' => '4040-784', 'surface' => 49.03, 'proration' => 3.007],
            ['correlative' => 12, 'unit_type_id' => 2, 'number' => 12, 'floor' => 2, 'rol' => '4040-785', 'surface' => 44.56, 'proration' => 2.733],
            ['correlative' => 13, 'unit_type_id' => 2, 'number' => 13, 'floor' => 2, 'rol' => '4040-786', 'surface' => 37.96, 'proration' => 2.328],
            ['correlative' => 14, 'unit_type_id' => 2, 'number' => 14, 'floor' => 2, 'rol' => '4040-787', 'surface' => 53.13, 'proration' => 3.258],
            ['correlative' => 15, 'unit_type_id' => 2, 'number' => 15, 'floor' => 2, 'rol' => '4040-788', 'surface' => 53.13, 'proration' => 3.258],
            ['correlative' => 16, 'unit_type_id' => 2, 'number' => 16, 'floor' => 2, 'rol' => '4040-789', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 17, 'unit_type_id' => 2, 'number' => 17, 'floor' => 2, 'rol' => '4040-790', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 18, 'unit_type_id' => 2, 'number' => 18, 'floor' => 2, 'rol' => '4040-791', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 19, 'unit_type_id' => 2, 'number' => 19, 'floor' => 2, 'rol' => '4040-792', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 20, 'unit_type_id' => 2, 'number' => 20, 'floor' => 2, 'rol' => '4040-793', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 21, 'unit_type_id' => 2, 'number' => 21, 'floor' => 2, 'rol' => '4040-794', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 22, 'unit_type_id' => 2, 'number' => 22, 'floor' => 2, 'rol' => '4040-795', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 23, 'unit_type_id' => 3, 'number' => 23, 'floor' => -1, 'rol' => '4040-478', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 24, 'unit_type_id' => 3, 'number' => 24, 'floor' => -1, 'rol' => '4040-479', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 25, 'unit_type_id' => 3, 'number' => 25, 'floor' => -1, 'rol' => '4040-480', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 26, 'unit_type_id' => 3, 'number' => 26, 'floor' => -1, 'rol' => '4040-481', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 27, 'unit_type_id' => 3, 'number' => 27, 'floor' => -1, 'rol' => '4040-482', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 28, 'unit_type_id' => 3, 'number' => 28, 'floor' => -1, 'rol' => '4040-483', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 29, 'unit_type_id' => 3, 'number' => 29, 'floor' => -1, 'rol' => '4040-484', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 30, 'unit_type_id' => 3, 'number' => 30, 'floor' => -1, 'rol' => '4040-485', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 31, 'unit_type_id' => 3, 'number' => 31, 'floor' => -1, 'rol' => '4040-486', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 32, 'unit_type_id' => 3, 'number' => 32, 'floor' => -1, 'rol' => '4040-487', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 33, 'unit_type_id' => 3, 'number' => 33, 'floor' => -1, 'rol' => '4040-488', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 34, 'unit_type_id' => 3, 'number' => 34, 'floor' => -1, 'rol' => '4040-489', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 35, 'unit_type_id' => 3, 'number' => 35, 'floor' => -1, 'rol' => '4040-490', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 36, 'unit_type_id' => 3, 'number' => 36, 'floor' => -1, 'rol' => '4040-491', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 37, 'unit_type_id' => 3, 'number' => 37, 'floor' => -1, 'rol' => '4040-492', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 38, 'unit_type_id' => 3, 'number' => 38, 'floor' => -1, 'rol' => '4040-493', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 39, 'unit_type_id' => 3, 'number' => 39, 'floor' => -1, 'rol' => '4040-494', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 40, 'unit_type_id' => 3, 'number' => 40, 'floor' => -1, 'rol' => '4040-495', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 41, 'unit_type_id' => 3, 'number' => 41, 'floor' => -1, 'rol' => '4040-496', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 42, 'unit_type_id' => 3, 'number' => 42, 'floor' => -1, 'rol' => '4040-497', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 43, 'unit_type_id' => 3, 'number' => 43, 'floor' => -1, 'rol' => '4040-498', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 44, 'unit_type_id' => 3, 'number' => 44, 'floor' => -1, 'rol' => '4040-499', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 45, 'unit_type_id' => 3, 'number' => 45, 'floor' => -1, 'rol' => '4040-500', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 46, 'unit_type_id' => 3, 'number' => 46, 'floor' => -1, 'rol' => '4040-501', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 47, 'unit_type_id' => 3, 'number' => 47, 'floor' => -1, 'rol' => '4040-502', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 48, 'unit_type_id' => 3, 'number' => 48, 'floor' => -1, 'rol' => '4040-503', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 49, 'unit_type_id' => 3, 'number' => 49, 'floor' => -1, 'rol' => '4040-504', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 50, 'unit_type_id' => 3, 'number' => 50, 'floor' => -1, 'rol' => '4040-505', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 51, 'unit_type_id' => 3, 'number' => 51, 'floor' => -1, 'rol' => '4040-506', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 52, 'unit_type_id' => 3, 'number' => 52, 'floor' => -1, 'rol' => '4040-507', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 53, 'unit_type_id' => 3, 'number' => 53, 'floor' => -1, 'rol' => '4040-508', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 54, 'unit_type_id' => 3, 'number' => 54, 'floor' => -1, 'rol' => '4040-509', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 55, 'unit_type_id' => 3, 'number' => 55, 'floor' => -1, 'rol' => '4040-510', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 56, 'unit_type_id' => 3, 'number' => 56, 'floor' => -1, 'rol' => '4040-511', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 57, 'unit_type_id' => 3, 'number' => 57, 'floor' => -1, 'rol' => '4040-512', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 58, 'unit_type_id' => 3, 'number' => 58, 'floor' => -1, 'rol' => '4040-513', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 59, 'unit_type_id' => 3, 'number' => 59, 'floor' => -1, 'rol' => '4040-514', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 60, 'unit_type_id' => 3, 'number' => 60, 'floor' => -1, 'rol' => '4040-515', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 61, 'unit_type_id' => 3, 'number' => 61, 'floor' => -1, 'rol' => '4040-516', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 62, 'unit_type_id' => 3, 'number' => 62, 'floor' => -1, 'rol' => '4040-517', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 63, 'unit_type_id' => 3, 'number' => 63, 'floor' => -1, 'rol' => '4040-518', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 64, 'unit_type_id' => 3, 'number' => 64, 'floor' => -1, 'rol' => '4040-519', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 65, 'unit_type_id' => 3, 'number' => 65, 'floor' => -1, 'rol' => '4040-520', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 66, 'unit_type_id' => 3, 'number' => 66, 'floor' => -1, 'rol' => '4040-521', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 67, 'unit_type_id' => 3, 'number' => 67, 'floor' => -1, 'rol' => '4040-522', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 68, 'unit_type_id' => 3, 'number' => 68, 'floor' => -1, 'rol' => '4040-523', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 69, 'unit_type_id' => 3, 'number' => 69, 'floor' => -1, 'rol' => '4040-524', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 70, 'unit_type_id' => 3, 'number' => 70, 'floor' => -1, 'rol' => '4040-525', 'surface' => 38.61, 'proration' => 2.368],
            ['correlative' => 71, 'unit_type_id' => 3, 'number' => 71, 'floor' => -1, 'rol' => '4040-526', 'surface' => 38.61, 'proration' => 2.368],
        ];

        DB::table('units')->insert($units);
    }
}
