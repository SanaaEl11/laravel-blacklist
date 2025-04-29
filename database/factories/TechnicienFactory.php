<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicienFactory extends Factory
{
    public function definition()
    {
        return [
            'cin' => $this->faker->unique()->numerify('A########'),
            'nom' => $this->faker->name,
            'adresse' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'id_entreprise' => Entreprise::inRandomOrder()->first()->id ?? null, // Associe un technicien à une entreprise existante
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
