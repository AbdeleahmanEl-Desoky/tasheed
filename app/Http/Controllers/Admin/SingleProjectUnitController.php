<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleProjectRequest;
use App\Models\Feature;
use App\Models\FeatureUnit;
use App\Models\SingleProject;
use App\Models\SingleProjectUnit;
use Illuminate\Http\Request;

class SingleProjectUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($project_id)
    {
        $singleProjecttUnits = SingleProjectUnit::with('project')->where('single_project_id',$project_id)->paginate(10);

        return view('dashboard.project.single.unit.index', compact('singleProjecttUnits','project_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($project_id)
    {
        $features = FeatureUnit::all();

        return view('dashboard.project.single.unit.create', compact('features','project_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'single_project_id' => 'required|integer|exists:single_projects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'number_room' => 'required|array',
            'name_room' => 'required|array',
            'number_room.*' => 'required|string',
            'name_room.*' => 'required|string',
            'feature_id' => 'array',
            'feature_id.*' => 'integer|exists:features,id',
            'caver.*' => 'nullable|file|mimes:jpg,jpeg,png',
            'gallery.*' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        // Ensure the arrays match in size
        if (count($request->number_room) !== count($request->name_room)) {
            return redirect()->back()->withErrors(['room' => __('Room numbers and names must match.')]);
        }

        // Combine room numbers and names into a single array
        $rooms = [];
        foreach ($request->number_room as $index => $room_number) {
            $rooms[] = [
                'room_number' => $room_number,
                'room_name' => $request->name_room[$index]
            ];
        }

        // Encode combined rooms as JSON
        $roomsJson = json_encode($rooms);

        // Create the new single project unit
        $singleProjectUnit = new SingleProjectUnit();
        $singleProjectUnit->single_project_id = $request->single_project_id;
        $singleProjectUnit->title = $request->title;
        $singleProjectUnit->description = $request->description;
        $singleProjectUnit->data = $roomsJson; // Save JSON-encoded data in the 'data' column

        // Save the single project unit
        $singleProjectUnit->save();

        // Handle caver file uploads
        if ($request->hasFile('caver')) {
            $singleProjectUnit->addMultipleMediaFromRequest(['caver'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('singleProjectCaver');
            });
        }

        // Handle gallery file uploads
        if ($request->hasFile('gallery')) {
            $singleProjectUnit->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('3d');
            });
        }

        // Attach selected unit features to the project
        if ($request->has('feature_unit_id')) {
            $singleProjectUnit->unitFeatures()->sync($request->input('feature_unit_id'));
        }

        return redirect()->route('dashboard.project.single.unit.index',$request->single_project_id)->with('success', __('Project unit added successfully.'));
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
        $singleProjectUnit = SingleProjectUnit::find($id);
        $features = FeatureUnit::all();
        $project_id = $singleProjectUnit->single_project_id;

        return view('dashboard.project.single.unit.edit', compact('singleProjectUnit', 'features', 'project_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate the request data
        $request->validate([
            'single_project_id' => 'required|integer|exists:single_projects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'number_room' => 'required|array',
            'name_room' => 'required|array',
            'number_room.*' => 'required|string',
            'name_room.*' => 'required|string',
            'feature_id' => 'array',
            'feature_id.*' => 'integer|exists:features,id',
            'caver.*' => 'nullable|file|mimes:jpg,jpeg,png',
            'gallery.*' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        // Ensure the arrays match in size
        if (count($request->number_room) !== count($request->name_room)) {
            return redirect()->back()->withErrors(['room' => __('Room numbers and names must match.')]);
        }

        // Combine room numbers and names into a single array
        $rooms = [];
        foreach ($request->number_room as $index => $room_number) {
            $rooms[] = [
                'room_number' => $room_number,
                'room_name' => $request->name_room[$index]
            ];
        }

        // Encode combined rooms as JSON
        $roomsJson = json_encode($rooms);

        // Find the existing SingleProjectUnit
        $singleProjectUnit = SingleProjectUnit::find($id);
        $singleProjectUnit->single_project_id = $request->single_project_id;
        $singleProjectUnit->title = $request->title;
        $singleProjectUnit->description = $request->description;
        $singleProjectUnit->data = $roomsJson; // Save JSON-encoded data in the 'data' column

        // Save the updated single project unit
        $singleProjectUnit->save();

        // Handle caver file uploads
        if ($request->hasFile('caver')) {
            $singleProjectUnit->clearMediaCollection('singleProjectCaver');
            $singleProjectUnit->addMultipleMediaFromRequest(['caver'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('singleProjectCaver');
            });
        }

        // Handle gallery file uploads
        if ($request->hasFile('gallery')) {
            $singleProjectUnit->clearMediaCollection('3d');
            $singleProjectUnit->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('3d');
            });
        }

        // Attach selected unit features to the project
        if ($request->has('feature_unit_id')) {
            $singleProjectUnit->unitFeatures()->sync($request->input('feature_unit_id'));
        } else {
            $singleProjectUnit->unitFeatures()->detach(); // Detach all features if none are selected
        }

        return redirect()->route('dashboard.project.single.unit.index', $request->single_project_id)->with('success', __('Project unit updated successfully.'));
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
