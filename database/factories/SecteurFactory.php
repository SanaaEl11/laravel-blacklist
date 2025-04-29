<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SecteurFactory extends Factory
{
    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->randomElement([
                'Informatique', 'Agriculture', 'Bâtiment', 
                'Commerce', 'Industrie', 'Services'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}