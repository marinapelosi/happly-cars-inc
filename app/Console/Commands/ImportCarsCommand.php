<?php

namespace App\Console\Commands;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\StoreCarTypeRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarTypeResource;
use App\Models\Car;
use App\Models\CarType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportCarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import car data located in a json default file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($cars = json_decode(Storage::disk('extradata')->get('cars.json'))) {
            $this->importCars($cars);
        }

        return 0;
    }

    public function importCars(array $carTypes): void
    {
        foreach ($carTypes as $type) {
            $carTypeInserted = $this->importCarType($type);
            $this->importCarModels($carTypeInserted, $type->models);
        }
    }

    public function importCarModels(int $carType, array $models): void
    {
        $request = new StoreCarRequest();

        foreach ($models as $key => $model) {
            $model->car_type = $carType;
            $resource = new CarResource($model);
            Car::updateOrCreate($resource->toArray($request));
        }
    }

    public function setCarTypeOnCarModels(int $carType, array $models): array
    {
        $cars = $models;

        foreach ($models as $key => $model) {
            $cars[$key]->car_type = $carType;
        }

        return $cars;
    }

    public function importCarType(Object $type): int
    {
        $request = new StoreCarTypeRequest();
        $resource = new CarTypeResource($type);
        return CarType::updateOrCreate($resource->toArray($request))->id;
    }
}
