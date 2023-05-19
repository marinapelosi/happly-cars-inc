<?php

namespace Database\Seeders;

use App\Models\UsersLocation;
use Illuminate\Database\Seeder;

class UsersLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersLocation::factory(10)->create();
    }
}
