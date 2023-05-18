<?php

namespace Tests\Unit\Command;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ImportCarsCommandTest extends TestCase
{
    use DatabaseTransactions;

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
