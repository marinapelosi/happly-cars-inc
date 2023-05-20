<?php

namespace App\Console\Commands;

use App\Http\Requests\StoreStateRequest;
use App\Http\Resources\StateResource;
use App\Models\State;
use App\Services\GeoLocation\LocationFinderService;
use App\Services\StateService;
use Faker\Core\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\Object_;

class ImportStatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import states located in a json default file';

    private $localizationFinder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LocationFinderService $localizationFinder)
    {
        parent::__construct();
        $this->localizationFinder = $localizationFinder;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($states = json_decode(Storage::disk('extradata')->get('states.json'))) {
            foreach ($states as $state) {
                $state = $this->updateStateLocation($state);
                $request = new StoreStateRequest();
                $resource = new StateResource($state);
                State::updateOrCreate($resource->toArray($request));
            }
        }

        return count($states) ?? 0;
    }

    public function updateStateLocation(Object $state): object
    {
        $cityState = StateService::setCityStateField($state->capital, $state->code);
        $location = $this->localizationFinder->getLocalizationByAddress($cityState);
        $state->latitude = $location['lat'];
        $state->longitude = $location['lng'];
        return $state;
    }
}
