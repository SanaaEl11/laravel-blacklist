<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder
{
    public function run()
    {
        TypeProduct::factory()
            ->count(6)
            ->sequence(
                ['nom' => 'Électronique'],
                ['nom' => 'Alimentaire'],
                ['nom' => 'Vêtement'],
                ['nom' => 'Meuble'],
                ['nom' => 'Outillage'],
                ['nom' => 'Logiciel']
            )
            ->create();
    }
}