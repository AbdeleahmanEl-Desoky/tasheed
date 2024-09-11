<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::paginate(10);

        return view('dashboard.project.feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        $feature = Feature::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $feature->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('feature');
            });
        }

        return redirect()->route('dashboard.project.features.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $feature = Feature::find($id);

        return view('dashboard.project.feature.show',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $feature = Feature::find($id);

        return view('dashboard.project.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request, int $id)
    {
        $feature = Feature::find($id);

        if ($request->hasFile('file'))
        {
            $feature->clearMediaCollection('feature');

            $feature->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('feature');
            });
        }

        $feature->update($request->except('file'));

        return redirect()->route('dashboard.project.features.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $feature  = Feature::find($id);

        $feature->clearMediaCollection('feature');

        $feature->delete();

        return redirect()->route('dashboard.project.features.index');
    }
}
