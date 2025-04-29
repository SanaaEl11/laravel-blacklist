<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SecteurSeeder::class,
            TypeProductSeeder::class,
            EntrepriseSeeder::class,
            AdminSeeder::class,
            TechnicienSeeder::class,
            ProductSeeder::class,
            PublicationSeeder::class,
            ObservationSeeder::class,
            ReclamationSeeder::class,
            BlacklistSeeder::class,
        ]);
    }
}