<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReclamationFactory extends Factory
{
    public function definition()
    {
        return [
            'publication_id' => Publication::inRandomOrder()->first()->id ?? null, // Associe une publication existante
            'reclamation' => $this->faker->paragraph,
            'date_creation' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'nom_entreprise_post' => $this->faker->company,
            'nom_entreprise_fraud' => $this->faker->company,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
