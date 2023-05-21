<?php

namespace Tests\Unit\Command;

use App\Models\State;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ImportStatesCommandTest extends TestCase
{

    use DatabaseTransactions;

    public function testShouldImportStatesByJsonFile()
    {
        Artisan::call('command:import-states');
        $states = State::get();
        $this->assertIsObject($states);
        $this->assertNotNull($states);
        $response = Artisan::output();
        $this->assertEmpty($response);
    }
}
