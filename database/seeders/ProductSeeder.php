<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $entreprises = Entreprise::all();
        $types = TypeProduct::all();

        if ($entreprises->isEmpty()) {
            $this->command->warn('No entreprises found! Make sure to seed the Entreprise table first.');
            return;
        }

        if ($types->isEmpty()) {
            $this->command->warn('No type products found! Make sure to seed the TypeProduct table first.');
            return;
        }

        Product::factory()->count(50)->create();
    }
}
