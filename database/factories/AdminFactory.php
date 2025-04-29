<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'motdepasse' => Hash::make('admin123'),
            'blacklist' => $this->faker->boolean(5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}