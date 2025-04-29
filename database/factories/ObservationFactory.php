<?php
namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationFactory extends Factory
{
    public function definition()
    {
        return [
            'id_entreprise' => Entreprise::inRandomOrder()->first()->id ?? null, // Associe une entreprise existante
            'nom_entreprise_post' => $this->faker->company,
            'nom_entreprise_fraud' => $this->faker->company,
            'raison' => $this->faker->paragraph,
            'preuve_file' => 'preuve_' . $this->faker->uuid . '.pdf',
            'post_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
