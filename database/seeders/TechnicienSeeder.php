<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\Technicien;
use Illuminate\Database\Seeder;

class TechnicienSeeder extends Seeder
{
    public function run()
    {
        $entreprises = Entreprise::all();

        if ($entreprises->isEmpty()) {
            $this->command->warn('No entreprises found! Make sure to seed the Entreprise table first.');
            return;
        }

        Technicien::factory()
            ->count(30)
            ->create();
    }
}

