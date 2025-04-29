<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    public function definition()
    {
        return [
            'rc' => 'RC' . $this->faker->numerify('########'),
            'ice' => 'ICE' . $this->faker->numerify('########'),
            'nom_entreprise_post' => $this->faker->company,
            'nom_entreprise_fraud' => $this->faker->company,
            'raison' => $this->faker->paragraph,
            'preuve_file' => 'preuve_' . $this->faker->uuid . '.pdf',
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'date_publication' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'id_entreprise' => Entreprise::inRandomOrder()->first()->id ?? null, // Associe une entreprise existante
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
