<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BenefitsRequest;
use App\Models\Benefit;
use Illuminate\Http\Request;

class AboutBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $benefits = Benefit::paginate(10);

        return view('dashboard.about.benefits.index',compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.about.benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BenefitsRequest $request)
    {
        $benefit = Benefit::create($request->except('file'));

        if ($request->hasFile('file'))
        {
            $benefit->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('benefit');
            });
        }

        return redirect()->route('dashboard.about.benefits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $benefit = Benefit::find($id);

        return view('dashboard.about.benefits.show',compact('benefit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $benefit = Benefit::find($id);

        return view('dashboard.about.benefits.edit',compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BenefitsRequest $request, int $id)
    {
        $benefit = Benefit::find($id);

        if ($request->hasFile('file'))
        {
            $benefit->clearMediaCollection('benefit');

            $benefit->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('benefit');
            });
        }

        $benefit->update($request->except('file'));

        return redirect()->route('dashboard.about.benefits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $benefit  = Benefit::find($id);

        $benefit->clearMediaCollection('benefit');

        $benefit->delete();

        return redirect()->route('dashboard.about.benefits.index');
    }
}
