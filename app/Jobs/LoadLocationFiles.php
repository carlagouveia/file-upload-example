<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Location;
use Illuminate\Support\Facades\Log;

class LoadLocationFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileContents;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileContents)
    {
        $this->fileContents = $fileContents;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $locations = $this->getLocationsFromCsv();

        try {
            DB::beginTransaction();

            foreach ($locations as $location) {
                $location->save();
            }

            DB::commit();
        } catch (Exception $e) {
            Log::error('Error loading locations in database.', $e);
            DB::rollBack();

            throw $e;
        }
    }

    public function getLocationsFromCsv()
    {
        $stream = fopen('php://memory','r+');
        fwrite($stream, $this->fileContents);
        rewind($stream);
        $header = fgetcsv($stream);
        $locations = [];

        while (($item = fgetcsv($stream)) !== false) {
            $location = new Location();
            $location->zipcode = $item[0];
            $location->city = $item[1];
            $location->state = $item[2];
            $location->country = $item[3];
            $locations[] = $location;
        }

        return $locations;
    }
}
