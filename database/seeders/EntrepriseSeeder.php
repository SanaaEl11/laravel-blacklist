<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\Secteur;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run()
    {
        $secteurs = Secteur::all();

        if ($secteurs->isEmpty()) {
            // Empêcher les erreurs en cas de table vide
            $this->command->warn('No secteurs found! Make sure to seed the Secteur table first.');
            return;
        }

        Entreprise::factory()
            ->count(20)
            ->create();
    }
}
