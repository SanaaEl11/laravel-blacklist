<?php

namespace Database\Seeders;

use App\Models\Observation;
use Illuminate\Database\Seeder;

class ObservationSeeder extends Seeder
{
    public function run()
    {
        Observation::factory()->count(30)->create();
    }
}
