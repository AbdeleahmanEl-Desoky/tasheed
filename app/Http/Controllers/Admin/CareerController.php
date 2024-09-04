<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareerRequest;
use App\Http\Requests\Request;
use App\Models\Career;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::paginate(10);

        return view('dashboard.career.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.career.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CareerRequest $request)
    {
      //   return $request->all();
        // Create the single project
        $career = Career::create($request->all());



        return redirect()->route('dashboard.career.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     return   $career = Career::find($id);

        return view('dashboard.career.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $career = career::find($id);


        return view('dashboard.career.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CareerRequest $request, int $id)
    {
        $career = career::find($id);

        // Update the project
        $career->update($request->all());

        return redirect()->route('dashboard.career.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $career = career::find($id);

        // Delete the project
        $career->delete();

        return redirect()->route('dashboard.career.index');
    }
}
