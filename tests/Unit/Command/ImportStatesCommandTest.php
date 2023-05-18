<?php

namespace Tests\Unit\Command;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ImportStatesCommandTest extends TestCase
{

    use DatabaseTransactions;

    public function testShouldImportStatesByJsonFile()
    {
        Artisan::call('command:import-states');
        $response = Artisan::output();
        $this->assertEmpty($response);
    }
}
