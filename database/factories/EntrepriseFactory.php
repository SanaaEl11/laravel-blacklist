<?php

namespace Database\Factories;

use App\Models\Secteur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class EntrepriseFactory extends Factory
{
    public function definition()
    {
        return [
            'ice' => 'ICE' . $this->faker->unique()->numerify('########'),
            'rc' => 'RC' . $this->faker->unique()->numerify('########'),
            'username' => $this->faker->unique()->userName,
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'motdepasse' => Hash::make('password'),
            'date_creation' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'status' => $this->faker->boolean(90),
            'admin' => $this->faker->boolean(10),
            'id_secteur' => Secteur::inRandomOrder()->first()->id ?? null, // Ajout d'un secteur aléatoire
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
