<?php

namespace Database\Factories;

use App\Models\Entreprise;
use App\Models\TypeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'prix' => $this->faker->randomFloat(2, 10, 1000),
            'id_entreprise' => Entreprise::inRandomOrder()->first()->id ?? null, // Associe un produit à une entreprise existante
            'id_type_produit' => TypeProduct::inRandomOrder()->first()->id ?? null, // Associe un produit à un type existant
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
