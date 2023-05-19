<?php

namespace App\Console\Commands;

use App\Http\Requests\StoreStateRequest;
use App\Http\Resources\StateResource;
use App\Models\State;
use Faker\Core\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        if ($states = json_decode(Storage::disk('extradata')->get('states.json'))) {
            foreach ($states as $state) {
                $request = new StoreStateRequest();
                $resource = new StateResource($state);
                State::updateOrCreate($resource->toArray($request));
            }
        }

        return count($states) ?? 0;
    }
}
