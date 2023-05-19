<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carsImported = Artisan::call('command:import-cars');
        $this->command->info($carsImported.' cars were imported with all your models');
    }
}
