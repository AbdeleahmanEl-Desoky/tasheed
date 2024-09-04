<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Requests\Request;
use App\Models\Career;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::paginate(10);

        return view('dashboard.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers = career::get();

        return view('dashboard.job.create',compact('careers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
      //   return $request->all();
        // Create the single project
        $job = Job::create($request->all());



        return redirect()->route('dashboard.job.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     return   $job = Job::find($id);

        return view('dashboard.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $careers = career::get();
        $job = Job::find($id);

        return view('dashboard.career.edit', compact('job','careers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, int $id)
    {
        $job = Job::find($id);

        // Update the project
        $job->update($request->all());

        return redirect()->route('dashboard.job.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $job = Job::find($id);

        // Delete the project
        $job->delete();

        return redirect()->route('dashboard.job.index');
    }
}
