<?php

namespace Database\Seeders;

use App\Console\Commands\ImportStatesCommand;
use App\Models\CarLocation;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('------------------------------------');
        $this->command->info('------------------------------------');
        $this->command->info("Hi. Let's start!");
        $this->call(UserAdminSeeder::class);
        $this->command->info("Here's your admin user");
        $this->command->info("Email: admin@happly.ai");
        $this->command->info("Password: password");

        $this->command->info('------------------------------------');
        $this->command->info('We can populate the database dynamically. This option is great for already running the import commands and making some relationships between the entities.');
        $dinamic = $this->command->ask('Type yes + enter to populate the database dynamically. Otherwise, press anything');

        if ($dinamic === 'yes') {
            $this->command->info('---------');
            $this->command->info('Yeah!');
            $this->command->info('Generating non staff users');
            $this->call(UserSeeder::class);
            $this->command->info('5 users were created');

            $this->command->info('---------');
            $this->command->info('Importing states by states.json');
            $this->call(StateSeeder::class);

            $this->command->info('---------');
            $this->command->info('Importing cars by cars.json');
            $this->call(CarSeeder::class);

            $this->command->info('---------');
            $this->command->info('Creating random cars locations');
            $this->call(CarLocationSeeder::class);
            $this->command->info('20 cars locations were created');

            $this->command->info('---------');
            $this->command->info('Receiving random delivery requests');
            $this->call(DeliverySeeder::class);
            $this->command->info('Some cars could be already delivered. Others could be waiting for delivery');

            $this->command->info('---------');
            $this->command->info('Thats it! Seedling done. Enjoy!');

            exit;
        }

        $this->command->info("No? Aw...anyway... you have the admin user so you can create anything using the api instructions on documentation.");
        $this->command->info('Thats it! Enjoy the software!');
    }
}
