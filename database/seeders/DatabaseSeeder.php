<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Inerba\DbConfig\DbConfig;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DbConfig::set('system.company_name', 'Diablada Morenada Pueblo de Tarapacá');
        DbConfig::set('system.company_rut', '76.123.456-7');
        DbConfig::set('system.company_logo', 'logo.png');
        DbConfig::set('system.company_address', 'Av. Siempre Viva 123');
        DbConfig::set('system.company_phone', '+56 2 1234 5678');
        DbConfig::set('system.company_email', 'contacto@diabladamorenada.cl');
        DbConfig::set('system.preapproval_plan_id', '5d1c9a13ef5446478e23ad65d98cb416');
        DbConfig::set('system.subscription', false);
        DbConfig::set('system.subscription_at', null);
        DbConfig::set('system.months_with_fees', '1,2,3,4,5,6,7,8,9,10,11,12');
        DbConfig::set('system.reserve_percent', 5);
        DbConfig::set('system.mora_percent', 10);
        DbConfig::set('system.links', ['Youtube' => 'https://www.youtube.com']);

        // Create necessary directories
        if (! is_dir(storage_path('app/public/users/photos'))) {
            mkdir(storage_path('app/public/users/photos'), 0755, true);
        }

        copy(resource_path('logos/diablada_morenada_pueblo_tarapaca.png'), storage_path('app/public/logo.png'));
        copy(resource_path('logos/avatar_tesorero.jpg'), storage_path('app/public/users/photos/avatar_tesorero.jpg'));
        copy(resource_path('logos/avatar_presidente.jpg'), storage_path('app/public/users/photos/avatar_presidente.jpg'));
        copy(resource_path('logos/avatar_caporal.jpg'), storage_path('app/public/users/photos/avatar_caporal.jpg'));

        // DbConfig::set('system.company_name', 'Sociedad Religiosa Siervos de María');
        // copy(resource_path('logos/siervos_de_maria.png'), public_path('logo.png'));

        $this->call([
            UserSeeder::class,
            AccountSeeder::class,
            ExpenseTypeSeeder::class,
            IncomeTypeSeeder::class,
            NewsSeeder::class,
        ]);

        $this->call([
            UnitTypeSeeder::class,
            UnitSeeder::class,
        ]);

        // command fees:generate 2025
        $this->call([
            IncomeSeeder::class,
            ExpenseSeeder::class,
        ]);

    }
}
