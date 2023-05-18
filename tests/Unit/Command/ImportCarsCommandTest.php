<?php

namespace Tests\Unit\Command;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ImportCarsCommandTest extends TestCase
{
    public function testShouldImportCarsByJsonFile()
    {
        Artisan::call('command:import-cars');

        $carTypes = CarType::with(['models'])->get();
        $this->assertIsObject($carTypes);
        $this->assertNotNull($carTypes);
        $this->assertNotEmpty($carTypes);

        $cars = Car::get();
        $this->assertIsObject($cars);
        $this->assertNotNull($cars);
        $this->assertNotEmpty($cars);

        $response = Artisan::output();

        $this->assertEmpty($response);
    }
}
