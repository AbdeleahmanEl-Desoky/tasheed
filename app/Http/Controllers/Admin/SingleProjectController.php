<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleProjectRequest;
use App\Models\Feature;
use App\Models\SingleProject;
use Illuminate\Http\Request;

class SingleProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $singleProjects = SingleProject::paginate(10);

        return view('dashboard.project.single.index', compact('singleProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::all();

        return view('dashboard.project.single.create', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //   return $request->all();
        // Create the single project
        $singleProject = SingleProject::create($request->except('caver', 'feature_id','gallery'));

        // Handle file upload
        if ($request->hasFile('caver')) {
            $singleProject->addMultipleMediaFromRequest(['caver'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('singleProjectCaver');
            });
        }
        // Handle file upload
        if ($request->hasFile('gallery')) {
            $singleProject->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('singleProjectGallery');
            });
        }


        // Attach selected features to the project
        if ($request->has('feature_id')) {
            $singleProject->features()->sync($request->input('feature_id'));
        }

        return redirect()->route('dashboard.project.single.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $singleProject = SingleProject::find($id);

        return view('dashboard.project.single.show', compact('singleProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $singleProject = SingleProject::find($id);
        $features = Feature::all();

        return view('dashboard.project.single.edit', compact('singleProject', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SingleProjectRequest $request, int $id)
    {
        $singleProject = SingleProject::find($id);

        // Handle file upload
        if ($request->hasFile('file')) {
            $singleProject->clearMediaCollection('singleProjectCaver');

            $singleProject->addMultipleMediaFromRequest(['caver'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('singleProjectCaver');
            });
        }

        // Update the project
        $singleProject->update($request->except('caver', 'features'));

        // Sync selected features to the project
        if ($request->has('features')) {
            $singleProject->features()->sync($request->input('features'));
        } else {
            $singleProject->features()->detach(); // Detach all features if none are selected
        }

        return redirect()->route('dashboard.project.single.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $singleProject = SingleProject::find($id);

        // Clear media collection
        $singleProject->clearMediaCollection('singleProjectCaver');

        // Delete the project
        $singleProject->delete();

        return redirect()->route('dashboard.project.single.index');
    }
}
