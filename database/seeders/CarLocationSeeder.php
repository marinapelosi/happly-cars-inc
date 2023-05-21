<?php

namespace Database\Seeders;

use App\Models\CarLocation;
use Illuminate\Database\Seeder;

class CarLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarLocation::factory(500)->create();
    }
}
