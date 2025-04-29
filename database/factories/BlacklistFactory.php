<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blacklist>
 */
class BlacklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'id_entreprise' => \App\Models\Entreprise::factory(),
        'nom_entreprise_post' => $this->faker->company,
        'nom_entreprise_fraud' => $this->faker->company,
        'raison' => $this->faker->paragraph,
        'preuve_file' => $this->faker->optional()->fileExtension,
        'post_date' => $this->faker->dateTimeThisYear,
    ];
}
}
