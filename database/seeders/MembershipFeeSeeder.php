<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembershipFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $users = User::with('userType')->where('is_active', true)->get();

        // // Crear cuotas para cada usuario activo (3 cuotas por usuario en promedio)
        // foreach ($users as $user) {
        //     MembershipFee::factory(rand(2, 4))->create([
        //         'user_id' => $user->id,
        //         'amount' => $user->userType->fee ?? 50.00,
        //     ]);
        // }
    }
}
