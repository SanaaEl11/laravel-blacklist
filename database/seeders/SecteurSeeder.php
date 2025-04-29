<?php

namespace Database\Seeders;

use App\Models\Secteur;
use Illuminate\Database\Seeder;

class SecteurSeeder extends Seeder
{
    public function run()
    {
        Secteur::factory()
            ->count(6)
            ->sequence(
                ['nom' => 'Informatique'],
                ['nom' => 'Agriculture'],
                ['nom' => 'Bâtiment'],
                ['nom' => 'Commerce'],
                ['nom' => 'Industrie'],
                ['nom' => 'Services']
            )
            ->create();
    }
}