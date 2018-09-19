<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCsvFile;
use App\Jobs\LoadLocationFiles;
use App\Job;

class LocationController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return view('forms/upload', compact('jobs'));
    }

    public function store(StoreCsvFile $request)
    {
        $validated = $request->validated();
        $fileContents = file_get_contents($validated['csv_file']->getRealPath());

        // Ideally we would dispatch the filepath on S3 instead of its contents
        LoadLocationFiles::dispatch($fileContents);

        return redirect()->home();
    }
}
