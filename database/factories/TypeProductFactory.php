<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeProductFactory extends Factory
{
    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->randomElement([
                'Électronique', 'Alimentaire', 'Vêtement', 
                'Meuble', 'Outillage', 'Logiciel'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}