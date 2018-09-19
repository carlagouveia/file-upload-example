<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\LoadLocationFiles;
use App\Location;

class LoadLocationFilesTest extends TestCase
{
    public function testIsParsingCsv()
    {
        $job = new LoadLocationFiles(file_get_contents(base_path('tests/fixtures/zipcodes.csv')));
        $output = $job->getLocationsFromCsv();

        $expected = new Location();
        $expected->zipcode = '00601';
        $expected->city = 'ADJUNTAS';
        $expected->state = 'PR';
        $expected->country = 'ADJUNTAS';

        $this->assertInternalType('array', $output);
        $this->assertEquals($expected, $output[0]);
    }
}
