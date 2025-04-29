<?php

namespace Database\Seeders;

use App\Models\Reclamation;
use Illuminate\Database\Seeder;

class ReclamationSeeder extends Seeder
{
    public function run()
    {
        Reclamation::factory()->count(25)->create();
    }
}
