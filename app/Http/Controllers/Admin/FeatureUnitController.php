<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Http\Requests\FeatureUnitRequest;
use App\Models\Feature;
use App\Models\FeatureUnit;
use Illuminate\Http\Request;

class FeatureUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = FeatureUnit::paginate(10);

        return view('dashboard.project.feature_unit.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project.feature_unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureUnitRequest $request)
    {
        $feature = FeatureUnit::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $feature->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('featureUnit');
            });
        }

        return redirect()->route('dashboard.project.feature_unit.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $feature = FeatureUnit::find($id);

        return view('dashboard.project.feature_unit.show',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $feature = FeatureUnit::find($id);

        return view('dashboard.project.feature_unit.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureUnitRequest $request, int $id)
    {
        $feature = FeatureUnit::find($id);

        if ($request->hasFile('file'))
        {
            $feature->clearMediaCollection('featureUnit');

            $feature->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('featureUnit');
            });
        }

        $feature->update($request->except('file'));

        return redirect()->route('dashboard.project.feature_unit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $feature  = FeatureUnit::find($id);

        $feature->clearMediaCollection('featureUnit');

        $feature->delete();

        return redirect()->route('dashboard.project.feature_unit.index');
    }
}
